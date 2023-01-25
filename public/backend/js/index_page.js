if ($('#per_page').length ) {
    $(document).on('change', '#per_page', function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: pageUrl,
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () {
                $('.dataTables_ajax').removeClass('d-none');
                $('.data_table').css('opacity', '.3');
            },
            success: function (data) {
                $('#tableData').html(data);
            }
        });
    });
}

if ($('.pagination').length ) {
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var myurl = $(this).attr('href');
        getData(myurl);
    });
}
function getData(myurl){
    $.ajax({
        url: myurl,
        datatype: "html",
        beforeSend:function(){
            $('.dataTables_ajax').removeClass('d-none');
            $('.data_table').css('opacity','.3');
        },
        success:function (data) {
            $('#tableData').html(data);
        }
    })
}

if ($('.filter_submit').length ) {
    $(document).on('click', '.filter_submit', function (event) {
        event.preventDefault();
        getFilterData()
    });
    $(document).on('click', '.filter_reset', function (event) {
        event.preventDefault();
        $('.search_input').val('');
        getFilterData()
    });
}
function getFilterData() {
    $.ajax({
        url: pageUrl,
        data: $('#filter_form').serialize(),
        datatype: "html",
        beforeSend:function(){
            $('.dataTables_ajax').removeClass('d-none');
            $('.data_table').css('opacity','.3');
        },
        success:function (data) {
            $("#filter_form")[0].reset();
            $('#tableData').html(data);
        }
    })
}

