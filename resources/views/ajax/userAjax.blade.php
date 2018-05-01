<script>

$(function(){

    $('#userSearch').keyup(function(e){
        var user = $(this).val();
        $.post('/user',{'user':user,'_token':$('input[name=_token]').val()},function(req){

             $('#tableusers').html("");
             for(i=0;i<req.length;i++){
                 data = "<td>"+ req[i].id +"</td>"+
                    "<td><a class='emp_name' href='/profile?id="+req[i].id+"'>" +req[i].name+ "</a></td>";
                    if(req[i].job_id == 0){
                        data +="<td>مدير</td>";
                    }else if(req[i].job_id == 1){
                        data +="<td>امين مخزن</td>";
                    }else{
                        data +="<td>كاتب شطب</td>";
                    }
                    if(req[i].user_id != 1){
                        data +="<td>"+req[i].store_name+"</td>";
                    }else{
                        data +="<td></td>";
                    }
                    data +="<td>"+req[i].email+"</td>"+
                            "<td>"+req[i].phone+"</td>";
                    @if(Auth::user()->job_id == 0)
                        data +="<td>";
                        if(req[i].job_id != 0){
                            data += '<a href="/delete?action=user&id='+req[i].id+'" data-class="'+req[i].name+'" class="btn btn-danger btn-sm confirm">حذف <i class="fa fa-close"></i></a>';
                        }
                        data += ' <a href="/edit?action=user&id='+req[i].id+'" class="btn btn-success btn-sm">تعديل <i class="fa fa-edit"></i></a></td>';
                    @else
                        data +="<td>disabled</td>";
                    @endif

                    $('#tableusers').append("<tr>" + data + "</tr>")
             }

        });

    });

});



</script>