
<script>
/*global $*/
/*===================================== template data =======================*/
var input1 =  ['مخزن الكهنه','مخزن الخامات','مخزن المستدم','مخزن المستهلك'],
	input2 = 'bar',
	input3 = [[800,750,850,900],[650,350,700,350]],
	input4 = ['المتاح','المستهلك'],
	input5 = 'canvas-stores-graph',
	input6 = ["منتج 1", "منتح2", "منتج 3", "منتجات اخرى"],
	input7 = 'line',
	input9 =['مصرف','مدخل'] ,
	input8 = [ [400,620,120,300 ],[ 500,440,240,280]],
	input10 ='chart-area2',
	myinput1 = 'doughnut',
	myinput2 =[100,50,20,60],
	myinput3 = ["منتح 1", "منتج 2","منتج 3","منتجات اخرى"],
	myinput5 = "chart-area",
	myinput4 = 'right';


/*background color */
var colorbackground = [ "rgba(50,200,52,0.4)",
						"rgba(90,80,172,0.4)",
					   "rgba(20,50,250,0.6)",
					   'rgba(230,60,52,0.6)',
                       "rgba(20,200,152,0.6)"
                       ];
/*=========================================================================*/

/*========================== load function =================================================*/

window.onload = function() {
	make_char_line_bar(input1,input2,input3,input4,input5,false,true,'مخازن وعهد');/*cahar1*/
	make_char_line_bar(input6,input7,input8,input9,input10,true,false,'ali');/*char 2*/
	make_doughnut( myinput1, myinput2, myinput3, myinput4, myinput5, colorbackground);/*chart*/

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
                backgroundColor: background_color,
                label: 'Dataset 1'
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
                text: 'المتاح حاليا'
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

function make_char_line_bar(labels_char,type_char,datasets_char,label_datasets_char,id_canves,file_mode = false,display_log = false,log_label = 'مخازن وعهد')
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
	 var ctx = document.getElementById(id_canves).getContext("2d");
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