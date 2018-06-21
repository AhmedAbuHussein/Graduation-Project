<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}}</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/res/css/font-awesome.min.css" rel="stylesheet">
    <link href="/res/css/jquery-ui.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/dashboard.css" />

    <script src="/res/js/jquery.js"></script>
<script src="/StreamLab/StreamLab.js"></script>
</head>
<body>
<div class="container-fluid">
        <div class="modal fade" id="clock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-center" id="myModalLabel">SMS</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" style="direction:rtl;" class="form-control" placeholder="رقم الهاتف">
                            </div>
                            <div class="form-group">
                                <textarea rows="10" style="direction:rtl; resize:none;" class="form-control" placeholder="رسالتك"></textarea>    
                            </div>                            
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary">ارسال</button>
                        </div>
                    </div>
                </div>
            </div>
    
    <div class="row">
        <div class="col-lg-2 d-none d-lg-block" style="padding-right:0;padding-left:0">
            <!--Start Aside Bar -->
            <div class="aside">
                <img width="80%" alt="main logo" class="main-logo" src="/img/main-logo.png" />
                <hr>
                <h3 class="text-center"><bdi>{{Auth::user()->fullname}}</bdi> <img src="{{isset(Auth::user()->img)?'/uploaded/' . Auth::user()->img:'/img/unknown.png'}}" /></h3>

                <h4 class="text-muted text-uppercase"><a href="{{ route('home')}}">الرئيسـيه</a></h4>

                <ul class="aside-ul"  id="aside-ul">
                    @foreach ($stores as $store)
                    @if(Auth::user()->role == 0)
                    <li class="down-menu"><bdi>{{$store->name}}</bdi> <i class="fa fa-chevron-left"></i> </li>
                    <ul class="open">
                        <li><a href="/additem">اضافه</a></li>
                        <li><a href="/make-covenant">توزيع</a></li>
                        <li><a href="/chart">احصائيات</a></li>
                    </ul>
                    @elseif(Auth::user()->store_id == $store->id)
                    <li class="down-menu"><bdi>{{$store->name}}</bdi> <i class="fa fa-chevron-left"></i> </li>
                    <ul class="open">
                        <li><a href="/additem">اضافه</a></li>
                        <li><a href="/make-covenant">توزيع</a></li>
                        <li><a href="/chart">احصائيات</a></li>
                    </ul>
                        @break
                    @endif
                    @endforeach
                </ul>

                <div class="aside-footer">
                    <ul class="list-unstyled">
                        <li><a href="#" class="btn" data-toggle="modal" data-target="#clock"><i class="fa fa-envelope-o fa-2x"></i></a></li>
                        <li><a href="/profile?id={{Auth::id()}}" class="btn"><i class="fa fa-user"></i></a></li>
                        <li><a href="{{ route('logout') }}" class="btn" 
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a></li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>

            </div>
            <!--End Aside Bar -->

        </div>
        <div class="content col-lg-10" style="padding-right:0;padding-left:0">
        <nav id="app" class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand d-lg-none" href="{{ url('/dashboard') }}">
                    الرئيسـيه
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto d-lg-none">
                        <li><a class="nav-link" href="/store">المخازن</a></li>
                        <li><a class="nav-link" href="/chart">الاحصائيات</a></li>
                        <li><a class="nav-link" href="/covenant-owner">العهد</a></li>
                        <li><a class="nav-link" href="/users">المستخدمين</a></li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @else
                        <notification :role="{{Auth::user()->role}}"></notification>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fullname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="text-align:right">
                                    <a class="dropdown-item" href="/profile?id={{Auth::id()}}">الملف الشخصي</a>
                                    <a class="dropdown-item" href="/modify?id={{Auth::id()}}">تعديل</a>
                                    <i class="divider"></i>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        تسجيل الخروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            
                <!--Start Content -->
                <div class="content">
                    <h2 class="text-center"><bdi>المخـــازن العــامـه</bdi></h2>
                    <hr />
                    <div class="content-box">
                     
                        <div class="row text-white">

                            <div class="col-sm-6 mt-3 col-md-3">
                                <a class="link" href="/covenant-owner">
                                    <div class="card bg-danger">
                                        <div class="card-body text-right">
                                            <i class="fa fa-shopping-bag pull display-3"></i>
                                            <span class="text-right display-3">150</span>
                                            <h3 class="text-center">العهد</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-6 mt-3 col-md-3">
                                <a class="link" href="/chart">
                                    <div class="card bg-info">
                                        <div class="card-body text-right">
                                            <i class="fa fa-line-chart pull display-3"></i>
                                            <span class="text-right display-3">{{$datastore}}</span>
                                            <h3 class="text-center">احصائيات</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-6 mt-3 col-md-3">
                                <a class="link" href="/users">
                                    <div class="card bg-warning">
                                        <div class="card-body text-right">
                                            <i class="fa fa-user-plus pull display-3"></i>
                                            <span class="text-right display-3">{{$users}}</span>
                                            <h3 class="text-center">المستخدمين</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-6 mt-3 col-md-3">
                                <a class="link" href="/store">
                                    <div class="card bg-primary">
                                        <div class="card-body text-right">
                                            <i class="fa fa-pie-chart pull display-3"></i>
                                            <span class="text-right display-3">{{count($stores)}}</span>
                                            <h3 class="text-center">المخازن</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>


                        </div>
                    </div>
                    <div class="row">
    
    
                        <div class="col-sm-6 mt-3 chart">
    
                          
                            <div style="width:95%; min-height:250px;margin-bottom:20px; position:relative;">
                                <canvas style="max-width:100%; height:300px;" id="dashChart"></canvas>
                            </div>
                            
                            <script src="/res/js/jquery.js"></script>
                            <script src="/res/js/Chart.js"></script>
                            <script>
                                $(function(){                                    
                                    var adds=[];
                                    var cov = [];
                                    $.get('/mainchart',function(response){
                                        console.log(response);
                                        var data = JSON.parse(response);
                                        adds = data[0];
                                        cov = data[1];
                                        var config = {
                                            type: 'line',
                                            data: {
                                                labels: ["المستهلك", "المستديم", "الخامات", "كهنه"],
                                                datasets: [{
                                                    label: "احصائيات الصرف",
                                                    data: cov,
                                                    fill: true,
                                                    borderColor: "#f27",
                                                    backgroundColor: "rgba(255,20,70,0.4)"
                                                }, {
                                                    label: "احصائيات الاضافه ",
                                                    data: adds,
                                                    fill: true,
                                                    borderColor: "#27f",
                                                    backgroundColor: "rgba(20,60,255,0.4)"
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                title: {
                                                    display: true,
                                                    text :"الاحصائيات العامه للمخازن"
                                                    
                                                }
                                            }
                                        };
                                
                                    var ctx = document.getElementById("dashChart").getContext("2d");
                                    var draw = new Chart(ctx, config);
                                });
                            });
                            </script>               

    
                        </div>
    
    
                        <!--content of stors -->
                        <div class="col-sm-6 mt-3">
                           <div class="card  mt-4">
                                <div class="card-heading bg-primary p-2 text-white text-center">اخر 5 اضافات</div>
                                <div class="card-body pt-0">
                                    <ul class="list-unstyled changes">
                                        @foreach ($adds as $add)
                                        <li class="nav-item">
                                            <span style="width:50%; display:inline-block">{{$add->datastore->name}}</span>
                                            <span>السعر : {{$add->price}}</span></li>
                                        @endforeach
                                    </ul>    
                                </div>
                            </div>
                        </div>
                        <!--content of stors -->
    
    
                    </div>
                </div>
                <!--End Content -->

        </main>
    </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="/res/js/jquery.js"></script>
    <script src="/res/js/jquery-ui.min.js"></script>

    <script>


    $('#aside-ul>li').click(function() {
        if ($(this).hasClass('selected')) {
            $(this).next('ul').slideUp(300);
            $(this).removeClass('selected');
        } else {
            $(this).addClass('selected').siblings().removeClass('selected');

            if ($(this).hasClass('selected')) {
                $('ul.open').slideUp();
                $(this).next('ul').slideDown(300);
            }
        }
    });


    $('.aside').css({
        'height': $(window).height(),
    });

    $(window).resize(function() {

        $('.aside').css({
            'height': $(window).height(),
        })

    });
    $("#datepicker").datepicker({
        inline: true,
        showButtonPanel: true,
        autoSize: true,

    });
    </script>

</body>
</html>


