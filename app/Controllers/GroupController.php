<?php

namespace App\Controllers;

use App\Models\Repositories\GroupRepository;
use App\Validation\GroupValidator;

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
        $total = count($this->group->all());
        
        return view('group.index', [
            'total'       => $total,
            'count_pages' => ceil($total / 5),
            'groups'      => $this->group->paginate(5),
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
        $validator = new GroupValidator($_POST);
        
        if (!$validator->check()) {
            return redirect()->back()->with('error', $validator->firstError())->go();
        }
        
        $this->group->create($_POST);
        
        return redirect()->back()->with('success', 'Grupo cadastrado com sucesso.')->go();
    }

    /**
     * Show the form for editing the specified group.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!(int) $id) {
            return abort(404);
        }
        
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
    public function update($id)
    {
        if (!(int) $id) {
            return abort(404);
        }
        
        $validator = new GroupValidator($_POST);
        
        if (!$validator->check()) {
            return redirect()->back()->with('error', $validator->firstError())->go();
        }
        
        $this->group->update($id, $_POST);
        
        return redirect()->back()->with('success', 'Grupo editado com sucesso.')->go();
    }

    /**
     * Remove the specified group from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(int) $id) {
            return abort(404);
        }
        
        if (! $this->group->delete($id)) {
            return redirect()->back()->with('error', 'Existem usuários vinculados a este grupo, exclua primeiro os usuários.')->go();
        }
        
        return redirect()->back()->with('success', 'Grupo excluído com sucesso.')->go();
    }
}