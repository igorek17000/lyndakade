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
