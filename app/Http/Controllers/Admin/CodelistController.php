<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;

use Asparagus\QueryBuilder;
use EasyRdf;

class CodelistController extends Controller
{
    public function getCodelists($localCodelists = null){
        $locale = \App::getLocale();
        $sparqlBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
        $sparqlBuilder->selectDistinct("?codelist", "?label")
            ->where("?codelist", "a", "skos:ConceptScheme")
            ->optional(
                    $sparqlBuilder->newSubgraph()
                    ->where('?codelist', 'rdfs:label', '?label1')
                    ->filter('langMatches(lang(?label1), "' . $locale . '")')
                    )

            ->optional(
                    $sparqlBuilder->newSubgraph()
                    ->where('?codelist', 'rdfs:label', '?label2')
                    ->filter('langMatches(lang(?label2), "en")')
                    )
            ->bind("if(bound(?label1), ?label1, ?label2) as ?label");
        if (!empty($localCodelists)) {
            $sparqlBuilder->values(["?codelist" => $localCodelists]);
        }
        $query = $sparqlBuilder->getSPARQL();
        $endpoint = new \EasyRdf_Sparql_Client(env("ENDPOINT"));
        $results = $endpoint->query($query);
        $codelists = [];
        foreach ($results as $row) {
            array_push($codelists, ["label" => isset($row->label) ?$row->label->getValue(): $row->codelist->getUri(), "value" => $row->codelist->getUri()]);
        }
        return response()->json($codelists);
    }
    
    public function getCollections(){
        $locale = \App::getLocale();
        $sparqlBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
        $sparqlBuilder->selectDistinct("?collection", "?label")
            ->where("?collection", "a", "skos:Collection")
            ->where("?collection", "skos:inScheme", "<" . request()->codelist . ">")
                ->optional(
                    $sparqlBuilder->newSubgraph()
                    ->where('?collection', 'rdfs:label', '?label1')
                    ->filter('langMatches(lang(?label1), "' . $locale . '")')
                    )

            ->optional(
                    $sparqlBuilder->newSubgraph()
                    ->where('?collection', 'rdfs:label', '?label2')
                    ->filter('langMatches(lang(?label2), "en")')
                    )
            ->bind("if(bound(?label1), ?label1, ?label2) as ?label");
        $query = $sparqlBuilder->getSPARQL();
        $endpoint = new \EasyRdf_Sparql_Client(env("ENDPOINT"));
        $results = $endpoint->query($query);
        $collections = [];
        foreach ($results as $row) {
            array_push($collections, ["label" => isset($row->label) ?$row->label->getValue(): $row->collection->getUri(), "value" => $row->collection->getUri()]);
        }
        return response()->json($collections);
    }
    
    public function getCodelistSelect($selected = null){
        $type = request()->type;
        if($type === 0){
            $codelists = collect(json_decode($this->getCodelists()->content()));
        }
        else{
            $codelists = collect(json_decode($this->getLocalCodelists()));
        }
        if($selected){

            $codelists->transform(function($item) use ($selected){
                if($item->value === $selected->codelist){
                    $item->selected = true;

                }
                return $item;
            });
        }
        return view("admin.codelists.codelistSelect", [
            "codelists" => $codelists,
            "function" => request()->func,
            "type" => request()->type,
        ]);
    }
    
    public function getLocalCodelists(){
        $codelistsInitial = \DB::table("codelist_collections")->pluck("codelist")->unique()->toArray();
        $codelists = $this->getCodelists($codelistsInitial)->content();
        return $codelists;
    }
    
    public function getCollectionSelect(){
        $collections = \App\CodelistCollection::where('codelist', '=', request()->codelist)->get()->map(function($item, $key){            
            $item->label = $item->title;
            $item->value = $item->id;
            return $item;
        });
        return view("admin.codelists.collectionSelect", [
            "collections" => $collections,
        ]);
    }
    
    public function getCodelist(){
        $locale = \App::getLocale();
        $sparqlBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
        $sparqlBuilder->selectDistinct("?concept", "?label", "?notation", "?broader" )
            ->where("?concept", "a", "skos:Concept")
            ->also("skos:notation","?notation" )
            ->also("skos:inScheme", "<" . request()->codelist . ">")
            ->optional("?concept", "skos:broader", "?broader")
            ->optional(
                $sparqlBuilder->newSubgraph()
                ->where('?concept', 'skos:prefLabel', '?label1')
                ->filter('langMatches(lang(?label1), "' . $locale . '")')
                )
            ->optional(
                $sparqlBuilder->newSubgraph()
                ->where('?concept', 'skos:prefLabel', '?label2')
                ->filter('langMatches(lang(?label2), "en")')
                )
            ->optional(
                $sparqlBuilder->newSubgraph()
                    ->where('?concept', 'skos:prefLabel', '?label3')
            )
            ->bind("coalesce(?label1, ?label2, ?label3) as ?label")
            ->orderBy("?broader");
        $query = $sparqlBuilder->getSPARQL();
        $endpoint = new \EasyRdf_Sparql_Client(env("ENDPOINT"));
        $results = $endpoint->query($query);
        $collections = [];
        foreach ($results as $row) {
            array_push($collections, 
                    [
                        "label" => isset($row->label) ?$row->label->getValue(): $row->notation->getValue(),
                        "notation" => $row->notation->getValue(),
                        "value" => $row->concept->getUri(),
                        "broader" => isset($row->broader) ? $row->broader->getUri(): ""
                    ]);
        }
        return response()->json($collections);
    }
    
    public function codelist2select(){
        $concepts = $this->constructPaths();
        return view("admin.codelists.conceptSelect", [
            "concepts" => $concepts,
            "scheme" => request()->codelist,
        ]);
    }
    
    public function constructPaths(){
        $concepts = collect(json_decode($this->getCodelist()->content()));
        $concepts->map(function($item, $key) use ($concepts){
            $path = $this->getBroader($item, $concepts);
            $item->path = $path;
            
            return ;
        });
       
        return $concepts;
    
    }
    
    public function getBroader($item, $concepts, $path = null){
        if($item->broader == ""){
                $path = "scheme" . "/" . $path;
        }
        else{
            //get new item from broader
            $broader = $concepts->search(function ($item2, $key) use($item) {
                return $item2->value == $item->broader;
                
            });
//            dd([
//                "broader" => $broader,
//                "concept" => $concepts[$broader]
//            ]);
            $path = $this->getBroader($concepts[$broader], $concepts , $concepts[$broader]->notation . '/' . $path);
            
            //check if it's path is set
                //get it's path and notation and end the procedure
            //else make it's path    
        }
        
        return rtrim($path, '/');
    }
}
