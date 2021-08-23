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
  <style>
    .w-20 {
      user-select: none;
    }

    .w-20 .card-body:hover {
      background-color: #00c0ef !important;
    }


    @media(min-width: 768px) {
      .w-20 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 20% !important;
        flex: 0 0 20% !important;
        max-width: 20%;
      }
    }

    @media(max-width: 768px) {

      .w-20 .card-body {
        background-color: #00c0ef !important;
      }

    }

  </style>
  <div class="container card mt-0 my-md-5 py-3 ">
    <h1>خرید اشتراک</h1>
    <p>
      با خرید اشتراک، در مدت زمان مورد نظر، میتوانید به تعداد دوره طرح، دوره هارو بصورت رایگان باز کنید و دانلود کنید.
    </p>
    <div class="row d-flex justify-content-center text-center mx-md-5 mt-3" style="font-size: 1.2em;">
      @foreach ($packages as $package)
        <div class="w-20 col-sm-4 mb-4 mx-md-auto mx-5">
          <div class="card-body" style="border: darkcyan 2px solid; border-radius: 10px; height: 300px !important;">
            <h3 class="pt-5 pb-4">{{ $package['title'] }}</h3>
            <p>{{ nPersian($package['days']) }} روزه</p>
            <p>{{ nPersian($package['count']) }} دوره آموزشی</p>
            <p>{{ nPersian(number_format($package['price'])) }} تومان</p>
            <button class="btn btn-secondary">خرید طرح</button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
