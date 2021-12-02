@extends('layouts.app')
@section('content')
    <div class="container">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <img src="{{ asset('image/404.gif') }}" width="100%" alt="404 not found - یافت نشد">
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                <div class="col-lg-12" style="margin-top: -40px">
                    <h3 class="text-center">صفحه مورد نظر شما یافت نشد!</h3>
                    <h6 class="text-center">چرا یکی از صفحات زیر را انتخاب نمی کنید؟</h6>
                </div>
                <div class="row" style="margin-bottom: 30px">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">
                        <button style="border-radius: 20px;background-color:#fdc840;width: 100px;height: 30px">صفحه اصلی </button>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
@endsection
