@extends('layouts.app')
@section('style')
<style>
    .card-body{
        background:#f3f3f3;
    }
    .ui-menu .ui-menu-item{
        text-align: right;
    }
</style>
@endsection

@section('content')

<div class="container">
    <div class="card mt-2 ml-auto mr-auto d-flex">
        <div class="card-heading p-2 text-right bg-info text-white font-weight-bold">اضافه عنصر جديد</div>
        <div class="card-body pb-0">
           <form action="/additem" method="POST" class="form-horizontal text-right" style="direction:rtl;">
                @csrf
                <div class="form-group row pl-3 pr-3">
                    <label for="product" class="control-label col-md-2 order-0">اسم المنتج</label>
                    <input id="product" name="product" type="text" class="form-control order-1 col-md-10" required placeholder="اسم المنتج">
                </div>

                <div class="form-group row pl-3 pr-3">
                    <label  for="source" class="control-label col-md-2 order-0">المصدر</label>
                    <input id="source" name="source" type="text" class="form-control order-1 col-md-10" required placeholder="المصدر">
                </div>

                <div class="form-group row pl-3 pr-3">
                    <label for="quantity" class="control-label col-md-2 order-0">الكميه</label>
                    <input id="quantity" name="quantity" type="text" class="form-control order-1 col-md-10" required placeholder="الكميه">
                </div>
                
                <div class="form-group row pl-3 pr-3">
                    <label for="price" class="control-label col-md-2 order-0">سعر القطعه</label>
                    <input id="price" name="price" type="text" class="form-control order-1 col-md-10" required placeholder="سعر القطعه ">
                </div>

                <div class="form-group row pl-3 pr-3">
                    <label  for="permision" class="control-label col-md-2 order-0">اذن التوريد</label>
                    <input id="permision" name="permision" type="text" class="form-control order-1 col-md-10" required placeholder="اذن التوريد">
                </div>

                
                <div class="form-group row pl-3 pr-3">
                    <label  for="store_id" class="control-label col-md-2 order-0">المخزن</label>
                    @if(Auth::user()->role == 0)
                    <select id="store_id" name="store_id" class="form-control order-1 col-md-10 " required>
                        <option value="">اختار المخزن</option>
                        @foreach ($stores as $store)
                            <option value="{{$store->id}}" >{{$store->name}}</option>
                        @endforeach
                    </select>
                    @else
                    <select id="store_id" name="store_id" class="form-control order-1 col-md-10 "  required>
                        @foreach ($stores as $store)
                            @if(Auth::user()->store_id == $store->id)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @break
                            @endif
                        @endforeach
                    </select>

                    @endif
                </div>
                

                <div class="form-group row justify-content-end pl-3 pr-3">
                    
                    <button  type="submit" class="btn btn-outline-primary  col-md-10">حفظ</button>
                </div>

           </form>

           
           @if(!empty($errors))

           @foreach ($errors as $error)
               <div class="alert alert-warning">{{$error}}</div>
           @endforeach

           @endif

        </div>
    </div>

</div>

@endsection
@section('script')

<script>
    
$(function(){
    var id = $("#store_id").val();
    $.get('/itemsname?id='+id,function(res){
        availableTags=[];
        for(i=0;i<JSON.parse(res).length;i++){
            availableTags[i] = JSON.parse(res)[i].name;
        }
        $("#product").autocomplete({
            source: availableTags
        });
    });
    $("#store_id").change(function(){
        id = $(this).val();
        $.get('/itemsname?id='+id,function(res){
            availableTags=[];
            for(i=0;i<JSON.parse(res).length;i++){
                availableTags[i] = JSON.parse(res)[i].name;
            }
            $("#product").autocomplete({
                source: availableTags
            });
        });

    });
   
});
</script>

@endsection