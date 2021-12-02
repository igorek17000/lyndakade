@extends('layouts.admin', ['page' => $learnpath ?? '' ? __('Edit Learn Path') : __('Add New Learn Path'), 'pageSlug' => 'learnpath'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ $learnpath ?? ''  ? __('Edit Learn Path') : __('Add New Learn Path') }}</h5>
                </div>
                <form method="post"
                      action="{{ $learnpath ?? ''  ? route('admins.learnpath.edit') : route('admins.learnpath.store') }}"
                      autocomplete="off"
                      enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        {{--                        @include('alerts.success')--}}

                        @if($learnpath ?? '')<input type="hidden" name="id" value="{{$learnpath->id}}">@endif

                        <div class="form-row form-group">
                            <div class="col{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label>{{ __('Title') }}</label>
                                <input type="text" name="title"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Title') }}"
                                       value="{{ $learnpath ?? '' ? $learnpath->title : old('title') }}">
                                @include('alerts.feedback', ['field' => 'title'])
                            </div>
                            <div class="col{{ $errors->has('titleEnglish') ? ' has-danger' : '' }}">
                                <label>{{ __('Title English') }}</label>
                                <input type="text" name="titleEnglish"
                                       class="form-control{{ $errors->has('titleEnglish') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Title English') }}"
                                       value="{{ $learnpath ?? '' ? $learnpath->titleEng : old('titleEnglish') }}">
                                @include('alerts.feedback', ['field' => 'titleEnglish'])

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <label>{{ __('Description') }}</label>
                            <textarea
                                id="description"
                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                rows="7"
                                type="text"
                                name="description"
                                autocomplete="description"
                                placeholder="{{ __('Description') }}">{{ $learnpath ?? '' ? $learnpath->description : old('description') }}</textarea>
                            @include('alerts.feedback', ['field' => 'description'])
                        </div>

                        <div class="form-group{{ $errors->has('descriptionEnglish') ? ' has-danger' : '' }}">
                            <label>{{ __('Description English') }}</label>
                            <textarea
                                id="descriptionEnglish"
                                class="form-control{{ $errors->has('descriptionEnglish') ? ' is-invalid' : '' }}"
                                rows="7"
                                type="text"
                                name="descriptionEnglish"
                                autocomplete="descriptionEnglish"
                                placeholder="{{ __('Description English') }}">{{ $learnpath ?? '' ? $learnpath->descriptionEng : old('descriptionEnglish') }}</textarea>
                            @include('alerts.feedback', ['field' => 'descriptionEnglish'])
                        </div>

                        <div class="form-row form-group">
                            {{--                            <div class="col">--}}
                            {{--                                <label>{{ __('Duration Hours') }}</label>--}}
                            {{--                                <input type="number"--}}
                            {{--                                       min="0"--}}
                            {{--                                       name="durationHours"--}}
                            {{--                                       id="durationHours"--}}
                            {{--                                       class="form-control{{ $errors->has('durationHours') ? ' is-invalid' : '' }}"--}}
                            {{--                                       placeholder="{{ __('Duration Hours') }}"--}}
                            {{--                                       value="{{ $learnpath ?? '' ? $learnpath->durationHours : old('durationHours', 0) }}"--}}
                            {{--                                >--}}
                            {{--                                @include('alerts.feedback', ['field' => 'durationHours'])--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col">--}}
                            {{--                                <label>{{ __('Duration Minutes') }}</label>--}}
                            {{--                                <input type="number"--}}
                            {{--                                       min="1"--}}
                            {{--                                       name="durationMinutes"--}}
                            {{--                                       id="durationMinutes"--}}
                            {{--                                       class="form-control{{ $errors->has('durationMinutes') ? ' is-invalid' : '' }}"--}}
                            {{--                                       placeholder="{{ __('Duration Minutes') }}"--}}
                            {{--                                       value="{{ $learnpath ?? '' ? $learnpath->durationMinutes : old('durationMinutes', 1) }}"--}}
                            {{--                                >--}}
                            {{--                                @include('alerts.feedback', ['field' => 'durationMinutes'])--}}
                            {{--                            </div>--}}
                            <div class="col">
                                <label>{{ __('Price') }}</label>
                                <input type="number"
                                       name="price"
                                       id="price"
                                       min="0"
                                       class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Price') }}"
                                       value="{{ $learnpath ?? '' ? $learnpath->price : old('price', 0) }}"
                                >
                                @include('alerts.feedback', ['field' => 'price'])
                            </div>
                            <div class="col">
                                <label>{{ __('Price Off Percent') }}</label>
                                <input type="number"
                                       min="0"
                                       max="100"
                                       name="priceOffPercent"
                                       id="priceOffPercent"
                                       class="form-control{{ $errors->has('priceOffPercent') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Price Off Percent') }}"
                                       value="{{ $learnpath ?? '' ? $learnpath->priceOffPercent : old('priceOffPercent', 0) }}"
                                >
                                @include('alerts.feedback', ['field' => 'priceOffPercent'])
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col{{ $errors->has('courses') ? ' has-danger' : '' }}">
                                <label>{{ __('Courses') }}</label>
                                <input type="text"
                                       name="courses"
                                       id="courses-tags"
                                       data-role="tagsinput"
                                       class="form-control{{ $errors->has('courses') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Courses') }}"
                                >
                                @include('alerts.feedback', ['field' => 'courses'])
                            </div>
                            <div class="col{{ $errors->has('libraries') ? ' has-danger' : '' }}">
                                <label>{{ __('Library') }}</label>
                                <input type="text"
                                       name="libraries"
                                       id="library-tags"
                                       data-role="tagsinput"
                                       class="form-control{{ $errors->has('libraries') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Library') }}"
                                >
                                @include('alerts.feedback', ['field' => 'libraries'])
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col{{ $errors->has('logo') ? ' has-danger' : '' }}">
                                <div class="btn btn-sm">
                                    <label>{{ __('Select Logo') }}</label>
                                    <input type="file" name="logo"
                                           class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Select Logo') }}" value="{{ old('logo') }}">
                                </div>
                                @include('alerts.feedback', ['field' => 'logo'])
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Publish') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <div class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('black/img/emilyz.jpg') }}" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description">
                                {{ __('Ceo/Co-Founder') }}
                            </p>
                        </div>
                    </div>
                    <div class="card-description">
                        {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
