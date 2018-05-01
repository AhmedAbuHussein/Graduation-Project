/* global $, alert ,window */

$(function() {

    'use strict';
    if ($('#notify').text() == "") {
        $('#notify').hide();
    } else {
        $('#notify').show();
    }


    $('.notification').click(function() {
        $(this).children('.notify').hide();
    });

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


    $('#job').change(function() {
        if ($(this).val() > 0) {
            $('#store').show(600);
        } else {
            $('#store').hide(600);
        }
    });


    $('.mytable').niceScroll();

    $('.selectbox').selectBoxIt();



});