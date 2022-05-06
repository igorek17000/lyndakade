@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
      'image' => fromDLHost($path->img),
      'title' => $path->titleEng . ' - ' . $path->title . ' - لیندا کده',
      'keywords' => get_seo_keywords() . ' , لیست مسیر آموزشی , learn path, learn-path, all learn paths ' . $path->title,
      'description' => 'مسیر آموزشی ' . $path->description . '| ' . get_seo_description(),
  ])

  <link rel="alternate" href="{{ route('learn.paths.show.short', [$path->id]) }}">
  @foreach (explode(',', $path->slug) as $slug)
    <link rel="alternate" href="{{ route('learn.paths.show', [$slug]) }}">
  @endforeach

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ItemList",
      "itemListElement": [
        @foreach (js_to_courses($path->_courses) as $course)
          {
          "@type": "ListItem",
          "position": "{{ $loop->index + 1 }}",
          "item": {
          "@type": "Course",
          "image": "{{ fromDLHost($course->img) }}",
          "url": "{{ route('courses.show.linkedin', [$course->slug_linkedin]) }}",
          "name": "{{ $course->titleEng }} - {{ $course->title }}",
          "description": "{{ $course->description }}",
          "dateCreated": "{{ $course->updateDate ?? $course->releaseDate }}",
          "timeRequired":
          "{{ $course->durationHours > 0 ? $course->durationHours . 'h ' . $course->durationMinutes . 'm' : $course->durationMinutes . 'm' }}",
          "provider": [
          @foreach ($course->authors as $author)
            {
            "@type": "Person",
            "name": "{{ $author->name }}",
            "url": {"@id": "{{ route('authors.show', [$author->slug]) }}"}
            }
            @if (!$loop->last)
              ,
            @endif
          @endforeach
          ]
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
  <div id="learn-path-top" class="px-0 pt-0" style="margin-bottom: 150px;">
    <div class="row m-0">
      <div class="path-big-img" style="
                                                                                max-width: 100%; width: 100%;
                                                                                background: url({{ fromDLHost($path->img) }});
                                                                                background-size: auto;
                                                                                height: 300px !important;">
        <img itemprop="image" src="#" class="lazyload" data-src="{{ fromDLHost($path->img) }}"
          alt="مسیر آموزشی {{ $path->title }} - Image of Learn Path {{ $path->titleEng }}" />
      </div>
      <div class="path-big-img-content w-100">
        <div class="container-fluid" style="height: 630px;overflow: hidden;">
          <div class="row">
            <div class="col-xs-12 col-md-12 path-title-desc ">
              <div class="container h-100 mt-4" style="position: relative;background-color: #ffffff;border-radius: 5px;">
                <div class="input-group"
                  style="text-align: left;position: absolute;width: 180px;left: 0;top: 2px;margin-left: 4px;margin-top: 2px;">
                  <span class="input-group-addon"><svg class="svg-inline--fa fa-copy fa-w-14"
                      style="position: absolute;z-index: 10;left: 8px;top: 5px;font-size: 18px;" aria-hidden="true"
                      data-prefix="fa" data-icon="copy" role="img" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 448 512" data-fa-i2svg="">
                      <path fill="currentColor"
                        d="M320 448v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V120c0-13.255 10.745-24 24-24h72v296c0 30.879 25.121 56 56 56h168zm0-344V0H152c-13.255 0-24 10.745-24 24v368c0 13.255 10.745 24 24 24h272c13.255 0 24-10.745 24-24V128H344c-13.2 0-24-10.8-24-24zm120.971-31.029L375.029 7.029A24 24 0 0 0 358.059 0H352v96h96v-6.059a24 24 0 0 0-7.029-16.97z">
                      </path>
                    </svg>
                    <input readonly="" onclick="(()=>{this.select();
                                                              this.setSelectionRange(0, 99999);
                                                              navigator.clipboard.writeText(this.value);
                                                                toastr.options.rtl = true;
                                                                toastr.options.positionClass = 'toast-bottom-left';
                                                              toastr.info('لینک کوتاه کپی شد.');})()"
                      style="font-size: 11px;text-align: left;direction: rtl;padding-left: 27px;padding-right: 2px;"
                      title="لینک کوتاه این مسیر آموزشی" type="text" value="lyndakade.ir/L/{{ $path->id }}"
                      id="shorturl" class="form-control">
                </div>
                <div class="path-big-img-path pt-3 my-0" style="width: -moz-fit-content;">
                  <a href="{{ route('learn.paths.index') }}">
                    مسیرهای یادگیری
                  </a>
                  <i class="lyndacon arrow-left"></i>
                  @if ($path->category)
                    <a href="{{ route('learn.paths.index', ['category_id' => $path->category->id]) }}">
                      {{ $path->category->title ?? $path->category->titleEng }}
                    </a>
                  @endif
                </div>
                <div class="row mx-auto">
                  <div class="col-md-6">
                    <div style="font-size: 24px;
                              margin-top: 10px;
                              margin-bottom: 9px;
                              font-weight: 700;min-height: 72px;">
                      <span>
                        {{ $path->title }}
                      </span>
                      <span class="ml-auto text-left d-block d-md-none" dir="ltr">
                        {{ $path->titleEng }}
                      </span>
                    </div>
                    <div class="path-description text-justify mb-2"
                      style="height: 125px !important; word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 1.5;-webkit-line-clamp: 5;-webkit-box-orient: vertical;">
                      {!! nPersian($path->description) !!}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="container text-left d-none d-md-block" dir="ltr" style="font-size: 24px;
                              margin-top: 10px;
                              margin-bottom: 9px;
                              font-weight: 700;min-height: 72px;">
                      <span>
                        {{ $path->titleEng }}
                      </span>
                    </div>
                    <div class="path-description text-justify mb-2 text-left"
                      style="height: 125px !important; word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 1.5;-webkit-line-clamp: 5;-webkit-box-orient: vertical;"
                      dir="ltr">
                      {!! nPersian($path->descriptionEng) !!}
                    </div>
                  </div>
                </div>
                <div class="row py-md-3 text-center" style="font-size: 1.25em;">
                  <div class="col-6 my-md-1">
                    <b>مدت زمان: </b>{{ $path->durationHours() ? $path->durationHours() . 'h' : '' }}
                    {{ $path->durationMinutes() ? $path->durationMinutes() . 'm' : '' }}
                  </div>
                  <div class="col-6 my-md-1">
                    <b>تعداد دوره ها: </b>{{ count(js_to_courses($path->_courses)) }}
                    {{-- <b>تعداد دوره ها: </b>{{ count(js_to_courses($path->courses)) }} --}}
                  </div>
                  @if ($path->price() > 0)
                    <div class="col-6 my-md-1">
                      <b>مجموع قیمت:</b>
                      <del class="text-muted">({{ nPersian($path->old_price()) }})</del>
                    </div>
                  @endif
                  <div class="col-6 my-md-1">
                    <b>قیمت @if ($path->price() > 0)
                        با 30% تخفیف
                      @endif:
                    </b>
                    @if ($path->price() == 0)
                      <span style="color: darkgreen">رایگان</span>
                    @else
                      {{ nPersian($path->price()) }}
                    @endif
                  </div>
                  <div class="col-6 my-md-1">
                    <b>تعداد مدرسین: </b>{{ count($authors) }}
                  </div>
                  <div class="col-6 my-md-1">
                    @if (\Illuminate\Support\Facades\Auth::check())
                      <div id="cart-btn">
                        @if ($path_state == '2')
                          <a data-id="2-{{ $path->id }}" class="btn btn-danger align-self-center cart-remove-btn">
                            حذف از سبد خرید
                          </a>
                        @elseif($path_state == '1')
                          <a data-id="2-{{ $path->id }}" class="btn btn-download align-self-center cart-add-btn">
                            افزودن به سبد خرید
                          </a>
                        @elseif($path_state == '3')
                          خریداری شده است.
                        @endif
                      </div>
                    @else
                      <div>
                        برای خرید این مسیر آموزشی باید
                        <a href="{{ route('login', ['returnUrl' => request()->url()]) }}" style="color: orange">
                          وارد حساب کاربری
                        </a>
                        خود شوید.
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <ul class="timeline">
      @foreach ($courses as $index => $course)
        <li>
          <div class="timeline-badge">{{ $index + 1 }}</div>
          <div class="timeline-panel p-0">
            @include('courses.partials._course_list_new', [
                'course' => $course,
            ])
          </div>
        </li>
      @endforeach
    </ul>
    <div class="row position-relative mx-0" style="height: 60px;">
      <div id="cart-btn">
        @if (auth()->check())
          <div id="cart-btn">
            @if ($path_state == '2')
              <a data-id="2-{{ $path->id }}" class="btn btn-danger align-self-center cart-remove-btn">
                حذف از سبد خرید
              </a>
            @elseif($path_state == '1')
              <a data-id="2-{{ $path->id }}" class="btn btn-download align-self-center cart-add-btn">
                افزودن به سبد خرید
              </a>
            @elseif($path_state == '3')
              خریداری شده است.
            @endif
          </div>
        @else
          <div>
            برای خرید این مسیر آموزشی باید
            <a href="{{ route('login', ['returnUrl' => request()->url()]) }}">
              وارد حساب کاربری
            </a>
            خود شوید.
          </div>
        @endif
      </div>
    </div>
  </div>
  <div id="learning-path">
    <div class="row path-experts mx-0">
      <div class="col-12">
        <h5 class="course-title">شما این مسیر آموزشی را با مدرسان زیر میگذرانید</h5>
      </div>
      @foreach ($authors as $index => $author)
        @include('authors.partials._item-grid', ['author' => $author])
      @endforeach
    </div>
  </div>
@endsection
@section('script_body')
  <script>
    $(function() {
      $('.carousel').carousel({
        interval: false,
        wrap: false,
        keyboard: false,
      });
    })
  </script>
@endsection
