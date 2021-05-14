@extends('layouts.admin', ['page' => __('Profile'), 'pageSlug' => 'user'])

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <div class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a>
                                {{--<img class="avatar" src="{{ asset('black/img/emilyz.jpg') }}" alt="">--}}
                                <img class="avatar" src="{{ asset($user->avatar) }}" alt="">
                                {{--<h5 class="title">{{ Auth::user()->name }}</h5>--}}
                                <h5 class="title">{{ $user->name }}</h5>
                            </a>
                            <p class="description">{{--{{ __('Ceo/Co-Founder') }}--}}{{ $user->role }}</p>
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
