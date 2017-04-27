<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class APIController extends Controller
{
    private static $excelFormats = [
        "xls",
        "csv",
        "xlsx"
    ];
    
    private static $jsonFormats = [
        "json",
    ];
    
    private static $rdfFormats = [
        "rdfxml",
        "turtle",
        "ntriples",
        "jsonld"
    ];
    
    public function getOrganizations($filter_array = null){
        Admin\RdfNamespacesController::setNamespaces();
                    
        $controller = new FiltersController;
        
        $organizations = $controller->organizations();
        
        if($filter_array == null){
            $result = json_decode($organizations->content());
        }
        else {
            $filtered = [];
            $array = explode(",",$filter_array); 
            foreach($array as $filter){
                
                $result = array_filter(json_decode($organizations->content()), function($item) use ($filter) {
                    if ($item->value == \EasyRdf_Namespace::shorten($filter) || $item->value == $filter ){
                        
                        return $item;
                    }
                });
                array_push($filtered, $result);
            }
            $result = array_collapse($filtered);
            
        }
        return response()->json($result);        
    }
    
    public function getYears($filter_array = null){
        
        Admin\RdfNamespacesController::setNamespaces();
        
        $controller = new FiltersController;
        
        $years = $controller->years();
        
        if($filter_array == null){
            $result = json_decode($years->content());
        }
        else {
            $filtered = [];
            $array = explode(",",$filter_array); 
            foreach($array as $filter){
                $result = array_filter(json_decode($years->content()), function($item) use ($filter) {
                    if ($item->value == \EasyRdf_Namespace::shorten($filter, true) || $item->value == $filter){
                        
                        return $item;
                    }
                });
                array_push($filtered, $result);
            }
            $result = array_collapse($filtered);
            
        }
        return response()->json($result);        
    }
    
    public function getPhases($filter_array = null){
        
        Admin\RdfNamespacesController::setNamespaces();
        $controller = new FiltersController;
        
        $phases = $controller->phases();
        
        if($filter_array == null){
            $result = json_decode($phases->content());
        }
        else {
            $filtered = [];
            $array = explode(",",$filter_array); 
            foreach($array as $filter){
                $result = array_filter(json_decode($phases->content()), function($item) use ($filter) {
                    if ($item->value == \EasyRdf_Namespace::shorten($filter) || $item->value == $filter){
                        
                        return $item;
                    }
                });
                array_push($filtered, $result);
            }
            $result = array_collapse($filtered);
            
        }
        return response()->json($result);        
    }
    
    public function value($id, Request $request){

        if (isset($request->lang)) {
            \App::setLocale($request->lang);
        }
        
        $indicator = \App\Indicator::where("indicator", "=", $id)->first();
        
        $request->request->set("indicatorID", $indicator->id);
        
        $organizations = $request->organization ? $this->getOrganizations($request->organization): $this->getOrganizations();

        $results = [];
        
        $tempPhase = $request->phase;
        
        $tempYear = $request->year;
        
        foreach(json_decode($organizations->content()) as $organization){
            
            $request->request->set("organization", $organization->url);
           
            $years = $tempYear ? $this->getYears($tempYear): $this->getYears();
            
            $phases = $tempPhase ? $this->getPhases($tempPhase): $this->getPhases();
            
            foreach(json_decode($years->content()) as $year){               
                
                $request->request->set("year", $year->url);
                
                foreach(json_decode($phases->content()) as $phase){

                    $controller = new Admin\IndicatorsController;
                    
                    $request->request->set("phase", $phase->url);
                    
                    $value = $controller->value($request)->content();
                    
                    $result = [
                        "organization" => $organization->label,
                        "indicatorID" => $indicator->indicator,
                        "indicatorTitle" => $indicator->title,
                        "indicatorType" => $indicator->type(),
                        "indicatorValue" => $value,
                        "group" => $indicator->indicatorGroup->title,
                        "year" => $year->label,
                        "phase" => $phase->label,
                    ];
                    array_push($results, $result);
                    $request->request->remove("phase");
                }                
                $request->request->remove("year");
            }
            $request->request->remove("organization");
        }
        if(isset($request->format)){
            return $this->transformResults($results);
        }
        else{
            return response()->json($results);
        }
        
    }
    
    public function transformResults($result){
        if(in_array(request()->format, self::$excelFormats)){
            return $this->excelHandler($result);
        }
        else if(in_array(request()->format, self::$rdfFormats)){
            return $this->rdfHandler($result);
        }
        else if(in_array(request()->format, self::$jsonFormats)){
            return $this->jsonHandler($result);
        }
        else if(request()->format == "embed"){
            return $this->embedHandler($result);
        }
        else
            {
                $response = response()->json("Error! Unsupported format.", 422);
                return $response;
            }
        
    }
    
    public function excelHandler($result){
        Excel::create('KPI_export', function($excel) use ($result){
            $excel->sheet("KPI_sheet", function($sheet) use ($result) {
                $sheet->fromArray($result);
                });
                
            })->export(request()->format);
    }
    
    public function rdfHandler($result){
        return response()->json($result);
    }
    
    public function embedHandler($result){
        return response()->json($result);
    }
    
    public function jsonHandler($result){
        return response()->json($result);
    }
}
