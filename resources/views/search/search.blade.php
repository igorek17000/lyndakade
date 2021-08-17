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
@endif
@section('content')
    <div class="container search-page">
        @if (isset($shown_item))
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
        @endif
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
                            @foreach($courses as $course)
                                    @include ('.courses.partials._course_list_grid', ['course' => $course, 'col' => 'col-lg-4'])
                            @endforeach
                        </div>
                        {{-- <div class="show-more-container">
                            <button class="show-more bottom-btn ga"
                                    data-ga-action="click" data-ga-label="show-more: Filter All">
                                <span class="sr-only">Show More All Results</span>
                                <span aria-hidden="true">Show More<i class="lyndacon arrow-down"></i></span>
                            </button>
                        </div> --}}
                    </section>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/search.js') }}"></script>
@endpush
