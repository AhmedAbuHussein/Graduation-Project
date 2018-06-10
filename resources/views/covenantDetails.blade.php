@extends('layouts.app')
@section('content') 

<div class="container">
    <h4 class="text-right mr-3 my-3"><bdi>صاحب العهده : <small>{{$owner->name}}</small></bdi></h4>
    <h4 class="text-right mr-3 mb-3"><bdi>البريد الالكتروني : <small>{{$owner->email}}</small></bdi></h4>
    <h4 class="text-right mr-3 mb-3"><bdi>الهاتف الجوال  : <small>{{$owner->phone}}</small></bdi></h4>
    <covenant :userid="{{$owner->id}}" class="mt-2"></covenant>
</div>

@endsection
@section('style')
<style>
    h4 small{
        color: #2c1e7d;
    }
</style>
@endsection