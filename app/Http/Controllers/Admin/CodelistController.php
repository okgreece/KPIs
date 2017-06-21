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
    public function getCodelists(){
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
    
    public function getCodelistSelect(){
        $codelists = collect(json_decode($this->getCodelists()->content()));
        
        return view("admin.codelists.codelistSelect", [
            "codelists" => $codelists,
            "type" => request()->type,
        ]);
    }
    
    public function getCollectionSelect(){
        $collections = collect(json_decode($this->getCollections()->content()));
        
        return view("admin.codelists.collectionSelect", [
            "collections" => $collections,
        ]);
    }
}
