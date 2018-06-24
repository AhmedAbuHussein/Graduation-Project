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

            <form action="{{url('/edit')}}" id="updateForm" method="POST"  class="form-horizontal">
                @csrf
                <input type="hidden" name="itemid" id="id" value=" {{$item->id}}" /> 
                <input type="hidden" name="store_id" value="{{$item->datastore->store_id}}" />
                <div class="form-group row">
                    <label class="control-label col-md-3">مصدر التوريد</label>
                    <input type="text" name="source" value="{{$item->source}}"  class="form-control col-md-9" placeholder="مصدر التوريد"> 
                </div>
               
                <div class="form-group row">
                    <label class="control-label col-md-3">الكميه المورده</label>
                    <input type="number" min="0.5" step="0.01" id="quantity" name="quantity" value="{{$item->quantity}}"  class="form-control col-md-9" placeholder="الكميه المورده"> 
                </div>
                <div class="form-group row">
                        <label class="control-label col-md-3">سعر القطعه</label>
                        <input type="number" min="0.01" step="0.01" name="price" value="{{$item->price}}"  class="form-control col-md-9" placeholder="سعر القطعه"> 
                    </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">الكميه الكليه بالمخزن</label>
                    <input type="text" name="total" value="{{$item->datastore->quantity}}" readonly class="form-control col-md-9" placeholder="الكميه المورده"> 
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">الكميه التي تم صرفها</label>
                    <input type="text" name="cov" value="{{$cov}}" readonly  class="form-control col-md-9" placeholder="الكميه المورده"> 
                </div>
                
                <div class="form-group row">
                        <label class="control-label col-md-3">اسم الصنف</label>
                        <input type="text" name="name" value="{{$item->datastore->name}}"  class="form-control col-md-9" readonly placeholder="اذن التوريد"> 
                    </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">اذن التوريد</label>
                    <input type="text" name="permision" value="{{$item->permision}}"  class="form-control col-md-9" readonly placeholder="اذن التوريد"> 
                </div>
                <div class="form-group row justify-content-end">
                    <button type="submit" class="btn btn-outline-primary btn-block col-md-9">حفظ <i class="fa fa-save"></i></button>
                    
                </div>


            </form>
       </div>
   </div>

</div>

@endsection

@section('topscript')
<script src="/js/sweetalert.js"></script>
@endsection

@section('script')
<script>
    msg = '';
    icon = '';
    if(window.location.hash == '#edit-save-owner'){
        msg = 'تم الحفظ بنجاح';
        icon = 'success';
    }else if(window.location.hash == '#edit-save'){
        msg = 'تم الحفظ وفي انتظار موافقه امين المخزن';
        icon = 'success';
    }else if(window.location.hash == '#edit-not-save'){
        msg = "حدث خطأ اثناء الحفظ!!";
        icon = 'error';
    }
    if(msg != ""){
        swal({
            'text': msg,
            'icon':icon,
        });
    }

    var check;
$(function(){

    $('#quantity').on('change',function(){
        data = $('#updateForm').serialize();
        $.get('/checkQuantity?'+data,function(res){
            check = res;
        });
    });

    $('#updateForm').submit(function(e){
        
       if(check == "error"){
            e.preventDefault();
            swal({
                text: "الكميه الكليه المتاحه اقل من الكميه الموزعه",
                title: "تحذير",
                icon: "warning",
            });
       }
        
    });
});

</script>
@endsection