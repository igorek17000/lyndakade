@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'پنل دوبله من - لیندا کده',
  'keywords' => get_seo_keywords() . ' , پنل دوبله من , my dubbed pandel, dubbed panel',
  'description' => 'پنل دوبله من | ' . get_seo_description(),
  ])
@endpush
@push('css_head')
@endpush
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <table class="table table-striped">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
            </tr>
        </tbody>
        </table>
      </div>
      <div class="col-md-6">
          {{ auth()->user()->courses }}
      </div>
      <div class="col-md-2">
          {{ auth()->user()->invoices }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-8">
      </div>
    </div>
  </div>
@endsection

@section('script_body')
  <script>
    $(document).ready(function() {
    });
  </script>
@endsection
