<!DOCTYPE html>
<html lang="Ar">
<head>
    <meta charset="UTF-8">
    <title>pdf</title>
<style>

        body{
            font-family: 'dejavu sans', sans-serif;
            direction:rtl;
            text-alignment:right;
            background: white;
            font-size: 12px;
        }
        .container{
            max-width: 960px;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .row{
            overflow: hidden;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-4{
            float: right;
            width: 28%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;        
        }

        /*start global frame*/
        .top_header, .second_part ,table{
            margin-top: 50px;
        }
        .top_header .right span,.second_part .second span ,table thead tr th{
            color: #C5251E;
        }
        h4,h5{
            color: #0D2833;
            font-weight: bold;  
        }
        table tbody tr td{
            color: #0D2833;
            font-weight: bold;  
        }
        hr{
            border-width: 1px;
        }
        img{
            border-radius: 100%;
            width: 120px;
            height: 120px;
            margin-top: -10px;
        }
        table{
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            direction: rtl;
            display: table;
            border-collapse: separate;
            border-spacing: 2px;
            border-color: grey;
        }
        .text-center{
            text-align: center !important;
        }
        .text-right{
            text-align: right !important;
        }
        table tr td , th{
            padding: 15px;
            border-bottom: 1px solid #ccc;
        }
        /*end global frame*/
</style>


</head>
<body>
   
    
<!--start first header-->
<div class="parent" id="content">
    <div class="top_header">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="part text-right right">
                        <h4><bdi>اسم الموظف: <span>{{Illuminate\Support\Facades\Auth::user()->fullname}}</span> </bdi></h4>
                        <h4>الوظيفه: <span>{{Illuminate\Support\Facades\Auth::user()->job_name}}</span> </h4>
                        <h4>المخزن: <span>{{Illuminate\Support\Facades\Auth::user()->store->name}}</span></h4>
                    </div>    
                </div>
                <div class="col-4">
                    <div class="part text-center middle">
                        <h2>جامعه قناه السويس</h2>
                        <h4>الاداره العامه للعهد والمخازن</h4>
                        <h4>{{Date('Y-M-D')}}</h4>
                    </div>
                </div>
                <div class="col-4">
                    <div class="part text-center">
                        <img src="img/logo.jpg" width="120px" height="120px">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <!--            end first header-->
    <!--            start second part-->
    <div class="second_part">
        <div class="container">
            <div class="second text-right">
            <h4>العناصر الكليه في المخزن: <span> {{$all}} </span></h4>
            </div>
            <div class="second text-right">
                <h4>العناصر التي تم صرفها : <span> {{$cov}} </span></h4>
            </div>
            <div class="second text-right">
                <h4>العناصر المتاحه في المخزن: <span> {{$stay}} </span></h4>
            </div>
            <div class="second text-right">
                    <h4>كميه العجز بالمخزن: <span> {{$stay - ($all - $cov)}} </span></h4>
                </div>
            <div class="second text-right">
                <h4>عدد مستخدمين العهد: <span>{{count($emps)}}</span></h4>
                <table>
                    <thead>
                        <tr class="text-right">
                        <th>المسلسل</th>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>الجهه</th>
                        <th>الكميه</th>
                        <th>العناصر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emps as $emp)
                            
                        <tr>
                        <td>{{$emp->id}}</td>
                        <td>{{$emp->name}}</td>
                        <td>{{$emp->phone}}</td>
                        <td>{{$emp->establishment}}</td>
                        <td>{{$emp->quantity}}</td>
                        <td>{{$emp->dname}}</td>
                        </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
</div>
<!--end second part-->
</div>

</body>
</html>

