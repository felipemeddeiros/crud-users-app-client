<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class UserController extends Controller
{
    use ApiResponser;

    /**
     * the service to consume the users service
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService) 
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->obtainUsers();

        return view('users.users', compact('users'));
    }

    /**
     * View to create a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function store(Request $request)
    {
        $response = $this->userService->createUser($request->all());

        if(isset($response->error)){
            return back()->with('error', (array)$response->error);
        }

        return redirect()->route('users.index')->with('message', 'Usuário Cadastrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        return $this->successResponse($this->userService->obtainUser($user));
    }

    /**
     * View to edit an user.
     */
    public function edit($user)
    {
        $user = $this->userService->obtainUser($user);

        return view('users.create', compact('user'));
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $response = $this->userService->editUser($request->all(), $user);

        if(isset($response->error)){
            return back()->with('error', (array)$response->error);
        }

        return redirect()->route('users.index')->with('message', 'Usuário Atualizado!');
    }

    /**
     * Delete the user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $this->userService->deleteUser($user);

        return redirect()->route('users.index')->with('message', 'Usuário Deletado!');
    }    
}
