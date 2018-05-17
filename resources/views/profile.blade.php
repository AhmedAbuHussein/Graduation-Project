@extends('layouts.app')

@section('style')

<style>

    
/*profile */

.header {
    margin-top: 2px;
    width: 100%;
    height: 400px;
    background: url('/img/cover.jpg') no-repeat;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header .header-img img {
    width: 200px;
    height: 180px;
    border-radius: 100%;
}

.header .header-img h3 {
    color: white;
    font-size: 22pt;
}
.dir{
    direction: rtl;
}
.card-body ul li>bdi{
    display: inline-block;
    width: 40%;
}
.card-body ul li{
    padding: 0.5rem;
    border-bottom: 0.05rem solid #000;
}
.card-body ul li:nth-child(even){
    background: #f3f3f3;
}

/*end profile */

</style>

@endsection

@section('content')

<div class="container">
    <div class="header">
        <div class="header-img">
            <img src="{{!empty($user->img)?'/uploaded/'.$user->img:'/img/unknown.png'}}" class="img" alt="user image" />
            <h3 class="text-center">{{$user->fullname}}</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-heading bg-primary p-2 text-right text-white font-weight-bold">بيانات المستخدم</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <h3 class="text-center">المعلومات الاساسيه</h3>
                    <ul class="list-unstyled list-notify dir text-right pr-0">
                        <li><bdi>اسم المستخدم</bdi><span>{{$user->username}}</span></li>
                        <li><bdi>البريد</bdi><span>{{$user->email}}</span></li>
                        <li><bdi>الجوال</bdi><span>{{$user->phone}}</span></li>
                        @if($user->role == 0)
                        <li><bdi>الوظيفه</bdi><span>مدير</span></li>
                        @else
                        <li><bdi>الوظيفه</bdi><span>{{$user->job_name}}</span></li>
                        <li><bdi>المخزن</bdi><span>{{$user->store->name}}</span></li>
                        @endif
                        <li><bdi>العنوان</bdi><span>{{$user->address}}</span></li>
                    </ul>
                </div>
                <div class="col-md-6 order-md-0"></div>
            </div>
        </div>
    </div>

</div>
@endsection