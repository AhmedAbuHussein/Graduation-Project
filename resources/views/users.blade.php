@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="/css/cardform.css">
@endsection

@section('content')
@csrf
<div class="container">
    <h2 class="text-center mt-3 mb-3">بيانات المستخدمين</h2>
    <users :userrole="{{Auth::user()->role}}"></users>
    <div class="text-right pt-4 after-panel">
        @if(Auth::user()->role == 0)
        <a class="btn btn-success" role="button" href="/register">اضافه موظف <i class="fa fa-plus"></i></a>
        @endif
    </div>
</div>
    
@endsection  

@section('topscript')
<script src="/js/sweetalert.js"></script>
@endsection