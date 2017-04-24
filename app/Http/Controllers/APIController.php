<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getOrganizations($filter_array = null){
        
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
                    if ($item->value == $filter){
                        
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
                    if ($item->value == $filter){
                        
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
                    if ($item->value == $filter){
                        
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
                    //logger(request());
                    $result = [
                        "organization" => $organization->label,
                        "indicatorID" => $indicator->indicator,
                        "indicatorTitle" => $indicator->title,
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
        return response()->json($results);
    }
}
