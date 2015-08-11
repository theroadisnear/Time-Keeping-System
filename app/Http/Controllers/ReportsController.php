<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use App\AttendanceLogs;
use App\Users;
use App\Accounts;
use App\AccountLogs;
use App\Images;
use App\Shifts;
use Illuminate\Support\Facades\Auth;
class ReportsController extends Controller
{
    public function redirectPathguard()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/attendance/index';
    }
    public function index()
    {
        if(Auth::check())
		{
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathguard());
			else	
				return view('reports.index');
		}
		else
			return view('auth/login');    
    }

	public function userLogs()
    {
		$attendanceLogs = AttendanceLogs::join('users', 'users.id', '=', 'attendance_logs.user_id')->orderBy('date_time_in', 'desc')->paginate(15);
        if(Auth::check())
			return view('reports.user_Logs')->with(compact('attendanceLogs'));
		else if (Auth::user()->role=="guard")
			return redirect()->intended($this->redirectPathguard());
		else
			return view('auth/login');
    }

	public function userLogsShowDate(Request $request)
    {
		$this->validate($request, ['start' => 'required', 
			'end' => 'required',
            ]);

		if($request->department == 'all')
		{
			$attendanceLogs = AttendanceLogs::join('users', 'users.id', '=', 'attendance_logs.user_id')
			->whereBetween('date_time_in', [Carbon::parse($request->start.' 00:00:00'), Carbon::parse($request->end.' 23:59:59')])
			->paginate(15);
			return view('reports.user_Logs')->with(compact('attendanceLogs'));
		}
		else if($request->department != 'all')
		{
			$attendanceLogs = AttendanceLogs::join('users', 'users.id', '=', 'attendance_logs.user_id')
			->where('users.department', $request->department)
			->whereBetween('date_time_in', [Carbon::parse($request->start.' 00:00:00'), Carbon::parse($request->end.' 23:59:59')])
			->paginate(15);
			return view('reports.user_Logs')->with(compact('attendanceLogs'));
		}
		
    }

	public function userLogsShowEmployeeNumber(Request $request)
    {
		$this->validate($request, ['usernumber' => 'required|integer|exists:users,usernumber'.$request->id, 
			'department' => 'required',
            ]);

		if($request->department == 'all')
		{
			$attendanceLogs = AttendanceLogs::join('users', 'users.id', '=', 'attendance_logs.user_id')
			->where('usernumber', $request->usernumber)
			->paginate(15);
			return view('reports.user_Logs')->with(compact('attendanceLogs'));
		}
		else if($request->department != 'all')
		{
			$attendanceLogs = AttendanceLogs::join('users', 'users.id', '=', 'attendance_logs.user_id')
			->where('users.department', $request->department)
			->where('usernumber', $request->usernumber)
			->paginate(15);
			return view('reports.user_Logs')->with(compact('attendanceLogs'));
		}
		
    }

	public function userLogsShowName(Request $request)
    {
		$this->validate($request, ['lastname' => 'required|exists:users,lastname'.$request->id, 
			'firstname' => 'required|exists:users,firstname'.$request->id, 
			'department' => 'required',
            ]);

		if($request->department == 'all')
		{
			$attendanceLogs = AttendanceLogs::join('users', 'users.id', '=', 'attendance_logs.user_id')
			->where('lastname', $request->lastname)->where('firstname', $request->firstname)
			->paginate(15);
			return view('reports.user_Logs')->with(compact('attendanceLogs'));
		}
		else if($request->department != 'all')
		{
			$attendanceLogs = AttendanceLogs::join('users', 'users.id', '=', 'attendance_logs.user_id')
			->where('users.department', $request->department)
			->where('lastname', $request->lastname)->where('firstname', $request->firstname)
			->paginate(15);
			return view('reports.user_Logs')->with(compact('attendanceLogs'));
		}
		
    }

	public function accountLogs()
    {
		$accountLogs = AccountLogs::join('accounts', 'accounts.id', '=', 'account_logs.account_id')->orderBy('account_logs.created_at', 'desc')->take(5)->select('account_logs.created_at AS al_created_at', 'account_logs.*', 'accounts.*')->paginate(15);
		if(Auth::check())
		{
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathguard());
			else
				return view('reports.account_Logs')->with(compact('accountLogs'));
		}
		else
			return view('auth/login');
    }

	public function accountLogsShow(Request $request)
	{
		$this->validate($request, ['start' => 'required', 
			'end' => 'required', 'logs' => 'required',
            ]);

		if($request->logs == 'all')
		{
			$accountLogs = AccountLogs::join('accounts', 'accounts.id', '=', 'account_logs.account_id')
			->whereBetween('account_logs.created_at', [Carbon::parse($request->start.' 00:00:00'), Carbon::parse($request->end.' 23:59:59')])
			->select('account_logs.created_at AS al_created_at', 'account_logs.*', 'accounts.*')->paginate(15);

			return view('reports.account_Logs')->with(compact('accountLogs'));
		}
		else if($request->logs != 'all')
		{
			$accountLogs = AccountLogs::join('accounts', 'accounts.id', '=', 'account_logs.account_id')
			->where('account_logs.name', $request->logs)
			->whereBetween('account_logs.created_at', [Carbon::parse($request->start.' 00:00:00'), Carbon::parse($request->end.' 23:59:59')])
			->select('account_logs.created_at AS al_created_at', 'account_logs.*', 'accounts.*')->paginate(15);
			return view('reports.account_Logs')->with(compact('accountLogs'));
		}
	}
}
