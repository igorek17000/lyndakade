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
          {{ auth()->user()->invoices }}
      </div>
      <div class="col-md-6">
          {{ auth()->user()->courses }}
      </div>
      <div class="col-md-2">
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
