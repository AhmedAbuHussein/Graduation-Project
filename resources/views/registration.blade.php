@extends('layouts.app')

@section('content')

<div class="container">
        <h2 class="text-center text-muted">تسجيل موظف جديد</h2>
    <div class="row">
      
        <div class="col-md-7 order-1">
            
            <form id="register" class="form-horizontal" method="POST" action="{{url('/register')}}" enctype="multipart/form-data">
                @csrf
                <!-- start first name create -->
                <div class="form-group">
                    <div class="col-md-3 text-md-left float-right">
                        <label for="firstname" class="control-label">الاسم الاول</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" value="{{Request::old('firstname')}}" id="firstname" name="firstname" class="form-control" placeholder="الاسم الاول" required />
                    </div>
                    
                </div>
                <!-- end first name create -->

                <!-- start last name create -->
                <div class="form-group">
                    <div class="col-md-3 text-md-left float-right">
                        <label for="lastname" class="control-label">الاسم الاخير</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="lastname" value="{{Request::old('lastname')}}" name="lastname" class="form-control" placeholder="الاسم الاخير" required />
                    </div>
                   
                </div>
                                                           
                <!-- end last name create -->

                <!-- start email create -->
                <div class="form-group">
                    <div class="col-md-3 text-md-left float-right">
                        <label for="email" class="control-label">البريد الالكتروني</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="email" value="{{Request::old('email')}}" name="email" class="form-control" placeholder="البريد الالكتروني" required />
                    </div>
                    
                </div>
                <!-- end email create -->

                <!-- start password create -->
                <div class="form-group">
                    <div class="col-md-3 text-md-left float-right">
                        <label for="password" class="control-label">كلمه المرور</label>
                    </div>
                    <div class="col-md-9">
                        <input type="password" id="password"  name="password" class="form-control" placeholder="كلمه المرور اكثر من 6 حروف" required />
                    </div>
                    
                </div>
                <!-- end email create -->

                <!-- start username create -->
                <div class="form-group">  
                    <div class="col-md-3 text-md-left float-right">
                        <label for="username" class="control-label">اسم المستخدم</label>
                    </div>            
                     <div class="col-md-9">
                        <input type="text" id="username" value="{{Request::old('username')}}" name="username" class="form-control" placeholder="اسم المستخدم" required />
                    </div>
                    
                </div>
                <!-- end email create -->

                <!-- start job create -->
                <div class="form-group">  
                    <div class="col-md-3 text-md-left float-right">
                        <label for="job" class="control-label">الوظيفه</label>
                    </div>            
                    <div class="col-md-9">
                        <select name="job_id" id="job" class="form-control">
                            <option value="">اختار الوظيفه</option>
                            <option value="0">مدير</option>
                            <option value="1">امين مخزن</option>
                            <option value="2">كاتب شطب</option>
                        </select>
                    </div>
                   
                </div>
                <!-- end email create -->
                <!-- start job create -->
                <div class="form-group" id="store" style="display:none;"> 
                    <div class="col-md-3 text-md-left float-right">
                        <label for="store" class="control-label">المخزن</label>
                    </div>             
                    <div class="col-md-9">
                        <select name="store" id="store" class="form-control">
                            <option value="">اختار المخزن</option>
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end email create -->

                 <!-- start username create -->
                 <div class="form-group">  
                        <div class="col-md-3 text-md-left float-right">
                            <label for="phone" class="control-label">رقم الهاتف</label>
                        </div>            
                         <div class="col-md-9">
                            <input type="text" id="phone" value="{{Request::old('phone')}}" name="phone" class="form-control" placeholder="رقم الهاتف" required />
                        </div>
                        
                    </div>
                    <!-- end email create -->
   
                <div class="form-group">
                    <div class="col-md-3 text-md-left float-right">
                        <label for="text" class="control-label">العنوان</label>
                    </div>
                    <div class="col-md-9">
                        <textarea id="text" name="address" placeholder="العنوان" class="form-control" rows="2">{{Request::old('address')}}</textarea>
                    </div>
                </div>

            </form>
        </div>

        <div class="col-md-5 col-md-pull-7">

            <div class="show-img">
                <img src="/img/unknown.png" alt="live preview" class="preview img-responsive center-block">
            </div>
            <div class="form-group">
                
                <input form="register" id="inputimg" type="file" max="1" name="imgfile" />
                
            </div>
            <div class="form-group" style="width:50%; margin:30px auto;">
                <button form="register" type="submit" class="btn btn-primary btn-block">تسجيل</button>
            </div>
        </div>
    </div>
</div>

@endsection