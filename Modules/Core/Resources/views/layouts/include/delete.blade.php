<style type="text/css">
    .alert{ padding:6px 10px; margin-top:10px}
    .alert-warning{display:none;}
    .alert-success{display:none;}
</style>

<div class="modal-content">
    <div class="modal-header">
        <h4 class="m-0" style="margin: 0 !important; font-size: 19px; font-weight: bold" ><i class="fa fa-trash"></i> {{$title}} </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{url($pageUrl)}}" id="delete" >
            @csrf

            <div class="alert alert-warning" role="alert">&nbsp;</div>
            <div class="alert alert-success" role="alert">&nbsp;</div>

            <div class="fbody">

                <input type="hidden" name="id" id="id" value="{{ $objData->$tableID }}" />
                <div class="form-group" >
                    <label class="col-sm-7 control-label" >Do you want to delete {{ $title }} ? </label>
                    <div class='col-sm-5'>
                        @php
                            $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                        @endphp
                        <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" id="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Yes, Delete This</button>&nbsp;&nbsp;
                        &nbsp;<a class="btn btn-default no" data-dismiss="modal" data-reload="false"><i class="fas fa-long-arrow-left"></i> <i class="fas fa-arrow-left"></i> No, Go Back </a>

                    </div>
                </div>


            </div>
            </from>
    </div>
    <div class="modal-footer">
        <button type="button"  data-reload="true" class="btn btn-secondary dismiss" data-bs-dismiss="modal">Close</button>
    </div>
</div>

<script>
    $(function(){
        $('form#delete').each(function(){
            $this = $(this);
            $this.find('#submit').on('click', function(event){
                event.preventDefault();
                var str = $this.serialize();
                $.post('{{ url($pageUrl) }}', str, function(response){
                    var jsonObj = $.parseJSON(response);
                    if (jsonObj.fail == false){
                        $this.find('.alert-success').html(jsonObj.error_messages).hide().slideDown();
                        $this.find('.fbody').hide();
                    }else{
                        $this.find('.alert-warning').html(jsonObj.error_messages).hide().slideDown();
                    }
                });

            });
        });
    });

</script>
