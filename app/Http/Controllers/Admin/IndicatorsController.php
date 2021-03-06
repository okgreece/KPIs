<?php

namespace App\Http\Controllers\Admin;

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
                    "groups" => $this->groups(),
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
        
        $this->validate($request, $this->createValidator());
        
        Indicator::create($requestData);
        
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
                    "groups" => $this->groups(),
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
        
        $indicator = Indicator::findOrFail($id);
        $this->validate($request, $this->editValidator($id));
        $indicator->update($requestData);
        
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
           // logger($aggregator);
            $aggregators_select = array_add($aggregators_select, $key, $value);
        }
        return $aggregators_select;
    }
    
    public function value(Request $request){
        //create the cache key
        $key = $this->cacheValueKey();
        
        //check if value exists in cache
        if(env("VALUE_CACHE") && \Cache::has($key)){
            $result = \Cache::get($key);
        }
        //calculate value if cache does not exist
        else{
            try{
                $result = $this->calculateValue();
            }
            catch (\App\Exceptions\AggregatorInstanceNotFoundException $ex){

                throw new \App\Exceptions\IndicatorCouldNotBeCalculatedException(
                        "Indicator:" 
                        . Indicator::find($request->indicatorID)->title 
                        . " could not be calculated for this dataset. "
                        . "A proper Aggregator Instance for the codelist"
                        . " specified was not defined.");
                
            }
            catch (\Exception $ex) {
                throw $ex;
            }
            
        }
        //return value in json format
        return response()->json($result);
    }
    
    public function calculateValue(){
        $request = request();
        $aggregator = new AggregatorsController;
        $indicator = Indicator::find($request->indicatorID);
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
        //cache value
        \Cache::add($key, $rounded_result, env("CACHE_TIME"));
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
    /**
    * @SWG\Get(
    *   path="/indicators/list",
    *   summary="List Indicators",
    *   tags={"indicators"},
    *   @SWG\Response(
    *     response=200,
    *     description="A list with all available indicators."
    *   ),
    *   @SWG\Parameter(
     *         name="lang",
     *         in="query",
     *         description="Localization paremeter. Choose from available languages (en, el).",
     *         required=false,
     *         type="string",
     *         enum={"en", "el"},        
     *     ),
    * )
    */
    public function indicators(Request $request){
        if(isset($request->lang)){
            \App::setLocale($request->lang);
        }        

        $indicators = \App\Indicator::all()->map(function($item, $key) {
            return [
                "id" => $item["id"],
                "label" => $item["title"],
                "description" => $item["description"],
                "numerator" =>$item->num->title,
                "denominator" => $item->denom->title,
                "indicator" => $item["indicator"],
                "group" => $item->indicatorGroup->title,
                "type" => $item->type(),
                "reverse" => $item->reverse(),
            ];
        });
        return response()->json($indicators);
    }
    private $pax = [

    ];


             
    public function editValidator ($id){
        $rules =  [
            'numerator' =>'required|integer',
            'denominator' =>'required|integer',
            'group' =>'required|integer',
            'type' =>'required|integer',
            'enabled' =>'required|boolean',
            'reverse' =>'required|boolean',
            'indicator' => 'required|unique:indicators,indicator,'.$id,            
            ];
        $translationRules = ['title' => 'required|max:150|unique:indicator_translations,indicator_id,'.$id,
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
            'numerator' =>'required|integer',
            'denominator' =>'required|integer',
            'group' =>'required|integer',
            'type' =>'required|integer',
            'enabled' =>'required|boolean',
            'reverse' =>'required|boolean',
            'indicator' => 'required|unique:indicators,indicator',            
            ];
        $translationRules = ['title' => 'required|max:150|unique:indicator_translations,title',
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
