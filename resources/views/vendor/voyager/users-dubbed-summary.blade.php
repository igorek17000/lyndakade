@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') . ' Users Dubbed Summary')

@section('page_header')
  <div class="container-fluid">
    <h1 class="page-title">
      Users Dubbed Summary
    </h1>
  </div>
@stop

@section('content')
  <div class="page-content browse container-fluid">
    @include('voyager::alerts')
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-bordered">
          <div class="panel-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-hover">
                <thead>
                  <tr>
                    <th>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
@stop

@section('javascript')
    <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
@stop
