<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Aggregator;
use Illuminate\Http\Request;
use Session;
use Asparagus\QueryBuilder;

class AggregatorsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $aggregators = Aggregator::paginate(25);

        return view('admin.aggregators.index', compact('aggregators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('admin.aggregators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $requestData = $request->all();

        $this->validate($request, $this->createValidator());

        $aggregator = Aggregator::create($requestData);

        Session::flash('flash_message', 'Aggregator added!');

        return redirect('admin/aggregators');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $aggregator = Aggregator::findOrFail($id);

        return view('admin.aggregators.show', compact('aggregator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $aggregator = Aggregator::findOrFail($id);

        return view('admin.aggregators.edit', compact('aggregator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {

        $requestData = $request->all();
        $aggregator = Aggregator::findOrFail($id);
        $this->validate($request, $this->editValidator($id));
        $aggregator->update($requestData);

        $aggregator->save();

        Session::flash('flash_message', 'Aggregator updated!');

        return redirect('admin/aggregators');
    }
    
    public function editValidator ($id){
        $rules =  [
            
            'code' => 'required|unique:aggregators,code,'.$id,            
            ];
        $translationRules = ['title' => 'required|max:150|unique:aggregator_translations,aggregator_id,'.$id,
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
            'code' => 'required|unique:aggregators,code',            
            ];
        $translationRules = ['title' => 'required|max:150|unique:aggregator_translations,title',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Aggregator::destroy($id);

        Session::flash('flash_message', 'Aggregator deleted!');

        return redirect('admin/aggregators');
    }
    /**
    * @SWG\Get(
    *   path="/aggregators/list",
    *   summary="List Aggregators",
    *   tags={"aggregators"},
    *   @SWG\Response(
    *     response=200,
    *     description="A list with all available aggregators."
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

    public function lineup(Request $request) {
        if (isset($request->lang)) {
            \App::setLocale($request->lang);
        }
        $list = Aggregator::all();
        return response()->json($list);
    }

    public function getRemote($organization, $property, $endpoint) {
        $sparql = new \EasyRdf_Sparql_Client($endpoint);
        $queryBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
        $queryBuilder->select("?value")
                ->where("<" . $organization . ">", "<" . $property . ">", "?value");
        $query_result = $sparql->query($queryBuilder);
        if (isset($query_result[0]->value)) {
            $result = $query_result[0]->value->getValue();
        } 
        else {
            $queryBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
            $queryBuilder->select("?value")
                    ->where("<" . $organization . ">", "<http://dbpedia.org/ontology/wikiPageRedirects>", "?redirect")
                    ->where("?redirect", "<" . $property . ">", "?value" );
            $query_result = $sparql->query($queryBuilder);
            $result = $query_result[0]->value->getValue();
        }
        return response()->json($result);
    }

    public function elements(Request $request){
//        $organization = $request->organization;
//
//        $year = $request->year;
//        $phase = $request->phase;
        $notations = $this->notations($request);
        return $notations;
//        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
//        $query = $this->elementsQuery($notations[0], $organization, $year, $phase);
//        $query_result = $sparql->query($query);
    }

    public function value(Request $request) {

        $organization = $request->organization;
        $aggregator = \App\Aggregator::find($request->aggregatorID);

        if ($aggregator->code == "population") {
            $org = \App\Organization::where('uri', '=', $organization)->first();
            $population = $org->geonamesInstance->population;
            return response()->json($population);
        }

        $year = $request->year;
        $phase = $request->phase;
        $notations = $this->notations($request);
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        $query = $this->query($notations[0], $organization, $year, $phase);
        $query_result = $sparql->query($query);
        if (isset($query_result[0]->sum)) {
            $included = $query_result[0]->sum->getValue();
        } else {
            return response()->json(0);
        }
        if (!empty($notations[1])) {
            $excluded = $sparql->query($this->query($notations[1], $organization, $year, $phase))[0]->sum->getValue();
        } else {
            $excluded = (float) 0;
        }
        $result = (double) $included - (double) $excluded;
        return response()->json($result);
    }

    public function groupedValue(Request $request) {

        $year = $request->year;
        $phase = $request->phase;
        $organization = $request->organization;
        $notations = $this->notations($request);
        $order = $request->order;

        $group = $request->group ? explode(",", $request->group) : [];
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        $included = $sparql->query($this->query($notations[0], $organization, $year, $phase, $order, $group));
        $fields = $included->getFields();
        $result = [];
        foreach ($included as $plus) {
            $elements = [];
            foreach ($fields as $field) {
                $element["field"] = $field;
                $element["value"] = $plus->$field->toRdfPhp()["value"];
                array_push($elements, $element);
            }
            array_push($result, $elements);
        }
        return response()->json($result);
    }
    
    public function notations(Request $request) {
        if ($request->aggregatorCode != null) {
            $aggregator = Aggregator::where('code', '=', $request->aggregatorCode)->first();
            $notations[0] = explode(",", $aggregator->included);
            $notations[1] = explode(",", $aggregator->excluded);
        } elseif ($request->aggregatorID != null) {
            $collection = Aggregator::find($request->aggregatorID)->collection();
            $notations[0] = explode(",", $collection->included);
            $notations[1] = explode(",", $collection->excluded);
        } else {
            $notations[0] = explode(",", $request->included);
            $notations[1] = explode(",", $request->excluded);
        }
        if (sizeof($notations[1]) == 1 && $notations[1][0] == "") {
            $notations[1] = [];
        }
        return $notations;
    }
    
    public function getAttachement() {
        $request = request();
        $organization = \App\Organization::where("uri", '=', $request->organization)->first();
        $key = "attachment_" . $organization->uri . "_" . $request->year;
        if(env("VALUE_CACHE") && \Cache::has($key)){
            $dimension = \Cache::get($key);
        }

        else{
            $sparqlBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
            $sparqlBuilder->selectDistinct("?dimension", "?attachment", "(group_concat(distinct ?codelist;separator=\"|||\") as ?codelist)")
                ->where("?dataset", 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', "<" . $organization->uri . ">")
                ->also('obeu-dimension:fiscalYear', "<" . $request->year . ">")
                ->also('qb:structure', '?dsd')
                ->where('?dsd', 'qb:component', '?component')
                ->where('?component', 'qb:dimension', '?dimension')
                ->where('?dimension', 'rdfs:subPropertyOf', '<' . $organization->dimension . '>')
                ->where('?dimension', 'qb:codeList', '?codelist')    
                ->optional('?component', 'qb:componentAttachment', '?attachment')
                ->groupBy("?dimension", "?attachment");
            $query = $sparqlBuilder->getSPARQL();
            logger($query);
            $endpoint = new \EasyRdf_Sparql_Client(env("ENDPOINT"));
            $results = $endpoint->query($query);
            try {
                foreach($results as $index=>$result){
                    $dimension[$index] = [
                    "dimension" => $result->dimension->getUri(),
                    "attachment" => isset($result->attachment) ? $result->attachment->shorten() : 'qb:Observation',
                    "codelist"=> $result->codelist->getValue()
                ];
                }
            } catch (\ErrorException $ex) {
                logger($ex);
                $dimension = null;
            }
            \Cache::add($key, collect($dimension), env("CACHE_TIME"));
        }
        return collect($dimension);
    }
    
    public function getDimensionsAttachment(Request $request) {
        $organization = \App\Organization::where("uri", '=', $request->organization)->first();
        $key = "attachment_dimensions" . $organization->uri . "_" . $request->year;
        if(env("VALUE_CACHE") && \Cache::has($key)){
            $dimension = \Cache::get($key);
        }
        else{
            $sparqlBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
            $sparqlBuilder->selectDistinct("?dimension", "?attachment", "?property")
                ->where("?dataset", 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', "<" . $organization->uri . ">")
                ->also('obeu-dimension:fiscalYear', "<" . $request->year . ">")
                ->also('qb:structure', '?dsd')
                ->where('?dsd', 'qb:component', '?component')
                ->where('?component', 'qb:dimension', '?dimension')
                ->optional('?dimension', 'rdfs:subPropertyOf', '?property')    
                ->optional('?component', 'qb:componentAttachment', '?attachment')
                ->groupBy("?dimension", "?attachment");
            $query = $sparqlBuilder->getSPARQL();
            logger($query);
            $endpoint = new \EasyRdf_Sparql_Client(env("ENDPOINT"));
            $result = $endpoint->query($query);
            
            try {
                foreach($result as $row=>$element){
                    $dimension[$row] = [
                    "dimension" => $element->dimension->getUri(),
                    "attachment" => isset($element->attachment) ? $element->attachment->shorten() : 'qb:Observation',
                    "property"=> isset($element->property) ? $element->property->getUri() : $element->dimension->getUri()
                            ];
                    }
            } catch (\ErrorException $ex) {
                logger($ex);
                $dimension = null;
            }
            foreach($dimension as $row=>$element){
                switch($element["attachment"]){
                    case "qb:Observation":
                        $dimension[$row]["attach_element"] = "?observation";
                        break;
                    case "qb:Slice":
                        $dimension[$row]["attach_element"] = "?slice";
                        break;
                    case "qb:DataSet":
                        $dimension[$row]["attach_element"] = "?dataset";
                        break;
                    default:
                        break;
                }
            }
            \Cache::add($key, $dimension, env("CACHE_TIME"));
        }
        return collect($dimension);
    }
    
    public function dimensions(){
        $dimensions = $this->getAttachement();
        $dummy = [];
        foreach($dimensions as $instance){
            $dummy[] = '<' . $instance["dimension"] . '>';
            $dimension["attachment"] = $instance["attachment"];
        }
        $dimension["dimension"] = implode("|", $dummy);
        return $dimension;
    }
    
    public function query($notation = null, $organization = null, $year = null, $phase = null, $order = null, $group = array()) {
        $dimension = $this->dimensions();
        $queryBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
        $attachments = $this->getDimensionsAttachment(request());
        $dim = "http://data.openbudgets.eu/ontology/dsd/dimension/budgetPhase";
        $budgetPhase = $attachments->where("property", $dim);
        $sum = ['(SUM(?amount) AS ?sum)'];
        $select = array_merge($group, $sum);
        $queryBuilder->select($select)
                ->where('?dataset', 'obeu-dimension:fiscalYear', '?year')
                ->also('obeu-dimension:organization', '?organization')
                ->where('?classification', 'skos:broader+', '?topConcept')
                ->where('?topConcept', 'skos:prefLabel', '?label')
                ->also('skos:notation', '?notation')
                ->where('?observation', 'obeu-measure:amount', '?amount')
                ->where($budgetPhase->pluck("attach_element")[0], "?budgetDimension", "?phase")
                ->values(["?budgetDimension" => $budgetPhase->pluck("dimension")]);
        if($dimension["attachment"] == 'qb:DataSet'){
            $queryBuilder->where('?dataset', $dimension["dimension"], '?classification')
                    ->where('?observation', 'qb:dataSet', '?dataset');
        }
        elseif($dimension["attachment"] == 'qb:Slice'){
            $queryBuilder->where('?dataset', 'qb:slice', '?slice')
                    ->where('?slice', $dimension["dimension"] , '?classification')
                    ->where('?slice', 'qb:observation', '?observation');
        }
        else{
            $queryBuilder->where('?observation', 'qb:dataSet', '?dataset')
                    ->where('?observation', $dimension["dimension"], '?classification');
        }
        
        if (!empty($notation)) {
            $queryBuilder->values(["?notation" => $notation]);
        }
        if (!empty($phase)) {
            $queryBuilder->values(["?phase" => [$phase]]);
        }
        if (!empty($organization)) {
            $queryBuilder->values(["?organization" => [$organization]]);
        }
        if (!empty($year)) {
            $queryBuilder->values(["?year" => [$year]]);
        }
        if (!empty($group)) {
            $queryBuilder->groupBy($group);
        }
        if (!empty($order)) {
            $queryBuilder->orderBy($order);
        }
        $query = $queryBuilder->getSPARQL();
        logger($query);
        return $query;
    }

}
