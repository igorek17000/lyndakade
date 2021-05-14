@extends('layouts.admin', ['page' => $subject ?? '' ? __('Edit Subject') : __('Add New Subject'), 'pageSlug' => 'subject'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ $subject ?? '' ? __('Edit Subject') : __('Add New Subject') }}</h5>
                </div>
                <form method="post"
                      action="{{ $subject ?? '' ? route('admins.subject.edit') : route('admins.subject.store') }}"
                      autocomplete="off"
                      enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        {{--                        @include('alerts.success')--}}

                        @if($subject ?? '')<input type="hidden" name="id" value="{{$subject->id}}">@endif

                        <div class="form-row form-group">
                            <div class="col{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label>{{ __('Title') }}</label>
                                <input type="text" name="title"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Title') }}"
                                       value="{{ $subject ?? '' ? $subject->title : old('title') }}">
                                @include('alerts.feedback', ['field' => 'title'])
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
