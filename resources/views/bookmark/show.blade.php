@extends('layouts.app')
@section('content')
    {{--    {{ var_export($parts) }}--}}
    <div class="container">
        <div class="row mt-3 align-self-center">
            <div class="card mb-3">
                <article class="card-group-item">
                    <header class="card-header clearfix pb-0">
                        <h5 class="title float-right">{{ $bookmark->title }}</h5>
                        {{-- <span class="title float-left"><a href="#">موارد بیشتر</a></span>--}}
                    </header>
                    <div class="filter-content">
                        <div class="card-body clearfix text-right">
                            @include('.bookmark.partials._bookmark_show', ['bookmark_parts', $bookmark_parts ])
                            {{--                             @foreach($bookmark->bookmark_parts[0]->course->course_parts as $part)--}}
                            {{--                                <div class="row no-gutters"--}}
                            {{--                                     onclick="location.href = '{{courseURL($course)}}';">--}}
                            {{--                                    <div class="col-md-4 align-self-center list-item-img">--}}
                            {{--                                        <img src="{{ asset($part->course->img) }}" class="card-img" alt="image">--}}
                            {{--                                        <p class="card-text">{{ $part->partNumber }}</p>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-md-8">--}}
                            {{--                                        <div class="card-body">--}}
                            {{--                                            <h5 class="card-title bookmark-title">{{ $part->title }}</h5>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            @endforeach--}}
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
