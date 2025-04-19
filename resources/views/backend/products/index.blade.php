
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{config('apps.products.title')}}</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{route('dashboard.index')}}">Dashboard</a>
            </li>
            <li class="active"><strong>{{config('apps.products.table1')}}</strong></li>
        </ol>
    </div>
</div>
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            
            <div class="ibox-title">
                <h5>{{config('apps.products.tableheading')}} </h5>
                @include('backend.products.component.toolbox')
            </div>
            <div class="ibox-content">
               @include('backend.products.component.filter')
               @include('backend.products.component.table')
            </div>
        </div>
    </div>
</div>

