<!DOCTYPE html>
<html>

<head>
  <title>مسیر آموزشی درخواست شده، ثبت شده است</title>
</head>

<body>
  <div style="width: 100%;" dir="rtl">
    <h1>مسیر آموزشی درخواست شده ثبت شده است</h1>
    <p>
      کاربر گرامی لیندا کده، درخواست مسیر آموزشی شما با عنوان
      {{ $path->titleEng }}
      بررسی شده، و هم اکنون در وبسایت قرار داده شده است.
      برای ورود به صفحه مسیر
      <a href="{{ route('learn.paths.show', [$path->slug]) }}">اینجا</a>
      کلیک کنید
    </p>
    <h3>
      مشخصات مسیر آموزشی درخواست شده
    </h3>

    <p>عنوان مسیر آموزشی: {{ $path->title }}</p>
    <ul>دوره های این مسیر آموزشی:
      @foreach (js_to_courses($path->_courses) as $course)
      {{-- @foreach (js_to_courses($path->courses) as $course) --}}
        <li>
          <a href="{{ courseURL($course) }}">{{ $course->titleEng }}</a>
        </li>
      @endforeach
    </ul>
    <a href="{{ route('learn.paths.show', [$path->slug]) }}" style="min-width: 50px; background-color: orange;">برو به
      مسیر آموزشی
    </a>
  </div>
</body>

</html>
