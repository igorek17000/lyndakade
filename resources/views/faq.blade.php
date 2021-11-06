@php
$questions = [
    [
        'question' => 'نحوه خرید دوره؟',
        'answer' =>
            'بطور کلی دو روش برای خرید دوره وجود دارد:

1) خرید دوره با پرداخت مستقیم: در این روش، دوره(‌های) مورد نظر خود را به <a href="' .
            route('cart.index') .
            '"> سبد خرید </a> خود اضافه کنید، سپس به صفحه <a href="' .
            route('cart.index') .
            '"> سبد خرید </a>  مراجعه و با استفاده دکمه <span>«عملیات پرداخت»</span> اقدام به پرداخت نمایید. همچنین پس از خرید دوره(ها)، می‌توانید از طریق صفحه <a href="' .
            route('courses.mycourses') .
            '"> دوره‌های خریداری شده</a> ، لیست تمامی دوره‌های خریداری شده‌ی خود را مشاهده نمایید. در صورتیکه در زمان پرداخت مشکلی رخ داده است، از طریق صفحه <a href="' .
            route('root.contact.us') .
            '">تماس با ما </a> به ما اطلاع رسانی کنید تا تیم پشتیبانی بررسی شود.

2) خرید دوره با استفاده از اشتراک: در این روش، می‌بایست از طریق صفحه <a href="' .
            route('packages.index') .
            '"> خرید اشتراک</a> ، اشتراک مورد نظر خود را خریداری نمایید، سپس همانند روش اول، دوره(های) مورد نظر خود را به <a href="' .
            route('cart.index') .
            '"> سبد خرید </a> اضافه کرده و سپس به صفحه <span>«سبد خرید»</span> بروید. این‌بار در صفحه <span>«سبد خرید»</span> در کنار دکمه <span>«عملیات پرداخت»</span>، دکمه‌ی <span>«استفاده از اشتراک»</span> راه نیز مشاهده می‌کنید. با استفاده از دکمه <span>«استفاده از اشتراک»</span>، تعداد دوره‌های موجود در سبد خرید شما، از اعتبار اشتراک شما کسر می‌شود. همچنین در صفحه سبد خرید، جدولی مربوط به <span>«تعداد دوره‌ها در سبد خرید»</span> و <span>«اعتبار اشتراک فعلی شما»</span> نیز وجود دارد.',
    ],
    [
        'question' => 'اشتراک چیست؟',
        'answer' => 'میزان اعتباری است که میتوانید در طول مدت زمان معین شده، به تعداد دوره آموزشی آن اشتراک، دوره آموزشی را بصورت رایگان دریافت نمایید.
توجه داشته باشید، در صورت پایان زمان اشتراک شما، دوره‌های آموزشی باز شده، همچنان باز خواهند ماند، و قادر به دریافت دوباره آنها می‌باشید.',
    ],
    [
        'question' => 'نحوه خرید اشتراک؟',
        'answer' =>
            'برای اینکار به صفحه <a href="' .
            route('packages.index') .
            '"> خرید اشتراک</a> مراجعه و بروی اشتراک مورد نظر خود کلیک کنید، و پس از انجام عملیات پرداخت، اشتراک انتخابی فورا برای شما فعال می‌شود.
برای بررسی میزان اعتبار اشتراک، میتوانید به صفحه <a href="' .
            route('cart.index') .
            '"> سبد خرید </a> یا صفحه <a href="' .
            route('packages.index') .
            '"> خرید اشتراک</a> مراجعه نمایید.',
    ],
    [
        'question' => 'نحوه استفاده از اشتراک؟',
        'answer' => 'برای اینکار، دوره(های) مورد نظر خود را به <a href="' . route('cart.index') . '"> سبد خرید </a> اضافه کرده و سپس به صفحه <a href="' . route('cart.index') . '"> سبد خرید </a> بروید، و در قسمت پایین جدول، کنار دکمه <span>«عملیات پرداخت»</span>، دکمه‌ی <span>«استفاده از اشتراک»</span> راه نیز مشاهده می‌کنید. با استفاده از دکمه <span>«استفاده از اشتراک»</span>، تعداد دوره‌های موجود در سبد خرید شما، از اعتبار اشتراک شما کسر می‌شود. همچنین در صفحه سبد خرید، جدولی مربوط به <span>«تعداد دوره‌ها در سبد خرید»</span> و <span>«اعتبار اشتراک فعلی شما»</span> نیز وجود دارد.',
    ],
    [
        'question' => 'استفاده از اشتراک برای خرید مسیر آموزشی؟',
        'answer' => 'توجه داشته باشید، در صورت وجود مسیر آموزشی در سبد خرید، و پرداخت از طریق دکمه <span>«استفاده از اشتراک»</span>، در این حالت تعداد دوره‌های موجود در مسیر آموزشی، از حساب اشتراکی شما کسر می‌شود.',
    ],
    [
        'question' => 'چگونه اعتبار اشتراک فعلی خود را افزایش دهیم؟',
        'answer' => 'پس از خرید یک اشتراک، شما قادر به خرید دوباره اشتراک نیز می‌باشید. اشتراک فعلی و اشتراک جدید می‌توانند متفاوت باشند، در این حالت، میزان اعتبار اشتراک جدید به میزان فعلی اضافه می‌گردد.',
    ],
    [
        'question' => 'درخواست دوره آموزشی؟',
        'answer' => 'در صورتی که با استفاده از روش دوم جستجو، قادر به یافتن دوره آموزشی مورد نظر نبوده‌اید، می‌توانید پس از ورود به حساب کاربری، به صفحه <a href="' . route('demands.create') . '"> درخواست دوره </a> مراجعه کنید و به یکی از دو روش، درخواست دوره ارسال نمایید:
1- با استفاده از نام درس و نام مدرس برای دوره آموزشی مربوطه در وبسایت لینکدین
2- با استفاده از لینک دوره آموزشی مربوطه در وبسایت لینکدین
توجه داشته باشید، در صورت قرار دادن دوره آموزشی مورد نظر شما در وبسایت ما، از طریق ایمیل وارد شده در حساب کاربری، به شما اطلاع رسانی خواهد شد.',
    ],
    [
        'question' => 'جستجوی دوره آموزشی؟',
        'answer' => 'جستجوی دوره آموزشی، به دو روش زیر قابل اجرا می‌باشد:

1- با استفاده از فیلد جستجو در بخش بالا صفحه: در اینجا قابلیت جستجو با <span>«نام دوره آموزشی به زبان فارسی یا انگلیسی»</span> و <span>«نام مدرس»</span> و یا <span>«عنوان دسته»</span> مورد نظر را جستجو نمایید.

2- با استفاده از فیلد قرار داده شده در صفحه اصلی وبسایت: در اینجا میتوانید لینک دوره آموزشی مربوطه از وبسایت لینکدین را وارد کرده و دکمه ارسال را انتخاب کنید. در این حالت، شما میتوانید وضعیت موجود بودن دوره آموزشی مورد نظر را بررسی نمایید.
',
    ],
    [
        'question' => 'چرا فیلم دوره‌ها پخش نمی‌شوند؟',
        'answer' => 'بدلیل حجیم بودن فیلم‌های هر دوره، ما آنها را بصورتی فشرده سازی کرده‌ایم که، سبب کاهش حجم چشمیگیری شده است، که این موضوع باعث صرفه جویی در مدت زمان و میزان حجم مصرفی شما می‌شود، به همین دلیل فیلم‌ها توسط برنامه‌های pot player، km player ، vlc media player و سایر مدیا پلیرهایی که قابلیت نصب codec بروی آنها وجود دارد، قابل اجرا هستند.',
    ],
    [
        'question' => 'تخفیفات براساس میزان خرید؟',
        'answer' => 'برای هر حساب کاربری، بر اساس میزان کل هزینه‌های پرداخت شده، در خریدهای بعدی میزان درصد تخفیفی نیز در نظر گرفته می‌شود که در جدول زیر قرار دارند.
        <table class="table table-bordered  text-center">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">سطح</th>
                    <th scope="col" class="align-middle">مجموع خرید</th>
                    <th scope="col" class="align-middle">درصد تخفیف (برای تمامی خریدها)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" class="align-middle">1</th>
                    <td class="align-middle">بین ' . nPersian(number_format(200000)) . ' تا
                      ' . nPersian(number_format(400000 - 1000)) . '
                      تومان
                    </td>
                    <td class="align-middle">' . nPersian(number_format(5)) . '%</td>
                  </tr>
                  <tr>
                    <th scope="row" class="align-middle">2</th>
                    <td class="align-middle">بین ' . nPersian(number_format(400000)) . ' تا
                      ' . nPersian(number_format(600000 - 1000)) . '
                      تومان
                    </td>
                    <td class="align-middle">' . nPersian(number_format(10)) . '%</td>
                  </tr>
                  <tr>
                    <th scope="row" class="align-middle">3</th>
                    <td class="align-middle">بین ' . nPersian(number_format(600000)) . ' تا
                      ' . nPersian(number_format(800000 - 1000)) . '
                      تومان
                    </td>
                    <td class="align-middle">' . nPersian(number_format(15)) . '%</td>
                  </tr>
                  <tr>
                    <th scope="row" class="align-middle">4</th>
                    <td class="align-middle">بین ' . nPersian(number_format(800000)) . ' تا
                      ' . nPersian(number_format(1000000 - 1000)) . '
                      تومان
                    </td>
                    <td class="align-middle">' . nPersian(number_format(20)) . '%</td>
                  </tr>
                  <tr>
                    <th scope="row" class="align-middle">5</th>
                    <td class="align-middle">' . nPersian(number_format(1000000)) . ' تومان به بالا</td>
                    <td class="align-middle">' . nPersian(number_format(25)) . '%</td>
                  </tr>
                </tbody>
              </table>
توجه داشته باشید، میزان کل هزینه‌های پرداخت شده، شامل خرید دوره‌های آموزشی، خرید مسیرهای آموزشی، خرید اشتراک می‌باشد.',
    ],
    [
        'question' => '',
        'answer' => '',
    ],
    [
        'question' => '',
        'answer' => '',
    ],
    [
        'question' => '',
        'answer' => '',
    ],
    [
        'question' => '',
        'answer' => '',
    ],
];
@endphp

