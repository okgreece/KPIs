<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiltersController extends Controller {
 
/**
 * @SWG\Swagger(
 *   @SWG\Info(
 *     title="KPIs API Documentation",
 *     version="1.0",
 *     description="KPIs API Documentation",
 *   ),
 *   
 *   basePath="/api/v1",
 *   produces={"application/json"},
 *   consumes={"application/json"},
 * )
 */
    
    
    /**
     * @SWG\Get(
     *   path="/filters/list",
     *   summary="List Filters",
     *   tags={"filters"},
     *   @SWG\Response(
     *     response=200,
     *     description="A list with all Filters that can be used."
     *   ),
     * )
     */

    public function filters() {

        $filters = [
            "phase",
            "year",
            "organization",
            "indicator"
        ];

        return response()->json($filters);
    }   
    
    /**
    * @SWG\Get(
    *   path="/filters/phases",
    *   summary="List Phases",
    *   tags={"filters"},
    *   @SWG\Response(
    *     response=200,
    *     description="A list with all Budget Phases that can be used."
    *   ),
     * @SWG\Parameter(
     *         name="lang",
     *         in="query",
     *         description="Localization paremeter. Choose from available languages (en, el).",
     *         required=false,
     *         type="string",
     *         enum={"en", "el"},         
     *     ),
    * )
    */

    public function phases() {
        
        if (isset(request()->lang)) {
            \App::setLocale(request()->lang);
        }

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
    
    /**
    * @SWG\Get(
    *   path="/filters/years",
    *   summary="List Years",
    *   tags={"filters"},
    *   @SWG\Response(
    *     response=200,
    *     description="A list with all years available."
    *   ),
    * )
    */
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
    
    /**
    * @SWG\Get(
    *   path="/filters/organizations",
    *   summary="List Organizations",
    *   tags={"filters"},
    *   @SWG\Response(
    *     response=200,
    *     description="A list with all available organizations."
    *   ),
    * )
    */
    
    public function organizations() {
        $request = request();
        if (isset($request->lang)) {
            \App::setLocale($request->lang);
        }

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
    
    /**
    * @SWG\Get(
    *   path="/filters/groups",
    *   summary="List Groups",
    *   tags={"filters"},
    *   @SWG\Response(
    *     response=200,
    *     description="A list with all available groups."
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
