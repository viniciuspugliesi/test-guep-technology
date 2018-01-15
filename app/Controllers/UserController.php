<?php

namespace App\Controllers;

use App\Models\Repositories\UserRepository;

class UserController
{
    /**
     * @var \App\Models\Repositories\UserRepository
     */
    private $user;
    
    /**
     * Make new instance of this class
     * 
     * @return void
     */
    public function __construct()
    {
        $this->user = new UserRepository();
    }
    
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', [
            'users' => $this->user->all(),
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->user->create($_POST);
        
        return redirect()->back()->withSuccess('Usuário cadastrado com sucesso.');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('user.show', [
            'user' => $this->user->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('user.edit', [
            'user' => $this->user->findOrFail($id),
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        $this->user->update($id, $_POST);
        
        return redirect()->back()->withSuccess('Usuário editado com sucesso.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->user->delete($id);
        
        return redirect()->back()->withSuccess('Usuário excluído com sucesso.');
    }
}