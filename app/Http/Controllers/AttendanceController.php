<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan as Artisan;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;
use App\Shifts;
use App\AttendanceLogs;
use App\Images;
use App\Accounts;

use DateTime;
use App\CustomClass\timeClass;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class AttendanceController extends Controller
{
	use AuthenticatesAndRegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		//$exitCode = Artisan::call('migrate', ['--force']);  //Migrations
		//$exitCode = Artisan::call('make:controller', ['name' => 'AccountsController']); //Create controller
		//$exitCode = Artisan::call('make:model', ['name' => 'AccountLogs']); //Create model
		$users = Auth::user();
		
		if(Auth::check())
		{
			$Accounts = Accounts::findOrFail(Auth::id());
			return view('attendance/index')->with(compact('Accounts'));
		}
		else
			return view('attendance/index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request)
    {
		$this->validate($request, ['usernumber' => 'required|integer'
			], ['required' => 'Please input your ID Number', 
			'integer' => 'It must be an integer']);
		if (Users::where('usernumber', '=', $request->usernumber)->exists())
		{
			$user = Users::where('usernumber', $request->usernumber)->first();
			$shift = Shifts::where('user_id' ,$user->id)->first();
			$image = Images::where('user_id', $user->id)->first();

			if ($user->status == false)
			{
				$user->status = true;

				$attendanceLog = new AttendanceLogs();
				$attendanceLog->user_id = $user->id;
				$attendanceLog->date_time_in = Carbon::now();

				$user->save();
				$attendanceLog->save();
			}
			else
			{
				$user->status = false;

				$matchThese = ['user_id' => $user->id, 'date_time_out' => null, 'message_logs' => null];
				$attendanceLog = AttendanceLogs::where($matchThese)->first();
				$attendanceLog->date_time_out = Carbon::now();
				
				$out = new DateTime(Carbon::parse($attendanceLog->date_time_out)->toTimeString());
				$in = new DateTime(Carbon::parse($attendanceLog->date_time_in)->toTimeString());

				$new_time_rendered =Carbon::parse($out->diff($in)->format("%H:%i:%s"));
				$attendanceLog->time_rendered = timeClass::timeCondition($in, $out, $new_time_rendered);

				$attendanceLog->message_logs = 'Successfully Log Out';

				$user->save();
				$attendanceLog->save();
			}
			return view('attendance.verification_details', compact('user'), compact('shift'))->with(compact('attendanceLog'))->with(compact('image'));
		}
		else
			return view('attendance.minion');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function stop()
    {
        $users = Users::where('status', true)->get();
        
        foreach ($users as $user) 
        {
                $matchThese = ['user_id' => $user->id, 'date_time_out' => null, 'message_logs' => null];

                $attendanceLog = AttendanceLogs::where($matchThese)->first();

                $attendanceLog->message_logs = 'Failed to log out, Forced log out by the system';
                $attendanceLog->date_time_out = Carbon::now();
                $attendanceLog->save();

                $user->status=false;
                $user->save();
        }
        $users = Auth::user();
		if(Auth::check())
		{
			$flag = 'yes';
		} else {
			$flag = 'no';
		}
       
        return view('attendance/index', array('flag' => $flag, 'users' => $users));
        //$attendanceLogs->message_logs = '';
        //$attendanceLogs->date_time_out = Carbon::now();
        //return redirect('attendance/index');
    }

}

