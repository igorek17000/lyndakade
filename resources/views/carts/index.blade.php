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
              <h2 class="text-center">لیست دوره های خریداری شده</h2>
              <table class="table table-bordered table-sm text-center">
                <thead>
                  <tr>
                    <th scope="col">سطح</th>
                    <th scope="col">مجموع خرید</th>
                    <th scope="col">درصد تخفیف (برای تمامی خریدها)</th>
                  </tr>
                </thead>

                <tbody id="card-list">
                  @foreach ($carts as $cart)
                    <tr>
                      @if ($cart->course)
                        <td>
                          <img src="#" data-src="{{ fromDLHost($cart->course->img) }}" class="lazyload" width="50"
                            height="50" alt="" />
                        </td>
                        <td>{{ $cart->course->title }}</td>
                        <td>{{ $cart->course->price }}</td>
                      @else
                        <td>
                          <img src="#" data-src="{{ fromDLHost($cart->learn_path->img) }}" class="lazyload" width="50"
                            height="50" alt="" />
                        </td>
                        <td>{{ $cart->learn_path->title }}</td>
                        <td>{{ $cart->learn_path->price() }}</td>
                      @endif
                      <td>
                        <button data-id="{{ $cart->item_id }}" class="btn btn-danger cart-remove-btn">حذف از سبد
                        </button>
                      </td>
                    </tr>
                  @endforeach
                  <tr>
                    <td></td>
                    <td>جمع کل</td>
                    <td>
                      @if (percent_off_for_user() == 1)
                        {{ $total_price }}
                      @else
                        با {{ (1 - percent_off_for_user()) * 100 }}% تخفیف {{ $total_price }}
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-danger">حذف همه موارد</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-primary" href="{{ route('payment.send') }}">عملیات پرداخت</a>
            <b> قبل از ادامه، از خاموش بودن فیلترشکن اطمینان حاصل نمایید. </b>
          </div>
        </article>
      </div>
    </div>
  </div>
@endsection
@push('js')

@endpush
