@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => 'مسیرهای آموزشی - لیندا کده',
      'keywords' => get_seo_keywords() . ' , لیست مسیرهای آموزشی , learn path, learn-path, all learn paths ',
      'description' => 'لیست مسیرهای آموزشی | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [{
          "@type": "Organization",
          "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade",
          "name": "Lynda Kade - لیندا کده",
          "url": "https://LyndaKade.ir",
          "sameAs": [
            "https://www.aparat.com/LyndaKade.ir",
            "https://www.instagram.com/LyndaKade.ir/",
            "https://t.me/LyndaKade/"
          ],
          "logo": {
            "@type": "ImageObject",
            "@id": "https://LyndaKade.ir/#/schema/image/LyndaKade",
            "url": "https://lyndakade.ir/image/logoedit2.png",
            "width": 100,
            "height": 100,
            "caption": "Lynda Kade - لیندا کده"
          },
          "image": {
            "@id": "https://LyndaKade.ir/#/schema/image/LyndaKade",
            "inLanguage": "fa-IR",
            "url": "https://lyndakade.ir/image/logoedit2.png",
            "width": 100,
            "height": 100,
            "caption": "Lynda Kade - لیندا کده"
          }
        },
        {
          "@type": "WebSite",
          "@id": "https://LyndaKade.ir/#/schema/website/LyndaKade",
          "url": "https://LyndaKade.ir",
          "name": "Lynda Kade - لیندا کده",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://LyndaKade.ir/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
          },
          "publisher": {
            "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade"
          }
        },
        {
            "@type": "WebPage",
            "@id": "{{ request()->url() }}",
            "url": "{{ request()->url() }}",
            "inLanguage": "fa-IR",
            "name": "مسیرهای آموزشی - لیندا کده",
            "dateModified": "{{ \Carbon\Carbon::now() }}",
            "description": "",
            "isPartOf": {
              "@id": "https://LyndaKade.ir/#/schema/website/LyndaKade"
            },
            "about": {
              "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade"
            }
          },
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
              "@id": "{{ route('learn.paths.show', ['business']) }}",
              "name": "Business - کسب و کار",
              "url": "{{ route('learn.paths.show', ['business']) }}"
            }
          }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
              "@id": "{{ route('learn.paths.show', ['creative']) }}",
              "name": "Creative - خلاقیت",
              "url": "{{ route('learn.paths.show', ['creative']) }}"
            }
          }, {
            "@type": "ListItem",
            "position": 3,
            "item": {
              "@id": "{{ route('learn.paths.show', ['technology']) }}",
              "name": "Technology - تکنولوژی",
              "url": "{{ route('learn.paths.show', ['technology']) }}"
            }
          }]
        }
      ]
    }
  </script>
