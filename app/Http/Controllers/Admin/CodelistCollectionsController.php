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
        
        CodelistCollection::create($requestData);

        Session::flash('flash_message', 'CodelistCollection added!');

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
        $controller = new CodelistController;
        $codelists = $controller->getCodelistSelect();
        $codelistcollection = CodelistCollection::findOrFail($id);

        return view('admin.codelist-collections.edit', compact('codelistcollection', 'codelists'));
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
        $codelistcollection->update($requestData);

        Session::flash('flash_message', 'CodelistCollection updated!');

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
        CodelistCollection::destroy($id);

        Session::flash('flash_message', 'CodelistCollection deleted!');

        return redirect('admin/codelist-collections');
    }
}
