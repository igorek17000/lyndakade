@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'پروفایل من - لیندا کده',
  'keywords' => get_seo_keywords() . ' , پروفایل من , my profile, profile',
  'description' => 'صفحه پروفایل من | ' . get_seo_description(),
  ])
@endpush
@push('css_head')

  <style>
    body {
      background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }

    .emp-profile {
      padding: 3%;
      margin-top: 3%;
      margin-bottom: 3%;
      border-radius: 0.5rem;
      background: #fff;
    }

    .profile-img {
      text-align: center;
      min-height: 175px;
      max-height: 175px;
    }

    .profile-img img {
      /* width: 70%; */
      /* height: 100%; */
      min-height: 175px;
      max-height: 175px;
    }

    .profile-img .file {
      position: relative;
      overflow: hidden;
      margin-top: -20%;
      width: 70%;
      border: none;
      border-radius: 0;
      font-size: 15px;
      background: #212529b8;
    }

    .profile-img .file input {
      position: absolute;
      opacity: 0;
      right: 0;
      top: 0;
    }

    .profile-head h5 {
      color: #333;
    }

    .profile-head h6 {
      color: #0062cc;
    }

    .profile-edit-btn {
      border: none;
      border-radius: 1.5rem;
      width: 70%;
      padding: 2%;
      font-weight: 600;
      color: #6c757d;
      cursor: pointer;
    }

    .proile-rating {
      font-size: 12px;
      color: #818182;
      margin-top: 5%;
    }

    .proile-rating span {
      color: #495057;
      font-size: 15px;
      font-weight: 600;
    }

    .profile-head .nav-tabs {
      margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
      font-weight: 600;
      border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
      border: none;
      border-bottom: 2px solid #0062cc;
    }

    .profile-work {
      padding: 14%;
      margin-top: -15%;
    }

    .profile-work p {
      font-size: 12px;
      color: #818182;
      font-weight: 600;
      margin-top: 10%;
    }

    .profile-work a {
      text-decoration: none;
      color: #495057;
      font-weight: 600;
      font-size: 14px;
    }

    .profile-work ul {
      list-style: none;
    }

    .profile-tab label {
      font-weight: 600;
    }

    .profile-tab p {
      font-weight: 600;
      color: #0062cc;
    }

  </style>

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
        {{-- <div class="profile-work">
          <p>WORK LINK</p>
          <a href="">Website Link</a><br />
          <a href="">Bootsnipp Profile</a><br />
          <a href="">Bootply Profile</a>
          <p>SKILLS</p>
          <a href="">Web Designer</a><br />
          <a href="">Web Developer</a><br />
          <a href="">WordPress</a><br />
          <a href="">WooCommerce</a><br />
          <a href="">PHP, .Net</a><br />
        </div>--}}
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
