<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Asparagus\QueryBuilder;
use EasyRdf;

class DashboardController extends Controller
{
    public function index(){
        $organizations = $this->organizations();
        return view('welcome', [            
            "organizations" => $organizations,
        ]);
        
    }
    
    public function dashboard(Request $request){
       
        $indicators = $this->getEnabled();
        $values = [];
        foreach($indicators as $indicator){
            $request->request->set("indicatorID", $indicator->id);
            array_push($values, [
                "indicator" => $indicator,
                "value" => $this->getValue($request),
                ]);
        }
        
        return view('indicators/components', [
            "indicators" => $values,
            
        ]);
    }
    
    private static $prefixes = array(
        'gr-dimension' => 'http://data.openbudgets.eu/ontology/dsd/greek-municipalities/dimension/',
        'obeu-budgetphase' => 'http://data.openbudgets.eu/resource/codelist/budget-phase/',
        'obeu-measure' => 'http://data.openbudgets.eu/ontology/dsd/measure/',
        'obeu-dimension' => 'http://data.openbudgets.eu/ontology/dsd/dimension/',
        'qb' => 'http://purl.org/linked-data/cube#',
        'skos' => 'http://www.w3.org/2004/02/skos/core#',
        'rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
        'rdfs' => "http://www.w3.org/2000/01/rdf-schema#"
    );
    
    public function organizations(){
        
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        $candidates = $sparql->query($this->organizationsQuery());
        $organizations = [];
        foreach($candidates as $candidate){
            
            array_push($organizations, ["label"=>$this->getLabel($candidate->organization), "value" => $candidate->organization, "population" => 10000000]);
        }
  
        return $organizations;
    }
    
    public function organizationsquery() {

        $queryBuilder = new QueryBuilder(self::$prefixes);
               
        $queryBuilder->selectDistinct("?organization")
                ->where('?dataset', 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', '?organization');
               
        $query = $queryBuilder->getSPARQL();
       
        return $query;
    }
    
    public function getPopulation(){
        
    }
    
    public function getLabel($uri){
        $queryBuilder = new QueryBuilder(self::$prefixes);
               
        $queryBuilder->selectDistinct("?label")
                ->where('<' . $uri . '>', 'rdfs:label', '?label');
                
               
        $query = $queryBuilder->getSPARQL();
        
        $sparql = new \EasyRdf_Sparql_Client("http://el.dbpedia.org/sparql");
        $labels = $sparql->query($query)[0]->label->getValue();
        
        return $labels;
        
    }
    
    public function phases(){
        $request = request();
        $organization = $request->organization;
        $queryBuilder = new QueryBuilder(self::$prefixes);
        $lang = "en";       
        $queryBuilder->selectDistinct("?phase", "?label")
                ->where('?dataset', 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', '<' . $organization . '>')
                ->also('qb:structure', '?dsd')
                ->where('?dsd', 'qb:component', '?component')
                ->where('?component', 'qb:dimension', "?dimension")
                ->where('?dimension', 'rdfs:subPropertyOf', '<http://data.openbudgets.eu/ontology/dsd/dimension/budgetPhase>')
                ->also( 'qb:codeList', '?codelist')
                ->where('?codelist', 'skos:hasTopConcept', '?phase')
                ->optional('?phase', 'skos:prefLabel', '?label')
                ->filter('langMatches(lang(?label), "' . $lang . '")')
                ->orderBy("?phase");
   
        $query = $queryBuilder->getSPARQL();        
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        
        $labels = $sparql->query($query);
        $phases = [];
        foreach($labels as $label){
            array_push($phases, ["label"=>$label->label->getValue(), "value"=>$label->phase]);
        }    
        
        return view('indicators.templates.phase', ["phases" => $phases]);
        
    }
    
    public function years(){
        $request = request();
        $organization = $request->organization;
        $queryBuilder = new QueryBuilder(self::$prefixes);
               
        $queryBuilder->selectDistinct("?year")
                ->where('?dataset', 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', '<' . $organization . '>')
                ->also('qb:structure', '?dsd')
                ->also('?dimension', '?year')
                ->where('?dsd', 'qb:component', '?component')
                ->where('?component', 'qb:dimension', "?dimension")
                ->where('?dimension', 'rdfs:subPropertyOf', '<http://data.openbudgets.eu/ontology/dsd/dimension/fiscalPeriod>')
                ->orderBy("?year");
                
        $query = $queryBuilder->getSPARQL();        
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        
        $labels = $sparql->query($query);
//       / dd($query);
        $years = [];
        foreach($labels as $label){
            $path = parse_url($label->year, PHP_URL_PATH);
            $pathFragments = explode('/', $path);
            $end = end($pathFragments);
            array_push($years, ["label"=>$end, "value"=>$label->year]);
        }    
        
        return view('indicators.templates.year', ["years" => $years]);
        
    }
    
    public function getEnabled(){
        $indicators = \App\Indicator::where('enabled', '=', true)->get();
        return $indicators;
    }
    
    public function getValue(Request $request){
        $indicator = new Admin\IndicatorsController;
        return $indicator->value($request)->getData();
    }
}
