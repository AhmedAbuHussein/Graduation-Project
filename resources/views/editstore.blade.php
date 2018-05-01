@extends('layouts.app')
@section('style')
<style>

    form,input{
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@section('content')

<div class="container">

    <h2 class="text-center text-muted m-4">تعديل البيانات</h2>
   <div class="row justify-content-center">
       <div class="col-md-8">

            <form action="{{url('/edit')}}" id="updateForm" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <input type="hidden" name="itemid" id="id" value=" {{$item->id}}" />
                <div class="form-group row">
                    <label class="control-label col-md-3">مصدر التوريد</label>
                    <input type="text" name="" value="{{$item->source}}"  class="form-control col-md-9" placeholder="مصدر التوريد"> 
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">سعر القطعه</label>
                    <input type="text" name="" value="{{$item->price}}"  class="form-control col-md-9" placeholder="سعر القطعه"> 
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">الكميه المورده</label>
                    <input type="text" name="" value="{{$item->quantity}}"  class="form-control col-md-9" placeholder="الكميه المورده"> 
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">الكميه الكليه بالمخزن</label>
                    <input type="text" name="" value="{{$item->datastore->quantity}}" readonly class="form-control col-md-9" placeholder="الكميه المورده"> 
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">الكميه التي تم صرفها</label>
                    <input type="text" name="" value="{{$item->datastore->quantity}}" readonly  class="form-control col-md-9" placeholder="الكميه المورده"> 
                </div>
                
                <div class="form-group row">
                        <label class="control-label col-md-3">اسم الصنف</label>
                        <input type="text" name="" value="{{$item->datastore->name}}"  class="form-control col-md-9" readonly placeholder="اذن التوريد"> 
                    </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">اذن التوريد</label>
                    <input type="text" name="" value="{{$item->permision}}"  class="form-control col-md-9" readonly placeholder="اذن التوريد"> 
                </div>
                <div class="form-group row justify-content-end">
                        <button type="submit" class="btn btn-outline-primary btn-block col-md-9">حفظ <i class="fa fa-save"></i></button>
                    
                </div>


            </form>
       </div>
   </div>

</div>

@endsection