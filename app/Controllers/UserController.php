<?php

namespace App\Controllers;

use App\Models\Repositories\UserRepository;
use App\Models\Repositories\GroupRepository;
use App\Validation\UserValidator;

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
        $total = count($this->user->all());
        
        return view('user.index', [
            'total'       => $total,
            'count_pages' => ceil($total / 5),
            'users'       => $this->user->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new GroupRepository();
        
        return view('user.create', [
            'groups' => $group->all(),
        ]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validator = new UserValidator($_POST);
        
        if (!$validator->check()) {
            return redirect()->back()->with('error', $validator->firstError())->go();
        }
        
        $this->user->create($_POST);
        
        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso.')->go();
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!(int) $id) {
            return abort(404);
        }
        
        $group = new GroupRepository();
        
        return view('user.edit', [
            'user'   => $this->user->findOrFail($id),
            'groups' => $group->all(),
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if (!(int) $id) {
            return abort(404);
        }
        
        $validator = new UserValidator($_POST);
        
        if (!$validator->check()) {
            return redirect()->back()->with('error', $validator->firstError())->go();
        }
        
        $this->user->update($id, $_POST);
        
        return redirect()->back()->with('success', 'Usuário editado com sucesso.')->go();
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(int) $id) {
            return abort(404);
        }
        
        $this->user->delete($id);
        
        return redirect()->back()->with('success', 'Usuário excluído com sucesso.')->go();
    }
}