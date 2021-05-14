@extends('layouts.admin', ['page' => $course ?? '' ? __('Edit Course') : __('Add New Course'), 'pageSlug' => 'course'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ $course ?? '' ? __('Edit Course') : __('Add New Course') }}</h5>
                </div>
                <form method="post"
                      action="{{ $course ?? '' ? route('admins.course.edit') : route('admins.course.store') }}"
                      autocomplete="off"
                      enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        {{--                        @include('alerts.success')--}}

                        @if($course ?? '')<input type="hidden" name="id" value="{{$course->id}}">@endif

                        <div class="form-row form-group">
                            <div class="col{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label>{{ __('Title') }}</label>
                                <input type="text" name="title"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Title') }}"
                                       value="{{ $course ?? '' ? $course->title : old('title') }}">
                                @include('alerts.feedback', ['field' => 'title'])
                            </div>
                            <div class="col{{ $errors->has('titleEnglish') ? ' has-danger' : '' }}">
                                <label>{{ __('Title English') }}</label>
                                <input type="text" name="titleEnglish"
                                       class="form-control{{ $errors->has('titleEnglish') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Title English') }}"
                                       value="{{ $course ?? '' ? $course->titleEng : old('titleEnglish') }}">
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
                                placeholder="{{ __('Description') }}">{{ $course ?? '' ? $course->description : old('description') }}</textarea>
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
                                placeholder="{{ __('Description English') }}">{{ $course ?? '' ? $course->descriptionEng : old('descriptionEnglish') }}</textarea>
                            @include('alerts.feedback', ['field' => 'descriptionEnglish'])
                        </div>

                        <div class="form-row form-group">
                            <div class="col{{ $errors->has('subjects') ? ' has-danger' : '' }}">
                                <label>{{ __('Subjects') }}</label>
                                <input type="text"
                                       name="subjects"
                                       id="subjects-tags"
                                       data-role="tagsinput"
                                       class="form-control{{ $errors->has('subjects') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Subjects') }}"
                                >
                                @include('alerts.feedback', ['field' => 'subjects'])
                            </div>
                            <div class="col{{ $errors->has('software') ? ' has-danger' : '' }}">
                                <label>{{ __('Software') }}</label>
                                <input type="text"
                                       name="software"
                                       id="software-tags"
                                       data-role="tagsinput"
                                       class="form-control{{ $errors->has('software') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Software') }}"
                                >
                                @include('alerts.feedback', ['field' => 'software'])
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col{{ $errors->has('author') ? ' has-danger' : '' }}">
                                <label>{{ __('Author') }}</label>
                                <input type="text"
                                       name="author"
                                       id="author-tags"
                                       data-role="tagsinput"
                                       class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Author') }}"
                                >
                                @include('alerts.feedback', ['field' => 'author'])
                            </div>
                            <div class="col">
                                <label for="skillLevel">Skill Level</label>
                                <select class="form-control" id="skillLevel" name="skillLevel">
                                    <option
                                        style="color: #0f0f0f" {{ $course ?? '' ? $course->skillLevel == 1 ? ' selected' : '' : '' }}>
                                        Beginner
                                    </option>
                                    <option
                                        style="color: #0f0f0f" {{ $course ?? '' ? $course->skillLevel == 2 ? ' selected' : '' : '' }}>
                                        Intermediate
                                    </option>
                                    <option
                                        style="color: #0f0f0f" {{ $course ?? '' ? $course->skillLevel == 3 ? ' selected' : '' : '' }}>
                                        Advanced
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label>{{ __('Price') }}</label>
                                <input type="number"
                                       name="price"
                                       id="price"
                                       min="0"
                                       class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Price') }}"
                                       value="{{ $course ?? '' ? $course->price : old('price', 0) }}"
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
                                       value="{{ $course ?? '' ? $course->priceOffPercent : old('priceOffPercent', 0) }}"
                                >
                                @include('alerts.feedback', ['field' => 'priceOffPercent'])
                            </div>
                            <div class="col">
                                <label>{{ __('Number Of Parts') }}</label>
                                <input type="number"
                                       min="1"
                                       name="partNumbers"
                                       id="partNumbers"
                                       class="form-control{{ $errors->has('partNumbers') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Number Of Parts') }}"
                                       value="{{ $course ?? '' ? $course->partNumbers : old('partNumbers', 1) }}"
                                >
                                @include('alerts.feedback', ['field' => 'partNumbers'])
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label>{{ __('Duration Hours') }}</label>
                                <input type="number"
                                       min="0"
                                       name="durationHours"
                                       id="durationHours"
                                       class="form-control{{ $errors->has('durationHours') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Duration Hours') }}"
                                       value="{{ $course ?? '' ? $course->durationHours : old('durationHours', 0) }}"
                                >
                                @include('alerts.feedback', ['field' => 'durationHours'])
                            </div>
                            <div class="col">
                                <label>{{ __('Duration Minutes') }}</label>
                                <input type="number"
                                       min="1"
                                       name="durationMinutes"
                                       id="durationMinutes"
                                       class="form-control{{ $errors->has('durationMinutes') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Duration Minutes') }}"
                                       value="{{ $course ?? '' ? $course->durationMinutes : old('durationMinutes', 1) }}"
                                >
                                @include('alerts.feedback', ['field' => 'durationMinutes'])
                            </div>
                            <div class="col">
                                <label>{{ __('Release Date') }}</label>
                                <input type="date"
                                       name="releaseDate"
                                       id="releaseDate"
                                       class="form-control{{ $errors->has('releaseDate') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Release Date') }}"
                                       value="{{ $course ?? '' ? $course->releaseDate : old('releaseDate') }}"
                                >
                                @include('alerts.feedback', ['field' => 'durationMinutes'])
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col{{ $errors->has('logo') ? ' has-danger' : '' }}">
                                <div class="btn btn-sm">
                                    <label>{{ __('Select Logo') }}</label>
                                    <input type="file" name="logo"
                                           class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Select Logo') }}" value="{{ old('logo') }}">
                                    @include('alerts.feedback', ['field' => 'logo'])
                                </div>
                            </div>
                            <div class="col{{ $errors->has('courseFile') ? ' has-danger' : '' }}">
                                <div class="btn btn-sm">
                                    <label>{{ __('Select Course File') }}</label>
                                    <input type="file" name="courseFile"
                                           class="form-control{{ $errors->has('courseFile') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Select Course File') }}" value="{{ old('courseFile') }}">
                                    @include('alerts.feedback', ['field' => 'courseFile'])
                                </div>
                            </div>
                            <div class="col{{ $errors->has('previewFile') ? ' has-danger' : '' }}">
                                <div class="btn btn-sm">
                                    <label>{{ __('Select Preview File') }}</label>
                                    <input type="file" name="previewFile"
                                           class="form-control{{ $errors->has('previewFile') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Select Preview File') }}"
                                           value="{{ old('previewFile') }}">
                                    @include('alerts.feedback', ['field' => 'previewFile'])
                                </div>
                            </div>
                            <div class="col{{ $errors->has('exerciseFile') ? ' has-danger' : '' }}">
                                <div class="btn btn-sm">
                                    {{--                                <div class="btn btn-sm">--}}
                                    <label>{{ __('Select Exercise File') }}</label>
                                    <input type="file" name="exerciseFile"
                                           {{--                                   required--}}
                                           class="form-control{{ $errors->has('exerciseFile') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Select Exercise File') }}"
                                           value="{{ old('exerciseFile') }}">
                                    @include('alerts.feedback', ['field' => 'exerciseFile'])
                                </div>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-12">
                                <div class="progress">
                                    <div class="bar"></div>
                                    <div class="percent">0%</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 col-md-3 text-info">Status: <span class="text-white"
                                                                                           id="status"></span></div>
                                    <div class="col-sm-7 col-md-4 text-info">Remaining Time: <span class="text-white"
                                                                                                   id="remainingTime"></span>
                                    </div>
                                    <div class="col-sm-6 col-md-5 text-info">Upload Speed: <span class="text-white"
                                                                                                 id="uploadSpeed"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Publish') }}</button>
                    </div>
                </form>
            </div>
        </div>

        {{--        <div class="col-md-4">--}}
        {{--            <div class="card card-user">--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="card-text">--}}
        {{--                        <div class="author">--}}
        {{--                            <div class="block block-one"></div>--}}
        {{--                            <div class="block block-two"></div>--}}
        {{--                            <div class="block block-three"></div>--}}
        {{--                            <div class="block block-four"></div>--}}
        {{--                            <a href="#">--}}
        {{--                                <img class="avatar" src="{{ asset('black/img/emilyz.jpg') }}" alt="">--}}
        {{--                                <h5 class="title">{{ auth()->user()->name }}</h5>--}}
        {{--                            </a>--}}
        {{--                            <p class="description">--}}
        {{--                                {{ __('Ceo/Co-Founder') }}--}}
        {{--                            </p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="card-description">--}}
        {{--                        {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="card-footer">--}}
        {{--                    <div class="button-container">--}}
        {{--                        <button class="btn btn-icon btn-round btn-facebook">--}}
        {{--                            <i class="fab fa-facebook"></i>--}}
        {{--                        </button>--}}
        {{--                        <button class="btn btn-icon btn-round btn-twitter">--}}
        {{--                            <i class="fab fa-twitter"></i>--}}
        {{--                        </button>--}}
        {{--                        <button class="btn btn-icon btn-round btn-google">--}}
        {{--                            <i class="fab fa-google-plus"></i>--}}
        {{--                        </button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
@endsection
