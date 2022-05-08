@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => 'تماس با ما - لیندا کده',
      'keywords' => get_seo_keywords() . ' , تماس با ما , contact us ',
      'description' => 'برای ارتباط با ما از این صفحه اقدام فرمایید. | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [{
          "@type": "Organization",
          "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade",
          "name": "Lynda Kade - لیندا کده",
          "url": "https://LyndaKade.ir",
          "sameAs": [
            "https://www.aparat.com/LyndaKade.ir",
            "https://www.instagram.com/LyndaKade.ir/",
            "https://t.me/LyndaKade/"
          ],
          "logo": {
            "@type": "ImageObject",
            "@id": "https://LyndaKade.ir/#/schema/image/LyndaKade",
            "url": "https://lyndakade.ir/image/logoedit2.png",
            "width": 100,
            "height": 100,
            "caption": "Lynda Kade - لیندا کده"
          },
          "image": {
            "@id": "https://LyndaKade.ir/#/schema/image/LyndaKade",
            "inLanguage": "fa-IR",
            "url": "https://lyndakade.ir/image/logoedit2.png",
            "width": 100,
            "height": 100,
            "caption": "Lynda Kade - لیندا کده"
          }
        },
        {
          "@type": "WebSite",
          "@id": "https://LyndaKade.ir/#/schema/website/LyndaKade",
          "url": "https://LyndaKade.ir",
          "name": "Lynda Kade - لیندا کده",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://LyndaKade.ir/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
          },
          "publisher": {
            "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade"
          }
        },
        {
          "@type": "WebPage",
          "@id": "{{ request()->url() }}",
          "url": "{{ request()->url() }}",
          "inLanguage": "fa-IR",
          "name": "لیندا کده | صفحه ورود به حساب کاربری",
          "dateModified": "{{ \Carbon\Carbon::now() }}",
          "description": "",
          "isPartOf": {
            "@id": "https://LyndaKade.ir/#/schema/website/LyndaKade"
          },
          "about": {
            "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade"
          }
        },
        {
          "@context": "https://schema.org",
          "@id": "https://LyndaKade.ir/#/schema/breadcrumb/LyndaKade",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
              "@id": "https://LyndaKade.ir/",
              "name": "LyndaKade",
              "url": "https://LyndaKade.ir/"
            }
          }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
              "@id": "{{ route('root.contact.us') }}",
              "name": "تماس با ما",
              "url": "{{ route('root.contact.us') }}"
            }
          }]
        },
        {
          "@context": "https://schema.org",
          "@id": "{{ route('root.contact.us') }}",
          "@type": "Organization",
          "name": "تماس با ما",
          "url": "{{ route('root.contact.us') }}",
          "logo": "https://lyndakade.ir/image/logo.png"
        }
      ]
    }
  </script>
