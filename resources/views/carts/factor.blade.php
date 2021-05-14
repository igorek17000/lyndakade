@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-12 justify-content-center">
                <div class="row">
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
                            <td>{{$paymentStatus}}</td>
                        </tr>
                        <tr>
                            <td>روش پرداخت</td>
                            <td>{{$paymentMethod}}</td>
                        </tr>
                        <tr>
                            <td>تاریخ</td>
                            <td>{{$date}}</td>
                        </tr>
                        <tr>
                            <td>کل</td>
                            <td>{{$total_price}}</td>
                        </tr>
                        <tr>
                            <td>قیمت</td>
                            <td>{{$total_price}}</td>
                        </tr>
                        <tr>
                            <td>شماره تراکنش بانکی</td>
                            <td>{{$referenceId}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <a class="btn btn-primary" href="{{ route('courses.mycourses') }}">دروس خریداری شده</a>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
