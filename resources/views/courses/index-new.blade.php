@extends('layouts.app-test')
@push('meta.in.head')
  <link rel="canonical" href="https://lyndakade.ir">
  <link rel="alternate" hreflang="fa" href="https://lyndakade.ir">

  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'لیندا کده بروز ترین وبسایت آموزشی',
  'keywords' => get_seo_keywords(),
  'description' => get_seo_description(),
  ])

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Lynda Kade - لیندا کده",
      "url": "https://lyndakade.ir/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "https://lyndakade.ir/search?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
  </script>

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "item": {
          "@id": "{{ route('courses.newest') }}",
          "name": "New Courses - جدیدترین دوره ها"
        }
      }, {
        "@type": "ListItem",
        "position": 2,
        "item": {
          "@id": "{{ route('learn.paths.index') }}",
          "name": "Learning Paths - مسیر آموزشی"
        }
      }, {
        "@type": "ListItem",
        "position": 3,
        "item": {
          "@id": "{{ route('packages.index') }}",
          "name": "Buy Packages - خرید اشتراک"
        }
      }, {
        "@type": "ListItem",
        "position": 4,
        "item": {
          "@id": "{{ route('demands.create') }}",
          "name": "Request Course - درخواست دوره"
        }
      }, {
        "@type": "ListItem",
        "position": 5,
        "item": {
          "@id": "{{ route('root.contact.us') }}",
          "name": "Contact Us - تماس با ما"
        }
      }, {
        "@type": "ListItem",
        "position": 6,
        "item": {
          "@id": "{{ route('faq') }}",
          "name": "FAQ - سوالات متداول"
        }
      }]
    }
  </script>
