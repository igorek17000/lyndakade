@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => ' لیندا کده | سبد خرید' . ' ',
  'keywords' => get_seo_keywords() . ' , ' . 'سبد , سبد خرید ',
  'description' => get_seo_description(),
  ])
@endpush
@section('content')
  <div class="container">
    <div class="row justify-content-center my-3">
      <div class="col-md-8 col-sm-12">
        <article class="card">
          <div class="filter-content">
            <div class="card-body clearfix">
              <h2 class="text-center">سبد خرید شما</h2>
              <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th class="align-middle">#</th>
                    <th scope="col" class="align-middle">نام محصول</th>
                    <th scope="col" class="align-middle">قیمت</th>
                    <th scope="col" class="align-middle"></th>
                  </tr>
                </thead>

                <tbody id="card-list">
                  @foreach ($carts as $index => $cart)
                    <tr>
                      @if ($cart->course)
                        <td class="align-middle">
                          {{ $index + 1 }}
                        </td>
                        <td class="align-middle">
                          <img src="#" data-src="{{ fromDLHost($cart->course->img) }}" class="lazyload" width="80"
                            alt="{{ $cart->course->title }}" />
                          <h6>{{ $cart->course->title }}</h6>
                          <h6>{{ $cart->course->titleEng }}</h6>
                        </td>
                        <td class="align-middle">{{ nPersian(number_format($cart->course->price)) }} تومان</td>
                      @else
                        <td class="align-middle">
                          {{ $index + 1 }}
                        </td>
                        <td class="align-middle">
                          <img src="#" data-src="{{ fromDLHost($cart->learn_path->img) }}" class="lazyload" width="80"
                            alt="{{ $cart->learn_path->title }}" />
                          <h6>{{ $cart->learn_path->title }}</h6>
                          <h6>{{ $cart->learn_path->titleEng }}</h6>
                        </td>
                        <td class="align-middle">{{ nPersian(number_format($cart->learn_path->price())) }} تومان</td>
                      @endif
                      <td class="align-middle">
                        <button data-id="{{ $cart->item_id }}" class="btn btn-danger cart-remove-btn">حذف از سبد
                        </button>
                      </td>
                    </tr>
                  @endforeach
                  <tr>
                    <td class="align-middle"></td>
                    <td class="align-middle">جمع کل</td>
                    <td class="align-middle">
                      @if (percent_off_for_user() == 1)
                        {{ nPersian(number_format($total_price)) }} تومان
                      @else
                        با {{ (1 - percent_off_for_user()) * 100 }}% تخفیف
                        {{ nPersian(number_format($total_price)) }} تومان
                      @endif
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-danger">حذف همه موارد</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <b> قبل از ادامه، از خاموش بودن فیلترشکن اطمینان حاصل نمایید. </b> <br />
            <a class="btn btn-primary" href="{{ route('payment.send') }}">عملیات پرداخت</a>
            <a class="btn btn-secondary mr-md-2" href={{ route('packages.unlock_courses') }}>استفاده از پکیج</a>
          </div>
        </article>
      </div>
    </div>
  </div>
@endsection
@push('js')

@endpush
