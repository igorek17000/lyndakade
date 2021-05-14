<!DOCTYPE html>
<html>

<head>
  <title>New Request For Courses</title>
</head>

<body>
  <h1>New Request For Courses</h1>
  @if ($demand->title && $demand->author)
    <p>Course Title: {{ $demand->title }}</p>
    <p>Course Author: {{ $demand->author }}</p>
  @endif
  @if ($demand->link)
    <p>
      Link: <a href="{{ $demand->link }}">
        {{ $demand->link }}
      </a>
    </p>
  @endif
  <p>Requested by
    <a href="{{ route('voyager.users.show', [$demand->user->id]) }}">
      {{ $demand->user->name }}
    </a>
  </p>
</body>

</html>
