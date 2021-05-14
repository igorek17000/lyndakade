<!DOCTYPE html>
<html>

<head>
  <title>درخواست دوره آموزشی در وبسایت LyndaKade.ir</title>
</head>

<body>
  <h1>درخواست دوره آموزشی در وبسایت <a href="https://LyndaKade.ir">LyndaKade.ir</a></h1>
  <p>
    کاربر گرامی لیندا کده، درخواست شما ثبت شده است و در سریعترین زمان ممکن بررسی میشود. در صورت ثبت دوره، به اطلاع شما
    میرسانیم.
  </p>
  <h3>
    مشخصات دوره درخواست شده
  </h3>

  @if ($demand->title && $demand->author)
    <p>عنوان دوره: {{ $demand->title }}</p>
    <p>مدرس دوره: {{ $demand->author }}</p>
  @endif
  @if ($demand->link)
    <p>
      لینک: <a href="{{ $demand->link }}">
        {{ $demand->link }}
      </a>
    </p>
  @endif
</body>

</html>