@endpush
@section('content')
  <div id="paths-hero" class="card bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 paths-hero-content">
          <h1>مسیرهای آموزشی</h1>
          <h2>مهارت های خود را تقویت کنید. تیز بمانید. جلو بروید.</h2>
          <p>کارشناسان صنعت برای شروع کار خود دانش و مهارت را به شما یاد می دهند.
            <br>
            مسیر خود را پیدا کنید. سفر خود را شروع کنید.
          </p>

          {{-- <div class="dropdown" dir="ltr">
            <button class="btn btn-dark btn-lg filter-paths" type="button" id="dropdownFilter" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              فیلتربندی
            </button>
            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownFilter">
              <span class="dropdown-item {{ $selected_category_id == -1 ? ' active' : '' }}" id="dropdown-see-all"
                onclick="changePaths('see-all')">همه</span>
              @foreach ($categories as $category)
                <span class="dropdown-item {{ $selected_category_id == $category->id ? ' active' : '' }}"
                  id="dropdown-{{ $category->id }}"
                  onclick="changePaths('{{ $category->id }}')">{{ $category->title }}</span>
              @endforeach
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    {{-- <img --}}
    {{-- class="card-img" --}}
    {{-- style=" --}}
    {{-- /*height: 450px;*/ --}}
    {{--  --}}{{-- background-size: cover; --}}
    {{--  --}}{{-- background: linear-gradient(to right,#000 0,rgba(0,0,0,.70) 40%,rgba(0,0,0,.70) 60%,#000 100%), --}}
    {{--  --}}{{-- url('{{ asset('learn paths/path-hero.jpg') }}'); --}}
    {{--  --}}{{-- background: url('{{ asset('learn paths/path-hero.jpg') }}') 50% 0 no-repeat; --}}
    {{-- "> --}}
  </div>
  <div id="learn-path-page">
    <div class="course row active mx-0 pb-3">
      <div class="col-md-2 col-sm-6 col-12 pt-md-5 text-right" style="margin-top: 1.5rem!important;">
        <div style="position: sticky; top: 15px;">
          <ul style="max-height: calc(100vh - 15px * 2);overflow-y: auto;">
            @foreach ($categories as $category)
              <li>
                <input type="radio" id="{{ $category->titleEng }}" name="category" class="cat"
                  data-id="{{ $category->id }}" {{ $selected_category_id == $category->id ? ' checked' : '' }}>
                <label for="{{ $category->titleEng }}" type="radio">{{ $category->title }}</label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-md-10 col-sm-6 col-12">
        @foreach ($categories as $category)
          <div id="cat-{{ $category->id }}" class="library-title row pb-0"
            style="margin-top: 2rem!important; {{ $selected_category_id == $category->id ? ' display:flex;' : ' display:none;' }}">
            <div class="col-12">
              <h3>{{ $category->title }}</h3>
            </div>
            @foreach ($category->paths as $learn_path)
              @include('learn_paths.partials.list_item_grid_new', [
                  'path' => $learn_path,
                  'loop' => $loop,
              ])
              {{-- <div class="col-sm-12 col-md-6 col-lg-3 p-2">
                <div class="card">
                  <a class="card-content"
                    href="{{ route('learn.paths.show', [explode(',', $learn_path->slug)[0]]) }}">
                    <div class="card-img">
                      <img src="#" class="lazyload card-img"
                        style="min-height: 150px !important;max-height: 200px !important;"
                        data-src="{{ fromDLHost($learn_path->thumbnail) }}"
                        alt="مسیر آموزشی {{ $learn_path->title }} - Image of Learn Path {{ $learn_path->titleEng }}" />
                    </div>
                    <div class="card-img-overlay text-center">
                      <h5 class="titlePer" style="height: 42px !important; font-size: initial;">
                        {{ $learn_path->title }}</h5>
                      <h5 class="titleEng" style="height: 42px !important; font-size: initial;">
                        {{ $learn_path->titleEng }}
                      </h5>
                      <div style="font-size: .8rem; font-weight: 400;">
                        زمان کل مسیر آموزشی
                        @if ($learn_path->durationHours() > 0)
                          {{ nPersian($learn_path->durationHours()) }}
                          ساعت
                        @endif
                        @if ($learn_path->durationMinutes() > 0)
                          {{ nPersian($learn_path->durationMinutes()) }}
                          دقیقه
                        @endif
                        <p class="mb-2 mt-2">تعداد دروس
                          {{ nPersian(count(js_to_courses($learn_path->_courses))) }}
                        </p>
                        <del
                          style="background-color: #6c757d;padding: 3px 4px;border-radius: 5px;">{{ nPersian($learn_path->old_price()) }}
                          تومان</del>
                        <span
                          style="background-color: lightgreen;padding: 3px 4px;border-radius: 5px;">{{ nPersian($learn_path->price()) }}
                          تومان</span>
                      </div>
                    </div>
                  </a>
                </div>
              </div> --}}
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
@section('script_body')
  <script>
    $(function() {
      $(document).on('click', '[name="category"]', function(event) {
        var cat_id = event.target.dataset.id;
        [].forEach.call(document.querySelectorAll(".library-title"), function(el) {
          if (el.id == `cat-${cat_id}`) {
            el.style.display = 'flex'
          } else {
            el.style.display = 'none'
          }
        });
      });
    });
  </script>
@endsection
