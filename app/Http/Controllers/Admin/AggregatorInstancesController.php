<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AggregatorInstance;
use Illuminate\Http\Request;
use Session;
use Asparagus\QueryBuilder;
use EasyRdf;

class AggregatorInstancesController extends Controller
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
            $aggregatorinstances = AggregatorInstance::where('type', 'LIKE', "%$keyword%")
				->orWhere('resource', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $aggregatorinstances = AggregatorInstance::paginate($perPage);
        }

        return view('admin.aggregator-instances.index', compact('aggregatorinstances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $aggregators = $this->aggregatorOptions();
        return view('admin.aggregator-instances.create', compact('aggregators'));
    }
    
    public function aggregatorOptions(){
        $aggregators = \App\Aggregator::all();
        $aggregator_select = [];
        foreach($aggregators as $aggregator){
            $key = $aggregator->id;
            $value = $aggregator->title;
            $aggregator_select = array_add($aggregator_select, $key, $value);
        }
        return $aggregator_select;
        
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
            'type' =>'required|integer',
            'resource' =>'required|'
            
        ]);
        AggregatorInstance::create($requestData);

        Session::flash('flash_message', 'AggregatorInstance added!');

        return redirect('admin/aggregator-instances');
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
        $aggregatorinstance = AggregatorInstance::findOrFail($id);

        return view('admin.aggregator-instances.show', compact('aggregatorinstance'));
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
        $aggregators = $this->aggregatorOptions();
        $aggregatorinstance = AggregatorInstance::findOrFail($id);

        return view('admin.aggregator-instances.edit', compact('aggregatorinstance', 'aggregators'));
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
        
        $aggregatorinstance = AggregatorInstance::findOrFail($id);
        $aggregatorinstance->update($requestData);

        Session::flash('flash_message', 'Aggregator Instance updated!');

        return redirect('admin/aggregator-instances');
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
        AggregatorInstance::destroy($id);

        Session::flash('flash_message', 'AggregatorInstance deleted!');

        return redirect('admin/aggregator-instances');
    }
    
}
