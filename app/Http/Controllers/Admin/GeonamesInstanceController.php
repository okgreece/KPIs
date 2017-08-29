<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Asparagus\QueryBuilder;

class GeonamesInstanceController extends Controller {

    public function get() {
        $sparql = new \EasyRdf_Sparql_Client(env("GEONAMES_ENDPOINT"));
        $query = new QueryBuilder(RdfNamespacesController::prefixes());
        $select = ["?geonames_id", '?name', '?population', '?countryCode', '?country', '?lat', '?long', "?map",'?parent', '?children', '?dbpedia', '?wikipedia', '?ppl'];
        foreach(config("translatable.locales") as $key=>$locale){
            array_push($select, "?label_".$locale);
        }
        $ppl = $query->newSubgraph()
                        ->where("?ppl", "<http://www.geonames.org/ontology#parentFeature>", "?geonames_id")
                        ->also("<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#P>")
                        ->also("<http://www.geonames.org/ontology#locationMap>", "?map")
                        ->also("<http://www.geonames.org/ontology#featureCode>", '?featureCode')                    
                        ->values(["?featureCode" => ["<http://www.geonames.org/ontology#P.PPLC>", "<http://www.geonames.org/ontology#P.PPLA>", "<http://www.geonames.org/ontology#P.PPLA2>", "<http://www.geonames.org/ontology#P.PPLA3>"]]);
        $query->select($select)
                ->where("?geonames_id", "<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#A>")
                ->also("rdf:type", "<http://www.geonames.org/ontology#Feature>")
                ->also("<http://www.geonames.org/ontology#name>", '?name')
                ->optional( "?geonames_id", "<http://www.geonames.org/ontology#population>", '?population')
                ->where( "?geonames_id", "<http://www.geonames.org/ontology#countryCode>", '?countryCode')
                ->where( "?geonames_id", "<http://www.geonames.org/ontology#parentCountry>", '?country')
                ->optional( "?geonames_id", '<http://www.w3.org/2003/01/geo/wgs84_pos#lat>', '?lat')
                ->optional( "?geonames_id", '<http://www.w3.org/2003/01/geo/wgs84_pos#long>', '?long')
                ->also("<http://www.geonames.org/ontology#parentFeature>", '?parent')
                ->optional("?geonames_id", "<http://www.geonames.org/ontology#childrenFeatures>", '?children')
                ->optional("?geonames_id", "rdfs:seeAlso", "?dbpedia")
                        ->optional(
                                $query->newSubgraph()
                                ->where("?geonames_id", "gn:wikipediaArticle", "?wikipedia")
                                ->filter("regex(str(?wikipedia), 'en.wikipedia')")
                                )    
                ->optional($ppl)  
                ->values(["?geonames_id" => [request()->geonames_id]]);  
        foreach(config("translatable.locales") as $key=>$locale){
            $query->optional(
                        $query->newSubgraph()
                        ->where('?ppl', 'gn:officialName|gn:alternateName', '?label'.$key)
                        ->where('?ppl', 'gn:name', '?def_label')
                        ->filter('langMatches(lang(?label'. $key.'), "' . $locale . '")')
                        )
                ->bind("if(bound(?label" . $key. "), ?label" . $key. ", ?def_label) as ?label_". $locale); 
        }
        //dd($query->getSPARQL());
        $results = $sparql->query($query);
        //dd($results);
        return response()->json($this->transform($results));
    }

    public function continents() {
        $sparql = new \EasyRdf_Sparql_Client(env("GEONAMES_ENDPOINT"));
        $query = new QueryBuilder(RdfNamespacesController::prefixes());
        $query->select("?uri", '?name', '?lat', '?long', '?parent', '?children')
                ->where("?uri", "<http://www.geonames.org/ontology#featureCode>", "<http://www.geonames.org/ontology#L.CONT>")
                ->also("<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#L>")
                ->also("rdf:type", "<http://www.geonames.org/ontology#Feature>")
                ->also("<http://www.geonames.org/ontology#name>", '?name')
                ->also("<http://www.geonames.org/ontology#parentFeature>", '?parent')
                ->also('<http://www.w3.org/2003/01/geo/wgs84_pos#lat>', '?lat')
                ->also('<http://www.w3.org/2003/01/geo/wgs84_pos#long>', '?long')
                ->optional("?uri", "<http://www.geonames.org/ontology#childrenFeatures>", '?children')
                ->orderBy("?name");
             
        $results = $sparql->query($query);
        
        return response()->json($this->transform($results));
        
    }
    
