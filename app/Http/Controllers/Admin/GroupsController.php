<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Group;
use App\GroupTranslation;
use Illuminate\Http\Request;
use Session;

class GroupsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $groups = Group::paginate(25);

        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'en_title' => 'required|max:120',
            'en_description' => 'required|max:400',
            'el_title' => 'required|max:120',
            'el_description' => 'required|max:400',
            'code' =>'required|',
        ]);
        
        $group = Group::create($requestData);
        
        $group->translateOrNew('en')->title = $requestData["en_title"];
        
        $group->translateOrNew('en')->description = $requestData["en_description"];
        
        $group->translateOrNew('el')->title = $requestData["el_title"];
        
        $group->translateOrNew('el')->description = $requestData["el_description"];
        
        $group->save();
                
        Session::flash('flash_message', 'Group added!');

        return redirect('admin/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);

        return view('admin.groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);

        return view('admin.groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'en_title' => 'required|max:120',
            'en_description' => 'required|max:400',
            'el_title' => 'required|max:120',
            'el_description' => 'required|max:400',
            'code' =>'required|',
        ]);
        
        $group = Group::findOrFail($id);
        $group->update($requestData);

        $group->translateOrNew('en')->title = $requestData["en_title"];
        
        $group->translateOrNew('en')->description = $requestData["en_description"];
        
        $group->translateOrNew('el')->title = $requestData["el_title"];
        
        $group->translateOrNew('el')->description = $requestData["el_description"];
        
        $group->save();
        
        
        Session::flash('flash_message', 'Group updated!');

        return redirect('admin/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Group::destroy($id);

        Session::flash('flash_message', 'Group deleted!');

        return redirect('admin/groups');
    }
}
