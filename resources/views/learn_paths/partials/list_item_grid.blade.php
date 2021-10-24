<div class="col-sm-12 col-md-6 col-lg-3 p-2">
  <div class="card">
    <a class="card-content" href="{{ route('learn.paths.show', [$path->slug]) }}">
      <div class="card-img">
        <img src="#" class="lazyload card-img" style="height: 150px !important;" data-src="{{ fromDLHost($path->thumbnail) }}" />
      </div>

      <div class="card-img-overlay text-center">
        {{-- <div class="card-img-overlay text-center vertical-center"> --}}
        <h5 class="titlePer" style="height: 42px !important; font-size: initial; display: block;">{{ $path->title }}</h5>
        <h5 class="titleEng" style="height: 42px !important; font-size: initial; display: none;">{{ $path->titleEng }}</h5>
        <div style="font-size: .8rem; font-weight: 400;">
          زمان کل مسیر آموزشی
          @if ($path->durationHours() > 0)
            {{ nPersian($path->durationHours()) }}
            ساعت
          @endif
          @if ($path->durationMinutes() > 0)
            {{ nPersian($path->durationMinutes()) }}
            دقیقه
          @endif
          <hr>
          <del
            style="background-color: #6c757d;padding: 3px 4px;border-radius: 5px;">{{ nPersian($path->old_price()) }}
            تومان</del>
          <span
            style="background-color: lightgreen;padding: 3px 4px;border-radius: 5px;">{{ nPersian($path->price()) }}
            تومان</span>
        </div>
      </div>
    </a>
    {{-- <div class="card-footer px-1" dir="ltr"> --}}
    {{-- <span class="btn btn-success ga" ref="#" onclick="alert('{{ $path->title }} به سبد اضافه شد.');"> --}}
    {{-- افزودن به سبد --}}
    {{-- </span> --}}
    {{-- <span class="btn btn-secondary px-1">{{ $path->price }} T</span> --}}
    {{-- <span class="btn btn-info px-1">{{ $path->priceOffPercent }}% OFF</span> --}}
    {{-- </div> --}}
  </div>
</div>
