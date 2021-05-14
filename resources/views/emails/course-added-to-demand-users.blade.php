<!DOCTYPE html>
<html>

<head>
  <title>دوره آموزشی درخواست شده، ثبت شده است</title>
</head>

<body>
  <div style="width: 100%;" dir="rtl">
    <h1>دوره آموزشی درخواست شده ثبت شده است</h1>
    <p>
      کاربر گرامی لیندا کده، درخواست دوره آموزشی شما با عنوان
      {{ $course->titleEng }}
      بررسی شده، و دوره مورد نظر هم اکنون در وبسایت قرار داده شده است.
      برای ورود به صفحه دوره
      <a href="{{ courseURL($course) }}">اینجا</a>
      کلیک کنید
    </p>
    <h3>
      مشخصات دوره درخواست شده
    </h3>

    <p>عنوان دوره: {{ $course->title }}</p>
    <ul>مدرس دوره:
      @foreach ($course->authors as $author)
        <li>
          {{ $author->name }}
        </li>
      @endforeach
    </ul>
    <a href="{{ courseURL($course) }}" style="min-width: 50px; background-color: orange;">برو به دوره</a>
  </div>
</body>

</html>
