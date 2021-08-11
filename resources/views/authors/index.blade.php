@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'لیندا کده | مدرسین',
  'keywords' => get_seo_keywords() . ' , مدرسین , authors ',
  'description' => 'لیست تمامی مدرسین در وبسایت لیندا کده. | ' . get_seo_description(),
  ])
@endpush
@section('content')

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('css/mastersStyle.css') }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="border-bottom: 10px solid #ffca08;margin-top: 15px">
        <h3 class="text-center"> مدرسین لیندا </h3>
      </div>
    </div>
    <div class="category-details">
      <div class="category-more-details mt-4" STYLE="border-radius: 20px">
        <div class="category-description" style="padding-top: 5px;padding-bottom: 2px">
          <div class="container">
            <p class="text-center">
              نویسندگان با دقت انتخاب شده ما مربیان کلاس ، نویسندگان پرفروش و مقامات شناخته شده هستند. ما این
              متخصصان را انتخاب می کنیم زیرا آنها معلمان مؤثر ، پرشور و پرشور هستند که موضوع را قابل دستیابی و درک
              آسان می کنند.
            </p>
          </div>
        </div>
      </div>
    </div>

    <ul class="alpha-nav" style="">
      @foreach (array_keys($authors) as $key)
        <li><a href="#{{ $key }}">{{ $key }}</a></li>
      @endforeach
    </ul>

  </div>
  <div class="container mt-40">

    @foreach (array_keys($authors) as $key)
      <div id="{{ $key }}">
        <h4>{{ $key }}</h4>
      </div>

      <div class="row mt-30 mb-5">
        @foreach ($authors[$key] as $author)
          <div class="col-md-2 col-sm-4">
            <a href="{{ route('authors.show', [$author->slug]) }}">
              <div class="box2 m-0 mt-1" style="border-radius: 20px">
                <img src="#" data-src="{{ fromDLHost($author->img) }}" class="lazyload">
                <div class="box-content">
                  <div class="inner-content">
                    <h3 class="title">{{ $author->name }}</h3>
                    <span class="post">
                      {{-- {{ $author->specialty }} --}}


                      {{-- @foreach ($author->subjects as $subject)
                        {{ $subject->title }}
                        @if ($subject->id != $author->subjects->last()->id)
                          ,
                        @endif
                      @endforeach --}}
                    </span>
                    {{-- <ul class="icon">
                                            <li><a href="{{ route('authors.show', [$author->slug, $author->id, rand(0, 20)]) }}"><i class="fa fa-address-card"></i></a></li>
                                        </ul> --}}
                  </div>
                </div>
              </div>
            </a>
            {{-- <div class="row align-items-center d-flex justify-content-center">
                            <a  href="{{ route('authors.show', [$author->slug, $author->id, rand(0, 20)]) }}"><button  style="border-radius: 20px;background-color:#fdc840;width: 200px;height: 30px;">  بررسی رزومه استاد</button></a>
                        </div> --}}
          </div>
        @endforeach
      </div>
    @endforeach
  </div>
@endsection
