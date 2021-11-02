@extends('layouts.app')
@if(isset($shown_item))
    @push('meta.in.head')
        @include('meta::manager',[
        'image' => fromDLHost($shown_item->img),
        'title' => $shown_item->title . ' - لیندا کده',
        'description' => $shown_item->description,
        'keywords' => get_seo_keywords() . ' , ' . $shown_item->title . ', ' . $shown_item->titleEng .  join(', ', explode(' ', $shown_item->title)) . ', ' . join(', ', explode(' ', $shown_item->titleEng)),
        ])
    @endpush
@else
    @push('meta.in.head')
        @include('meta::manager',[
            'image' => 'https://lyndakade.ir/image/logo.png',
            'title' => 'لیندا کده',
            'keywords' => get_seo_keywords(),
            'description' => get_seo_description(),
        ])
    @endpush
@endif
@section('content')
    <div class="container search-page">
        {{-- @if (isset($shown_item))
            <div class="row mb-5 justify-content-center shown-item">
                @if(isset($shown_item->img))
                    <div class="col-xs-12 col-md-6 subject-img" style="background-image: url({{ fromDLHost($shown_item->img) }});background-size: cover;" >
                    </div>
                @endif
                <div class="col-xs-12 col-md-6 subject-details">
                    <h1 class="subject-title">
                        {{ $shown_item->title }}
                    </h1>
                    @if($shown_item->description)
                        <p class="subject-description text-justify">
                            {{ $shown_item->description }}
                        </p>
                    @endif
                </div>
            </div>
        @endif --}}
        <div class="row my-3 justify-content-center">
            <aside id="search-filters" class="col-md-2 hidden-xs hiddem-sm search-filter-cont">
                <button class="btn btn-mobile" data-toggle="collapse" data-target="#search-sidebar">
                    <i class="fa fa-bars"></i>
                </button>
                <nav class="navbar navbar-expand  flex-md-column flex-row align-items-start">
                    <div id="search-sidebar" class="collapse navbar-collapse">
                        <ul class="filter-set ga-category accessible-tabs flex-md-column flex-row navbar-nav w-100 justify-content-between"
                            data-context="Category Filters">
                            @if(isset($categories_filter) && count($categories_filter) > 0)
                                @foreach($categories_filter as $category)
                                    <li class="nav-item">
                                        <span style="font-size: 1rem;"><b>{{ $category['title'] }}</b></span>
                                        <ul>
                                            @foreach($category['items'] as $index => $item)
                                                <li class="filter-item"
                                                    @if($index > 4) style="{{ $index > 4 ? 'display:none;' : '' }}" @endif>
                                                    @if(isset($_GET[$category['key']]) && ($_GET[$category['key']] == $item['title'] || (isset($item['titleEng']) && $_GET[$category['key']] == $item['titleEng'])))
                                                        <span>
                                                    <strong>{{ $item['title'] }}<span class="result-count">({{ $item['count'] }})</span></strong>
                                                </span>
                                                    @else
                                                        <a class="filter ga ga-multiple" rel="nofollow"
                                                           href="{{ $item['link'] }}"> {{ $item['title'] }}<span
                                                                class="result-count">&nbsp;({{ $item['count'] }})</span>
                                                        </a>
                                                    @endif
                                                </li>
                                            @endforeach
                                            @if($category['hasMore'])
                                                <li class="show-more-toggle">
                                                    <button class="btn btn-link">
                                                        <span>+ موارد بیشتر</span>
                                                    </button>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </nav>
            </aside>

            <section class="col-xs-12 col-md-10 search-results-cont pull-left">
                <div class="row">
                    <section id="search-results-bar">
                        <div class="row mx-1">
                            @if (isset($shown_item))
                            <div class="col-xs-12 mb-3">
                                <h1 class="subject-title w-100">
                                    <span>
                                        {{ $shown_item->title }}
                                    </span>
                                    <span class="text-left" style="float: left;" dir="ltr">
                                        {{ $shown_item->titleEng ?? '' }}
                                    </span>
                                </h1>
                            </div>

                            @endif
                            @if(isset($result_count) && isset($q))
                                <div class="results-heading col-xs-12 col-sm-8">
                                    {{ $result_count }}
                                    مورد برای
                                    <span class="term">{{ $q }}</span>
                                    {{ count($_GET) > 1 ? ' و موارد انتخاب شده ' : '' }}
                                    یافته شد
                                </div>
                            @else
                                <div class="results-heading col-xs-12 col-sm-8">
                                </div>

                            @endif
                            <div class="hidden-xs col-sm-4">
                                <div class="sort-filters">
                                    <span>مرتب شده با</span>
                                    <select name="sort">
                                        <option value="1">بیشترین مطابقت</option>
                                        <option value="2">تاریخ انتشار</option>
                                    </select>
                                </div>
                            </div>
                            @if(isset($filtered_items) && count($filtered_items) > 0)
                                <div class="col-xs-12 pills">
                                    <div class="selected-filters">
                                        <span class="filtered-title">موارد انتخاب شده</span>
                                        <ul class="active-filters">
                                            @foreach($filtered_items as $filtered_item)
                                                <li>
                                                    <a class="filter-remove"
                                                       href="{{ $filtered_item['link'] }}"
                                                       data-type="{{ $filtered_item['key'] }}"
                                                       data-name="{{ $filtered_item['title'] }}">
                                                        <span
                                                            class="sr-only">{{ $filtered_item['title'] }} - Remove filter</span>
                                                        <span class="label" aria-hidden="true"><i
                                                                class="lyndacon close-x"></i>{{ $filtered_item['title'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                    @if(isset($object))
                        <div class="card flex-row flex-wrap w-100 py-3 {{ $object['img'] ? '' : ' px-3 ' }}">
                            @if($object['img'])
                                <div class="card-header border-0" style="
                                    max-width: 160px;
                                    background: transparent;
                                ">
                                    <img src="{{ fromDLHost($object['img']) }}" alt="" style="
                                    width: 100%;
                                    border-radius: 50%;
                                ">
                                </div>
                            @endif
                            <div class="card-block px-2" style="{{ $object['img'] ? ' max-width: 70%; ' : '' }}">
                                <span class="card-title mb-2">{{ $object['type'] }}</span><p></p>
                                <h2 class="card-title">{{ $object['title'] }}</h2>
                                <p class="card-text text-justify">{{ $object['description'] }}</p>
                            </div>
                            <div class="w-100"></div>
                        </div>
                    @endif
                    <section id="search-results">
                        <div class="row mx-1" id="search-results-list">
                            @if(count($courses) == 0)
                                نتیجه ای یافت نشد.
                            @endif
                            <style>
                                .timeline > li > .timeline-panel {
                                    width: calc(100% - 15px) !important;
                                }
                                .timeline:before {
                                    width: 0 !important;
                                }
                            </style>
                        <ul class="timeline pb-0" id="course-list">
                            @foreach ($courses as $course)
                                @include('courses.partials._course_list_timeline', ['course'=> $course])

                            {{-- <li class="course">
                                <a href="{{ courseURL($course) }}" class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h2 class="timeline-title" style="font-size: 1.25rem;">
                                            <p class="m-0">
                                            {{ $course->title }}
                                            <small class="text-muted">
                                                توسط
                                                <span class="text-left" dir="ltr">
                                                    @foreach ($course->authors as $author)
                                                        {{ $author->name }}
                                                        @if (!$loop->last)
                                                        ,
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </small>
                                            </p>
                                            <p dir="ltr" class="text-left m-0">
                                                {{ $course->titleEng }}
                                                <small class="text-muted">
                                                    by
                                                    <span>
                                                        @foreach ($course->authors as $author)
                                                            {{ $author->name }}
                                                            @if (!$loop->last)
                                                            ,
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                </small>
                                            </p>
                                        </h2>
                                    </div>
                                    <div class="timeline-body text-justify row">
                                    <div class="col-md-3 col-sm-12 text-center">
                                        <img src="#" class="lazyload" data-src="{{ $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img) }}" style="max-height: 150px;" />

                                    </div>
                                    <div class="col-md-9  col-sm-12">
                                        <p class="mt-md-3" style="word-break: break-word;
                                                                    overflow: hidden;
                                                                    text-overflow: ellipsis;
                                                                    display: -webkit-box;
                                                                    line-height: 2; /* fallback */
                                                                    /* fallback */
                                                                    -webkit-line-clamp: 3; /* number of lines to show */
                                                                    -webkit-box-orient: vertical;">
                                        {!! $course->description !!}
                                        </p>
                                        <div class="row">
                                        <div class="col-md-3 col-6 pb-1">
                                            <b>مدت زمان:</b>
                                            {{ $course->durationHours ? $course->durationHours . 'h ' : '' }}
                                            {{ $course->durationMinutes ? $course->durationMinutes . 'm' : '' }}
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <b>سطح:</b>
                                            {{ \App\SkillLevel::find($course->skillLevel)->title }}
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <b>تاریخ انتشار:</b>
                                            <span id="release-date" title="در لینکدین {{ date('Y/m/d', strtotime($course->releaseDate)) }}">
                                            {{ date('Y/m/d', strtotime($course->releaseDate)) }}
                                            </span>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <b>زیرنویس:</b>
                                            @if (get_course_status_state($course->dubbed_id))
                                            <span>دوبله شده</span>
                                            @elseif (get_course_status_state($course->persian_subtitle_id) &&
                                            get_course_status_state($course->english_subtitle_id))
                                            <span>انگلیسی و فارسی</span>
                                            @elseif (get_course_status_state($course->persian_subtitle_id))
                                            <span>فارسی</span>
                                            @elseif (get_course_status_state($course->english_subtitle_id))
                                            <span>انگلیسی</span>
                                            @else
                                            <span style="color: red">
                                                ندارد
                                            </span>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </a>
                            </li> --}}
                            @endforeach
                        </ul>

                            {{-- @foreach($courses as $course)
                                    @include ('.courses.partials._course_list_grid', ['course' => $course, 'col' => 'col-lg-4'])
                            @endforeach --}}
                        <div class="col-12 mb-4 mt-2">
                            <button class="btn btn-light load-more w-100" coursetype="button" style="margin: auto;">
                            <span class="text-t">نمایش موارد بیشتر</span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin: auto;"></span>
                            </button>
                        </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script>

    $(function() {
      $('.load-more').click(function(e) {
        var page = ($('#course-list .course').length / 20) + 1;
        var el = this;
        $(el).prop('disabled', true);
        urlObject = new URL(document.location.href);
        params = urlObject.searchParams;
        let data = {
            _token: $('[name="_token"]').val(),
            page: page,
        }
        for(let item of params){
            let pa = item[0], pb = item[1];
            data[pa] = pb;
        }
        console.log(data);
        $.ajax({
          url: window.location.href.split('?')[0],
          method: 'get',
          data,
          success: function(result) {
            var course_list = document.getElementById('course-list');
            for (let res of result.courses) {
              // console.log(res);
              course_list.insertAdjacentHTML('beforeend', res)
            }
            $(el).prop('disabled', false);
            if(!result.hasMore){
                $(el).remove();
            }
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
