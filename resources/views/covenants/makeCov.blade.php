@extends('layouts.app')
@section('style')
<style>

    label{
        direction: rtl;
    }
    h3{
        direction: rtl;
        font-family: Arial, Helvetica, sans-serif;
    }
    h3 span{
        opacity: 0.5;
        padding-bottom: 0.5rem;
        display: inline-block;
        cursor: pointer;
    }
    h3 span.run{
        color: #f23;
        opacity: 1;
        border-bottom: .1rem solid #f27;
    }
    .covenant{
        display: none;
    }
    .running{
        width: 60%;
        margin: auto;
    }
</style>
@endsection
@section('content')

<div class="container">
    <h3 class="text-center mt-4"><span class="run" data-class="employee">تسجيل صاحب عهده</span> | <span data-class="covenant"> تسجيل عهده جديده</span></h3>
    <div id="employee" class="employee running">
        <form id="empForm" method="POST" action="/new-employee" style="direction:rtl; text-align:right;">
            @csrf
            <div class="form-group">
                <label>صاحب العهده</label>
                <input type="text" placeholder="اسم صاحب العهده" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>الرقم القومي</label>
                <input type="number" id="ssn" placeholder="الرقم القومي" name="ssn" required title="أدخل 14 رقم" class="form-control">
            </div>
            <div class="form-group">
                <label>رقم الهاتف</label>
                <input type="number" placeholder="رقم الهاتف" id="phone" name="phone" required class="form-control">
            </div>
            <div class="form-group">
                <label>البريد الالكتروني</label>
                <input type="email" placeholder="البريد الالكتروني" required name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>المؤسسه</label>
                <input type="text" placeholder="المؤسسه" name="establishment" required class="form-control">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-outline-success btn-block" value="حفظ">
            </div>
        </form>
    </div>
    <!-- this is the covenant div contant -->
    <div id="covenant" class="covenant running">
        <form id="covForm" method="POST" action="/new-covenant" style="direction:rtl; text-align:right">
            @csrf
            <div class="form-group">
                <label class="control-label">الصنف</label>
                <select class="form-control" name="datastore" id="datastore" required>
                    <option value="">اختار الصنف</option> 
                    @foreach ($datastores as $data)
                    <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                </select> 
            </div>
            <div class="form-group">
                <label class="control-label">الكميه</label>
                <input type="number" min="0.01" step="0.1" id="quantity" placeholder="الكميه" class="form-control" required name="quantity"> 
            </div>
            <div class="form-group">
                <label class="control-label">اذن الصرف</label>
                <input type="text" id="permision"placeholder="اذن الصرف" class="form-control" required name="permision">
            </div>
            <div class="form-group">
                <label class="control-label">صاحب العهده</label>
                <select class="form-control" name="employee" required>
                    <option value="">اختار صاحب العهده</option>
                    @foreach ($emps as $emp)
                    <option value="{{$emp->id}}">{{$emp->name}}</option>
                    @endforeach
                </select>
            </div>

            <input class="btn btn-block btn-outline-success" value="حفظ" type="submit">

        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    var ssn = false,phone = false,permision = false, qunat = false;
    $('h3 span').click(function(){
        $(this).addClass('run').siblings('span').removeClass('run');
        $(this).parent().siblings('.running').hide();
        $('#'+$(this).data('class')).show(700);
    });

        if(window.location.hash == "#covenant"){
            $('h3 span').each(function(){
                if($(this).data('class') == "covenant"){
                    $(this).addClass('run');
                }else{
                    $(this).removeClass('run');
                }
            });
            $('div.running').hide();
            $('#covenant').show(700);
            swal({
                'text':' تم حفظ صاحب العهده بنجاح ابدء في تسجيل العهده',
                'icon':'success',
            });
        }else if(window.location.hash == "#emp-error"){

            swal({
                'text':'حدث خطأ اثناء حفظ صاحب العهده حاول مره اخري',
                'icon':'error',
            });

        }else if(window.location.hash == "#cov-error"){

            swal({
                'text':'حدث خطأ اثناء حفظ العهده حاول مره اخري',
                'icon':'error',
            });

        }



    $('#ssn').blur(function(){
        if($(this).val().length != 14){
            $(this).css('border','1px solid red');
            ssn = false;
        }else{
            $(this).css('border','1px solid green');
            ssn = true;
        }
    });

    $('#phone').blur(function(){
        if($(this).val().length < 10 || $(this).val().length >11){
            $(this).css('border','1px solid red');
            phone = false;
        }else{
            $(this).css('border','1px solid green');
            phone= true;
        }
    });
    $('#empForm').submit(function(e){
        if(ssn == false || phone == false){
            e.preventDefault();
        }
    });


    $('#quantity').blur(function(){
        quantity = $(this).val();
        app = $(this);
        txt = $('#datastore').val();
        $.get('/check-quantity?id='+txt,function(res){
            if(quantity > res){
                app.css('border','1px solid red');
                app.attr('title','هذه الكميه اكبر من الكميه المتاحه بالمخزن');
                qunat = false;
            }else{
                app.css('border','1px solid green');
                app.attr('title','');
                qunat = true;
                
            }
        });
    });

    $('#permision').blur(function(){
        per = $(this).val();
        app = $(this);
        $.get('/check-permision?per='+per,function(res){
            console.log(res);
            if(res == 'error'){
                app.css('border','1px solid red');
                app.attr('title','هذا الاذن تم استخدامه بالفعل');
                permision = false;
            }else{
                app.css('border','1px solid green');
                app.attr('title','');
                permision = true;
            }
        });
    });

    $('#covForm').submit(function(e){
        if(qunat == false || permision == false){
            e.preventDefault();
        }
    })

</script>
@endsection