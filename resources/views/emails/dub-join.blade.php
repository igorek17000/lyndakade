<!DOCTYPE html>
<html dir="rtl">

<head>
  <title>{{ 'رزومه‌ی ' . ($gender == 'female' ? 'خانم ' : 'آقای ') . $name }}</title>
</head>

<body>
  <div dir="rtl" style="text-align: right">
    <h1>{{ 'رزومه‌ی ' . ($gender == 'female' ? 'خانم ' : 'آقای ') . $name }}</h1>
    <p>
      نام و نام خانوادگی: {{ $name }}
    </p>
    <p>
      جنسیت: {{ $gender == 'female' ? 'خانم ' : 'آقای ' }}
    </p>
    <p>
      ایمیل: {{ $email }}
    </p>
    <p>
      شماره: {{ $phone }}
    </p>
    <p>
      مهارت‌ها: {{ $skills }}
    </p>
  </div>
</body>

</html>
