@extends('layouts.app')
@section('style')
    {{--you can write your style her--}} 
    <style>
        .dir{
            direction: rtl;
        }
        #store{
            display: none;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="card mb-0 pb-0 mt-0">
        <div class="card-header bg-light text-right">تسجيل موظف جديد</div>
        <div class="card-body">

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="mt-1">
                <div class="row text-center justify-content-center">
                            
                    @csrf
                    <div class="col-md-8 order-1">

                        <div class="form-group row">
                                <label for="fullname" class="col-md-3 order-1 col-form-label text-md-right">الاسم الكلي</label>

                                <div class="col-md-9 order-0">
                                    <input id="fullname" type="text" class="dir form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ old('fullname') }}" required autofocus>

                                    @if ($errors->has('fullname'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('fullname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                        <div class="form-group row">
                            <label for="username" class="col-md-3 order-1 col-form-label text-md-right">اسم المستخدم</label>

                            <div class="col-md-9 order-0">
                                <input id="username" type="text" class="dir form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="email" class="col-md-3 order-1 col-form-label text-md-right">البريد الالكتروني</label>

                            <div class="col-md-9 order-0">
                                <input id="email" type="email" class="dir form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 order-1 col-form-label text-md-right">كلمه المرور</label>

                            <div class="col-md-9 order-0">
                                <input id="password" type="password" class="dir form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 order-1 col-form-label text-md-right">تاكيد كلمه المرور</label>

                            <div class="col-md-9 order-0">
                                <input id="password-confirm" type="password" class="dir form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="job_name" class="col-md-3 order-1 col-form-label text-md-right">الوظيفه</label>

                            <div class="col-md-9 order-0">
                                <select id="job_name" class="dir form-control{{ $errors->has('job_name') ? ' is-invalid' : '' }} dir" name="job_name" required>
                                    <option value="">اختار الوظيفه</option>
                                    <option value="مدير">مدير</option>
                                    <option value="امين مخزن">امين مخزن</option>
                                    <option value="كاتب شطب">كاتب شطب</option>
                                </select>
                                @if ($errors->has('job_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('job_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" id="store">

                            <div class="col-md-9 order-0">
                                <select id="store_id" class="dir form-control{{ $errors->has('store_id') ? ' is-invalid' : '' }} dir" name="store_id" required>
                                    <option value="">اختار المخزن</option>
                                    @foreach ($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                    @endforeach
                            
                                </select>
                                @if ($errors->has('store_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('store_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                                                            

                        <div class="form-group row">
                            <label for="phone" class="col-md-3 order-1 col-form-label text-md-right">الهاتف الجوال</label>

                            <div class="col-md-9 order-0">
                                <input id="phone" type="text" class="dir form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        
                        <div class="form-group row">
                            <label for="address" class="col-md-3 order-1 col-form-label text-md-right">العنوان</label>

                            <div class="col-md-9 order-0">
                                <textarea id="address" class="dir form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"  required>{{ old('address') }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group row mb-0">
                                <div class="col-md-9 order-0">
                                <button type="submit" class="btn btn-primary btn-block">تسجيل</button>
                                </div>
                        </div>


                    </div>
                                
                </div>
            </form>  
        </div>
    </div> 
    
</div>
@endsection
@section('script')
<script>
$(function(){
    $('#job_name').change(function(){
        if($(this).val() == "مدير" || $(this).val() == ""){
            $("#store").hide(500);
        }else{
            $("#store").show(500);
        }
    });

});
</script>
 {{--you can write you script her--}}
@endsection
