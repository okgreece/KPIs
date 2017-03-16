<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SPARQLEndpoint;
use Illuminate\Http\Request;
use Session;

class SPARQLEndpointsController extends Controller
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
            $sparqlendpoints = SPARQLEndpoint::where('uri', 'LIKE', "%$keyword%")
				->orWhere('enabled', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $sparqlendpoints = SPARQLEndpoint::paginate($perPage);
        }

        return view('admin.s-p-a-r-q-l-endpoints.index', compact('sparqlendpoints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.s-p-a-r-q-l-endpoints.create');
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
        
        SPARQLEndpoint::create($requestData);

        Session::flash('flash_message', 'SPARQLEndpoint added!');

        return redirect('admin/s-p-a-r-q-l-endpoints');
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
        $sparqlendpoint = SPARQLEndpoint::findOrFail($id);

        return view('admin.s-p-a-r-q-l-endpoints.show', compact('sparqlendpoint'));
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
        $sparqlendpoint = SPARQLEndpoint::findOrFail($id);

        return view('admin.s-p-a-r-q-l-endpoints.edit', compact('sparqlendpoint'));
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
        
        $sparqlendpoint = SPARQLEndpoint::findOrFail($id);
        $sparqlendpoint->update($requestData);

        Session::flash('flash_message', 'SPARQLEndpoint updated!');

        return redirect('admin/s-p-a-r-q-l-endpoints');
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
        SPARQLEndpoint::destroy($id);

        Session::flash('flash_message', 'SPARQLEndpoint deleted!');

        return redirect('admin/s-p-a-r-q-l-endpoints');
    }
}
