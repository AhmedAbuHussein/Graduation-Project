@extends('layouts.header')
@section('content')
<div class="container">
	<h2 class="text-center">اصحاب العٌهد</h2>
	@if(empty($empty))
	<div class="panel panel-primary table-panel">
		<div class="panel-heading form-parent"><i class="fa fa-chevron-left"></i>
			<form class="form-inline" id="searchData" method="POST" enctype="multipart/form-data">
				@csrf
				<input class="form-control" id="searchinput" type="search" name="search" placeholder="بحث باسم الصنف" />
			</form>
		</div>
		<div class="panel-body mytable" id="table-container">

			<table class="table table-responsive table-striped">
				<tr>
					<th class="text-center">التسلسل</th>
					<th class="text-center">الاسم</th>
					<th class="text-center">الرقم القومي</th>
					<th class="text-center">البريد الاليكتروني</th>
					<th class="text-center">المؤسسه</th>
					<th class="text-center">التحكم</th>
				</tr>
                @foreach($items as $item)
				<tr>
					<td>{{$item->id}}</td>
					<td><a href="{{url('/profile?id=').$item->id}}">{{$item->name}}</a></td>
					<td>{{$item->ssn}}</td>
					<td>{{$item->email}}</td>
                    <td>{{$item->establishment}}</td>
                    
                    <td><button class="btn btn-sm btn-success">تعديل <i class="fa fa-edit"></i></button></td>
                    <td><button class="btn btn-sm btn-danger">حذف <i class="fa fa-close"></i></button></td>
                    
                </tr>
                @endforeach
			</table>
		</div>
	</div>
	@else

	<h3 class="text-center">{{$empty}}</h3>

	@endif
</div>
@endsection
