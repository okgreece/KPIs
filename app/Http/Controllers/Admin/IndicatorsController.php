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
            'numerator' =>'required|integer',
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
            'numerator' =>'required|integer',
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
        //create the cache key
        $key = $this->cacheValueKey();
        
        //check if value exists in cache
        if(env("CACHE_VALUE") && \Cache::has($key)){
            $result = \Cache::get($key);
        }
        //calculate value if cache does not exist
        else{
            $result = $this->calculateValue();
        }
        //return value in json format
        return response()->json($result);
    }
    
    public function calculateValue(){
        $request = request();
        $indicatorCode = $request->indicatorCode;
        $indicatorID = $request->indicatorID;
        $aggregator = new AggregatorsController;
        $indicator = Indicator::find($indicatorID);
        $request["aggregatorID"] = $indicator->numerator;
        $numerator = $aggregator->value($request)->getData();
        $request["aggregatorID"] = $indicator->denominator;
        $denominator = $aggregator->value($request)->getData();
        $result = $denominator != 0 ? $numerator / $denominator : 0;
        if($indicator->type == 0){
            $result = $result * 100;
        }
        $key = $this->cacheValueKey();
        $rounded_result = round($result, 2);
        //cache value forever
        \Cache::add($key, $rounded_result, 60);
        return $rounded_result;
    }
    /**
     * function cacheValueKey
     * 
     * creates a json encoded cache key for each value, using the unique components
     * of the indicator building stage as is the indicator ID, organization,
     * budget phase and year
     * 
     * @param string $delimiter delimeter used between different parameters
     * @return string
     */
    public function cacheValueKey($delimiter = "_"){
        $request = request();

        $key = $request->indicatorID 
                . $delimiter
                . $request->organization
                . $delimiter
                . $request->year
                . $delimiter
                . $request->phase;
        return json_encode($key);
    }
    
    /**
     * function indicators
     * 
     * Returns all indicators description on requested language. Language can
     * be defined either automatically using browser preferences or forced by using 
     * the lang query parameter
     * 
     * @param Request $request
     * @return json 
     */
    public function indicators(Request $request){
        if(isset($request->lang)){
            \App::setLocale($request->lang);
        }        
        $indicators = \App\Indicator::all();
        return response()->json($indicators);
    }
}
