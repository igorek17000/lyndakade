@extends('errors::illustrated-layout')

@section('title', env('APP_NAME') . ' - '. __('در حال تعمیر'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'متاسفانه سایت در حال تعمیر است، لطفا بعدا دوباره تلاش کنید.'))