    public function continentRegions() {
        $sparql = new \EasyRdf_Sparql_Client(env("GEONAMES_ENDPOINT"));
        $query = new QueryBuilder(RdfNamespacesController::prefixes());
        $query->select("?uri", '?name', '?lat', '?long', '?parent', '?children')
                ->where("?uri", "<http://www.geonames.org/ontology#featureCode>", "<http://www.geonames.org/ontology#L.RGN>")
                ->also("<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#L>")
                ->also("rdf:type", "<http://www.geonames.org/ontology#Feature>")
                ->also("<http://www.geonames.org/ontology#name>", '?name')
                ->also("<http://www.geonames.org/ontology#parentFeature>", '?parent')
                ->also('<http://www.w3.org/2003/01/geo/wgs84_pos#lat>', '?lat')
                ->also('<http://www.w3.org/2003/01/geo/wgs84_pos#long>', '?long')
                ->optional("?uri", "<http://www.geonames.org/ontology#childrenFeatures>", '?children')
                ->orderBy("?name");
        if(request()->continent != null){
            $query->values(["?parent" => [request()->continent]]);
        }     
        $results = $sparql->query($query);
        
        return response()->json($this->transform($results));
        
    }

    public function countries() {
        $sparql = new \EasyRdf_Sparql_Client(env("GEONAMES_ENDPOINT"));
        $query = new QueryBuilder(RdfNamespacesController::prefixes());
        $query->select("?uri", '?name', '?population', '?countryCode', '?lat', '?long', '?parent', '?children')
                ->where("?uri", "<http://www.geonames.org/ontology#featureCode>", "<http://www.geonames.org/ontology#A.PCLI>")
                ->also("<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#A>")
                ->also("rdf:type", "<http://www.geonames.org/ontology#Feature>")
                ->also("<http://www.geonames.org/ontology#name>", '?name')
                ->also("<http://www.geonames.org/ontology#population>", '?population')
                ->also("<http://www.geonames.org/ontology#countryCode>", '?countryCode')
                ->also('<http://www.w3.org/2003/01/geo/wgs84_pos#lat>', '?lat')
                ->also('<http://www.w3.org/2003/01/geo/wgs84_pos#long>', '?long')
                ->also("<http://www.geonames.org/ontology#parentFeature>", '?parent')
                ->optional("?uri", "<http://www.geonames.org/ontology#childrenFeatures>", '?children')
                ->orderBy("?name");
        $results = $sparql->query($query);
        
        return response()->json($this->transform($results));
    }
    
    public function adm1() {
        $sparql = new \EasyRdf_Sparql_Client(env("GEONAMES_ENDPOINT"));
        $query = new QueryBuilder(RdfNamespacesController::prefixes());
        $query->select("?uri", '?name', '?population', '?countryCode', '?country', '?lat', '?long', '?parent', '?children')
                ->where("?uri", "<http://www.geonames.org/ontology#featureCode>", "<http://www.geonames.org/ontology#A.ADM1>")
                ->also("<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#A>")
                ->also("rdf:type", "<http://www.geonames.org/ontology#Feature>")
                ->also("<http://www.geonames.org/ontology#name>", '?name')
                ->optional( "?uri", "<http://www.geonames.org/ontology#population>", '?population')
                ->where( "?uri", "<http://www.geonames.org/ontology#countryCode>", '?countryCode')
                ->where( "?uri", "<http://www.geonames.org/ontology#parentCountry>", '?country')
                ->optional( "?uri", '<http://www.w3.org/2003/01/geo/wgs84_pos#lat>', '?lat')
                ->optional( "?uri", '<http://www.w3.org/2003/01/geo/wgs84_pos#long>', '?long')
                ->also("<http://www.geonames.org/ontology#parentFeature>", '?parent')
                ->optional("?uri", "<http://www.geonames.org/ontology#childrenFeatures>", '?children')
                ->orderBy("?name");
        
        if(request()->countryCode != null){
            $query->values(["?countryCode" => [request()->countryCode]]);
        }
        if(request()->country != null){
            $query->values(["?country" => [request()->country]]);
        }
        $results = $sparql->query($query);
        
        return response()->json($this->transform($results));
    }
    
