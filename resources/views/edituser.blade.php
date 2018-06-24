@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="/css/edituser.css">

@endsection
@section('content')
<div class="container">
        @if(isset($user))
    <h2 class="text-center text-muted mt-3 mb-4">تعديل المعلومات الشخصيه</h2>
   
    <form method="POST" action="/modify" enctype="multipart/form-data">
        <div class="row text-center">
                    
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="col-md-7 order-md-1">

                <div class="form-group row">
                        <label for="fullname" class="col-md-3 order-md-1 col-form-label text-right">الاسم الكلي</label>

                        <div class="col-md-9 order-0">
                            <input 
                                id="fullname" 
                                type="text" 
                                class="form-control dir{{ $errors->has('fullname') ? ' is-invalid' : '' }}" 
                                name="fullname" 
                                value="{{ $user->fullname }}" 
                                required 
                                autofocus>

                            @if ($errors->has('fullname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 

                <div class="form-group row">
                    <label for="username" class="col-md-3 order-md-1 col-form-label text-right">اسم المستخدم</label>

                    <div class="col-md-9 order-0">
                        <input 
                            id="username"
                            type="text" 
                            class="form-control dir{{ $errors->has('username') ? ' is-invalid' : '' }}" 
                            name="username" 
                            value="{{ $user->username }}" 
                            required 
                            >


                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="email" class="col-md-3 order-md-1 col-form-label text-right">البريد الالكتروني</label>

                    <div class="col-md-9 order-0">
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control dir{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                            name="email" 
                            value="{{ $user->email }}" 
                            required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-3 order-md-1 col-form-label text-right">كلمه المرور</label>

                    <div class="col-md-9 order-0">
                        <input 
                            id="password" 
                            type="password" 
                            class="form-control dir{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                            name="password">
                            <i class="fa fa-eye"></i>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-md-3 order-md-1 col-form-label text-right">الوظيفه</label>

                    <div class="col-md-9 order-0">
                        <select id="role" class="form-control dir{{ $errors->has('role') ? ' is-invalid' : '' }} dir" name="role" required>
                            <option value="">اختار الوظيفه</option>
                            <option value="مدير" {{$user->job_name == "مدير"? 'selected':''}}>مدير</option>
                            <option value="امين مخزن" {{$user->job_name == "امين مخزن"? 'selected':''}}>امين مخزن</option>
                            <option value="كاتب شطب" {{$user->job_name == "كاتب شطب"? 'selected':''}}>كاتب شطب</option>
                        </select>
                        @if ($errors->has('role'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row" id="store">

                    <div class="col-md-9 order-0">
                        <select id="store_id" class="form-control dir{{ $errors->has('store_id') ? ' is-invalid' : '' }} dir" name="store_id">
                            <option value="">اختار المخزن</option>
                            @foreach ($stores as $store)
                            <option value="{{$store->id}}" {{$user->store_id == $store->id? 'selected':''}}>{{$store->name}}</option>
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
                    <label for="phone" class="col-md-3 order-md-1 col-form-label text-right">الهاتف الجوال</label>

                    <div class="col-md-9 order-0">
                        <input 
                            id="phone" 
                            type="number" 
                            class="form-control dir{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                            name="phone" 
                            value="{{ $user->phone }}" 
                            required>

                        @if ($errors->has('phone'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> 

                
                <div class="form-group row">
                    <label for="address" class="col-md-3 order-md-1 col-form-label text-right">العنوان</label>

                    <div class="col-md-9 order-0">
                        <textarea 
                            id="address" 
                            class="form-control dir{{ $errors->has('address') ? ' is-invalid' : '' }}" 
                            name="address"  
                            required>{{ $user->address }}</textarea>
                        @if ($errors->has('address'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> 



            </div>

            <div class="col-md-5 order-md-0">


                <label for="inputimg" class="show-img pb-0 m-auto btn btn-outline-info">
                    <img src="{{!empty($user->img)?'/uploaded/'.$user->img:'/img/unknown.png'}}" alt="live preview" class="preview img-responsive center-block">
                </label>
                <input id="inputimg" type="file" max="1" name="imgfile" />
                    
                
                <div class="form-group mb-3 mt-3 mr-auto ml-auto" style="max-width:15rem;">
                    <button type="submit" class="btn btn-primary btn-block">حفظ <i class="fa fa-save"></i></button>
                </div>

            </div>
                        
        </div>
    </form>  
    @else
        <div class="alert alert-warning mt-4" >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <h4 class="text-center">عفوا لم يتم العثور علي هذا المستخدم</h4>
        </div>
    @endif
</div>
@endsection
@section('script')

<script src="/js/edituser.js"></script>
<script>
    if(window.location.hash == "#not-save"){
        swal({
            'text':'حدث خطا اثناء حفظ البيانات',
            'icon':'error',
        });
    }
    
</script>

@endsection
