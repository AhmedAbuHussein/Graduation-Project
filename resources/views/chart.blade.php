@extends('layouts.app')
@section('topscript')
<script src="/res/js/Chart.js"></script>
@endsection
@section('style')
<link rel="stylesheet" href="/css/charts.css">
@endsection
@section('content')
<!--start sectiion one about the top header of the page conatint avg numberuser two button-->

<div class="myheader">
    <div class="container">
        <div class="row text-center">
            <div class=" myhead-anlys col-lg-3 col-md-6 col-6">
                <!--first anaulse عدد اصحاي العهد-->
                <div class="label-anlys">
                    <i class="fa fa-user fa-2x fa-fw"></i><span>اصحاب العهد </span>
                </div>
                <span class="his-type">
						<bdi class="number_his-coves">{{$covcount}}</bdi>
					</span>
            </div>
            <div class=" myhead-anlys col-lg-3 col-md-6 col-6">
                <div class="label-anlys">
                    <i class="fa fa-pie-chart fa-2x fa-fw"></i><span>متوسط الصرف</span>
                </div>
                <span class="his-type">
						<bdi class="number_avg">{{$avgcov}} %</bdi>
					</span>
            </div>
            <div class=" myhead-anlys col-lg-3 col-md-6 col-6">
                <div class="label-anlys">
                    <i class="fa fa-shopping-bag fa-2x fa-fw"></i><span>الفئات المتاحه</span>
                </div> 
                <span class="his-type">
						<bdi class="number_avg">{{$ava}}</bdi>
					</span>
            </div>
            <div class=" myhead-anlys col-lg-3 col-md-6 col-6">
                <a class="btn btn-success btn-block btn-sm report2" href="{{url('pdf')}}"><i class="fa fa-file-pdf-o text-white"></i> <span>طباعه التقرير</span></a>
            </div>
        </div>
    </div>
</div>
<!-- ========================================================	-->
<!--start section two about the main grap and the the main info about the the stores containt -->
<div class="main-graph">
    <div class="container">
        <!--====== header of main graph ========-->
        <div class="header-main-graph">
            <div class="row">
                <div class="col-md-6 label-graph">
                    <p class="lead text-center"> {{date('Y'). '-' . (date('Y')-1)}} احصائيات الصرف والاضافه لجميع المخازن</p>
                </div>
                <div class="col-md-6 peroid">
                    <div class="row">
                        <div class="col-6 myselect">
                            <label>
			   	       	   	<i class="fa fa-calendar fa-2x fa-fw"></i>
			   	       	   </label>
                            <select id="endDate" class="selectbox form-control"><!--end time-->
                             @foreach ($date as $d)
                             <option value="{{$d}}">{{$d}}</option>
                             @endforeach
						    </select>
                        </div>
                        <div class="col-6 myselect select-box">
                            
                            <label>
			   	       	   	<i class="fa fa-calendar fa-2x fa-fw"></i>
			   	       	   </label>
                            <select id="startDate" class="selectbox form-control"><!--start time-->
                                @foreach ($date as $d)
                                    <option value="{{$d}}">{{$d}}</option>
                                @endforeach
							 </select>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--===================================================-->

        <!--==========================the main graph real grap =======-->
        <div class="graph">
            <div class="row">
                <div class="col-md-8" id="canves-parent">
                    <canvas id="canvas-stores-graph"></canvas>
                </div>
                <div class="col-md-4 pb-2">
                    <!--this is progrss bar where describe the stores state-->
                    <h2>نسبة المصروف فى كل مخزن</h2>
                    <div class="myprogressinfo" >
                        <progressbar></progressbar>
                        <!--000000000000000-->
                    </div>


                </div>
            </div>

        </div>
        <!--=================================================================-->

    </div>

</div>
<!-- =========================================================   -->
<!--=================================================================
		   ssistant graphas containt sample grap present the date in each stores 
		===================================================================-->
<div class="assistant-graphs">
    <div class="container">
        <div class="mygraps">
            <div class="row">
                <div class="col-md-4 mygraphs-tor">
                    <div class="theinfo">
                        <div class="h2">
                            <span>العهد </span>
                            <div class="option">
                                <i class="fa fa-gears select-pos"></i>
                                <!--option for the select the time-->
                                <select name="thetime" class="selectbox form-control">
											<option value="1">الاسبوع الماضى </option>
											<option value="2">الشهر الماضى</option>
											<option value="3">اليوم</option>
										</select>
                            </div>

                        </div>
                        <div class="mycontent text-right">
                            <div class="row">
                                <div class="col-md-12 col-6 infoStorProg mb-3">
                                    <!--منتج 1-->
                                    <label>منتج 1</label>
                                    <div class="progress dir">
                                        <div class="progress-bar progress-bar-danger  " role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%"><span style="font-size: 19px;">عهد <bdi>80 %</bdi></span></div>
                                    </div>
                                </div>
                                <div class="col-md-12  col-6 infoStorProg mb-3">
                                    <!--منتج 2-->
                                    <label>منتج 2</label>
                                    <div class="progress dir">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:40%"><span style="font-size: 19px;">عهد<bdi> 40 %</bdi></span></div>
                                    </div>
                                </div>
                                <div class="col-md-12  col-6 infoStorProg mb-3">
                                    <!--منتج 3-->
                                    <label>منتج 3</label>
                                    <div class="progress dir">
                                        <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:60%"><span style="font-size: 19px;">عهد <bdi>60 %</bdi></span></div>
                                    </div>
                                </div>
                                <div class="col-md-12  col-6 infoStorProg">
                                    <!-- منتجات اخرى-->
                                    <label>منتجات اخرى</label>
                                    <div class="progress dir">
                                        <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:30%"><span style="font-size: 19px;">عهد <bdi>30 %</bdi></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mygraphs-tor">
                    <div class="theinfo">
                        <div class="h2">
                            <i class="fa fa-database"></i>
                            <span>المتاح حاليا في المخزن</span>
                        </div>
                        <div class="mycircl-grap" style="width: 90%;">

                            <canvas id="chart-area" style="max-height:260px;" />
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

</div>
@extends('myChartScript')
<!-- ========================================================= -->
@endsection