<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Asparagus\QueryBuilder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller {

    public function index() {
        $organizations = $this->organizations();
        return view('welcome', [
            "organizations" => $organizations,
        ]);
    }
    
    public function embed(){
        $request = request();
        $urls = new \stdClass();
        $urls->organization = $request->organization;
        $urls->phase = $request->phase;
        $urls->year = $request->year;
        if (isset($request->lang)) {
            \App::setLocale($request->lang);
        }
        $controller = new APIController;
        $content = $this->dashboard($request);
        if(sizeof(explode(",", $request->indicator)) > 1){
            $multiple = true;
        }
        else{
            $multiple = false;
        }
        $indicator = json_decode($controller->value($content["indicators"][0]["indicator"]->indicator, $request)->content())[0];
        $view_elements = [
            "content" => $content,
            "indicator" => $indicator,
            "multiple" => $multiple,
            "form" => false,
            "urls" => $urls
        ];
        return view("embed/embed", $view_elements);
    }
    
    public function dashboard(Request $request) {
        if(!isset($request->indicator)){
            $indicators = $this->getEnabled();
        }
        else{
            $indicators = \App\Indicator::whereIn("indicator", explode(",", $request->indicator))
                ->get();
        }
        $values = [];
        foreach ($indicators as $indicator) {
            $request->request->set("indicatorID", $indicator->id);
            try{
                $value = $this->getValue($request);
                array_push($values, [
                "indicator" => $indicator,
                "value" => $value,
            ]);
            } catch (\Exception $ex) {
                logger($ex);
            }
            
        }

        $integration = $this->integration();
        
        $allIndicators = [
            "indicators" => $values,
        ];

        $organization = [
            "organization" => \App\Organization::where("uri", '=', request()->organization)->first(),
        ];

        $result = array_merge($allIndicators, $integration, $organization);

        if(\Route::currentRouteName() == "embed"){
            return $result;
        }
        else{
            return view('indicators/gridComponents', $result);
        }
        
    }
    
    public function integration(){
        $datasetE = $this->getDataset("expenditure");
        $datasetR = $this->getDataset("revenue");
        $OSDatasetE = $this->getRudolfDataset($datasetE);
        $OSDatasetR = $this->getRudolfDataset($datasetR);
        return [
            "osLinkE" => $this->getOSLink($datasetE, $OSDatasetE),
            "osLinkR" => $this->getOSLink($datasetR, $OSDatasetR),
            "indigoLinkE" => $this->getIndigoLink($datasetE, $OSDatasetE),
            "indigoLinkR" => $this->getIndigoLink($datasetR, $OSDatasetR),
        ];
    }

    public function getOSLink($SPARQLDataset, $OSDataset) {
        $request = request();
        
        if ($SPARQLDataset != null) {
            if (isset($OSDataset)) {
                $query = [
                    "lang" => \App::getLocale(),
                    "measure" => "amount.sum",
                    "groups[]" => "economicClassification.notation",
                    "filters[budgetPhase.budgetPhase][]" => $request->phase,
                    "visualizations[]" => "Treemap"
                ];
                return $link = $OSDataset->name
                        . "?"
                        . http_build_query($query)
                ;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    
    public function getIndigoLink($SPARQLDataset, $OSDataset){
        if ($SPARQLDataset != null) {
            if (isset($OSDataset)) {
                return env("INDIGO") . env("INDIGO_ROUTE") . $OSDataset->name;
            }
        }
        else{
            return null;
        }
    }
    
    public function getRudolfDataset($SPARQLdataset){        
        $md5 = substr(md5($SPARQLdataset), 0 , 5);
        $client = new \GuzzleHttp\Client();
        try {
            $result = $client->request("GET", env("RUDOLF"));
        } catch (\GuzzleHttp\Exception\ConnectException $ex) {
            return null;
        }
        $cubes = collect(json_decode($result->getBody()->getContents())->data);

        $OSDataset = $cubes->filter(function ($cube) use ($md5) {
                    return $cube->name !== "global" ? explode("__", $cube->name)[1] == $md5 : null;
                })->first();
        return $OSDataset;
    }

    public function getDataset($operation) {
        $request = request();
        $sparqlBuilder = new QueryBuilder(Admin\RdfNamespacesController::prefixes());
        $sparqlBuilder->selectDistinct("?dataset")
                ->where("?dataset", 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', "<" . $request->organization . ">")
                ->also('obeu-dimension:fiscalYear', "<" . $request->year . ">")
                ->also('obeu-dimension:operationCharacter', 'obeu-operation:' . $operation);
        $query = $sparqlBuilder->getSPARQL();
        $endpoint = new \EasyRdf_Sparql_Client(env("ENDPOINT"));
        $result = $endpoint->query($query);
        try {
            $dataset = $result[0]->dataset->getUri();
        } catch (\ErrorException $ex) {
            $dataset = null;
        }
        return $dataset;
    }

    public function evolution() {
        $values = $this->getYearly();
        $chart = $this->getYearlyChart($values);
        return view('indicators/time', ["chart" => $chart]);
    }

    public function dimension() {
        $request = request();
        $dimension = $request->dimension;
        if ($dimension == "year") {
            return $this->years();
        } elseif ($dimension == "phase") {
            return $this->phases();
        } elseif ($dimension == "indicatorID") {
            return view("indicators.templates.indicator");
        } elseif ($dimension == "organization") {
            $organizations = $this->organizations();
            return view("indicators.templates.organization", ["organizations" => $organizations]);
        }
    }

    public function free() {
        $request = request();
        $dimension = $request->free;
        if ($dimension == "year") {
            return $this->years()->years;
        } elseif ($dimension == "phase") {
            return $this->phases()->phases;
        } elseif ($dimension == "indicatorID") {
            return $this->indicators();
        } elseif ($dimension == "organization") {
            return $this->organizations();
        }
    }

    public function indicators() {
        $indicators = \App\Indicator::all();
        $result = [];
        foreach ($indicators as $indicator) {
            array_push($result, ["label" => $indicator->title, "value" => $indicator->id]);
        }
        return $result;
    }
    
    public function organizations() {

        $candidates = \App\Organization::where('enabled', '=', '1')->get();
        $organizations = [];
        foreach ($candidates as $candidate) {
            array_push($organizations, ["label" => $this->getLabel($candidate), "value" => $candidate->uri, "id" => $candidate->id]);
        }
        return $organizations;
    }

    public function organizationsquery() {
        $queryBuilder = new QueryBuilder(Admin\RdfNamespacesController::prefixes());
        $queryBuilder->selectDistinct("?organization")
                ->where('?dataset', 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', '?organization')
                ->orderBy('?organization');
        $query = $queryBuilder->getSPARQL();
        return $query;
    }
    
    public function getLabel(\App\Organization $organization) {
        $label = $organization->geonamesInstance->label;
        cache($organization->uri, $label);
        return $label;
    }
    
    public function phasesApi() {
        $request = request();
        if (isset($request->organization)) {
            $organization = '<' . $request->organization . '>';
        } else {
            $organization = "?organization";
        }
        $queryBuilder = new QueryBuilder(Admin\RdfNamespacesController::prefixes());
        $locale = \App::getLocale();
        $queryBuilder->selectDistinct("?phase", "?label_placeholder")
                ->where('?dataset', 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', $organization)
                ->also('qb:structure', '?dsd')
                ->where('?dsd', 'qb:component', '?component')
                ->where('?component', 'qb:dimension/rdfs:subPropertyOf*', "?dimension")
                ->where('?dimension','qb:codeList', '?codelist')
                ->where('?codelist', 'skos:hasTopConcept', '?phase')
                ->values(["?dimension"=>['<http://data.openbudgets.eu/ontology/dsd/dimension/budgetPhase>']])
                ->optional(
                        $queryBuilder->newSubgraph()
                        ->where('?phase', 'skos:prefLabel', '?label')
                        ->filter('langMatches(lang(?label), "' . $locale . '")')
                        )
                
                ->optional(
                        $queryBuilder->newSubgraph()
                        ->where('?phase', 'skos:prefLabel', '?label2')
                        ->filter('langMatches(lang(?label2), "en")')
                        )
                ->bind("if(bound(?label), ?label, ?label2) as ?label_placeholder")
                ->orderBy("?phase");
        $query = $queryBuilder->getSPARQL();
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        $labels = $sparql->query($query);
        $phases = [];
        foreach ($labels as $label) {
            if ($label->label_placeholder->getValue() == "Reserved") {
                continue;
            }
            Cache::forever($label->phase . "_" .$locale, $label->label_placeholder->getValue());
            array_push($phases, ["label" => $label->label_placeholder->getValue(), "value" => $label->phase]);
        }
        return $phases;
    }

    public function phases() {
        $phases = $this->phasesApi();
        return view('indicators.templates.phase', ["phases" => $phases]);
    }
    
    public function yearsApi(){
        $request = request();
        if (isset($request->organization)) {
            $organization = '<' . $request->organization . '>';
        } else {
            $organization = "?organization";
        }
        $queryBuilder = new QueryBuilder(Admin\RdfNamespacesController::prefixes());
        $queryBuilder->selectDistinct("?year")
                ->where('?dataset', 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', $organization)
                ->also('qb:structure', '?dsd')
                ->also('?dimension', '?year')
                ->where('?dsd', 'qb:component', '?component')
                ->where('?component', 'qb:dimension', "?dimension")
                ->where('?dimension', 'rdfs:subPropertyOf', '<http://data.openbudgets.eu/ontology/dsd/dimension/fiscalPeriod>')
                ->orderBy("?year");

        $query = $queryBuilder->getSPARQL();
        //logger($query);
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        $labels = $sparql->query($query);
        $years = [];
        foreach ($labels as $label) {
            $lastPart = $this->urlLast($label->year);
            array_push($years, ["label" => $lastPart, "value" => $label->year]);
            Cache::forever($label->year, $lastPart);
        }
        return $years;
    }

    public function years() {
        $years = $this->yearsApi();
        return view('indicators.templates.year', ["years" => $years]);
    }

    public function urlLast($url) {
        $path = parse_url($url, PHP_URL_PATH);
        $pathFragments = explode('/', $path);
        $end = end($pathFragments);
        return $end;
    }

    public function getEnabled() {
        $indicators = \App\Indicator::where('enabled', '=', true)->get();
        return $indicators;
    }

    public function getValue(Request $request) {
        $indicator = new Admin\IndicatorsController;
        return $indicator->value($request)->getData();
    }

    public function getYearly() {
        $request = request();
        $years = $this->years()->years;
        $values = [];
        foreach ($years as $year) {
            $request->request->set('year', $year["value"]);
            $value = $this->getValue($request);
            array_push($values, ["year" => $year["label"], "value" => $value]);
        }
        return response()->json($values);
    }

    public function chartTransform($data) {
        $request = request();
        $indicator = \App\Indicator::find($request->indicatorID);
        $values = collect(json_decode($data->content()));

        if ($indicator->type == 0) {
            //    $multiplier = 100;
            $yaxis = "Percent";
        } else {
            //    $multiplier = 1;
            $yaxis = "Euro per citizen";
        }

        $labels = $values->map(function($item, $key) {
                    return $item->year;
                })->all();
        $series = $values->map(function($item, $key) {
                    return $item->value;
                })->all();
        $dataset = [
            "label" => implode(", ", [cache($request->organization . Cache::get('locale')), $indicator->title, cache($request->phase . "_" . \App::getLocale())]) ,
            "fill" => false,
            "lineTension" => "0.1",
            "type" => "bar",
            'backgroundColor' => "rgba(38, 185, 154, 0.3)",
            'borderColor' => "rgba(38, 185, 154, 1)",
            'data' => $series,
        ];
        $result = ["labels" => $labels, "datasets" => $dataset];
        return response()->json($result);
    }

    public function getYearlyChart($data) {
        $object = collect(json_decode($this->chartTransform($data)->content()));
        $labels = $object["labels"];
        $datasets = $object["datasets"];
        $chartjs = app()->chartjs
                ->name('line')
                ->type('bar')
                ->labels($labels)
                ->datasets([
                    $datasets,
                ])
                ->options([
            "legend" => [
                "display" => true,
                "position" => "bottom",
            ],
            "scales" => [
                "yAxes" => [
                    [
                        "ticks" => [

                            "beginAtZero" => true,
                        ]
                    ]
                ]
            ]
        ]);

        return $chartjs;
    }

    public function chartCompareTransform($data) {

        $values = collect(json_decode($data->content()));

        $labels = $values->map(function($item, $key) {
                return $item->label;
                })->all();
        $series = $values->map(function($item, $key) {
                return $item->value;
                })->all();
        $request = request();
        $dataset = [
            "label" => cache($request->dimensions[0]["value"] . Cookie::get('locale')) . " " . cache($request->dimensions[1]["value"] . Cookie::get('locale')) . " " . cache($request->dimensions[2]["value"] . Cookie::get('locale')),
            "fill" => false,
            "lineTension" => "0.1",
            "type" => "bar",
            'backgroundColor' => "rgba(38, 185, 154, 0.3)",
            'borderColor' => "rgba(38, 185, 154, 1)",
            'data' => $series,
        ];
        $result = ["labels" => $labels, "datasets" => $dataset];
        return response()->json($result);
    }

    public function getCompareChart($data) {
        $object = collect(json_decode($this->chartCompareTransform($data)->content()));
        $labels = $object["labels"];
        $datasets = $object["datasets"];
        $chartjs = app()->chartjs
                ->name('compareGraph')
                ->type('bar')
                ->labels($labels)
                ->datasets([
                    $datasets,
                ])
                ->options([
            "legend" => [
                "display" => true,
                "position" => "bottom",
            ],
            "scales" => [
                "yAxes" => [
                    [
                        "ticks" => [
                            "beginAtZero" => true,
                            ]
                        ]
                    ]
                ]
                    ]
                        );
        return $chartjs;
    }

    public function update() {
        $values = $this->getYearly();
        $object = collect(json_decode($this->chartTransform($values)->content()));
        return $object;
    }

    public function compare() {
        $request = request();
        $free = $request->free;
        $concepts = $this->free();
        foreach ($request->dimensions as $dimension) {
            $request->request->set($dimension["dimension"], $dimension["value"]);
        }
        $values = [];
        foreach ($concepts as $element) {
            //dd($element);
            $request->request->set($free, $free == "indicator" ? $element["value"]->getUri() : $element["value"] );
            array_push($values, [
                "label" => $element["label"],
                "value" => $this->getValue($request),
            ]);
        }
        $data = response()->json($values);
        $chart = $this->getCompareChart($data);
        return view("indicators/compare_graph", ["chart" => $chart]);
    }

    public function radarValues() {
        $groups = \App\Group::all();
        $request = request();
        $radars = [];
        foreach ($groups as $group) {
            $indicators = \App\Indicator::where("group", "=", $group->id)->get();
            $labels = [];
            $data = [];
            foreach ($indicators as $indicator) {
                $request->request->set("indicatorID", $indicator->id);
                array_push($labels, explode(" ",$indicator->title));
                array_push($data, $this->getValue($request));
            }
            array_push($radars, ["label" => $group->title, "dataset" => ["labels" => $labels, "data" => $data]]);
        }
        return response()->json($radars);
    }

    public function radar() {
        $radarValues = json_decode($this->radarValues()->content());
        $charts = [];
        $id = 0;
        foreach ($radarValues as $dataset) {
            $graph = $this->getRadarChart($dataset, $id);
            array_push($charts, $graph);
            $id++;
        }
        $integration = $this->integration();
        
        $allCharts = [
            "charts" => $charts,
        ];
        $result = array_merge($allCharts, $integration);
        return view("indicators.radar_graph", $result);
    }

    public function updateRadar() {
        $radarValues = json_decode($this->radarValues()->content());
        $charts = [];
        foreach ($radarValues as $dataset) {
            $graph = $this->getRadarDataset($dataset);
            array_push($charts, $graph);
        }
        return response()->json($charts);
    }

    public function getRadarDataset($data) {
        $request = request();
        //dd($request);
        $dataset = [
            "label" => implode(", ", [$data->label, $this->getLabel(\App\Organization::where("uri", $request->organization)->first()), cache($request->phase . "_" . \App::getLocale()), cache($request->year)]),
            'backgroundColor' => "rgba(38, 185, 154, 0.3)",
            'borderColor' => "rgba(38, 185, 154, 1)",
            "pointBackgroundColor" => "rgba(179,181,198,1)",
            "pointBorderColor" => "#fff",
            "pointHoverBackgroundColor" => "#fff",
            "pointHoverBorderColor" => "rgba(179,181,198,1)",
            "data" => $data->dataset->data,
            ];
        return response()->json($dataset);
    }

    public function getRadarChart($data, $id) {
        $labels = $data->dataset->labels;
        $dataset = json_decode($this->getRadarDataset($data)->content());
        $type = $id == 1 || $id == 2 ? "bar" : "radar";
        $beginAtZero = ["yAxes" => [["ticks" => ["beginAtZero" => true]]]];
        $scales = $id == 1 || $id == 2 ? $beginAtZero : false;
        $chartjs = app()->chartjs
                ->name('radarGraph' . $id)
                ->type($type)
                ->labels($labels)
                ->datasets([
                    $dataset,
                ])
                ->options([
            "legend" => [
                "display" => true,
                "position" => "bottom",
            ],
            "scales" => $scales,
        ]);
        return $chartjs;
    }
    
    public function language($lang){
        \Cookie::forget('locale');
        cookie()->queue(
                cookie()->forever("locale", $lang)
                );
        return redirect('/');
    }
    
    public function tinyURL(){
        $url = request()->url;
        $shorten = file_get_contents('http://tinyurl.com/api-create.php?url='. $url);
        return response()->json($shorten);
    }
}