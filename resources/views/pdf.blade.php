<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/res/css/jquery-ui.min.css" rel="stylesheet">
    <link href="/res/css/font-awesome.min.css" rel="stylesheet">
    
<style>

        body{
            direction: rtl;
            background: white;
            font-size: 12pt;
        }
        .part img{
            margin-top: -1rem;
        }
        /*start global frame*/
        .top_header, .second_part ,table{
            margin-top: 3rem;
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
            border-width: .2rem;
        }
        /*end global frame*/
</style>


</head>
<body>
   
    
<!--           start first header-->
<div class="parent">
            <div class="top_header">
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="part text-right right">
                                <h4>اسم الموظف: <span>احمد محمد حسن</span> </h4>
                                <h4>الوظيفه: <span>امين مخزن</span> </h4>
                                <h4>المخزن: <span>المستهلك</span></h4>
                            </div>    
                        </div>
                        <div class="col-4">
                            <div class="part text-center middle">
                                <h2>جامعه قناه السويس</h2>
                                <h4>الاداره العامه للعهد والمخازن</h4>
                                <h4>2018 / 6 / 10</h4>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="part text-center">
                              <img class="rounded-circle" src="img/ahmed.jpg" width="120px" height="120px">
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
                        <h5>العناصر الكليه في المخزن: <span> 100 </span></h5>
                    </div>
                    <div class="second text-right">
                        <h5>العناصر التي تم صرفها : <span> 200 </span></h5>
                    </div>
                    <div class="second text-right">
                        <h5>االعناصر المتاحه في المخزن: <span> 300 </span></h5>
                    </div>
                    <div class="second text-right">
                        <h5>عدد مستخدمين العهد:</h5>
                        <table class="table">
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
                              <tr>
                                <td>1</td>
                                <td>احمد محمد علي</td>
                                <td>01002506687</td>
                                <td>جامعه قناه السويس</td>
                                <td>200 جهاز</td>
                                <td>كمبيوتر</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>احمد محمد علي</td>
                                <td>01002506687</td>
                                <td>جامعه قناه السويس</td>
                                <td>200 جهاز</td>
                                <td>كمبيوتر</td>
                              </tr>
                            </tbody>
                      </table>
                    </div>
                </div>
            </div>
<!--            end second part-->
</div>

<script src="{{ asset('js/app.js') }}" ></script>
<script src="/res/js/jquery.js"></script>

</body>
</html>