    public function adm2() {
        $sparql = new \EasyRdf_Sparql_Client(env("GEONAMES_ENDPOINT"));
        $query = new QueryBuilder(RdfNamespacesController::prefixes());
        $query->select("?uri", '?name', '?population', '?countryCode', '?country', '?lat', '?long', '?parent', '?children')
                ->where("?uri", "<http://www.geonames.org/ontology#featureCode>", "<http://www.geonames.org/ontology#A.ADM2>")
                ->also("<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#A>")
                ->also("rdf:type", "<http://www.geonames.org/ontology#Feature>")
                ->also("<http://www.geonames.org/ontology#name>", '?name')
                ->also("<http://www.geonames.org/ontology#parentFeature>", '?parent')
                ->also("<http://www.geonames.org/ontology#countryCode>", '?countryCode')
                ->also("<http://www.geonames.org/ontology#parentCountry>", '?country')
                ->optional( "?uri", "<http://www.geonames.org/ontology#population>", '?population')
                ->optional( "?uri", '<http://www.w3.org/2003/01/geo/wgs84_pos#lat>', '?lat')
                ->optional( "?uri", '<http://www.w3.org/2003/01/geo/wgs84_pos#long>', '?long')
                ->optional("?uri", "<http://www.geonames.org/ontology#childrenFeatures>", '?children')
                ->orderBy("?name");
        
        if(request()->countryCode != null){
            $query->values(["?countryCode" => [request()->countryCode]]);
        }
        if(request()->country != null){
            $query->values(["?country" => [request()->country]]);
        }
        if(request()->adm1 != null){
            $query->values(["?parent" => [request()->adm1]]);
        }
        $results = $sparql->query($query);
        
        return response()->json($this->transform($results));
    }
    
    public function adm3() {
        $sparql = new \EasyRdf_Sparql_Client(env("GEONAMES_ENDPOINT"));
        $query = new QueryBuilder(RdfNamespacesController::prefixes());
        $query->select("?uri", '?name', '?population', '?countryCode', '?country', '?lat', '?long', '?parent', '?children')
                ->where("?uri", "<http://www.geonames.org/ontology#featureCode>", "<http://www.geonames.org/ontology#A.ADM3>")
                ->also("<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#A>")
                ->also("rdf:type", "<http://www.geonames.org/ontology#Feature>")
                ->also("<http://www.geonames.org/ontology#name>", '?name')
                ->optional( "?uri", "<http://www.geonames.org/ontology#population>", '?population')
                ->where( "?uri", "<http://www.geonames.org/ontology#countryCode>", '?countryCode')
                ->where( "?uri", "<http://www.geonames.org/ontology#parentCountry>", '?country')
                ->optional( "?uri", '<http://www.w3.org/2003/01/geo/wgs84_pos#lat>', '?lat')
                ->optional( "?uri", '<http://www.w3.org/2003/01/geo/wgs84_pos#long>', '?long')
                ->also("<http://www.geonames.org/ontology#parentFeature>", '?parent')
                ->optional("?uri", "<http://www.geonames.org/ontology#childrenFeatures>", '?children')
                ->orderBy("?name");  
        
        if(request()->countryCode != null){
            $query->values(["?countryCode" => [request()->countryCode]]);
        }
        if(request()->country != null){
            $query->values(["?country" => [request()->country]]);
        }
        if(request()->adm2 != null){
            $query->values(["?parent" => [request()->adm2]]);
        }
        $results = $sparql->query($query);
        
        return response()->json($this->transform($results));
    }
    
