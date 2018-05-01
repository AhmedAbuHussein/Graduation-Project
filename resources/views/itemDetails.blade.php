@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="/css/cardform.css">
@endsection
@section('content')

<div class="container">
    <itemdetails itemid="{{$itemid}}"></itemdetails>
</div>

@endsection