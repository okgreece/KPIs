<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Indicator;
use Illuminate\Http\Request;
use Session;

class IndicatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $indicators = Indicator::paginate(25);

        return view('admin.indicators.index', compact('indicators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.indicators.create', 
                [
                    "groups"=>$this->groups(),
                    "aggregators" => $this->aggregators(),
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
        
        $this->validate($request, [
            'en_title' => 'required|max:120',
            'en_description' => 'required|max:400',
            'el_title' => 'required|max:120',
            'el_description' => 'required|max:400',
            'nominator' =>'required|integer',
            'denominator' =>'required|integer',
            //'code' =>'required',
            'group' =>'required|integer',
            'type' =>'required|integer',
            'enabled' =>'required|boolean',
            'reverse' =>'required|boolean',
        ]);
        
        $indicator = Indicator::create($requestData);
        
        $indicator->translateOrNew('en')->title = $requestData["en_title"];
        
        $indicator->translateOrNew('en')->description = $requestData["en_description"];
        
        $indicator->translateOrNew('el')->title = $requestData["el_title"];
        
        $indicator->translateOrNew('el')->description = $requestData["el_description"];
        
        $indicator->save();

        Session::flash('flash_message', 'Indicator added!');

        return redirect('admin/indicators');
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
        $indicator = Indicator::findOrFail($id);

        return view('admin.indicators.show', compact('indicator'));
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
        $indicator = Indicator::findOrFail($id);
        
        return view('admin.indicators.edit', compact('indicator'),
                [
                    "groups"=>$this->groups(),
                    "aggregators" => $this->aggregators(),
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
        
        $this->validate($request, [
            'en_title' => 'required|max:120',
            'en_description' => 'required|max:400',
            'el_title' => 'required|max:120',
            'el_description' => 'required|max:400',
            'nominator' =>'required|integer',
            'denominator' =>'required|integer',
            //'code' =>'required',
            'group' =>'required|integer',
            'type' =>'required|integer',
            'enabled' =>'required|boolean',
            'reverse' =>'required|boolean',
        ]);
        
        $indicator = Indicator::findOrFail($id);
        $indicator->update($requestData);
        
        $indicator->translateOrNew('en')->title = $requestData["en_title"];
        
        $indicator->translateOrNew('en')->description = $requestData["en_description"];
        
        $indicator->translateOrNew('el')->title = $requestData["el_title"];
        
        $indicator->translateOrNew('el')->description = $requestData["el_description"];
        
        $indicator->save();
        
        Session::flash('flash_message', 'Indicator updated!');

        return redirect('admin/indicators');
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
        Indicator::destroy($id);

        Session::flash('flash_message', 'Indicator deleted!');

        return redirect('admin/indicators');
    }
    
    public function groups()
    {
        $groups = \App\Group::all();
        $group_select = array();
        foreach ($groups as $group) {
            $key = $group->id;
            $value = $group->title;
            $group_select = array_add($group_select, $key, $value);
        }
        return $group_select;
    }
    
    public function aggregators()
    {
        $aggregators = \App\Aggregator::all();
        $aggregators_select = array();
        foreach ($aggregators as $aggregator) {
            $key = $aggregator->id;
            $value = $aggregator->title;
            $aggregators_select = array_add($aggregators_select, $key, $value);
        }
        return $aggregators_select;
    }
    
    public function value(Request $request){
        
        $indicatorCode = $request->indicatorCode;
        $indicatorID = $request->indicatorID;
        $aggregator = new AggregatorsController;
        $indicator = Indicator::find($indicatorID);
        $request["aggregatorID"] = $indicator->nominator;
        $nominator = $aggregator->value($request)->getData();
        $request["aggregatorID"] = $indicator->denominator;
        $denominator = $aggregator->value($request)->getData();
        $result = $denominator != 0 ? $nominator / $denominator : 0;
        if($indicator->type == 0){
            $result = $result * 100;
        }
        return response()->json($result);
    }
       
    public function lineup(Request $request){
        $indicatorCode = $request->indicatorCode;
        $indicatorID = $request->indicatorID;
        $aggregator = new AggregatorsController;
        $indicator = Indicator::find($indicatorID);
        $request["aggregatorID"] = $indicator->nominator;
        $nominator = $aggregator->value($request)->getData();
        $request["aggregatorID"] = $indicator->denominator;
        $denominator = $aggregator->value($request)->getData();
        $result = $nominator / $denominator;
        return response()->json($result);
    }
    
    public function enabled(Request $request){
        $indicatorCode = $request->indicatorCode;
        $indicatorID = $request->indicatorID;
        $aggregator = new AggregatorsController;
        $indicator = Indicator::find($indicatorID);
        $request["aggregatorID"] = $indicator->nominator;
        $nominator = $aggregator->value($request)->getData();
        $request["aggregatorID"] = $indicator->denominator;
        $denominator = $aggregator->value($request)->getData();
        $result = $nominator / $denominator;
        return response()->json($result);
    }
}
