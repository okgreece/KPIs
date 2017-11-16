<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CodelistCollection;
use Illuminate\Http\Request;
use Session;

class CodelistCollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $codelistcollections = CodelistCollection::where('codelist', 'LIKE', "%$keyword%")
				->orWhere('included', 'LIKE', "%$keyword%")
				->orWhere('excluded', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $codelistcollections = CodelistCollection::paginate($perPage);
        }

        return view('admin.codelist-collections.index', compact('codelistcollections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $controller = new CodelistController;
        request()->func = "getConcepts";
        request()->type = 0;
        $codelists = $controller->getCodelistSelect();
        
        return view('admin.codelist-collections.create', [
            "codelists" => $codelists,
        ]);
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
        
        $requestData["included"] = implode(',', $requestData["included"]);
        try{
            $requestData["excluded"] = implode(',', $requestData["excluded"]);
        } catch (\Exception $ex) {

        }

        CodelistCollection::create($requestData);

        Session::flash('flash_message', 'Codelist Collection added!');

        return redirect('admin/codelist-collections');
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
        $codelistcollection = CodelistCollection::findOrFail($id);

        return view('admin.codelist-collections.show', compact('codelistcollection'));
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
        $codelistcollection = CodelistCollection::findOrFail($id);
        $controller = new CodelistController;
        request()->func = "getConcepts";
        request()->type = 0;
        $codelists = $controller->getCodelistSelect($codelistcollection);
        return view('admin.codelist-collections.edit', [
            "codelistcollection" => $codelistcollection,
            "codelists" => $codelists,
        ]);

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
        
        $codelistcollection = CodelistCollection::findOrFail($id);
        
        $requestData["included"] = isset($requestData["included"])? implode(',', $requestData["included"]) : $codelistcollection->included;
        
        try{
            $requestData["excluded"] = isset($requestData["excluded"])? implode(',', $requestData["excluded"]) : $codelistcollection->excluded;
        } catch (\Exception $ex) {

        }
        
        $codelistcollection->update($requestData);

        Session::flash('flash_message', 'Codelist Collection updated!');

        return redirect('admin/codelist-collections');
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
        
        $instances = CodelistCollection::find($id)->instances;
        if($instances->count() != 0 ){
            foreach($instances as $instance){
                try{
                    $instance->delete();
                } catch (\Exception $ex) {
                    dd($ex);
                }            
            }
            $cascade = "Found and deleted related Aggregator instances";
        }
        else{
            $cascade = "There was no related Aggregator Instances";
        }
        
        CodelistCollection::destroy($id);
        
        Session::flash('flash_message', 'Codelist Collection deleted! ' . $cascade);

        return redirect('admin/codelist-collections');
    }
}
