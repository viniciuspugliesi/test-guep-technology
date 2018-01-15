<?php

namespace App\Controllers;

use App\Models\Repositories\GroupRepository;

class GroupController
{
    /**
     * @var \App\Models\Repositories\GroupRepository
     */
    private $group;
    
    /**
     * Make new instance of this class
     * 
     * @return void
     */
    public function __construct()
    {
        $this->group = new GroupRepository();
    }
    
    /**
     * Display a listing of the group.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('group.index', [
            'groups' => $this->group->all(),
        ]);
    }

    /**
     * Show the form for creating a new group.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created group in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->group->create($_POST);
        
        return redirect()->back()->withSuccess('Grupo cadastrado com sucesso.');
    }

    /**
     * Display the specified group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('group.show', [
            'group' => $this->group->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('group.edit', [
            'group' => $this->group->findOrFail($id),
        ]);
    }

    /**
     * Update the specified group in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        $this->group->update($id, $_POST);
        
        return redirect()->back()->withSuccess('Grupo editado com sucesso.');
    }

    /**
     * Remove the specified group from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->group->delete($id);
        
        return redirect()->back()->withSuccess('Grupo excluído com sucesso.');
    }
}