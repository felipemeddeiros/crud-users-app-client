<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginService;
use App\Traits\ApiResponser;

class LoginController extends Controller
{
    use ApiResponser;

	/**
     * the service to consume the users service
     * @var UserService
     */
    protected $loginService;

    public function __construct(LoginService $loginService) 
    {
        $this->loginService = $loginService;
    }

    /**
     * Page to login
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.login');
    }

    /**
     * Allows the user to login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function login(Request $request) 
    {
    	$response = $this->loginService->login($request->all());

        if(isset($response->error)){
            return back()->with('error', [(array)$response->error]);
        }

        $this->loginService->setUser($response);

    	return redirect()->route('users.index');
    }

    /**
     * Allows the user to logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function logout() 
    {
        $this->loginService->logout();

        return redirect()->route('beginning');
    }
}
 