@endpush
@section('content')
  <div class="container" style="margin-bottom: 10px">
    <div class="row" style="margin-top: 50px;padding-top: 10px; padding-bottom: 10px">
      <div class="col-lg-6">
        <div class="col-lg-12" style="border-radius: 20px;margin-bottom: 20px;padding-top: 5px">
          <div class="col-lg-12">
            <h1 style="font-size: 1.15rem;">راه های ارتباطی</h1>
            <hr>
          </div>
          <div class="row text-center">
            <div class="col-3">
              <a rel="noreferrer" href="http://www.T.me/LyndaKadeSupport" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram پیشتبانی تلگرام"
                  title="پیشتبانی تلگرام" class="icon-telegram">
                <br />
                پیشتبانی تلگرام
              </a>
            </div>
            <div class="col-3">
              <a rel="noreferrer" href="http://www.Aparat.com/LyndaKade.ir" target="_blank">
                <img data-toggle="tooltip" src="https://lyndakade.ir/image/socialicons/aparat.png" alt="Aparat آپارات"
                  title="آپارات" class="icon-aparat" width="40" height="40">
                <br />
                آپارات
              </a>
            </div>
            <div class="col-3">
              <a rel="noreferrer" href="http://www.Instagram.com/lyndakade.ir" target="_blank">
                <img data-toggle="tooltip" src="https://lyndakade.ir/image/socialicons/instagram2.png"
                  alt="Instagram اینستاگرام" title="اینستاگرام" class="icon-instagram" style="height: 40px;">
                <br />
                اینستاگرام
              </a>
            </div>
            <div class="col-3">
              <a rel="noreferrer" href="tel:+989377629084">
                <img data-toggle="tooltip"
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAD1ElEQVRoge2ZS0hUURjHf40PSDI1NKSgIogSo4UYRkktatP7KUqrWvQie4DuW5RBIUWLok2RPaBN4a5IWvZYtCh7aS90V1QOJVamOS2+73Cn6d6ZO/eeq0Hzh8tl5vvOOf//nHO+c75vIIcccrCBQqAJuA68BoaARETPEPBKx2rUsa1gG/AuQuKZnrfAljAC8oD2pA4fA83AAqAoTMcZUARUAQd0TDP+SSAWpEMj4juwK2gnIRED9gA/cMRkha04IpZbpRYMK3DEbPbbqBBZlwlkJv4V7EM4vcFnAGjE2RMTsZy8kAd0I9waUo1uRDfp+wIwlqbjOcAZ4BkwAPQBrcCkEGTT4ZdySuaYFr2I6qo0Pk3AN9zD5eGgTH2gWsfo8eM8qM5TPOz1wIj6XAZqgFJgO86BNjccX08U6xhf/TibX9YL99V+2sV2RW1dRLfEMvHz5RhDZuMXMNnFXg581PahTuM0sCYkgQjxwm6cWYkCVoQAfFF7qYe9Uu3vs2GXBVz5BTkn+vU9z8Neoe/BAH0HRhAhj/Rd52Hfoe+olpZvZFpaO9V+y8VWAsTVXmOfGmBxj0wDhpHoVZFiW61tHwQg6BfW9sgAcBvIB/am2L7oewYWM7ug8DN19eozgCwngxjwRG3NkbCzuLQMutTvRMr3G/T7ODA7C4J+YV1ILbJPRoElKbYb2kc33udNUFgXAtCmvr38mceXItd7I8bmzEQipBBnT3QiyY/BTBwxcWTPmABQA5xHqjMfgLvI3czPRTMSIQDzgU/a5lyKrQy4mdRnP/Aw6XPq00XmFCAyIQBLcRKtIy72DThpqpmhdiRRqkQumubWPIQkZ16zE6kQkOrGqLY9y5/LDCQ01wFrgKku7ctx8pkE0BKWX1AhIGLMzHQSrJBnMs0+D/u4CAFZZmbP9PJ3aM6EEm372cM+bkJAAoCJZqPIoVmStoWDxdruaVh+NoSAhNo2nEJFHAkE0zO0u6b+p8LysyXEoBa4k9TvCJICHEB+/TL1K0IKGiZyzQrL76s6Fgck7oVlSAAYTiLj9owg1U43TFUfX+UgU6CrDsM6DcqQ5Owiso9MDWAEuIfcrL2wUH1f+hnoqjpHWTEMihaEW4cf5wacqJF6qE0k8oDnCLetfhoUIP/hJYD90fHKGgdxzqYCv402IpX4YWBlNLyywiqEyxiwLtvGx5FfYBgJlROxzPKBQ8BP5XIsSCcx5EAb005eIP9/LMJ+1peMUh2jVcdMKIejhCyMr8cJyRPx9ABrwwhIRgFys+1AIocpwkXxxHWMSzpmvi0ROeTwP+M3VRKuYcd8Z5MAAAAASUVORK5CYII="
                  alt="تماس تلفن" title="تماس تلفن" class="icon-phone" style="height: 40px;">
                <br />
                تماس تلفنی
              </a>
            </div>
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
