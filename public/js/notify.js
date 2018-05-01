$(function() {
    var list = $('#notify-list');
    var notification = $('#notification');
    //notify-list
    count = 0;
    setInterval(function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/notification',
            dataType: 'json',
            type: 'get',
            data: { 'count': count },
            success: function(response) {
                $('#notify').text(response.count).show();
                list.html("");
                for (i = 0; i < response.count; i++) {
                    list.append('<li><a href="/manage?itemid=' + response.notify[i].requerd_num + '">' + response.notify[i].notify + '</a></li>');
                }
                count = response.count;
            }
        });
    }, 5000);



});