
<style type="text/css">
    .alert{ padding:6px 10px; margin-top:10px}
    .alert-warning{display:none;}
    .alert-success{display:none;}
    .alert-warning ul{
        margin-bottom: 0px !important;
    }
</style>
<form method="post" action="{{url($bUrl.'/store')}}" enctype="multipart/form-data" id="edit">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <input type="hidden" class="datepickerNone">
            <h4 class="m-0" style="margin: 0 !important; font-size: 19px; font-weight: bold" > <i class="fa fa-edit"></i> {{$title}} </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <div class="col-md-12">
                    <div id="error_message"></div>
                    <div class="alert alert-warning" role="alert">&nbsp;</div>
                    <div class="alert alert-success" role="alert">&nbsp;</div>
                    <input type="hidden"  value="{{ getValue($tableID, $objData) }}" id="id" name="{{$tableID}}">


                    <div class="form-group row">
                        <div class="col-sm-6">
                            @php
                                $input_name = 'name';
                            @endphp
                            <label for="{{$input_name}}" class="col-sm-12 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code> </label>
                            <input type="text" value="{{ getValue($input_name, $objData) }}" id="{{$input_name}}" name="{{$input_name}}"  class="form-control  @error($input_name) is-invalid @enderror ">
                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                        </div>
                        <div class="col-sm-6">
                            @php
                                $input_name = 'order_by';
                            @endphp
                            <label for="{{$input_name}}" class="col-sm-12 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} </label>
                            <input type="text" value="{{ getValue($input_name, $objData) }}" id="{{$input_name}}" name="{{$input_name}}"  class="form-control onlyNumber @error($input_name) is-invalid @enderror ">

                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @php
                $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
            @endphp
            <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" id="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Update</button>&nbsp;&nbsp;
            <button type="button"  data-reload="true" class="btn btn-secondary dismiss" data-bs-dismiss="modal">Close</button>
        </div>
</form>



<script>
    $(function(){
        $('form#edit').each(function(){
            $this = $(this);
            $this.find('#submit').on('click', function(event){
                event.preventDefault();
                $.ajax({
                    url:"{{url($bUrl.'/store')}}",
                    type : 'POST',
                    data : $this.serialize(),
                    success:function (response) {
                        $('#submit').prop( "disabled", false );
                        $('#submit').html('<i class="fas fa-sync-alt"></i> Update')
                        if (response == 'success'){
                            $this.find('.alert-success').html('Successfully Updated').hide().slideDown();
                            $this.find('.fbody').hide();
                            $('.alert-warning').hide();
                        }else{
                            var html = '<ul>'
                            $.each(response, function(index, item) {
                                html += '<li>'+item +'</li>'
                            });
                            html +='</ul>'
                            $('.alert-warning').html(html).hide().slideDown();
                            $('.alert-success').hide();
                        }
                    }
                })

            });
        });
        $('.onlyNumber').on('keyup', function (e) {
            if (/\D/g.test(this.value)) {
                this.value = this.value.replace(/\D/g, '');
            }
        });
    });
</script>
