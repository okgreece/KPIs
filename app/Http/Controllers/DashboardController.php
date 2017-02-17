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
    
    public function evolution(){
        $values = $this->getYearly();
        $chart = $this->getYearlyChart($values);
        return view('indicators/time', ["chart" => $chart]);
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
    
    public function getYearly(){
        $request = request();
        $years = $this->years()->years;
        $values = [];
        foreach($years as $year){
            $request->request->set('year', $year["value"]);        
            $value = $this->getValue($request);
            array_push($values, ["year"=>$year["label"], "value" => $value]);            
        }
        return response()->json($values);
    }
    
    
   public function y($array){
       return $array["year"];
   }
   
   public $color_palette = [
       "red",
       "yellow",
       "blue",
       "green"
   ];
   
   public function chartTransform($data){
        $request = request();
        $indicator = \App\Indicator::find($request->indicatorID);
        $values = collect(json_decode($data->content()));
        
        if($indicator->type == 0){
            $multiplier = 100;
            $yaxis = "Percent";
        }
        else{
            $multiplier = 1;
            $yaxis = "Euro per citizen";
        }
        
        $labels = $values->map(function($item, $key){
            return $item->year;
        })->all();
        $series = $values->map(function($item, $key) use ($multiplier){
            return $item->value * $multiplier;
        })->all();      
        
        $dataset = [
                "label" => $indicator->title,
                "fill" => false,
                "lineTension" => "0.1",
                "type" => "bar",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $series,
            ];
        $result = ["labels" => $labels, "datasets" => $dataset];
        return response()->json($result);
   }
    
    public function getYearlyChart($data){
        
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
            "legend"=> [
                "display" => true,
                "position" => "bottom",
            ]
        ]);

        return $chartjs;
    }
/*    
    
    var response = {!! $values->content() !!}
    var SeriesLabels = $.map(response, function(el) { return el.year; })
    var Series = $.map(response, function(el) { return el.value; })

    
    var label = "Δείκτης Συνολικών Εσόδων ανα Κάτοικο";
    var data = {
        labels: SeriesLabels,
        datasets: [
            {
                label: label,
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#" + colors[1],
                borderColor: "#" + colors[1],
                borderColor: "#" + colors[1],
                        borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: "miter",
                pointBorderColor: "#" + colors[1],
                pointBorderColor: "#" + colors[1],
                        pointBackgroundColor: "#" + colors[1],
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#" + colors[1],
                pointHoverBorderColor: "#" + colors[1],
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: Series
            }]
    };
    var options = {
        graphTitleFontSize: 18,
        graphTitle: "MyTitle",
        responsive: false};

    var myLineChart = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
    });
 * 
 */
}
