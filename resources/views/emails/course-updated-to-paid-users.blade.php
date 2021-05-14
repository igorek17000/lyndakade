<!DOCTYPE html>
<html>

<head>
  <title>دوره آموزشی خریداری شده، بروزرسانی شده است</title>
</head>

<body>
  <div style="width: 100%;" dir="rtl">
    <h1>دوره آموزشی خریداری شده بروزرسانی شده است</h1>
    <p>
      کاربر گرامی لیندا کده، دوره آموزشی که شما قبلا خریداری نموده اید، با عنوان
      {{ $course->titleEng }}
      بروزرسانی شده است و هم اکنون میتوانید از طریق لینک زیر به بخش دانلود بروید.
      <a href="{{ courseURL($course) }}">اینجا کلیک کن</a>
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
