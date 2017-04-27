<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Aggregator;
use Illuminate\Http\Request;
use Session;
use Asparagus\QueryBuilder;
use EasyRdf;

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

        $this->validate($request, [
            'en_title' => 'required|max:120',
            'en_description' => 'required|max:400',
            'el_title' => 'required|max:120',
            'el_description' => 'required|max:400',
            'included' => 'required|',
            'codelist' => 'required|url',
            'code' => 'required|',
        ]);

        $aggregator = Aggregator::create($requestData);

        $aggregator->translateOrNew('en')->title = $requestData["en_title"];

        $aggregator->translateOrNew('en')->description = $requestData["en_description"];

        $aggregator->translateOrNew('el')->title = $requestData["el_title"];

        $aggregator->translateOrNew('el')->description = $requestData["el_description"];

        $aggregator->save();

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

        $this->validate($request, [
            'en_title' => 'required|max:120',
            'en_description' => 'required|max:400',
            'el_title' => 'required|max:120',
            'el_description' => 'required|max:400',
            'included' => 'required|',
            'codelist' => 'required|url',
            'code' => 'required|',
        ]);

        $aggregator = Aggregator::findOrFail($id);
        $aggregator->update($requestData);

        $aggregator->translateOrNew('en')->title = $requestData["en_title"];

        $aggregator->translateOrNew('en')->description = $requestData["en_description"];

        $aggregator->translateOrNew('el')->title = $requestData["el_title"];

        $aggregator->translateOrNew('el')->description = $requestData["el_description"];

        $aggregator->save();

        Session::flash('flash_message', 'Aggregator updated!');

        return redirect('admin/aggregators');
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

    public function lineup(Request $request) {

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

    public function value(Request $request) {
        $organization = $request->organization;
        $aggregator = \App\Aggregator::find($request->aggregatorID);
        if ($aggregator->code == "population") {
            $property = $aggregator->included;
            $endpoint = $aggregator->codelist;
            return $this->getRemote($organization, $property, $endpoint);
        }
        $year = $request->year;
        $phase = $request->phase;

        $notations = $this->notations($request);
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        $query = $this->query($notations[0], $organization, $year, $phase);
        $query_result = $sparql->query($query);
        //dd(isset($query_result[0]->sum));
        if (isset($query_result[0]->sum)) {
            //dd(isset($query_result[0]->sum));
            $included = $query_result[0]->sum->getValue();
        } else {
            //dd(isset($query_result[0]->sum));
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

        $aggregator = $request->aggregatorCode;
        $aggregatorID = $request->aggregatorID;

        if ($aggregator != null) {
            $notations[0] = explode(",", Aggregator::where('code', '=', $aggregator)->first()->included);
            $notations[1] = explode(",", Aggregator::where('code', '=', $aggregator)->first()->excluded);
        } elseif ($aggregatorID != null) {

            $notations[0] = explode(",", Aggregator::find($aggregatorID)->included);
            $notations[1] = explode(",", Aggregator::find($aggregatorID)->excluded);
        } else {
            $notations[0] = explode(",", $request->included);
            $notations[1] = explode(",", $request->excluded);
        }
        if (sizeof($notations[1]) == 1 && $notations[1][0] == "") {
            $notations[1] = [];
        }
        return $notations;
    }

    public function query($notation = null, $organization = null, $year = null, $phase = null, $order = null, $group = array()) {

        $queryBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
        $sum = ['(SUM(?amount) AS ?sum)'];
        $select = array_merge($group, $sum);
        $queryBuilder->select($select)
                ->where('?dataset', 'obeu-dimension:fiscalYear', '?year')
                ->also('obeu-dimension:organization', '?organization')
                ->also('qb:slice', '?slice')
                ->where('?slice', 'qb:observation', '?observation')
                ->also('?slice', 'gr-dimension:economicClassification', '?classification')
                ->where('?classification', 'skos:broader+', '?topConcept')
                ->where('?topConcept', 'skos:prefLabel', '?label')
                ->also('skos:notation', '?notation')
                ->where('?observation', 'gr-dimension:budgetPhase', '?phase')
                ->also('obeu-measure:amount', '?amount');

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

        return $query;
    }

}
