@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row my-3 justify-content-center">
            <div id="search-filters" class="hidden-xs hidden-sm col-md-2">
                <ul class="filter-set ga-category accessible-tabs" data-context="Category Filters">
                    <li>
                        <h3>Topics</h3>
                        <ul class="truncate">
                            @foreach($courses->first()->subjects->first()->library->subjects as $item)
                                <li tabindex="0">
                                    <a class="filter ga ga-multiple"
                                       href="{{ route('home.show', [$item->slug, $item->id]) }}">
                                        {{ $item->title }}<span>&nbsp;({{ count($item->courses) }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li data-filter="data analysis software">
                        <h3>Software Tutorials</h3>
                        <ul class="truncate">
                            @foreach($courses->first()->subjects->first()->library->software as $item)
                                <li tabindex="0">
                                    <a class="filter ga ga-multiple"
                                       href="?category={{ $item->slug }}">
                                        {{ $item->title }}<span>&nbsp;({{ count($item->courses) }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li data-filter="author">
                        <h3>Author</h3>
                        <ul class="truncate">
                            @foreach($courses->first()->subjects->first()->library->subjects as $item)
                                <li>
                                    <a class="filter ga ga-multiple"
                                       href="?author={{ $item->slug }}">
                                        {{ $item->name }}<span>&nbsp;({{ count($item->courses) }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li data-filter="skill level">
                        <h3>Skill level</h3>
                        <ul class="truncate">
                            @foreach($courses->first()->subjects->first()->library->subjects as $item)
                                <li tabindex="0">
                                    <a class="filter ga ga-multiple"
                                       href="?category=microsoft_124">
                                        Microsoft<span>&nbsp;(808)</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="card col-md-8">
                <div class="card-body clearfix" id="list-items">
                    @foreach($courses as $course)
                        @include ('.courses.partials._course_list', ['course' => $course])
                        {{--                        @if ($course->id != $courses->last()->id)--}}
                        {{--                            <hr>--}}
                        {{--                        @endif--}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/search.js') }}"></script>
@endpush
