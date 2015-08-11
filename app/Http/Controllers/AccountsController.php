<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\HTML;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use App\Accounts;
use App\AccountLogs;
use App\Images;
use App\Users;
use App\Shifts;

use Validator;

class AccountsController extends Controller
{
    public function index()
    {
		if(Auth::check()){
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathguard());
			else if (Auth::user()->role=="officer")
				return redirect('users');
			else
			{
				$accounts = Accounts::paginate(15);
				return view('accounts.index', compact('accounts'));
			}
		}
		else
			return view('auth/login');
			
    }
    public function create()
    {
		if(Auth::check())
		{
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathguard());
			else if (Auth::user()->role=="officer")
				return redirect('users');
			else
				return view('accounts.create');
		}
		else
			return view('auth/login');
    }
    public function store(Request $request)
    {
		$this->validate($request, [
			'usernumber' => 'exists:users,usernumber|unique:accounts,usernumber,'.$request->id,
			'username' => 'required|unique:accounts,username|min:6',
			'password' => 'required|min:6|confirmed',
			'role' => 'required|in:officer,administrator'
			]);

		$account = new Accounts;
		
		$account->username = $request->username;
		$account->password = $request->password;
		$account->role = $request->role;
		if($request->usernumber !=null)
		{
			$account->usernumber = $request->usernumber;
		}
		else if($request->usernumber == null)
		{
			$account->usernumber = null;
		}

		$account->save();
		
		$accountAuth = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $account->id;
		$accountlog->account_id = $accountAuth->id;
		$accountlog->name = 'Account';
		$accountlog->message_logs = $accountAuth->username.' has successfully created a new account with username "'.$account->username.'"'; 
		$accountlog->save();

        return redirect('accounts');
    }
    public function show($id)
    {
		if(Auth::check())
        {
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathguard());
			else if (Auth::user()->role=="officer")
				return redirect('users');
			else
			{
				$account = Accounts::findOrFail($id);
				$accountLogs = AccountLogs::where('account_id', $id)->get();
				if($account->usernumber)
				{
					$user = Users::where('usernumber', $account->usernumber)->firstOrFail();
					$shift = Shifts::where('user_id', $user->id)->firstOrFail();
					$image = Images::where('user_id', $user->id)->firstOrFail();
				}
				return view('accounts.view')->with(compact('account'))->with(compact('accountLogs'))->with(compact('user'))->with(compact('shift'))->with(compact('image'));
			}
		}
		else
			return view('auth/login');
    }
    public function edit($id)
    {
		$account = Accounts::findOrFail($id);
		$accountLogs = AccountLogs::where('account_id', $id)->get();
		return view('accounts.edit', compact('account'))->with(compact('accountLogs'));
    }
	public function resetPass($id)
    {
        $Accounts = Accounts::findOrFail($id);
        return view('accounts.reset', compact('Accounts'));
    }
    public function passEdit()
    {
        $Accounts = Accounts::findOrFail(Auth::user()->id);
        return view('accounts.change', compact('Accounts'));
    }
    public function resetUpdate(Request $request)
    {
        $account = Accounts::findOrFail($request->id);
        $account->password = $request->password;
        
		$accountAuth = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $account->id;
		$accountlog->account_id = $accountAuth->id;
		$accountlog->name = 'Account';
		$accountlog->message_logs = $accountAuth->username.' has successfully changed Password for username "'.$account->username.'"'; 
		$accountlog->save();
		
        $account->save();

		$accounts = Accounts::paginate(15);
        return view('accounts.index', compact('accounts'));
    }
    public function changePass(Request $request)
    {
		$this->validate($request, ['password' => 'required|min:6|max:50|confirmed',
			'password_confirmation' => 'required|min:6|max:50',
			'password_old' => 'required'

			], ['required' => 'Required',
			'integer' => 'It must be an integer', 
			'confirmed' => 'Password does not match'
			]);
		if (Hash::check($request->password_old, Auth::user()->password))
		{
			$account = Accounts::findOrFail(Auth::user()->id);
			$account->password = $request->password;
			
			$accountAuth = Accounts::findOrFail(Auth::id());
			$accountlog = new AccountLogs();
			$accountlog->name_id = $account->id;
			$accountlog->account_id = $accountAuth->id;
			$accountlog->name = 'Account';
			$accountlog->message_logs = $accountAuth->username.' has successfully changed Password for username "'.$account->username.'"'; 
			$accountlog->save();
			
			$account->save();

			if (Auth::user()->role!="guard")
			{
				return redirect('users');
			}
			else
			{
				return redirect('attendance.index');
			}
		}
		else
		{
			$Accounts = Accounts::findOrFail(Auth::user()->id);
			$messagess = 'Old Password does not match';
			if (Auth::user()->role!="guard")
			{
				return view('attendance/index', compact('Accounts'))->withErrors( $messagess , 'password_old' );
			}
			else
			{
				return view('attendance/index', compact('Accounts'))->withErrors( $messagess , 'password_old' );
			}
			
		}
    }
	public function delete(Request $request)
    {
        $account = Accounts::findOrFail($request->id);
		$account->delete();

		$accountAuth = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $account->id;
		$accountlog->account_id = $accountAuth->id;
		$accountlog->name = 'Account';
		$accountlog->message_logs = $accountAuth->username.' has successfully deleted an account with username "'.$account->username.'"'; 
		$accountlog->save();

        return redirect('accounts');
    }
	public function redirectPathguard()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/attendance/index';
	}
}