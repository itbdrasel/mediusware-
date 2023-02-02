
// How much data will be displayed per page
$(document).on('change', '#per_page', function (event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: pageUrl,
        data: $(this).serialize(),
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            ajaxBeforeSend();
        },
        success: function (data) {
            $('#tableData').html(data);
        }
    });
});


// laravel pagination ”code start”

$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    $('li').removeClass('active');
    $(this).parent('li').addClass('active');
    var myurl = $(this).attr('href');
    getData(myurl);
});

// pagination ajax
function getData(myurl){
    $.ajax({
        url: myurl,
        datatype: "html",
        beforeSend:function(){
            ajaxBeforeSend();
        },
        success:function (data) {
            $('#tableData').html(data);
        }
    })
}
// laravel pagination ”code end”



// table data filter ”code start”
$(document).on('click', '.filter_submit', function (event) {
    event.preventDefault();
    getFilterData()
});
$(document).on('click', '.filter_reset', function (event) {
    event.preventDefault();
    $('.search_input').val('');
    getFilterData()
});
function getFilterData() {
    $.ajax({
        url: pageUrl,
        data: $('#filter_form').serialize(),
        datatype: "html",
        beforeSend:function(){
            ajaxBeforeSend();
        },
        success:function (data) {
            $("#filter_form")[0].reset();
            $('#tableData').html(data);
        }
    })
}
// table data filter ”code end”


// table data sorting ”code start”
$(document).on('click', '.sort', function (event) {
    event.preventDefault();
    let order = 2;
    let sort_by = $(this).data('row');
    let hSortBy = $('#sortBy').data('row');
    if (sort_by == hSortBy){
        order = $('#sortBy').val();
    }
    $.ajax({
        url: pageUrl+"?by="+sort_by+"&order="+order,
        datatype: "html",
        processData: true,
        beforeSend:function(){
            ajaxBeforeSend();
        },
        success:function (data) {
            ajaxBeforeSend(false)
            $("#filter_form")[0].reset();
            $('#tableData').html(data);
             order = order==1?2:1;
            $('#sortBy').val(order);
            $('#sortBy').data('row', sort_by);
            if(order == 1){
                $("#"+sort_by).append('&nbsp;<i class="fa fa-arrow-up"><i>');
            }else if(order == 2){
                $("#"+sort_by).append('&nbsp;<i class="fa fa-arrow-down"><i>');
            }
        }
    });
});
// table data sorting ”code end”




// Ajax modal data delete
 function deleteItem (id, url){
     $('#submit').html('<i class="fas fa-trash-alt"></i> Yes, Delete This');
     $('#submit').attr("disabled", false);
     $('.alert-success').hide();
     $('.alert-warning').hide();
     $('.fbody').show();
     $("#deleteModal").modal("show");
     $('#deleteId').val(id);
     $('#deleteUrl').val(url);
 }


    $(document).on('click', '#submit', function (event) {
        event.preventDefault();
        let id =  $('#deleteId').val();
        let url =  $('#deleteUrl').val();
        $.ajax({
            type: 'POST',
            url: url+'/'+id,
            data: {id:id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            datatype:'json',
            beforeSend:function(){
                $('#submit').html('<i class="fas fa-spinner fa-pulse"></i> Please Wait');
                $('#submit').attr("disabled", "disabled");
            },
            success: function (data) {
                if (data){
                    $('#tableData').html(data);
                    $('.alert-success').html('The item has been successfully deleted').hide().slideDown();
                    $('.fbody').hide();
                }else {
                    $('.alert-warning').html('The field is required').hide().slideDown();
                }
            }
        });
    });


// Ajax before send preloader
function ajaxBeforeSend(isSend=true) {
    if (isSend){
        $('.dataTables_ajax').removeClass('d-none');
        $('.data_table').css('opacity','.3');
    }else {
        $('.dataTables_ajax').addClass('d-none');
        $('.data_table').css('opacity','1');
    }

}


function blankModal(url) {
    $("#blankModal").modal("show");
    $.ajax({
        url: url,
        datatype: "html",
        beforeSend:function(){
            $('#blankModalBody').html('<div class="modal-body">\n' +
                '<div class="spinner-border"></div>\n' +
                '</div>');
        },
        success:function (data) {
            $('#blankModalBody').html(data);
        }
    })
}
