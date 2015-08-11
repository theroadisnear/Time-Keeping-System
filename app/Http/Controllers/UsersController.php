<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AccountLogs;
use App\Users;
use App\Accounts;
use App\Images;
use App\Shifts;
use Illuminate\Http\Request;
use Validator;
use Date;

use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		if(Auth::check())
        {
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathguard());
			else
			{
				$users = Users::paginate(15);
				return view('users.students', compact('users'));
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
			else
				return view('users.create');
		}
		else
			return view('auth/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
		$this->validate($request, ['usernumber' => 'required|unique:users|integer', 
            'lastname' => 'required|min:2|max:50', 
            'firstname' => 'required|min:2|max:50',
            'middleinitial' => 'required|min:1|max:1',
            'department' => 'required',
            'birthday' => 'required|date_format:"Y-m-d"|before:2010-01-01|after:1899-12-31',
            'idpicture' => 'required|image'

            ]);

        $users = new Users;

        $users->usernumber = $request->usernumber;
        $users->lastname = $request->lastname;
        $users->firstname = $request->firstname;
        $users->middleinitial = $request->middleinitial;
        $users->birthday = $request->birthday;
        $users->department = $request->department;

        $users->save();

        $imageName = $users->id.'.'.$request->file('idpicture')->getClientOriginalExtension();
        $path = base_path().'/public/images/idpictures/';
        $request->file('idpicture')->move(base_path().'/public/images/idpictures/', $imageName);

        $images = new Images;
        $images->idpicture = '/images/idpictures/'.$users->id.'.'.$request->file('idpicture')->getClientOriginalExtension();
        $images->user_id = $users->id;
        $images->save();

        $image = Image::make(base_path().'/public/images/idpictures/'.$imageName)->resize(350, 350);
        $image->save(base_path().'/public/images/idpictures/'.$imageName);
        if (($request->official_time_in != null) && ($request->official_time_in != null))
        {
            $shifts = new Shifts;
            $shifts->user_id = $users->id;
            $shifts->official_time_in = date("H:i", strtotime($request->official_time_in));
            $shifts->official_time_out = date("H:i", strtotime($request->official_time_out)); //echo date("H:i", strtotime("04:25 PM"));

            $shifts->save();
        }
        $account = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $users->id;
		$accountlog->account_id = $account->id;
		$accountlog->name = 'User';
		$accountlog->message_logs = $account->username.' has successfully created a new user with id number "'.$users->usernumber.'"'; 
		$accountlog->save();
		
        return redirect('users');
    }

	public function newShift(Request $request)
	{
		$this->validate($request, ['official_time_in' => 'required', 
            'official_time_out' => 'required',
            ]);
		$user = Users::where('usernumber', $request->usernumber)->first();
		$shifts = new Shifts;
        $shifts->user_id = $user->id;
        $shifts->official_time_in = date("H:i", strtotime($request->official_time_in));
        $shifts->official_time_out = date("H:i", strtotime($request->official_time_out)); //echo date("H:i", strtotime("04:25 PM"));

        $shifts->save();

		$account = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $user->id;
		$accountlog->account_id = $account->id;
		$accountlog->name = 'User';
		$accountlog->message_logs = $account->username.' has successfully created a new shift with id number "'.$user->usernumber.'"'; 
		$accountlog->save();


		return redirect('users');
	}
    public function show($id)
    {
		if(Auth::check())
        {
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathguard());
			else
				{
					$user = Users::findOrFail($id);
					$image = Images::findOrFail($id);
					$shift = Shifts::where('user_id', $id)->first();
					return view('users.view', compact('user'))->with(compact('image'))->with(compact('shift'));
				}
		}
		else
			return view('auth/login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Users::findOrFail($id);
        $image = Images::findOrFail($id);
        $shift = Shifts::where('user_id', $id)->first();
		if(Auth::check())
        {
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathguard());
			else
				return view('users.edit', compact('user'))->with(compact('image'))->with(compact('shift'));
		}
		else
			return view('auth/login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {	
        $this->validate($request, ['usernumber' => 'required|integer|unique:users,usernumber,'.$request->id, 
            'lastname' => 'required|min:2|max:50', 
            'firstname' => 'required|min:2|max:50',
            'middleinitial' => 'required|min:1|max:1',
            'department' => 'required',
            'birthday' => 'required|date_format:"Y-m-d"|before:2010-01-01|after:1899-12-31',
            'idpicture' => 'image|unique:images,idpicture,$request->id',

            ]);


        $user = Users::findOrFail($request->id);
        $shift = Shifts::where('user_id', $request->id)->first();
        $image = Images::findOrFail($request->id);

        $user->usernumber = $request->usernumber;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->middleinitial = $request->middleinitial;
        $user->birthday = $request->birthday;
        $user->department = $request->department;
        $shift->official_time_in = date("H:i", strtotime($request->official_time_in));
        $shift->official_time_out = date("H:i", strtotime($request->official_time_out));
		$shift->save();

        if($request->hasFile('idpicture'))
        {
            $imageName = $user->id.'.'.$request->file('idpicture')->getClientOriginalExtension();
            $path = base_path().'/public/images/idpictures/';
            $request->file('idpicture')->move(base_path().'/public/images/idpictures/', $imageName);

            
            $image->idpicture = '/images/idpictures/'.$user->id.'.'.$request->file('idpicture')->getClientOriginalExtension();
            $image->user_id = $user->id;
            $image->save();

            $image = Image::make(base_path().'/public/images/idpictures/'.$imageName)->resize(350, 350);
            $image->save(base_path().'/public/images/idpictures/'.$imageName);

        }
        
        $user->save();
		
		$account = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $user->id;
		$accountlog->account_id = $account->id;
		$accountlog->name = 'User';
		$accountlog->message_logs = $account->username.' has successfully updated "'.$user->usernumber.'"'.' information'; 
		$accountlog->save();

        return redirect('users');
    }   

    public function delete(Request $request)
    {
        $user = Users::findOrFail($request->id);
		$account = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $user->id;
		$accountlog->account_id = $account->id;
		$accountlog->name = 'User';
		$accountlog->message_logs = $account->username.' has successfully deleted a user with id number "'.$user->usernumber.'"'; 

        $user->delete();
		$accountlog->save();

        return redirect('users');
    }

	public function activate(Request $request)
    {
        $user = Users::findOrFail($request->id);

        $user->activate = true;
		$user->save();
		
		$account = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $user->id;
		$accountlog->account_id = $account->id;
		$accountlog->name = 'User';
		$accountlog->message_logs = $account->username.' has successfully activated a user with id number "'.$user->usernumber.'"'; 
		$accountlog->save();

        return redirect('users');
    }

	public function deactivate(Request $request)
    {
        $user = Users::findOrFail($request->id);

        $user->activate = false;
		$user->save();
		
		$account = Accounts::findOrFail(Auth::id());
		$accountlog = new AccountLogs();
		$accountlog->name_id = $user->id;
		$accountlog->account_id = $account->id;
		$accountlog->name = 'User';
		$accountlog->message_logs = $account->username.' has successfully deactivated a user with id number "'.$user->usernumber.'"'; 
		$accountlog->save();

        return redirect('users');
    }
	public function redirectPathguard()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/attendance/index';
    }
}
