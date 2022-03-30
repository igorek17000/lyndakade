@php
$questions = [
    [
        'question' => 'نحوه خرید دوره؟',
        'answer' =>
            'بطور کلی دو روش برای خرید دوره وجود دارد:

        1) خرید دوره با پرداخت مستقیم: در این روش، دوره(‌های) مورد نظر خود را به <a target="_blank" href="' .
            route('cart.index') .
            '"> سبد خرید </a> خود اضافه کنید، سپس به صفحه <a target="_blank" href="' .
            route('cart.index') .
            '"> سبد خرید </a>  مراجعه و با استفاده دکمه <span>«عملیات پرداخت»</span> اقدام به پرداخت نمایید. همچنین پس از خرید دوره(ها)، می‌توانید از طریق صفحه <a target="_blank" href="' .
            route('courses.mycourses') .
            '"> دوره‌های خریداری شده</a> ، لیست تمامی دوره‌های خریداری شده‌ی خود را مشاهده نمایید. در صورتیکه در زمان پرداخت مشکلی رخ داده است، از طریق صفحه <a target="_blank" href="' .
            route('root.contact.us') .
            '">تماس با ما </a> به ما اطلاع رسانی کنید تا تیم پشتیبانی بررسی شود.

            2) خرید دوره با استفاده از اشتراک: در این روش، می‌بایست از طریق صفحه <a target="_blank" href="' .
            route('packages.index') .
            '"> خرید اشتراک</a> ، اشتراک مورد نظر خود را خریداری نمایید، سپس همانند روش اول، دوره(های) مورد نظر خود را به <a target="_blank" href="' .
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
            'برای اینکار به صفحه <a target="_blank" href="' .
            route('packages.index') .
            '"> خرید اشتراک</a> مراجعه و بروی اشتراک مورد نظر خود کلیک کنید، و پس از انجام عملیات پرداخت، اشتراک انتخابی فورا برای شما فعال می‌شود.
            برای بررسی میزان اعتبار اشتراک، میتوانید به صفحه <a target="_blank" href="' .
            route('cart.index') .
            '"> سبد خرید </a> یا صفحه <a target="_blank" href="' .
            route('packages.index') .
            '"> خرید اشتراک</a> مراجعه نمایید.',
    ],
    [
        'question' => 'نحوه استفاده از اشتراک؟',
        'answer' => 'برای اینکار، دوره(های) مورد نظر خود را به <a target="_blank" href="' . route('cart.index') . '"> سبد خرید </a> اضافه کرده و سپس به صفحه <a target="_blank" href="' . route('cart.index') . '"> سبد خرید </a> بروید، و در قسمت پایین جدول، کنار دکمه <span>«عملیات پرداخت»</span>، دکمه‌ی <span>«استفاده از اشتراک»</span> راه نیز مشاهده می‌کنید. با استفاده از دکمه <span>«استفاده از اشتراک»</span>، تعداد دوره‌های موجود در سبد خرید شما، از اعتبار اشتراک شما کسر می‌شود. همچنین در صفحه سبد خرید، جدولی مربوط به <span>«تعداد دوره‌ها در سبد خرید»</span> و <span>«اعتبار اشتراک فعلی شما»</span> نیز وجود دارد.',
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
        'answer' =>
            'در صورتی که با استفاده از روش دوم جستجو، قادر به یافتن دوره آموزشی مورد نظر نبوده‌اید، می‌توانید پس از ورود به حساب کاربری، به صفحه <a target="_blank" href="' .
            route('demands.create') .
            '"> درخواست دوره </a> مراجعه کنید و به یکی از دو روش، درخواست دوره ارسال نمایید:
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
        'answer' => 'بدلیل حجیم بودن فیلم‌های هر دوره، ما آنها را بصورتی فشرده سازی کرده‌ایم که، سبب کاهش حجم چشمیگیری شده است، که این موضوع باعث صرفه جویی در مدت زمان و میزان حجم مصرفی شما می‌شود، به همین دلیل فیلم‌ها توسط برنامه‌های <a target="_blank" href="https://soft98.ir/multi-media/player/2438-potplayer.html"> Pot Player </a>، <a target="_blank" href="https://soft98.ir/multi-media/video-player/278-kmplayer-free.html"> KM Player </a> ، <a target="_blank" href="https://soft98.ir/multi-media/video-player/496-vlc-media-player.html"> VLC Media Player </a> و یا سایر مدیا پلیرهایی که قابلیت نصب <a target="_blank" href="https://codecpack.co/download/PotPlayer.html"> Codec </a> بروی آنها وجود دارد، قابل اجرا هستند.',
    ],
    [
        'question' => 'تخفیفات براساس میزان خرید؟',
        'answer' =>
            'برای هر حساب کاربری، بر اساس میزان کل هزینه‌های پرداخت شده، در خریدهای بعدی میزان درصد تخفیفی نیز در نظر گرفته می‌شود که در جدول زیر قرار دارند.
            توجه داشته باشید، میزان کل هزینه‌های پرداخت شده، شامل خرید دوره‌های آموزشی، خرید مسیرهای آموزشی، خرید اشتراک می‌باشد. <table class="table table-bordered mt-2 text-center"><thead><tr><th scope="col" class="align-middle">سطح</th><th scope="col" class="align-middle">مجموع خرید</th><th scope="col" class="align-middle">درصد تخفیف (برای تمامی خریدها)</th></tr></thead><tbody><tr><th scope="row" class="align-middle">1</th><td class="align-middle">بین ' .
            nPersian(number_format(200000)) .
            ' تا ' .
            nPersian(number_format(400000 - 1000)) .
            ' تومان </td><td class="align-middle">' .
            nPersian(number_format(5)) .
            '%</td></tr><tr><th scope="row" class="align-middle">2</th><td class="align-middle">بین ' .
            nPersian(number_format(400000)) .
            ' تا ' .
            nPersian(number_format(600000 - 1000)) .
            ' تومان </td><td class="align-middle">' .
            nPersian(number_format(10)) .
            '%</td></tr><tr><th scope="row" class="align-middle">3</th><td class="align-middle">بین ' .
            nPersian(number_format(600000)) .
            ' تا ' .
            nPersian(number_format(800000 - 1000)) .
            ' تومان </td><td class="align-middle">' .
            nPersian(number_format(15)) .
            '%</td></tr><tr><th scope="row" class="align-middle">4</th><td class="align-middle">بین ' .
            nPersian(number_format(800000)) .
            ' تا ' .
            nPersian(number_format(1000000 - 1000)) .
            ' تومان </td><td class="align-middle">' .
            nPersian(number_format(20)) .
            '%</td></tr><tr><th scope="row" class="align-middle">5</th><td class="align-middle">' .
            nPersian(number_format(1000000)) .
            ' تومان به بالا</td><td class="align-middle">' .
            nPersian(number_format(25)) .
            '%</td></tr></tbody></table>',
    ],
    [
        'question' => 'آیا طرح اینترنت نیم‌بها شامل وبسایت لینداکده نیز می‌باشد؟',
        'answer' => 'بله. از طریق لینک <a href="https://l2i.ir/qmn3k" target="_blank">https://l2i.ir/qmn3k</a> قابل بررسی می‌باشد.',
    ],
    [
        'question' => 'تا چه مدت میتوان دوره های خریداری شده را دانلود کرد؟',
        'answer' => 'با خرید هر دوره یا مسیر آموزشی، با هر یک از روش‌های موجود، آن دوره یا مسیر آموزشی بصورت دائم برای شما باز می‌باشد. در صورتی که دوره آپدیت شود، از طریق ایمیل به شما اطلاع رسانی می‌شود و همینطور آپدیت را می‌توانید رایگان دریافت کنید.',
    ],
    [
        'question' => 'علت نمایش تعداد بازدید سایت لینکدین؟',
        'answer' => 'برای آشنایی با محبوب‌ترین دوره‌های آموزشی در سطح جهانی، در وب‌سایت خود، تعداد یادگیرندگان هر دوره از وب‌سایت مرجع را نشان می‌دهیم.',
    ],
];
@endphp

