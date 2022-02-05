<div class="col-sm-12 col-md-6 col-lg-3 p-2">
  <div class="card">
    <a class="card-content" href="{{ route('learn.paths.show', [$learn_path->slug]) }}">
      <div class="card-img">
        <img itemprop="image" src="#" class="lazyload card-img" style="height: 150px !important;" data-src="{{ fromDLHost($learn_path->thumbnail) }}"  alt="مسیر آموزشی {{ $learn_path->title }} - Image of Learn Path {{ $learn_path->titleEng }}" />
      </div>

      <div class="card-img-overlay text-center">
        {{-- <div class="card-img-overlay text-center vertical-center"> --}}
        <h5 class="titlePer" style="height: 42px !important; font-size: initial;">{{ $learn_path->title }}</h5>
        <h5 class="titleEng" style="height: 42px !important; font-size: initial;">{{ $learn_path->titleEng }}</h5>
        <div style="font-size: .8rem; font-weight: 400;">
          زمان کل مسیر آموزشی
          @if ($learn_path->durationHours() > 0)
            {{ nPersian($learn_path->durationHours()) }}
            ساعت
          @endif
          @if ($learn_path->durationMinutes() > 0)
            {{ nPersian($learn_path->durationMinutes()) }}
            دقیقه
          @endif
          {{-- <p class="mb-2 mt-2">تعداد دروس {{ nPersian(count(js_to_courses($learn_path->_courses))) }}</p> --}}
          <p class="mb-2 mt-2">تعداد دروس {{ nPersian(count(js_to_courses($learn_path->courses))) }}</p>
          <del
            style="background-color: #6c757d;padding: 3px 4px;border-radius: 5px;">{{ nPersian($learn_path->old_price()) }}
            تومان</del>
          <span
            style="background-color: lightgreen;padding: 3px 4px;border-radius: 5px;">{{ nPersian($learn_path->price()) }}
            تومان</span>
        </div>
      </div>
    </a>
    {{-- <div class="card-footer px-1" dir="ltr"> --}}
    {{-- <span class="btn btn-success ga" ref="#" onclick="alert('{{ $learn_path->title }} به سبد اضافه شد.');"> --}}
    {{-- افزودن به سبد --}}
    {{-- </span> --}}
    {{-- <span class="btn btn-secondary px-1">{{ $learn_path->price }} T</span> --}}
    {{-- <span class="btn btn-info px-1">{{ $learn_path->priceOffPercent }}% OFF</span> --}}
    {{-- </div> --}}
  </div>
</div>
