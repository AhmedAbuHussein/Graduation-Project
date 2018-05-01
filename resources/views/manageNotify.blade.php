@extends('layouts.header')

@section('content')

<div class="container">
    <h2 class="text-center">اشعارات مخزن <span>{{$original->store_name}}</span></h2>
    <div class="panel panel-primary">
        <div class="panel-heading">البيانات</div>
        <div class="panel-body">
            <div class="row">

                <div class="col-md-6 col-md-push-6">
                    <h3 class="text-center">البيانات قبل التعديل</h3>
                    <ul class="list-unstyled list-notify">
                        <li><bdi>اسم الصنف</bdi><span>{{$original->name}}</span></li>
                        <li><bdi>المصدر</bdi><span>{{$original->source}}</span></li>
                        <li><bdi>الكميه</bdi><span>{{$original->quant}}</span></li>
                        <li><bdi>السعر</bdi><span>{{$original->price}}</span></li>
                        <li><bdi>الاجمالي</bdi><span>{{$original->total}}</span></li>
                        <li><bdi>اذن الصرف</bdi><span>{{$original->permision}}</span></li>
                    </ul>
                </div>
                <div class="col-md-6 col-md-pull-6">
                    <h3 class="text-center">البيانات بعد التعديل</h3>
                    <ul class="list-unstyled list-notify">
                            <li><bdi>اسم الصنف</bdi><span>{{$history->name}}</span></li>
                            <li><bdi>المصدر</bdi><span>{{$history->source}}</span></li>
                            <li><bdi>الكميه</bdi><span>{{$history->quantity}}</span></li>
                            <li><bdi>السعر</bdi><span>{{$history->price}}</span></li>
                            <li><bdi>الاجمالي</bdi><span>{{$history->total}}</span></li>
                            <li><bdi>اذن الصرف</bdi><span>{{$history->permision}}</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    @if(Auth::user()->store_id == $original->store_id && Auth::user()->jop_id < 2)
    <div class="text-center">
        <a class="btn btn-danger confirm" data-class="التعديل" href="#" onclick="
        event.preventDefault();
        document.getElementById('cancel').submit();
        ">الغاء التعديل</a>
        <form class="form-inline" id="cancel" action="/editaction" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="action" value="cancel">
            <input type="hidden" name="history_id" value="{{$history->id}}">
        </form>

        <a class="btn btn-primary" href="#" onclick="
            event.preventDefault();
            document.getElementById('save').submit();
        ">حفظ التعديل</a>
        <form class="form-inline" id="save" action="/editaction" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="history_id" value="{{$history->id}}">
        </form>
    </div>
    @else
    <div class="text-center alert alert-danger">
        انتظار موافقه امين المخزن علي هذا التعديل
    </div>
    @endif
</div>

@endsection