@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'پنل دوبله من - لیندا کده',
  'keywords' => get_seo_keywords() . ' , پنل دوبله من , my dubbed pandel, dubbed panel',
  'description' => 'پنل دوبله من | ' . get_seo_description(),
  ])
@endpush
@push('css_head')
@endpush
@section('content')
  <div class="container emp-profile">
    <div class="row">
      <div class="col-md-4">
        <div class="profile-img">
          <img itemprop="image" src="#" class="lazyload" data-src="{{ $user ? fromDLHost($user->avatar) : fromDLHost('black/img/emilyz.jpg') }}"
           alt="my photo - عکس من" />
          {{-- <div class="file btn btn-lg btn-primary">
            ویرایش عکس
            <input type="file" name="avatar" accept="image/*" />
          </div> --}}
        </div>
      </div>
      <div class="col-md-6">
        <div class="profile-head">
          <h5>
            {{ $user ? $user->name : 'الکساندر' }}
          </h5>
          <h6>
            {{ $user ? $user->role->display_name : 'کاربر عادی' }}
          </h6>
          {{-- <p class="proile-rating">امتیاز : <span>8/10</span></p> --}}
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#مشخصات" role="tab" aria-controls="home"
                aria-selected="true">مشخصات</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Timeline</a>
            </li> --}}
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        @if ($user ? Auth::id() == $user->id : true)
          <a class="profile-edit-btn" href="{{ route('my-profile.edit') }}">
            ویرایش
          </a>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="profile-work">
          {{-- <p>WORK LINK</p>
          <a href="">Website Link</a><br />
          <a href="">Bootsnipp Profile</a><br />
          <a href="">Bootply Profile</a>
          <p>SKILLS</p>
          <a href="">Web Designer</a><br />
          <a href="">Web Developer</a><br />
          <a href="">WordPress</a><br />
          <a href="">WooCommerce</a><br />
          <a href="">PHP, .Net</a><br /> --}}
        </div>
      </div>
      <div class="col-md-8">
        <div class="tab-content profile-tab" id="myTabContent">
          <div class="tab-pane fade show active" id="مشخصات" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
              <div class="col-md-6">
                <label>نام نمایشی</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user ? $user->name : 'name' }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>نام</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user ? $user->firstName : 'firstName' }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>نام خانوادگی</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user ? $user->lastName : 'lastName' }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>نام کاربری</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user && $user->username ? $user->username : 'username' }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>ایمیل</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user ? $user->email : 'kshitighelani@gmail.com' }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>شماره تماس</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user ? $user->mobile : '0123456789' }}</p>
              </div>
            </div>
          </div>
          {{-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
              <div class="col-md-6">
                <label>Experience</label>
              </div>
              <div class="col-md-6">
                <p>Expert</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Hourly Rate</label>
              </div>
              <div class="col-md-6">
                <p>10$/hr</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Total Projects</label>
              </div>
              <div class="col-md-6">
                <p>230</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>English Level</label>
              </div>
              <div class="col-md-6">
                <p>Expert</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Availability</label>
              </div>
              <div class="col-md-6">
                <p>6 months</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>Your Bio</label><br />
                <p>Your detail description</p>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script_body')
  <script>
    $(document).ready(function() {

    });

  </script>
@endsection
