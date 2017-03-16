<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OSEndpoint;
use Illuminate\Http\Request;
use Session;

class OSEndpointsController extends Controller
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
            $osendpoints = OSEndpoint::where('uri', 'LIKE', "%$keyword%")
				->orWhere('enabled', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $osendpoints = OSEndpoint::paginate($perPage);
        }

        return view('admin.o-s-endpoints.index', compact('osendpoints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.o-s-endpoints.create');
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
        
        OSEndpoint::create($requestData);

        Session::flash('flash_message', 'OSEndpoint added!');

        return redirect('admin/o-s-endpoints');
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
        $osendpoint = OSEndpoint::findOrFail($id);

        return view('admin.o-s-endpoints.show', compact('osendpoint'));
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
        $osendpoint = OSEndpoint::findOrFail($id);

        return view('admin.o-s-endpoints.edit', compact('osendpoint'));
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
        
        $osendpoint = OSEndpoint::findOrFail($id);
        $osendpoint->update($requestData);

        Session::flash('flash_message', 'OSEndpoint updated!');

        return redirect('admin/o-s-endpoints');
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
        OSEndpoint::destroy($id);

        Session::flash('flash_message', 'OSEndpoint deleted!');

        return redirect('admin/o-s-endpoints');
    }
}
