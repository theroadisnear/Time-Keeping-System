<?php

namespace App\Http\Controllers;

use Illumiate\HTML;
use Illuminate\Http\Request;
use App\Accounts;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class AccountController extends Controller
{
    public function getLogin()
    {
        if(Auth::check())
		{
			if (Auth::user()->role=="guard")
				return redirect()->intended($this->redirectPathGuard());
			else
				return redirect()->intended($this->redirectPath());
		}
		else
			return view('auth/login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
	public function postLoginClient(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPathClient())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
    public function loginPathClient()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/attendance/index';
    }
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect()->intended($this->redirectPath());
    }
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }
    public function getLogout()
    {
        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/home');
    }
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/home';
    }
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'username';
    }
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(get_class($this))
        );
    }
    public function index()
    {
        $Accounts = Accounts::all();
        return view('list', compact('Accounts'));    
    }
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $Accounts = Accounts::findOrFail($id);
        return view('list', compact('Accounts'));
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $Accounts = Accounts::findOrFail($id)->delete();
        $Accounts = Accounts::all();
        return view('list', compact('Accounts'));
    }
    public function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/users';
    }
	public function redirectPathGuard()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/attendance/index';
    }

}
