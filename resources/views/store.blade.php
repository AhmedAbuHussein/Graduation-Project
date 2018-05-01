@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="/css/cardform.css">
@endsection
@section('content')
<div class="container">
    <h2 class="text-muted text-center m-4">بيانات المخازن</h2>

    <div>
        <stores :user="{{Auth::user()}}"></stores>
    </div>

        <div class="text-right mt-3 text-center">
                <a class="btn btn-outline-success add" href="/additem">اضافه <i class="fa fa-plus"></i></a>
                <a class="btn btn-outline-info add" href="">صرف <i class="fa fa-shopping-bag"></i></a>
            </div>
        
    </div>

@endsection