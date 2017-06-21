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
        
        $this->validate($request, $this->createValidator());
        
        $group = Group::create($requestData);
        
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

        $group = Group::findOrFail($id);

        $this->validate($request, $this->editValidator($id));
        
        $group->update($requestData);
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
    
    public function editValidator ($id){
        $rules =  [
            'code' => 'required|unique:groups,code,'.$id,            
            ];
        $translationRules = ['title' => 'required|max:150|unique:group_translations,aggregator_id,'.$id,
                             'description' => 'required|max:400'
            ];

        // Add translation rules to rules array for each defined locale.
        foreach (config('translatable.locales') as $locale) {
            foreach ($translationRules as $key => $rule) {
                $rules["$locale.$key"] = $rule;
                }
        }
        return $rules;
    }
    
    public function createValidator (){
        $rules =  [
            'code' => 'required|unique:groups,code',            
            ];
        $translationRules = ['title' => 'required|max:150|unique:group_translations,title',
                             'description' => 'required|max:400'
            ];

        // Add translation rules to rules array for each defined locale.
        foreach (config('translatable.locales') as $locale) {
            foreach ($translationRules as $key => $rule) {
                $rules["$locale.$key"] = $rule;
                }
        }
        return $rules;
    }
}
