# زرین پال | Zarinpal

Zarinpal library for Laravel

کتابخانه زرین پال برای لاراول

## روش نصب - Installation

Use composer to install this package

برای نصب و استفاده از این پکیج می توانید از کمپوسر استفاده کنید

```bash
composer require pishran/zarinpal
```
## تنظیمات - Configuration

Add your merchant id to .env file

مرچنت کد خود را اضافه کنید

```dotenv
ZARINPAL_MERCHANT_ID=00000000-0000-0000-0000-000000000000
```

To enable sandbox mode

برای فعالسازی حالت تست

```dotenv
ZARINPAL_SANDBOX_ENABLED=true
```

## روش استفاده | How to use

### ارسال مشتری به درگاه پرداخت

```php
$response = zarinpal()
    ->amount(100) // مبلغ تراکنش به تومان
    ->request()
    ->zarin() // فعالسازی زرین گیت - اختیاری
    ->callback('https://domain.com/verification') // آدرس برگشت پس از پرداخت
    ->description('transaction info') // توضیحات تراکنش
    ->email('name@domain.com') // ایمیل مشتری - اختیاری
    ->mobile('09123456789') // شماره موبایل مشتری - اختیاری
    ->send();

if (!$response->success()) {
    return $response->error()->message();
}

// ذخیره اطلاعات در دیتابیس
// $response->authority();

// هدایت مشتری به درگاه پرداخت
return $response->redirect();
```

### بررسی وضعیت تراکنش

```php
$authority = request()->query('Authority'); // دریافت کوئری استرینگ ارسال شده توسط زرین پال

$response = zarinpal()
    ->amount(100)
    ->verification()
    ->authority($authority)
    ->send();

if (!$response->success()) {
    return $response->error()->message();
}

// پرداخت موفقیت آمیز بود
// دریافت شماره پیگیری تراکنش و انجام امور مربوط به دیتابیس
return $response->referenceId();
```
