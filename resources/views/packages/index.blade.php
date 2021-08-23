@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'لیندا کده | خرید اشتراک' ,
  'keywords' => get_seo_keywords() . ', خرید اشتراک , buy package , package, lyndakade package',
  'description' => 'خرید اشتراک | ' . get_seo_description(),
  ])
@endpush
@section('content')
  <div class="container">
    <h1>خرید اشتراک</h1>
    <p>
      با خرید اشتراک، در مدت زمان مورد نظر، میتوانید به تعداد دوره طرح، دوره هارو بصورت رایگان باز کنید و دانلود کنید.
    </p>
    <div class="row d-flex justify-content-center">
      @foreach ($packages as $package)
        <div class="col-md-3 col-sm-6">
          <h3>{{ $package['title'] }}</h3>

        </div>
      @endforeach
    </div>
  </div>
@endsection
