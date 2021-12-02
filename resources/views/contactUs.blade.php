@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'تماس با ما - لیندا کده',
  'keywords' => get_seo_keywords() . ' , تماس با ما , contact us ',
  'description' => 'برای ارتباط با ما از این صفحه اقدام فرمایید. | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "تماس با ما",
      "url": "{{ route('root.contact.us') }}",
      "logo": "https://lyndakade.ir/image/logo.png"
    }
  </script>
@endpush
@section('content')
  <div class="container" style="margin-bottom: 10px">
    <div class="row" style="margin-top: 50px;background-color: white;padding-top: 10px; padding-bottom: 10px">
      <div class="col-lg-6">
        <div class="col-lg-12 social-box"
          style="border-radius: 20px;background-color: orange;margin-bottom: 20px;padding-top: 5px">
          <div class="col-lg-12">
            <h1 style="font-size: 1.15rem;">راه های ارتباطی</h1>
            <hr>
          </div>
          <div class="row text-center">
            <div class="col-lg-6 col-xs-6">
              <a rel="noreferrer" href="http://www.T.me/LyndaKadeSupport" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram پیشتبانی تلگرام" title="پیشتبانی تلگرام"
                  class="icon-telegram">
                پیشتبانی تلگرام
              </a>
            </div>
            <div class="col-lg-6 col-xs-6">
              {{-- <a rel="noreferrer" href="http://www.T.me/LyndaKade" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram کانال تلگرام" title="کانال تلگرام"
                  class="icon-telegram">
                کانال تلگرام
              </a> --}}
              <a rel="noreferrer" href="http://www.Instagram.com/lyndakade.ir" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/instagram2.png') }}" alt="Instagram اینستاگرام" title="اینستاگرام"
                  class="icon-instagram">
                اینستاگرام</a>
            </div>
            {{-- <div class="col-lg-6 col-xs-4">
              <i class="fab fa-telegram-plane fa-2x iconFa"></i>
              <p style="font-size:14px">09171986156</p>
            </div> --}}
          </div>
        </div>
        <div class="col-lg-12" style="margin-bottom: 20px;border: 1px solid gainsboro;border-radius: 20px">
          <div class="p-2">
            <form method="POST" class="contact-us">
              @csrf
              <div class="form-group row">
                <div class="col-12">
                  <label for="name">نام:</label>
                  <input name="name" type="text" class="form-control" placeholder="مانند : علی " id="name" required
                    autofocus>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <label for="email">پست الکترونیک:</label>
                  <input name="email" type="email" class="form-control" id="email" placeholder="مانند : info@gmail.com"
                    required>
                  <small id="emailHelp" class="form-text text-muted">جهت ارتباط با شما وارد کردن پست الکترونیک الزامی
                    است</small>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <label for="inlineFormCustomSelect"> یکی از موارد زیر را انتخاب کنید :</label>
                  <select name="type" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option selected disabled>انتخاب....</option>
                    <option value=" انتقاد">انتقاد</option>
                    <option value="شکایت">شکایت</option>
                    <option value="پیشنهاد">پیشنهاد</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <label for="message">متن پیام :</label>
                  <textarea name="message" class="form-control" rows="5" id="message" required></textarea>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">
                    ارسال
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="col-lg-12" style="margin-bottom: 20px">
          <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px;border-radius: 20px">
            <iframe src="https://maps.google.com/maps?q=Bandar%20%Lengeh&t=&z=13&ie=UTF8&iwloc=&output=embed"
              style="border:0" allowfullscreen>
            </iframe>
          </div>
        </div>
        <div class="col-lg-12 social-box"
          style="border-radius: 20px;background-color: orange;padding-top: 5px;padding-bottom: 5px">
          <div class="col-lg-12">
            <h6>شبکه های اجتماعی :</h6>
            <hr>
          </div>
          <div class="row text-center">
            <div class="col-lg-4 col-xs-4">
              <a rel="noreferrer" href="http://www.Instagram.com/lyndakade.ir" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/instagram2.png') }}" alt="Instagram اینستاگرام" title="اینستاگرام"
                  class="icon-instagram">
                اینستاگرام</a>
            </div>
            {{-- <div class="col-lg-4 col-xs-4">
              <a href="">
                <i class="fas fa-envelope fa-2x iconFa"></i>
              </a>
            </div> --}}
            {{-- <div class="col-lg-4 col-xs-4">
              <a rel="noreferrer" href="http://www.T.me/LyndaKade" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram" title="کانال تلگرام"
                  class="icon-telegram">
                کانال تلگرام
              </a>
            </div> --}}
            <div class="col-lg-4 col-xs-4">
              <a rel="noreferrer" href="http://www.T.me/LyndaKadeSupport" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram پیشتبانی تلگرام" title="پیشتبانی تلگرام"
                  class="icon-telegram">
                پیشتبانی تلگرام
              </a>
            </div>
            <div class="col-lg-4 col-xs-4">
              {{-- <a href="">
                <i class="fas fa-envelope fa-2x iconFa"></i>
              </a> --}}
              <a rel="noreferrer" href="http://www.Aparat.com/LyndaKade.ir" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/aparat.png') }}" alt="Aparat آپارات" title="آپارات" class="icon-aparat">
                آپارات
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="direction: ltr">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="direction: rtl">این برگه در دست تعمیر است! </h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <img src="{{ asset('image/MaintenanceGif2.gif') }}" width="100%" alt="Maintenance">
            </div>
            <div class="col-lg-6">
              هر سایتی برای توسعه و یا رفع خطا باید زمانی را برای انجام تعمیر در نظر بگیرد. درست است که برای سایت‌هایی که
              تازه شروع به کارکرده‌اند نیاز به حالت تعمیر تقریباً وجود ندارد اما برای سایت‌های با بازدید بالا جزئی از روال
              عادی می‌تواند به‌حساب بیاید. و به‌جای اینکه بازدیدکنندگان با یک صفحه به‌هم‌ریخته مواجه شوند و فکر کنند که
              سایت خراب است ما خیلی محترمانه توضیح می‌دهیم که سایت به‌طور موقت در دست تعمیر است و ما به‌زودی برمی‌گردیم.
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">بستن برگه</button>
        </div>
      </div>

    </div>
  </div> --}}
@endsection
@push('js')
  <script>
    $(function() {

      $('form.contact-us')[0].onsubmit = (e) => {
        e.preventDefault();

        $.ajax({
          url: "{!! route('root.contact.us.post') !!}",
          method: 'post',
          data: {
            name: $('#name').val(),
            type: $('#inlineFormCustomSelect')[0].selectedOptions[0].value,
            email: $('#email').val(),
            message: $('#message').val(),
            _token: $('input[name="_token"]').val(),
          },
          success: (res) => {
            console.log(res);
            if (res['alert-type'] === 'info')
              toastr.success(res['message'], {
                timeOut: 5000
              });
            else
              toastr.error(res['message'], {
                timeOut: 5000
              });
            document.getElementsByClassName('contact-us')[0].reset();
          },
          errors: (xhr) => {
            console.error(xhr);
          }
        });
        return false;
      }
    });
  </script>
@endpush
