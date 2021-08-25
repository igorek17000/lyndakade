<!DOCTYPE html>
<html>

<head>
  <title>خرید پکیج با موفقیت انجام شد.</title>
</head>

<body>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  <div dir="rtl" style="text-align: right; font-size:1.3em;">
    <h1>خرید پکیج با موفقیت انجام شد.</h1>

    <p>
      پکیج {{ nPersian($package->days) }} روزه برای شما
      از تاریخ
      @php
        $d = date('Y/m/d', strtotime($start_date));
        $d = explode('/', $d);
        echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/')) . ' ' . nPersian(date('H:i:s', strtotime($start_date)));
      @endphp
      تا تاریخ
      @php
        $d = date('Y/m/d', strtotime($end_date));
        $d = explode('/', $d);
        echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/')) . ' ' . nPersian(date('H:i:s', strtotime($end_date)));
      @endphp
      فعال میباشد. با استفاده از این پکیج میتوانید به تعداد
      {{ nPersian($package->count) }}
      دوره آموزشی را بصورت رایگان باز و دانلود کنید.
    </p>
    <h4>
      توجه داشته باشید در صورت پایان زمان پکیج، تعداد دوره آموزشی آن به پکیج خریداری شده ی بعدی تعلق <b>نخواهد</b> گرفت.
    </h4>

    <h5>عنوان پکیج: {{ $package->title }}</h5>
    <p>{{ nPersian($package->days) }} روزه</p>
    <p>{{ nPersian($package->count) }} دوره آموزشی</p>

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
  </div>
</body>

</html>
