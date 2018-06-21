@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="/css/cardform.css">
@endsection
@section('content')

<div class="container">
    <itemadd itemid="{{$itemid}}"></itemadd>
    <itemcov itemid="{{$itemid}}"></itemcov>
</div>

@endsection