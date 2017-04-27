<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RdfNamespace;
use Illuminate\Http\Request;
use Session;

class RdfNamespacesController extends Controller
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
            $rdfnamespaces = RdfNamespace::where('prefix', 'LIKE', "%$keyword%")
				->orWhere('url', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $rdfnamespaces = RdfNamespace::paginate($perPage);
        }

        return view('admin.rdf-namespaces.index', compact('rdfnamespaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.rdf-namespaces.create');
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
           'uri' => 'unique:rdf_namespaces|url',
           'prefix' => 'unique:rdf_namespaces|alpha_dash'
        ]);
        
        RdfNamespace::create($requestData);

        Session::flash('flash_message', 'RdfNamespace added!');

        return redirect('admin/rdf-namespaces');
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
        $rdfnamespace = RdfNamespace::findOrFail($id);

        return view('admin.rdf-namespaces.show', compact('rdfnamespace'));
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
        $rdfnamespace = RdfNamespace::findOrFail($id);

        return view('admin.rdf-namespaces.edit', compact('rdfnamespace'));
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
        
        $rdfnamespace = RdfNamespace::findOrFail($id);
        $this->validate($request, [
           'url' => 'unique:rdf_namespaces,'.$rdfnamespace->id .'|url',
           'prefix' => 'unique:rdf_namespaces,'.$rdfnamespace->id .'|alpha_dash'
        ]);
        $rdfnamespace->update($requestData);

        Session::flash('flash_message', 'RdfNamespace updated!');

        return redirect('admin/rdf-namespaces');
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
        RdfNamespace::destroy($id);

        Session::flash('flash_message', 'RdfNamespace deleted!');

        return redirect('admin/rdf-namespaces');
    }
    
    public static function setNamespaces(){
        $namespaces = \App\RdfNamespace::all();
        foreach ($namespaces as $namespace){
            \EasyRdf_Namespace::set($namespace->prefix, $namespace->url);
        }
        return;
    }
    
    public static function prefixes (){
       $namespaces = \App\RdfNamespace::all();
       $prefixes = [];
       foreach ($namespaces as $namespace){
           array_push($prefixes, [$namespace->prefix => $namespace->url]);
           
       }
       return array_collapse($prefixes);
    }
}