@extends('layouts.app')

@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => 'سوالات متداول - لیندا کده',
      'keywords' => get_seo_keywords() . ' , سوالات متداول , faq, questions, ticket, تیکت ',
      'description' => 'مشاهده لیست سوالات متداول کاربران. | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [

        @foreach ($questions as $question)
          {
          "@type": "Question",
          "name": "{{ $question['question'] }}",
          "acceptedAnswer": {
          "@type": "Answer",
          "text": "{!! nl2br(e($question['answer'])) !!}"
          }
          }
          @if (!$loop->last)
            ,
          @endif
        @endforeach
      ]
    }
  </script>
@endpush
@section('content')
  <style>
    .faq-questions blockquote a {
      color: blue;
      font-weight: bold;
    }

  </style>
  <div class="container">
    <p>&nbsp;</p>
    <h1 class="text-center" style="color: #2500bb;font-weight: 600;">سوالات متداول</h1>
    <div class="faq-questions">
      <p>&nbsp;</p>
      @foreach ($questions as $question)
        <h3 style="font-size: 24px;">
          <span style="color: #000000;">#</span>
          <span style="color: #0072ff;">
            <span style="color: #000000;">{{ nPersian($loop->iteration) }}</span>
            {{ $question['question'] }}
          </span>
        </h3>
        <blockquote
          style="background-color: #eee;border-right: 15px solid #00a3a3;padding: 5px;border-left: 3px solid #00a3a3;">
          {!! nl2br($question['answer']) !!}
        </blockquote>
        <p>&nbsp;</p>
      @endforeach
    </div>
  </div>
@endsection
@push('js')
  <script>
    $(function() {});
  </script>
@endpush
