@extends('layouts.app')
@section('style')
<style>
    div.list>div:nth-child(even){
        background: #f3f3f3;
    }
</style>
@endsection
@section('content')

<div class="container" style="direction:rtl; text-align:right;">
    <div class="row mt-5">
        <div class="col-sm-6">
            <h3 class="text-center">البيانات قبل التعديل</h3>
            <hr>

            <div class="card">
                    <div class="card-body py-0">
                        <div class="list">
                            <div class="row">
                                <div class="col-4 py-2 border-bottom">اسم العنصر</div>
                                <div class="col-8 py-2 border-bottom">{{$additem->datastore->name}}</div>
                            </div>
                            <div class="row">
    
                                <div class="col-4 py-2 border-bottom">المصدر</div>
                                <div class="col-8 py-2 border-bottom">{{$additem->source}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 py-2 border-bottom">الكميه</div>
                                <div class="col-8 py-2 border-bottom">{{$additem->quantity}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 py-2 border-bottom">السعر</div>
                                <div class="col-8 py-2 border-bottom">{{$additem->price}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 py-2 ">اذن الصرف</div>
                                <div class="col-8 py-2 ">{{$edititem->permision}}</div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            
        </div>
        <div class="col-sm-6">
            <h3 class="text-center">البيانات التي تم التعديل عليها</h3>
            <hr>
            <div class="card">
                    <div class="card-body py-0">
                        <div class="list">
                            <div class="row">
                                <div class="col-4 py-2 border-bottom">اسم العنصر</div>
                                <div class="col-8 py-2 border-bottom">{{$edititem->additem->datastore->name}}</div>
                            </div>
                            <div class="row">
    
                                <div class="col-4 py-2 border-bottom">المصدر</div>
                                <div class="col-8 py-2 border-bottom">{{$edititem->source}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 py-2 border-bottom">الكميه</div>
                                <div class="col-8 py-2 border-bottom">{{$edititem->quantity}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 py-2 border-bottom">السعر</div>
                                <div class="col-8 py-2 border-bottom">{{$edititem->price}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 py-2 ">اذن الصرف</div>
                                <div class="col-8 py-2 ">{{$edititem->permision}}</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
    <div class="text-center mt-3">
        <a class="btn btn-outline-danger" role="button" href="/cancalEdit?notify={{$notify}}">الغاء <i class="fa fa-close"></i></a>
        <a class="btn btn-outline-success" role="button" href="/saveEdit?notify={{$notify}}&id={{$edititem->id}}">حفظ <i class="fa fa-save"></i></a>
    </div>
    


</div>

@endsection