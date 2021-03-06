<!DOCTYPE html>
<html dir="rtl">

<head>
  <title>خرید شما با موفقیت انجام شد.</title>
</head>

<body>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <h1>خرید شما با موفقیت انجام شد.</h1>

  <table class="table table-bordered table-sm col-md-6 col-sm-12">
    <thead>
      <tr>
        <th scope="col">پرداخت</th>
        <th scope="col">{{ $paymentId }}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>وضعیت پرداخت</td>
        <td>{{ $status }}</td>
      </tr>
      <tr>
        <td>روش پرداخت</td>
        <td>{{ $paymentMethod }}</td>
      </tr>
      <tr>
        <td>تاریخ</td>
        <td>{{ $date }}</td>
      </tr>
      <tr>
        <td>قیمت کل</td>
        <td>{{ $amount }}</td>
      </tr>
      <tr>
        <td>شماره تراکنش بانکی</td>
        <td>{{ $factorId }}</td>
      </tr>
    </tbody>
  </table>

  @if (count($courses) > 0)
    <h5>دوره های خریداری شده</h5>
    <ul>
      @foreach ($courses as $course)
        <li>
          <a href="{{ route('courses.show.linkedin', $course->slug_linkedin) }}">
            {{ $course->title }} - {{ $course->titleEng }}
          </a>
        </li>
      @endforeach
    </ul>
  @endif
  @if (count($paths) > 0)
    <h5>مسیر های خریداری شده</h5>
    <ul>
      @foreach ($paths as $path)
        <li>
          <a href="{{ route('learn.paths.show', $path->slug) }}">
            {{ $path->title }} - {{ $path->titleEng }}
          </a>
        </li>
      @endforeach
    </ul>
  @endif

  <div class="card-body clearfix">
    <h2 class="text-center">تخفیفات براساس میزان خرید</h2>
    <table class="table table-bordered  text-center">
      <thead>
        <tr>
          <th scope="col" class="align-middle">سطح</th>
          <th scope="col" class="align-middle">مجموع خرید</th>
          <th scope="col" class="align-middle">درصد تخفیف (برای تمامی خریدها)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row" class="align-middle">1</th>
          <td class="align-middle">بین {{ nPersian(number_format(200000)) }} تا
            {{ nPersian(number_format(400000 - 1000)) }}
            تومان
          </td>
          <td class="align-middle">{{ nPersian(number_format(5)) }}%</td>
        </tr>
        <tr>
          <th scope="row" class="align-middle">2</th>
          <td class="align-middle">بین {{ nPersian(number_format(400000)) }} تا
            {{ nPersian(number_format(600000 - 1000)) }}
            تومان
          </td>
          <td class="align-middle">{{ nPersian(number_format(10)) }}%</td>
        </tr>
        <tr>
          <th scope="row" class="align-middle">3</th>
          <td class="align-middle">بین {{ nPersian(number_format(600000)) }} تا
            {{ nPersian(number_format(800000 - 1000)) }}
            تومان
          </td>
          <td class="align-middle">{{ nPersian(number_format(15)) }}%</td>
        </tr>
        <tr>
          <th scope="row" class="align-middle">4</th>
          <td class="align-middle">بین {{ nPersian(number_format(800000)) }} تا
            {{ nPersian(number_format(1000000 - 1000)) }}
            تومان
          </td>
          <td class="align-middle">{{ nPersian(number_format(20)) }}%</td>
        </tr>
        <tr>
          <th scope="row" class="align-middle">5</th>
          <td class="align-middle">{{ nPersian(number_format(1000000)) }} تومان به بالا</td>
          <td class="align-middle">{{ nPersian(number_format(25)) }}%</td>
        </tr>
        <tr>
          @if (check_user_level_up() < 5)
            <th colspan="12" class="align-middle"> مجموع خرید شما
              <b>{{ nPersian(
    number_format(
        auth()->user()->paids->sum('price'),
    ),
) }}</b>
              میباشد و به
              <b>{{ nPersian(number_format(left_to_next_level())) }}</b> نیاز دارید به سطح
              <b>{{ nPersian(check_user_level_up() + 1) }}</b> برسید
            </th>
          @else
            <th colspan="12" class="align-middle">شما هم اکنون در سطح آخر قرار دارید و در هر خرید {{ nPersian(25) }}%
              تخفیف خواهید
              داشت.</th>
          @endif
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
