$(document).ready(function () {

    // $( "#search" ).autocomplete({
    //     source: 'search.php'
    // });


    $("#date_in").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#date_out").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#date_start_support").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#domain_date_start").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#domain_date_expired").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#host_date_start").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#host_date_expired").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#date_create").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#date").pDatepicker({
        format: 'YYYY/M/D'
    });
    $("#date_create_customer").pDatepicker({
        format: 'YYYY/M/D'
    });
    // $("#date_comment").pDatepicker({
    //     format: 'YYYY/M/D'
    // });

    // $('.search_btn').click(function (e) {
    //     e.preventDefault();

        // var search = $('#search').val();
        // // console.log(search);
        // $.ajax({
        //
        //     url: 'search.php',
        //     type: 'get',
        //     data: $('#search').val(),
        //     success: function(response) {
        //         $('table#resultTable tbody').html(response);
        //     }
        // });
        // console.log(search);

    // });
    $('#submit').click(function (e) {

        e.preventDefault();

        var data = $('#pass').val();

        $.ajax({
            url: 'generatePass.php',
            type: 'POST',
            cache: false,
            data: data,
            success: function (data) {
                $('#generate').html(data);
            }
        });

    });

});