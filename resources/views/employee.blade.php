@extends('layouts.app')
@section('content')
<div class="container">
	<h2 class="text-center mt-4 mb-2">اصحاب العٌهد</h2>
	@if(empty($empty))
	<employee :role="{{Auth::user()->role}}"></employee>
	@else
	<h3 class="text-center">{{$empty}}</h3>
	@endif
</div>
@endsection