@extends('layouts.app')

@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'لیندا کده | سوالات متداول',
  'keywords' => get_seo_keywords() . ' , سوالات متداول , faq, questions, ticket, تیکت ',
  'description' => 'مشاهده لیست سوالات متداول کاربران. | ' . get_seo_description(),
  ])
  {{-- <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [{
        "@type": "Question",
        "name": "What is the return policy?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "<p>Most unopened items in new condition and returned within <strong>90 days</strong> will receive a refund or exchange. Some items have a modified return policy noted on the receipt or packing slip. Items that are opened or damaged or do not have a receipt may be denied a refund or exchange. Items purchased online or in-store may be returned to any store.</p><p>Online purchases may be returned via a major parcel carrier. <a href=http://example.com/returns> Click here </a> to initiate a return.</p>"
        }
      }, {
        "@type": "Question",
        "name": "How long does it take to process a refund?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "We will reimburse you for returned items in the same way you paid for them. For example, any amounts deducted from a gift card will be credited back to a gift card. For returns by mail, once we receive your return, we will process it within 4–5 business days. It may take up to 7 days after we process the return to reflect in your account, depending on your financial institution's processing time."
        }
      }, {
        "@type": "Question",
        "name": "What is the policy for late/non-delivery of items ordered online?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "<p>Our local teams work diligently to make sure that your order arrives on time, within our normaldelivery hours of 9AM to 8PM in the recipient's time zone. During  busy holiday periods like Christmas, Valentine's and Mother's Day, we may extend our delivery hours before 9AM and after 8PM to ensure that all gifts are delivered on time. If for any reason your gift does not arrive on time, our dedicated Customer Service agents will do everything they can to help successfully resolve your issue.</p><p><a href=https://example.com/orders/>Click here</a> to complete the form with your order-related question(s).</p>"
        }
      }, {
        "@type": "Question",
        "name": "When will my credit card be charged?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "We'll attempt to securely charge your credit card at the point of purchase online. If there's a problem, you'll be notified on the spot and prompted to use another card. Once we receive verification of sufficient funds, your payment will be completed and transferred securely to us. Your account will be charged in 24 to 48 hours."
        }
      }, {
        "@type": "Question",
        "name": "Will I be charged sales tax for online orders?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text":"Local and State sales tax will be collected if your recipient's mailing address is in: <ul><li>Arizona</li><li>California</li><li>Colorado</li></ul>"}
        }]
    }
    </script> --}}