@endpush
@section('content')
  <style>
    .hero-space {
      height: 450px !important;
    }

    @media (min-width: 426px) {
      .hero-space {
        height: 300px !important;
      }
    }

    @media (min-width: 769px) {
      .hero-space {
        height: 310px !important;
      }
    }

    @media (min-width: 1025px) {
      .hero-space {
        height: 260px !important;
      }
    }

    .show-xs {
      display: none !important;
    }

    @media (max-width: 767px) {
      .show-xs {
        display: block !important;
      }
    }

  </style>
  <div class="row m-0 home-page">
    <div class="col-12 hero-space">
      <div class="hero-text" style="background-color: rgba(255, 255, 255, 0.5) !important;">
        <h1 style="font-size: 2.25rem;">
          دانلود آموزش های وبسایت
          <a href="https://www.linkedin.com/" style="color: #2977c9;">لینکدین</a>
          به همراه زیرنویس فارسی و انگلیسی
        </h1>
        @guest
          <div>برای خرید و دانلود آموزش ها وارد حساب کاربری خود شوید</div>
        @endguest
        <div style="margin-top: 5%; margin-bottom: 2%;">
          برای جستجوی درس مربوطه کافی است لینک مربوط به درس را که در
          <a href="https://www.linkedin.com/" style="color: #2977c9;">سایت لینکدین</a>
          است را وارد کنید
        </div>
        <div class="row m-0 p-0">
          <div class="col-12 m-0 p-0">
            <form id="url-form" name="url-form">
              <div class="row justify-content-center px-0">
                <div class="col-12 px-0 px-md-2">
                  <input id="url" name="url" type="text" class="form-control"
                    placeholder="https://www.linkedin.com/learning/writing-articles-2" dir="ltr">
                </div>
                <button type="submit" class="btn btn-primary w-auto">ارسال</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container my-3">
    <div class="row">
      <div class="col-lg-3 col-sm-6 d-md-block d-none">
        <div class="card-box pb-2"
          style="background-color:#00aaca;border-radius: 10px;max-height: 143px;height: 143px !important">
          <div class="inner pt-0" style="position: relative;">
            <h3 class="counter"
              style="color: black;float: left;margin: auto;position: absolute;top: 50%;left: 20px;-ms-transform: translateY(-50%);transform: translateY(-50%);">
              {{ get_number_of_all_courses() }}</h3>
            <p style="color: black;width: 60%;" class="text-center"> تعداد دوره‌های آموزشی سایت </p>
          </div>
          <div class="inner pt-0" style="position: relative;">
            <h3 class="counter"
              style="color: black;float: left;margin: auto;position: absolute;top: 50%;left: 20px;-ms-transform: translateY(-50%);transform: translateY(-50%);">
              {{ get_number_of_all_paths() }}</h3>
            <p style="color: black;width: 60%;" class="text-center">تعداد مسیرهای آموزشی سایت</p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6 d-md-none">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_number_of_all_courses() }}</h3>
            <p style="color: black" class="mr-2"> تعداد دوره‌های آموزشی سایت </p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 d-md-none">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_number_of_all_paths() }}</h3>
            <p style="color: black" class="mr-2"> تعداد مسیرهای آموزشی سایت </p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_sum_of_all_courses_part_numbers() }}</h3>
            <p style="color: black" class="mr-2"> تعداد کل ویدیوهای آموزشی </p>
          </div>
          <div class="icon">
            <i class="fa fa-video" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_sum_of_all_courses_time() }}</h3>
            <p style="color: black" class="mr-2"> زمان کل آموزشهای سایت (دقیقه)</p>
          </div>
          <div class="icon">
            <i class="fa fa-clock" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_number_of_authors_has_at_least_one_course() }}</h3>
            <p style="color: black" class="mr-2">تعداد مدرسان </p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row card mx-0 pb-3">
    <div class="container">
      <h5 class="my-0 mt-2"> مسیرهای آموزشی
        <a class="btn btn-primary btn-xs mr-3" href="{{ route('learn.paths.index') }}" style="max-width: 110px;">مشاهده
          بیشتر</a>
      </h5>
      <hr style="border-top: 1px solid  #f8ba16" class="my-2">
      <div class="row">
        @foreach ($paths as $path)
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1 @if ($loop->iteration > 6) hidden-md hidden-sm hidden-xs @endif">
            <a href="{{ route('learn.paths.show', [$path->slug]) }}" class="text-center">
              <div class="mx-auto" style="position: relative;width: 255px;">
                <img class="lazyload d-inline-block" data-src="{{ fromDLHost($path->thumbnail) }}"
                  alt="مسیر آموزشی {{ $path->title }} - Image of Learn Path {{ $path->titleEng }}"
                  style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;">
                <span
                  style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                  {{ $path->durationHours() + ($path->durationMinutes() > 20 ? 1 : 0) }} ساعت
                </span>
              </div>
              <div style="/*height: 100px;*/">
                <p class="mt-2 text-center pr-2 mb-0"
                  style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                  {{ $path->title }}
                </p>
                <p class="text-center pl-2 mb-0"
                  style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                  {{ $path->titleEng }}
                </p>
              </div>
              {{-- <br />
            <span class="tile-heading py-2">تعداد دروس
                {{ nPersian(count(js_to_courses($path->_courses))) }}</span> --}}
              {{-- <br />
            <span class="my-2 d-inline-block" style="max-height: 39px;overflow-y: hidden;">
                مدرسین:

                @foreach ($path->authors() as $author)
                {{ $author->name }} @if (!$loop->last), @endif
                @endforeach
            </span> --}}
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="row card mx-0 mt-4 pb-4">
    <div class="container">
      <h5 class="mt-3 ">
        دوره های آموزشی
      </h5>
      <button type="button" class="preview-course-button" data-toggle="modal" data-target="#preview-modal"
        data-src="https://dl.lyndakade.ir/courses/2014/04/Drawing%20Foundations%20-%20Fundamentals/preview.mp4"
        data-title="Drawing Foundations - Fundamentals" data-price="20000">
        پیش‌نمایش
      </button>
      <hr style="border-top: 1px solid  #f8ba16" class="my-2">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1 ">
          <a href="https://lyndakade.ir/learning/paths/build-your-analytical-skills-with-statistical-analysis"
            class="text-center">
            <div class="mx-auto" style="position: relative;width: 255px;">
              <img class="d-inline-block lazyloaded"
                data-src="https://dl.lyndakade.ir/learn-paths/build-your-analytical-skills-with-statistical-analysis/thumbnail.webp"
                alt="مسیر آموزشی تقویت مهارت های تحلیلی خود را با تجزیه و تحلیل آماری - Image of Learn Path Build Your Analytical Skills with Statistical Analysis"
                style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;"
                src="https://dl.lyndakade.ir/learn-paths/build-your-analytical-skills-with-statistical-analysis/thumbnail.webp">
              <span
                style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                2 ساعت
              </span>
            </div>
            <div style="/*height: 100px;*/">
              <p class="mt-2 text-center pr-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                تقویت مهارت های تحلیلی خود را با تجزیه و تحلیل آماری
              </p>
              <p class="text-center pl-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                Build Your Analytical Skills with Statistical Analysis
              </p>
            </div>


          </a>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1 ">
          <a href="https://lyndakade.ir/learning/paths/build-your-data-analysis-skills" class="text-center">
            <div class="mx-auto" style="position: relative;width: 255px;">
              <img class="d-inline-block lazyloaded"
                data-src="https://dl.lyndakade.ir/learn-paths/build-your-data-analysis-skills/thumbnail.webp"
                alt="مسیر آموزشی افزایش مهارت تجزیه و تحلیل داده های خود - Image of Learn Path Build Your Data Analysis Skills"
                style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;"
                src="https://dl.lyndakade.ir/learn-paths/build-your-data-analysis-skills/thumbnail.webp">
              <span
                style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                5 ساعت
              </span>
            </div>
            <div style="/*height: 100px;*/">
              <p class="mt-2 text-center pr-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                افزایش مهارت تجزیه و تحلیل داده های خود
              </p>
              <p class="text-center pl-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                Build Your Data Analysis Skills
              </p>
            </div>


          </a>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1 ">
          <a href="https://lyndakade.ir/learning/paths/master-microsoft-excel" class="text-center">
            <div class="mx-auto" style="position: relative;width: 255px;">
              <img class="d-inline-block lazyloaded"
                data-src="https://dl.lyndakade.ir/learn-paths/master-microsoft-excel/thumbnail.webp"
                alt="مسیر آموزشی به یک استاد مایکروسافت اکسل تبدیل شوید - Image of Learn Path Master Microsoft Excel"
                style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;"
                src="https://dl.lyndakade.ir/learn-paths/master-microsoft-excel/thumbnail.webp">
              <span
                style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                25 ساعت
              </span>
            </div>
            <div style="/*height: 100px;*/">
              <p class="mt-2 text-center pr-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                به یک استاد مایکروسافت اکسل تبدیل شوید
              </p>
              <p class="text-center pl-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                Master Microsoft Excel
              </p>
            </div>


          </a>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1 ">
          <a href="https://lyndakade.ir/learning/paths/master-the-fundamentals-of-ai-and-machine-learning"
            class="text-center">
            <div class="mx-auto" style="position: relative;width: 255px;">
              <img class="d-inline-block lazyloaded"
                data-src="https://dl.lyndakade.ir/learn-paths/master-the-fundamentals-of-ai-and-machine-learning/thumbnail.webp"
                alt="مسیر آموزشی تسلط بر اصول هوش مصنوعی و یادگیری ماشین - Image of Learn Path Master the Fundamentals of AI and Machine Learning"
                style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;"
                src="https://dl.lyndakade.ir/learn-paths/master-the-fundamentals-of-ai-and-machine-learning/thumbnail.webp">
              <span
                style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                12 ساعت
              </span>
            </div>
            <div style="/*height: 100px;*/">
              <p class="mt-2 text-center pr-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                تسلط بر اصول هوش مصنوعی و یادگیری ماشین
              </p>
              <p class="text-center pl-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                Master the Fundamentals of AI and Machine Learning
              </p>
            </div>


          </a>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1 ">
          <a href="https://lyndakade.ir/learning/paths/become-a-react-developer" class="text-center">
            <div class="mx-auto" style="position: relative;width: 255px;">
              <img class="d-inline-block lazyloaded"
                data-src="https://dl.lyndakade.ir/learn-paths/become-a-react-developer/thumbnail.webp"
                alt="مسیر آموزشی به یک توسعه دهنده React تبدیل شوید - Image of Learn Path Become a React Developer"
                style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;"
                src="https://dl.lyndakade.ir/learn-paths/become-a-react-developer/thumbnail.webp">
              <span
                style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                6 ساعت
              </span>
            </div>
            <div style="/*height: 100px;*/">
              <p class="mt-2 text-center pr-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                به یک توسعه دهنده React تبدیل شوید
              </p>
              <p class="text-center pl-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                Become a React Developer
              </p>
            </div>


          </a>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1 ">
          <a href="https://lyndakade.ir/learning/paths/become-an-accounts-payable-officer-2" class="text-center">
            <div class="mx-auto" style="position: relative;width: 255px;">
              <img class="d-inline-block lazyloaded"
                data-src="https://dl.lyndakade.ir/learn-paths/become-an-accounts-payable-officer-2/thumbnail.webp"
                alt="مسیر آموزشی تبدیل به یک مسئول حسابهای پرداختنی شوید - Image of Learn Path Become an Accounts Payable Officer"
                style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;"
                src="https://dl.lyndakade.ir/learn-paths/become-an-accounts-payable-officer-2/thumbnail.webp">
              <span
                style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                20 ساعت
              </span>
            </div>
            <div style="/*height: 100px;*/">
              <p class="mt-2 text-center pr-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                تبدیل به یک مسئول حسابهای پرداختنی شوید
              </p>
              <p class="text-center pl-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                Become an Accounts Payable Officer
              </p>
            </div>


          </a>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1  hidden-md hidden-sm hidden-xs ">
          <a href="https://lyndakade.ir/learning/paths/prepare-for-microsoft-azure-architect-technologies-certification-az-300"
            class="text-center">
            <div class="mx-auto" style="position: relative;width: 255px;">
              <img class="d-inline-block lazyloaded"
                data-src="https://dl.lyndakade.ir/learn-paths/prepare-for-microsoft-azure-architect-technologies-certification-az-300/thumbnail.webp"
                alt="مسیر آموزشی آماده شدن برای گواهینامه Microsoft Azure Architect Technologies (AZ-300) - Image of Learn Path Prepare for Microsoft Azure Architect Technologies Certification (AZ-300)"
                style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;"
                src="https://dl.lyndakade.ir/learn-paths/prepare-for-microsoft-azure-architect-technologies-certification-az-300/thumbnail.webp">
              <span
                style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                24 ساعت
              </span>
            </div>
            <div style="/*height: 100px;*/">
              <p class="mt-2 text-center pr-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                آماده شدن برای گواهینامه Microsoft Azure Architect Technologies (AZ-300)
              </p>
              <p class="text-center pl-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                Prepare for Microsoft Azure Architect Technologies Certification (AZ-300)
              </p>
            </div>


          </a>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1  hidden-md hidden-sm hidden-xs ">
          <a href="https://lyndakade.ir/learning/paths/the-top-10-most-popular-courses-among-engineering-professionals"
            class="text-center">
            <div class="mx-auto" style="position: relative;width: 255px;">
              <img class="d-inline-block ls-is-cached lazyloaded"
                data-src="https://dl.lyndakade.ir/learn-paths/the-top-10-most-popular-courses-among-engineering-professionals/thumbnail.webp"
                alt="مسیر آموزشی 10 دوره محبوب در بین حرفه ای های مهندسی - Image of Learn Path The Top 10 Most Popular Courses among Engineering Professionals"
                style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;"
                src="https://dl.lyndakade.ir/learn-paths/the-top-10-most-popular-courses-among-engineering-professionals/thumbnail.webp">
              <span
                style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                25 ساعت
              </span>
            </div>
            <div style="/*height: 100px;*/">
              <p class="mt-2 text-center pr-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                10 دوره محبوب در بین حرفه ای های مهندسی
              </p>
              <p class="text-center pl-2 mb-0"
                style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                The Top 10 Most Popular Courses among Engineering Professionals
              </p>
            </div>


          </a>
        </div>
      </div>
    </div>
  </div>



  {{-- @if (isset($dubbed_courses))
    @if (count($dubbed_courses) > 0)
      <div class="row card mx-0 latest-courses border-0">
        <div class="col-12 card-body">
          <div class="container">
            <h5>
              <i class="fas fa-plus-square"></i>
              دوره های آموزشی دوبله شده
              (تعداد دوره ها {{ nPersian(count($dubbed_courses)) }})
              <a class="btn btn-primary my-2" href="{{ route('courses.free') }}">مشاهده بیشتر</a>
            </h5>
            <hr style="border-top: 1px solid  #f8ba16">
            <div class="row d-flex ">
              @foreach ($dubbed_courses as $course)
                @include('courses.partials._course_list_grid', ['course' => $course])
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @endif
  @endif

  <div class="row card mx-0 latest-courses border-0">
    <div class="col-12 card-body">
      <div class="container">
        <h5>
          <i class="fas fa-plus-square"></i>
          دوره های آموزشی رایگان
          (تعداد دوره ها {{ $free_courses_count }})
          <a class="btn btn-primary my-2" href="{{ route('courses.free') }}">مشاهده بیشتر</a>
        </h5>
        <hr style="border-top: 1px solid  #f8ba16">
        <div class="row d-flex ">
          @foreach ($free_courses as $course)
            @include('courses.partials._course_list_grid', ['course' => $course])
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="row card mx-0 latest-courses border-0">
    <div class="col-12 card-body">
      <div class="container">
        <h5>
          <i class="fas fa-plus-square"></i>
          جدیدترین دوره های آموزشی
          <a class="btn btn-primary my-2" href="{{ route('courses.newest') }}">مشاهده بیشتر</a>
        </h5>
        <hr style="border-top: 1px solid  #f8ba16">
        <div class="row d-flex ">
          @foreach ($latest_courses as $course)
            @include('courses.partials._course_list_grid', ['course' => $course])
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="row card mx-0 latest-courses border-0">
    <div class="col-12 card-body">
      <div class="container">
        <h5>
          <i class="fas fa-plus-square"></i>
          محبوب ترین دوره های آموزشی
          <a class="btn btn-primary my-2" href="{{ route('courses.best') }}">مشاهده بیشتر</a>
        </h5>
        <hr style="border-top: 1px solid  #f8ba16">
        <div class="row d-flex ">
          @foreach ($popular_courses as $course)
            @include('courses.partials._course_list_grid', ['course' => $course])
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="row card mx-0 latest-courses border-0">
    <ul id="myTab" role="tablist"
      class="nav nav-tabs nav-pills flex-md-row text-center border-0 rounded-nav d-flex justify-content-center">
      @foreach ($page_tabs as $tab)
        <li class="nav-item flex-md-fill">
          <a id="{{ $tab[0] }}-tab" data-toggle="tab" href="#{{ $tab[0] }}" role="tab"
            aria-controls="{{ $tab[0] }}" aria-selected="true"
            class="nav-link border-0 text-uppercase font-weight-bold {{ $loop->first ? 'active' : '' }}">{{ $tab[1] }}</a>
        </li>
      @endforeach
    </ul>
    <div id="myTabContent" class="tab-content">
      @foreach ($page_tabs as $tab)
        <div id="{{ $tab[0] }}" role="tabpanel" aria-labelledby="{{ $tab[0] }}-tab"
          class="tab-pane fade p-0 {{ $loop->first ? 'show active' : '' }}">
          <div class="row card mx-0 latest-courses border-0">
            <div class="col-12 card-body px-0">
              <div class="container">
                <div class="row d-flex">
                  @foreach ($tab[2] as $course)
                    @include('courses.partials._course_list_grid', ['course' => $course])
                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <!-- End rounded tabs -->
  </div> --}}


  <div class="modal fade" id="form-link-modal" tabindex="-1" role="dialog" aria-labelledby="form-link-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content text-center" style="background-color: orange;">
        <div class="modal-header" style="border-color: orange;">
          <h5 class="modal-title" id="form-link-modal-title">نتیجه جستجو</h5>
          <button type="button" class="close ml-0 mr-auto" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="form-link-modal-body" style="font-size: 1.5rem;">
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>

  <div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="preview-modal-title"
    aria-hidden="true" style="background-color: #444c;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content text-center">
        <div class="modal-body p-0" id="preview-modal-body"
          style="margin-bottom: -15px;overflow-y: hidden;font-size: 1.5rem;">
          <video class="w-100" src="" controls aria-controls="true"></video>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script_body')
  <script>
    function perToEng(str) {
      var
        persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
        arabicNumbers = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
      if (typeof str === 'string') {
        for (var i = 0; i < 10; i++) {
          str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
        }
      }
      return str;
    }

    function engToPer(n) {
      const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

      return n
        .toString()
        .replace(/\d/g, x => farsiDigits[x]);
    }

    $(document).ready(function() {
      $('.counter').each(function() {
        $(this).prop('Counter', 0).animate({
          Counter: perToEng($(this).text())
        }, {
          duration: 5000,
          easing: 'swing',
          step: function(now) {
            $(this).text(engToPer(Math.ceil(now)));
          }
        });
      });

      //   $(document).on('click', '.btn-subject-preview', function(e) {
      //     e.preventDefault();
      //     alert($(e.target.parentNode).text());
      //   });
    });

    $(function() {
      $('.shadow #myTab > li > a').click((e) => {
        setTimeout(() => {
          document.querySelectorAll('#myTabContent div[role="tabpanel"].show').forEach(el => {
            el1 = $(el);
            el1.removeClass('show');
          });
          let element = $('#myTabContent div[role="tabpanel"].active');
          element.addClass('show');
        }, 200);
      });
    });

    $(function() {
      document.getElementById('url-form').onsubmit = function(e) {
        let url = $('#url').val();
        $.ajax({
          url: "{{ route('course.api.with-link') }}",
          method: 'post',
          data: {
            'link': url
          },
          success: (result) => {
            console.log("result", result);
            if (result.status == 'success') {
              // $('#url').val('');
              window.location.href = result.url;
              return;
            } else if (result.status == 'link is required') {
              $('#form-link-modal-body').text('لینک را باید وارد کنید.');
            } else if (result.status == 'link is not valid') {
              $('#form-link-modal-body').text('لینک نامعتبر میباشد.');
            } else if (result.status == 'course was not found') {
              // $('#form-link-modal-body').text('دوره آموزشی یافت نشد.');
              $('#form-link-modal-body')[0].innerHTML =
                '<p>دوره آموزشی یافت نشد</p><a class="btn btn-primary" href="{{ route('demands.create') }}">درخواست دوره</a>';
            } else {
              $('#form-link-modal-body').text('خطای پیش بینی نشده رخ داده است، لطفا دوباره تلاش کنید.');
            }
            $('#form-link-modal').modal('toggle');
          },
          errors: (xhr) => {
            $('#form-link-modal-body').text('خطای پیش بینی نشده رخ داده است، لطفا دوباره تلاش کنید.');
            $('#form-link-modal').modal('toggle');
          }
        })
        return false;
      };
    });

    $(function() {
      document.querySelectorAll('*[data-price]').forEach(element => {
        element.setAttribute('data-price', engToPer(element.getAttribute('data-price')));
      });
      $('#preview-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        // $('#preview-modal-title').text(button.data('title'));
        document.querySelector('#preview-modal-body video').setAttribute('src', button.data('src'));
        document.querySelector('#preview-modal-body video').play();
      });
      $('#preview-modal').on('hidden.bs.modal', function() {
        document.querySelector('#preview-modal-body video').setAttribute('src', '');
      });
    });
  </script>

@endsection
