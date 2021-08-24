@if (count(Auth::user()->carts) > 0)
  <table id="dtHorizontalVerticalExample" class="table table-dark table-bordered table-sm">
    <caption><a href="{{ route('cart.index') }}" style="color: white;">مشاهده سبد خرید</a></caption>
    <thead class="thead-dark">
      <tr>
        <th></th>
        <th scope="col">نام محصول</th>
        <th scope="col">قیمت</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody id="card-list">
      @foreach (Auth::user()->carts as $cart)
        <tr>
          @if ($cart->course)
            <td>
              <img src="#" data-src="{{ fromDLHost($cart->course->img) }}" class="lazyload" width="50" height="50"
                alt="" />
            </td>
            <td>
              <span>{{ $cart->course->title }}</span>
            </td>
            <td>{{ nPersian(number_format($cart->course->price)) }}</td>
          @else
            <td>
              <img src="#" data-src="{{ fromDLHost($cart->learn_path->img) }}" class="lazyload" width="50" height="50"
                alt="" />
            </td>
            <td>
              <span>{{ $cart->learn_path->title }}</span>
            </td>
            <td>{{ nPersian(number_format($cart->learn_path->price())) }}</td>
          @endif
          <td>
            <button data-id="{{ $cart->item_id }}" class="btn btn-danger cart-remove-btn">حذف از سبد
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <span class="px-2">سبد خرید شما خالی میباشد.</span>
@endif
