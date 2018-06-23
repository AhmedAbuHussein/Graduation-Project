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

.discard:nth-child(even) .card {
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
            <h3 class="text-center">{{$user->name}}</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-heading bg-primary p-2 text-right text-white font-weight-bold">بيانات المستخدم</div>
        <div class="card-body">
            <h3 class="text-center">المعلومات الاساسيه</h3>
            <ul class="list-unstyled list-notify dir text-right pr-0">
                <li><bdi>اسم</bdi><span>{{$user->name}}</span></li>
                <li><bdi>البريد</bdi><span>{{$user->email}}</span></li>
                <li><bdi>الجوال</bdi><span>{{$user->phone}}</span></li>                
                <li><bdi>المؤسسه</bdi><span>{{$user->establishment}}</span></li>
                <li><bdi>الرقم القومي</bdi><span>{{$user->ssn}}</span></li>
            </ul>
        </div>
    </div>
        
    
    <div class="card mt-1 mb-3">
        <div class="card-heading bg-info p-2 text-right text-white font-weight-bold">العهد</div>
        <div class="card-body py-0">
            <div class="row">
                @foreach ($covenants as $item)
                <div class="col-md-4 col-lg-3 col-sm-6 discard">
                    <div class="card my-2 text-center">
                        <div class="card-body">
                            <h3 class="card-title">{{$item->datastore->name}}</h3>
                            <a href="/employee/{{$item->employee->id}}" class="card-subtitle d-block">{{$item->employee->name}}</a>
                            <bdi class="card-subtitle d-block">المخزن : <span>{{$item->datastore->store->name}}</span></bdi>
                            <bdi class="card-text d-block">الكميه : <span>{{$item->quantity}}</span></bdi>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <div class="pagination justify-content-center">{{$covenants}}</div>
            </div>
        </div>
    </div>

</div>
@endsection
