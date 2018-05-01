$(function() {

    function readURL(input, $seleector) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $($seleector).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("input[type='file']").change(function() {
        readURL(this, '.preview');
    });

    $('.fa.fa-eye').hover(function() {
        $(this).parent().find('input').attr('type', 'text');
    }, function() {
        $(this).parent().find('input').attr('type', 'password');
    })
});