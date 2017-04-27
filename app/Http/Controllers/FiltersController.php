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

    public function phases() {

        $controller = new DashboardController;
        Admin\RdfNamespacesController::setNamespaces();
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
        Admin\RdfNamespacesController::setNamespaces();
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
