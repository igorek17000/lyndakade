<!DOCTYPE html>
<html dir="rtl">

<head>
  <title>خرید شما با موفقیت انجام شد.</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>
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

</body>

</html>
