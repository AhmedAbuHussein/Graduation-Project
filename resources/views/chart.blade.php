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
            <div class="">
                <div class="mygraphs-tor">
                    <div class="theinfo">
                        <div class="h2 text-right">
                            
                            <span>عدد الفئات المتاحه في كل مخزن</span>
                            <i class="fa fa-database"></i>
                        </div>
                        <div class="mycircl-grap" style="width: 90%;">

                            <canvas id="chart-area" style="max-height:350px;" />
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