@endpush
@section('content')
  <style>
    #faqExample .card-body a {
      color: blue;
      font-weight: bold;
    }

    #faqExample .card-body span {
      font-weight: bold;
    }

  </style>
  <div class="container">
    <div class="row my-4 justify-content-center">
      <div class="col-12 text-center">
        <h1>
          سوالات متداول
        </h1>
      </div>
      <div class="col-12 mx-auto">
        <div class="accordion" id="faqExample">
          {{-- <section class="pt-3"> --}}
          {{-- <h3>بخش اول</h3> --}}

          @foreach ($questions as $question)
            <div class="card">
              <div class="card-header p-2">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" aria-expanded="false">
                    {{ $question['question'] }}
                  </button>
                </h5>
              </div>
              <div class="collapse" data-parent="#faqExample">
                <div class="card-body">
                  {!! nl2br($question['answer']) !!}
                </div>
              </div>
            </div>
          @endforeach

          {{-- </section> --}}
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
  <script>
    $(function() {
      var idx = 1;
      document.querySelectorAll('#faqExample .card').forEach((el) => {
        var heading_id = 'heading' + idx,
          collapse_id = 'collapse' + idx;

        var heading = el.querySelector('.card-header');
        heading.setAttribute('id', heading_id);

        var btn = el.querySelector('button');
        btn.setAttribute('data-target', '#' + collapse_id);
        btn.setAttribute('aria-controls', collapse_id);

        var content = el.querySelector('.collapse');
        content.setAttribute('id', collapse_id);
        content.setAttribute('aria-labelledby', heading_id);

        idx++;
      });
    });
  </script>
@endpush
