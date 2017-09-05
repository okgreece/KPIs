<div class="col-md-3">
    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Sidebar
        </div>

        <div class="panel-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
<!--                    <a href="{{ url('/admin') }}">
                        Dashboard
                    </a>-->
                    @if(\Entrust::can('manage-options'))
                    <a href="{{ route('organizations.index') }}">
                        Organizations
                    </a>
                    <a href="{{ route('groups.index') }}">
                        Groups
                    </a>
                    <a href="{{ route('aggregators.index') }}">
                        Aggregators
                    </a>
                    <a href="{{ route('indicators.index') }}">
                        Indicators
                    </a>
                    @endif
                    @if(\Entrust::can('manage-ontology'))
                    <a href="{{ route('aggregator-instances.index') }}">
                        Aggregator Instances
                    </a>
                    <a href="{{ route('codelist-collections.index') }}">
                        Codelist Collections
                    </a>
                    @endif
                    @if(\Entrust::can('manage-options'))
                    <a href="{{ route('rdf-namespaces.index') }}">
                        RDF Namespaces
                    </a>
<!--                    
                    <a href="{{ route('o-s-endpoints.index') }}">
                        OS Endpoints
                    </a>
                    <a href="{{ route('s-p-a-r-q-l-endpoints.index') }}">
                        SPARQL Endpoints
                    </a>-->
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