    public function adm4() {
        $sparql = new \EasyRdf_Sparql_Client(env("GEONAMES_ENDPOINT"));
        $query = new QueryBuilder(RdfNamespacesController::prefixes());
        $query->select("?uri", '?name', '?population', '?countryCode', '?country', '?lat', '?long', '?parent', '?children')
                ->where("?uri", "<http://www.geonames.org/ontology#featureCode>", "<http://www.geonames.org/ontology#A.ADM4>")
                ->also("<http://www.geonames.org/ontology#featureClass>", "<http://www.geonames.org/ontology#A>")
                ->also("rdf:type", "<http://www.geonames.org/ontology#Feature>")
                ->also("<http://www.geonames.org/ontology#name>", '?name')
                ->optional( "?uri", "<http://www.geonames.org/ontology#population>", '?population')
                ->where( "?uri", "<http://www.geonames.org/ontology#countryCode>", '?countryCode')
                ->where( "?uri", "<http://www.geonames.org/ontology#parentCountry>", '?country')
                ->optional( "?uri", '<http://www.w3.org/2003/01/geo/wgs84_pos#lat>', '?lat')
                ->optional( "?uri", '<http://www.w3.org/2003/01/geo/wgs84_pos#long>', '?long')
                ->also("<http://www.geonames.org/ontology#parentFeature>", '?parent')
                ->optional("?uri", "<http://www.geonames.org/ontology#childrenFeatures>", '?children');  
        
        if(request()->countryCode != null){
            $query->values(["?countryCode" => [request()->countryCode]]);
        }
        if(request()->country != null){
            $query->values(["?country" => [request()->country]]);
        }
        if(request()->adm3 != null){
            $query->values(["?parent" => [request()->adm3]]);
        }
        $results = $sparql->query($query);
        
        return response()->json($this->transform($results));
    }
    
    public function transform(\EasyRdf_Sparql_Result $input){
        $output = [];
        foreach ($input as $result) {
            $dump = [];
            foreach ($result as $key => $value) {
                if (class_basename($value) == "EasyRdf_Resource") {
                    $dump[$key] = $value->getUri();
                }
                elseif (class_basename($value) == "EasyRdf_Literal") {
                    $dump[$key] = $value->getValue();
                } 
            }
            array_push($output, $dump);
        }
        return $output;
        
    }

    public function getContinents(){
        $items = collect(json_decode($this->continents()->content()))->map(function($item, $key){
            $item->value = $item->uri;
            $item->label = $item->name;
            return $item;
        });
        return view("admin.codelists.geonamesSelect", [
            "items" => $items,
            "label" => "Continent",
            "id" => "continent",
            "function" => "getCountries"
        ]);
    }
    
    public function getCountries(){
        $items = collect(json_decode($this->countries()->content()))->map(function($item, $key){
            $item->value = $item->uri;
            $item->label = $item->name;
            return $item;
        });
        return view("admin.codelists.geonamesSelect", [
            "items" => $items,
            "label" => "Country",
            "id" => "country",
            "function" => "getAdm1"
        ]);
    }
    
    public function getAdm1(){
        $items = collect(json_decode($this->adm1()->content()))->map(function($item, $key){
            $item->value = $item->uri;
            $item->label = $item->name;
            return $item;
        });
        return view("admin.codelists.geonamesSelect", [
            "items" => $items,
            "label" => "Administrative Level 1",
            "id" => "adm1",
            "function" => "getAdm2"
        ]);
    }
    
    public function getAdm2(){
        $items = collect(json_decode($this->adm2()->content()))->map(function($item, $key){
            $item->value = $item->uri;
            $item->label = $item->name;
            return $item;
        });
        return view("admin.codelists.geonamesSelect", [
            "items" => $items,
            "label" => "Administrative Level 2",
            "id" => "adm2",
            "function" => "getAdm3"
        ]);
    }
    
    public function getAdm3(){
        $items = collect(json_decode($this->adm3()->content()))->map(function($item, $key){
            $item->value = $item->uri;
            $item->label = $item->name;
            return $item;
        });
        return view("admin.codelists.geonamesSelect", [
            "items" => $items,
            "label" => "Administrative Level 3",
            "id" => "adm3",
            "function" => "getAdm4"
        ]);
    }

    public function getAdm4(){
        $items = collect(json_decode($this->adm4()->content()))->map(function($item, $key){
            $item->value = $item->uri;
            $item->label = $item->name;
            return $item;
        });
        return view("admin.codelists.geonamesSelect", [
            "items" => $items,
            "label" => "Administrative Level 4",
            "id" => "adm4",
            "function" => ""
        ]);
    }

}
