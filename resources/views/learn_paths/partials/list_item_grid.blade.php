<div class="col-sm-12 col-md-6 col-lg-3 p-2">
  <div class="card">
    <a class="card-content" href="{{ route('learn.paths.show', [$path->library->slug, $path->slug]) }}">
      <div class="card-img">
        <img src="#" class="lazyload card-img" height="150" data-src="{{ fromDLHost($path->img) }}" />
      </div>

      <div class="card-img-overlay text-center">
        {{-- <div class="card-img-overlay text-center vertical-center"> --}}
        <h4>{{ $path->title }}</h4>
        <div style="font-size: .8rem; font-weight: 400;">
          زمان کل مسیر آموزشی
          @if ($path->durationHours() > 0)
            {{ $path->durationHours() }}
            ساعت
          @endif
          @if ($path->durationMinutes() > 0)
            {{ $path->durationMinutes() }}
            دقیقه
          @endif
          <br>
          <style>
            .amount {
              position: relative;
            }

            .amount::after {
              content: "";
              width: 100%;
              height: 1px;
              background: black;
              position: absolute;
              bottom: -10px;
              left: 0;
            }

          </style>
          <span class="btn btn-success px-1 amount">{{ $path->old_price() }} تومان</span>
          <span class="btn btn-success px-1">{{ $path->price() }} تومان</span>
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
