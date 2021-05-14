@extends('layouts.app')
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
      margin-top: -5%;
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
    <form method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-4">
          <div class="profile-img">
            <img src="#" class="lazyload" id="avatar-img"
              data-src="{{ $user ? fromDLHost($user->avatar) : fromDLHost('black/img/emilyz.jpg') }}" alt="" />
            <label class="file btn btn-lg btn-primary">
              ویرایش عکس
              <input type="file" name="avatar" accept="image/*" />
            </label>
          </div>
        </div>
        <div class="col-md-6">
          @foreach ([
          [
              'key' => 'name',
              'type' => 'text',
              'title' => 'نام نمایشی',
          ],
          [
              'key' => 'firstName',
              'type' => 'text',
              'title' => 'نام',
          ],
          [
              'key' => 'lastName',
              'type' => 'text',
              'title' => 'نام خانوادگی',
          ],
          [
              'key' => 'username',
              'type' => 'text',
              'title' => 'نام کاربری',
          ],
          [
              'key' => 'email',
              'type' => 'email',
              'title' => 'ایمیل',
          ],
          [
              'key' => 'mobile',
              'type' => 'tel',
              'title' => 'شماره تماس',
          ],
      ]
      as $item)
            <div class="form-group row">
              <label for="{{ $item['key'] }}"
                class="col-md-4 col-form-label text-md-left">{{ $item['title'] }}</label>
              <div class="col-md-8 col-lg-6">
                <input id="{{ $item['key'] }}" type="{{ $item['type'] }}" class="form-control"
                  name="{{ $item['key'] }}" value="{{ $user ? $user->{$item['key']} : $item['key'] }}" required>
                @if ($item['key'] == 'username')
                  <span id="validateUsername">
                    @error('name')
                      {{ $message }}
                    @enderror
                  </span>
                @endif
              </div>
            </div>
          @endforeach
          <div class="form-group row">
            <button class="btn btn-primary" type="submit">ثبت تغییرات</button>
          </div>
        </div>
      </div>
    </form>
  </div>

@endsection

@section('script_body')
  <script src="{{ asset('js/jquery.form.js') }}"></script>
  <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      var validateUsername = $('#validateUsername');
      var submit_btn = $('button[type="submit"]');
      //   console.log(submit_btn);
      $('#username').keyup(function() {
        var t = this;
        var img = "{{ asset('ajax-loader.gif') }}";
        if (this.value != this.lastValue && this.value.length > 3) {
          if (this.timer) clearTimeout(this.timer);
          validateUsername.removeClass('error').html(
            '<img src="/ajax-loader.gif" height="16" width="16" />درحال بررسی...');

          submit_btn.prop("disabled", true);
          this.timer = setTimeout(function() {
            $.ajax({
              timeout: 5000,
              url: "{{ route('users.username-check') }}",
              data: {
                username: t.value,
                _token: $('input[name="_token"]').val()
              },
              dataType: 'json',
              type: 'post',
              success: function(res) {
                validateUsername.html(res.msg);
                validateUsername.css('color', res.result ? 'red' : 'green');
                if (res.result)
                  submit_btn.prop("disabled", false);
              },
              error: function(err) {
                console.error(err);
              }
            });
          }, 200);

          this.lastValue = this.value;
        }
      });
    });

  </script>
@endsection

@push('js')
  <script>
    $(function() {
      $('input[name="avatar"]').onchange = function(evt) {
        var tgt = evt.target || window.event.srcElement,
          files = tgt.files;
        // $('#avatar-img')[0].src = '';
        // FileReader support
        if (FileReader && files && files.length) {
          var fr = new FileReader();
          fr.onload = function() {
            $('#avatar-img')[0].src = fr.result;
          }
          fr.readAsDataURL(files[0]);
        }

        // Not supported
        else {
          // fallback -- perhaps submit the input to an iframe and temporarily store
          // them on the server until the user's session ends.
        }
      };
    });

  </script>
@endpush
