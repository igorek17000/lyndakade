@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-3 align-self-center">
            <div class="card mb-3">
                <article class="card-group-item">
                    <header class="card-header clearfix pb-0">
                        <h5 class="title pull-right">لیست علاقه مندی ها</h5>
                        <span class="title pull-left"><a href="#">موارد بیشتر</a></span>
                    </header>
                    <div class="filter-content">
                        <div class="card-body clearfix">
                            @if(count($bookmarks) > 0)
                                @foreach($bookmarks as $bookmark)
                                    @include('.bookmark.partials._bookmarks_list', ['bookmark', $bookmark])
                                    @if($bookmarks->last()->id != $bookmark->id)
                                        <hr class="my-1">
                                    @endif
                                @endforeach
                            @else
                                <span>
                                    لیست علاقمه مندی های شما خالی میباشد.
                                </span>
                            @endif
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
