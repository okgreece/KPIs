<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiltersController extends Controller {

    public function filters() {

        $filters = [
            "phase",
            "year",
            "organization",
            "indicator"
        ];

        return response()->json($filters);
    }   
    
    private static $prefixes = array(
        'gr-dimension' => 'http://data.openbudgets.eu/ontology/dsd/greek-municipalities/dimension/',
        'obeu-budgetphase' => 'http://data.openbudgets.eu/resource/codelist/budget-phase/',
        'obeu-measure' => 'http://data.openbudgets.eu/ontology/dsd/measure/',
        'obeu-dimension' => 'http://data.openbudgets.eu/ontology/dsd/dimension/',
        'obeu-operation' => 'http://data.openbudgets.eu/resource/codelist/operation-character/',
        'qb' => 'http://purl.org/linked-data/cube#',
        'skos' => 'http://www.w3.org/2004/02/skos/core#',
        'rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
        'rdfs' => "http://www.w3.org/2000/01/rdf-schema#",
        'dbpedia-el' => "http://el.dbpedia.org/resource/",
        'dbpedia' => "http://dbpedia.org/resource/",
        'gn' => 'http://sws.geonames.org/'
    );
    
    public static function setNamespaces(){
        $myPrefixes = self::$prefixes;
        foreach ($myPrefixes as $namespace){
            \EasyRdf_Namespace::set(key($myPrefixes), $namespace);
            next($myPrefixes);
        }
        return;
    }

    public function phases() {

        $controller = new DashboardController;
        $this->setNamespaces();
        $phases = collect($controller->phasesApi())->map(function($item, $key) {
            return [
                "label" => $item["label"],
                "value" => \EasyRdf_Namespace::shorten($item["value"]->getUri()),
                "url" => $item["value"]->getUri(),
            ];
        });

        return response()->json($phases);
    }

    public function years() {

        $controller = new DashboardController;

        $years = collect($controller->yearsApi())->map(function($item, $key) {

            return [
                "label" => $item["label"],
                "value" => \EasyRdf_Namespace::shorten($item["value"]->getUri(),true),
                //"value" => $item["label"],
                "url" => $item["value"]->getUri(),
            ];
        });

        return response()->json($years);
    }

    public function organizations() {

        $controller = new DashboardController;
        $this->setNamespaces();
        $organizations = collect($controller->organizations())->map(function($item, $key) {

            return [
                "label" => $item["label"],
                "value" => \EasyRdf_Namespace::shorten($item["value"]),
                "url" => $item["value"],
            ];
        });

        return response()->json($organizations);
    }

    public function groups(Request $request) {

        if (isset($request->lang)) {
            \App::setLocale($request->lang);
        }

        $groups = collect(\App\Group::all())->map(function($item, $key) {

            return [
                "label" => $item["title"],
                "value" => $item["code"],
                "description" => $item["description"],
                    ];
        });
        return response()->json($groups);
    }

}
