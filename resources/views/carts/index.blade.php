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
    <div class="row my-3">
      <div class="col-12 justify-content-center">
        <div class="row">
          <table class="table table-bordered table-sm col-md-6 col-sm-12">
            <thead class="thead-dark">
              <tr>
                <th></th>
                <th scope="col">نام محصول</th>
                <th scope="col">قیمت</th>
                <th scope="col"></th>
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
                    <td>{{ $cart->learn_path->price }}</td>
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
                <td>{{ $total_price }}</td>
                <td>
                  <button class="btn btn-danger">حذف همه موارد</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <a class="btn btn-primary" href="{{ route('payment.send') }}">عملیات پرداخت</a>
        <b> قبل از ادامه، از خاموش بودن فیلترشکن اطمینان حاصل نمایید. </b>
      </div>
    </div>
  </div>
@endsection
@push('js')

@endpush
