@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => date_get_seo_title($coursetype) . ' - لیندا کده',
      'keywords' => get_seo_keywords() . ' , ' . date_get_seo_keywords($coursetype),
      'description' => date_get_seo_title($coursetype) . ' | ' . get_seo_description(),
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
            "name": "{{ date_get_seo_title($coursetype) }} - لیندا کده",
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
          "@id": "https://LyndaKade.ir/#/schema/breadcrumb/LyndaKade",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
              "@id": "https://LyndaKade.ir/Learning",
              "name": "Learning",
              "url": "https://LyndaKade.ir/Learning"
            }
          }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
              @if ($coursetype == 'newest')
                {{ route('courses.newest') }}
              @elseif ($coursetype == 'best')
                {{ route('courses.best') }}
              @elseif ($coursetype == 'free')
                {{ route('courses.free') }}
              @endif",
              @if ($coursetype == 'newest')
                جدیدترین دوره های آموزشی
              @elseif ($coursetype == 'best')
                محبوب دوره های آموزشی
              @elseif ($coursetype == 'free')
                دوره های آموزشی رایگان
              @endif",
              @if ($coursetype == 'newest')
                {{ route('courses.newest') }}
              @elseif ($coursetype == 'best')
                {{ route('courses.best') }}
              @elseif ($coursetype == 'free')
                {{ route('courses.free') }}
              @endif"
            }
          }]
        },
        {
          "@context": "https://schema.org",
          "@type": "ItemList",
          "itemListElement": [
            @foreach ($courses->take(10) as $course)
              {
              "@type": "ListItem",
              "position": "{{ $loop->index + 1 }}",
              "item": {
              "@type": "Course",
              "image": "{{ fromDLHost($course->img) }}",
              "url": "{{ route('courses.show.linkedin', [$course->slug_linkedin]) }}",
              "name": "{{ $course->titleEng }} - {{ $course->title }}",
              "description": "{{ $course->description }}",
              "dateCreated": "{{ $course->updateDate ?? $course->releaseDate }}",
              "timeRequired":
              "{{ $course->durationHours > 0 ? $course->durationHours . 'h ' . $course->durationMinutes . 'm' : $course->durationMinutes . 'm' }}",
              "provider": [
              @foreach ($course->authors as $author)
                {
                "@type": "Person",
                "name": "{{ $author->name }}",
                "url": {"@id": "{{ route('authors.show', [$author->slug]) }}"}
                }
                @if (!$loop->last)
                  ,
                @endif
              @endforeach
              ]
              }
              }
              @if (!$loop->last)
                ,
              @endif
            @endforeach
          ]
        }
      ]
    }
  </script>
@endpush
@section('content')
  <h1 class="sr-only">
    @if ($coursetype == 'newest')
      جدیدترین دوره های آموزشی
    @elseif ($coursetype == 'best')
      محبوب دوره های آموزشی
    @elseif ($coursetype == 'free')
      دوره های آموزشی رایگان
    @endif
  </h1>
  @csrf
  <div class="row mx-0 justify-content-center">
    <aside class="col-md-10">
      <div class="section-module">
        <div class="row d-flex " id="course-list">
          @foreach ($courses as $course)
            @include('courses.partials._course_list_grid', ['course' => $course])
          @endforeach
        </div>
        <div class="col-12 mb-4 mt-2">
          <button class="btn btn-light load-more w-100" coursetype="button" style="margin: auto;">
            <span class="text-t">نمایش دادن 40 دوره آموزشی بعدی</span>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin: auto;"></span>
          </button>
        </div>
      </div>
    </aside>
  </div>
@endsection
@push('js')
  <script>
    $(function() {
      $('.load-more').click(function(e) {
        var page = ($('#course-list .course').length / 40) + 1;
        var el = this;
        $(el).prop('disabled', true);
        $.ajax({
          url: '{{ route('courses.' . $coursetype) }}',
          method: 'get',
          data: {
            _token: $('[name="_token"]').val(),
            page: page,
          },
          success: function(result) {
            var course_list = document.getElementById('course-list');
            for (let res of result) {
              // console.log(res);
              course_list.insertAdjacentHTML('beforeend', res)
            }
            $(el).prop('disabled', false);
          },
          errors: function(xhr) {
            console.log(xhr);
            $(el).prop('disabled', false);
          }
        });
      })
    });
  </script>
@endpush
