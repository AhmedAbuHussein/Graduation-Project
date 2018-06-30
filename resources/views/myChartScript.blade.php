
<script>
/*global $*/
/*===================================== template data =======================*/
var arr = [];
var arr2 = [];
@foreach ($count[0] as $c)
    arr.push({{$c}});
@endforeach
@foreach ($count[1] as $c)
    arr2.push({{$c}});
@endforeach
var input1 =  ['مخزن المستهلك ','مخزن المستدم ',' مخزن الخامات','مخزن الكهنه'],
    input2 = 'bar',
	input3 = [ arr,arr2],
	input4 = ['المتاح','المستهلك'],
	input5 = 'canvas-stores-graph',
	myinput1 = 'line',
	myinput2 =[100,50,20,60],
	myinput3 = ["المستهلك", "المستديم","الخامات","الكهنه"],
	myinput5 = "chart-area",
    myinput4 = 'right';

/*background color */
var colorbackground = [ 
    "rgba(50,200,52,0.4)",
    "rgba(90,80,172,0.4)",
    "rgba(20,50,250,0.6)",
    'rgba(230,60,52,0.6)',
    "rgba(20,200,152,0.6)"
    ];
/*=========================================================================*/

/*========================== load function =================================================*/

window.onload = function() {
    canvas = document.querySelector('#'+input5);
    ctx = canvas.getContext('2d');
    make_char_line_bar(ctx,input1,input2,input3,input4,input5,false,true,'مخازن وعهد');/*cahar1*/
    
    $.get('/chartdoughnut',function(res){
        myinput2 = JSON.parse(res);
        make_doughnut(myinput1, myinput2, myinput3, myinput4, myinput5, colorbackground);/*chart*/
    });
    $('#startDate').change(function(){

        var startdate = $(this).val();
        var endDate = $('#endDate').val(); 
    
        $.get('/chartAjax',{'start':startdate,'end':endDate},function(res){
            var data = JSON.parse(res);
            input3 = [data[0],data[1]];
            $('#'+input5).remove(); // this is my <canvas> element
            $('#canves-parent').append('<canvas id="'+input5+'"><canvas>');
            canvas = document.querySelector('#'+input5);
            ctx = canvas.getContext('2d');
            make_char_line_bar(ctx,input1,input2,input3,input4,input5,false,true,'مخازن وعهد');/*cahar1*/
        });
    
    });

    $('#endDate').change(function(){

        var startdate = $('#startDate').val();
        var endDate = $(this).val();
    
        $.get('/chartAjax',{'start':startdate,'end':endDate},function(res){
            var data = JSON.parse(res);
            input3 = [data[0],data[1]];
            $('#'+input5).remove(); // this is my <canvas> element
            $('#canves-parent').append('<canvas id="'+input5+'"><canvas>');
            canvas = document.querySelector('#'+input5);
            ctx = canvas.getContext('2d');
            make_char_line_bar(ctx,input1,input2,input3,input4,input5,false,true,'مخازن وعهد');/*cahar1*/
            
        });
    
    });

};
/*
=============================================================
=================== function make_doughnut ==================
=============================================================
*/
/*
 * type,data_set,labels_data_set,legend_postion,canvas_id,background_color
 * and make doughnut for this data_set to labels_data_set 
*/
function make_doughnut(type,data_set,labels_data_set,legend_postion,canvas_id,background_color)
{
	if(data_set.length != labels_data_set.length)
		{
			alert('error in the length not equal the label input3 and input4 ')
			return 0
		}
	var config = {
        type: type,
        data: {
            datasets: [{
                data: data_set,
                backgroundColor: background_color[2],
                label:"المخازن"
            }],
            labels: labels_data_set
        },
        options: {
            responsive: true,
            legend: {
                position: legend_postion,
            },
            title: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
	var ctx2 = document.getElementById(canvas_id).getContext("2d");
        /*window.myDoughnut*/var char2 = new Chart(ctx2, config);
}

/*
=============================================================
=================== function make_char_line_bar =============
=============================================================
*/
/*
 * this function take the pamatera
 * labels_char,type_char,datasets_char,label_datasets_char,id_canves,file_mode = false,
 * display_log = false,log_label = 'مخازن وعهد'
 * to maker bar states for the datasets for this label_datasets_char
*/

function make_char_line_bar(ctx,labels_char,type_char,datasets_char,label_datasets_char,id_canves,file_mode = false,display_log = false,log_label = 'مخازن وعهد')
{ 
    
	if(datasets_char.length != label_datasets_char.length)
		{
			alert('error in the length not equal the label input3 and input4 ')
			return 0
		}
	var chartData = {
            labels: labels_char,
            datasets: [{
                type: type_char,
                label: label_datasets_char[0],
                backgroundColor:colorbackground[2],
				borderColor: 'white',
                borderWidth: 2,
                fill: file_mode,
                data: datasets_char[0] 
            }]
        };
	
    if(label_datasets_char.length > 1)
		{
			var flag = label_datasets_char.length - 1;

			for(var i=1 ; i <= flag ; i++)
			{  
				var x = {
					type: type_char,
					label: label_datasets_char[i],
					borderColor:  'white',
					backgroundColor:"rgba(200,20,70,0.5)",
					borderWidth: 2,
					fill: file_mode,
					data: datasets_char[i] 
				}
				chartData.datasets[i] = x;   
			}
					  
        }

        
            var cahr1 = new Chart(ctx, {
                type: type_char,
                data: chartData,
                options: {
                    responsive: true,
                    title: {
                        display: display_log,
                        text: log_label
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });
    
            
            
}
/*==============  end ===========================================*/





</script>