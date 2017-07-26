<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Asparagus\QueryBuilder;
use App\Organization;
use App\GeonamesInstance;
use Illuminate\Http\Request;
use Session;

class OrganizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $organizations = Organization::where('uri', 'LIKE', "%$keyword%")
				->orWhere('enabled', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $organizations = Organization::paginate($perPage);
        }

        return view('admin.organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $availableOrganizations = $this->availableOrganizationsSelect();
        return view('admin.organizations.create', compact('availableOrganizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->geonamesId();
        $requestData = request()->all();
        
        $this->validate($request, [
           'uri' => 'unique:organizations|url'
        ]);
        
        $geoinstance = GeonamesInstance::create($requestData);
        foreach(config("translatable.locales") as $key=>$locale){
            $geoinstance->translateOrNew($locale)->label = $requestData["label_".$locale];
        }
        $geoinstance->save();
        
        $requestData["geonames_instance_id"] = $geoinstance->id;
        
        
        
        Organization::create($requestData);

        Session::flash('flash_message', 'Organization added!');

        return redirect('admin/organizations');
    }
    
    public function geonamesId(){
        
        
        if(isset(request()->adm4)){
            request()->merge(["geonames_id" => request()->adm4]);
        }
        elseif(isset(request()->adm3)){
            request()->merge(["geonames_id" => request()->adm3]);
        }
        elseif(isset(request()->adm2)){
            request()->merge(["geonames_id" => request()->adm2]);
        }
        elseif(isset(request()->adm1)){
            request()->merge(["geonames_id" => request()->adm1]);
        }
        elseif(isset(request()->country)){
            request()->merge(["geonames_id" => request()->country]);
        }
        $controller = new GeonamesInstanceController;
       
        request()->merge((array)json_decode($controller->get()->content())[0]);
        return;        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $organization = Organization::findOrFail($id);

        return view('admin.organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        $availableOrganizations = $this->availableOrganizationsSelect();
        return view('admin.organizations.edit', [
            "organization" => $organization,
            "availableOrganizations" => $availableOrganizations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $requestData = $request->all();
        $organization = Organization::findOrFail($id);
        $this->validate($request, [
           'uri' => 'unique:organizations,'.$organization->id .'|url'
        ]);
        $organization->update($requestData);

        Session::flash('flash_message', 'Organization updated!');

        return redirect('admin/organizations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Organization::destroy($id);

        Session::flash('flash_message', 'Organization deleted!');

        return redirect('admin/organizations');
    }
    
    public function availableOrganizationsquery() {
        $queryBuilder = new QueryBuilder(RdfNamespacesController::prefixes());
        $queryBuilder->selectDistinct("?organization")
                ->where('?dataset', 'rdf:type', 'qb:DataSet')
                ->also('obeu-dimension:organization', '?organization')
                ->orderBy('?organization');
        $query = $queryBuilder->getSPARQL();
        return $query;
    }
    
    public function availableOrganizationsSelect(){
        $sparql = new \EasyRdf_Sparql_Client(env('ENDPOINT'));
        $candidates = $sparql->query($this->availableOrganizationsQuery());
        $includedOrganizations = Organization::all();
        
        $organizations = [];
        foreach ($candidates as $candidate) {
            //eliminate already included organizations
            $valid = $includedOrganizations->search(function($item, $key) use ($candidate){   
                return ($item->uri == $candidate->organization->getURI());  
            });
            if($valid !== false || strpos($candidate->organization->getUri(), "codelist/cl-geo") !== FALSE){
                continue;
            }
            else{
                array_push($organizations, [ "$candidate->organization" => $candidate->organization]);
            }
            
        }
        return $organizations;
    }
}
