<script>
     var tableStore = $('#tableStore');
    $(function() {

       
        $('#searchinput').keyup(function(event) {

            event.preventDefault();
            var text = $(this).val();
            var store = $('#storechoose').val();
            console.log("input "+text)
            $.post('/store', { 'item': text,'store':store, '_token': $('input[name=_token]').val() }, function(req) {
                
                updateTable(req);

            });

        });

        $('#storechoose').change(function(e) {
            e.preventDefault();
            var text = $(this).val();
            var textitem = $('#searchinput').val();
    
            $.post('/storetype', { 'text': text,'item':textitem, '_token': $('input[name=_token]').val() }, function(req) {
                
                updateTable(req);
            });

        });

    });


    function updateTable(req) {
        console.log(req);
        $("#spancount").text(req.data.length);
        tableStore.html("");
        for (i = 0; i < req.data.length; i++) {

            tdata = "<td>" + req.data[i].id + "</td>" +
                "<td>" + req.data[i].name + "</td>" +
                "<td>" + req.data[i].store_name + "</td>" +
                "<td>" + req.data[i].quantity + "</td>" +
                "<td>" + req.data[i].price + "</td>" +
                "<td>" + req.data[i].price * req.data[i].quantity + "</td>" ;

            if ( req.role == null || req.role == req.data[i].store_id ) {
        
                tdata += '<td><a href="/edit?id=' + req.data[i].id + '" class="btn btn-success btn-sm ">تعديل <i class="fa fa-edit"></i></a></td>'
            }else{ 
                tdata += "<td>Disabled</td>";
            }
        

            tableStore.append("<tr>" + tdata + "</tr>");
        }
       
    }

</script>