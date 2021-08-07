@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ $page }}</h4>
                        </div>
                        <div class="col-4 text-right">
{{--                            @if($pageSlug != 'user')--}}
                                <a href="{{ route('admins.'. $pageSlug . '.add') }}"
                                   class="btn btn-sm btn-primary">Add</a>
                            {{--                            @endif--}}
                        </div>
                    </div>
                    <div class="pagination-sm text-center">
                        {{ $listItems->links('pagination.default') }}
                        {{--                        @foreach($totalPages as $pageNumber)--}}
                        {{--                            <a class="btn btn-sm animation-on-hover{{ $loop->index === $currentPage - 1 ? " active" : "" }}"--}}
                        {{--                               href="{{ route('admins.'. $pageSlug . '.all', ['page' => $pageNumber]) }}">{{$pageNumber}}</a>--}}
                        {{--                        @endforeach--}}
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Publish Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listItems as $item)
                            <tr>
                                <th scope="row">{{ (($listItems->currentPage() - 1) * $listItems->perPage()) + $loop->index + 1 }}</th>
                                <td>
                                    <a href="@if($pageSlug == 'course') {{courseURL($item)}}
                                    @elseif($pageSlug == 'learnpath') {{route('learn.paths.show', [$item->library->slug, $item->slug])}}
                                    @elseif($pageSlug == 'user') {{route('admins.user.show', [$item->username])}}
                                    @elseif(in_array($pageSlug, ['library', 'subject', 'software'])) {{route('home.show', [$item->slug])}}
                                    @endif">{{ $item->titleEng ?? $item->title ?? $item->firstName . ' ' . $item->lastName }}</a>
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item"
                                               href="{{ route('admins.'. $pageSlug . '.edit', ['id' => $item->id]) }}">Edit</a>
                                            <form method="post"
                                                  action="{{ route('admins.'. $pageSlug . '.remove') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button class="dropdown-item" type="submit">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="pagination-sm text-center">
                        {{ $listItems->links('pagination.default') }}
                        {{--                        @foreach($totalPages as $pageNumber)--}}
                        {{--                            <a class="btn btn-sm animation-on-hover{{ $loop->index === $currentPage - 1 ? " active" : "" }}"--}}
                        {{--                               href="{{ route('admins.'. $pageSlug . '.all', ['page' => $pageNumber]) }}">{{$pageNumber}}</a>--}}
                        {{--                        @endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
