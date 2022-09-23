
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
            <h4 class="modal-title" id="myModalLabel"> {{$title}} </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <div class="col-md-12">
                    <div id="error_message"></div>
                    <div class="alert alert-warning" role="alert">&nbsp;</div>
                    <div class="alert alert-success" role="alert">&nbsp;</div>
                    <input type="hidden"  value="{{ getValue($tableID, $objData) }}" id="id" name="{{$tableID}}">


                    <div class="input-group mb-3">
                        @php
                            $input_name = 'name';
                        @endphp
                        <label for="guest_type_title" class="w-100">{{ucfirst(str_replace('_',' ',$input_name))}}<code>*</code></label>
                        <input type="text" value="{{ getValue($input_name, $objData) }}" id="{{$input_name}}" name="{{$input_name}}"  class="form-control  @error($input_name) is-invalid @enderror ">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                    </div>
                    <div class="input-group mb-3">
                        @php
                            $input_name = 'slug';
                        @endphp
                        <label for="guest_type_title" class="w-100">{{ucfirst(str_replace('_',' ',$input_name))}}<code>*</code></label>
                        <input type="text" value="{{ getValue($input_name, $objData) }}" id="{{$input_name}}" name="{{$input_name}}"  class="form-control  @error($input_name) is-invalid @enderror ">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                    </div>
                    <div class="input-group mb-3">
                        @php
                            $input_name = 'status';
                        @endphp
                        <label for="guest_type_title" class="w-100">{{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                        <select name="{{$input_name}}"  class="form-control">
                            <option {{(getValue($input_name, $objData) ==1 )?'selected':''}} value="1">Active</option>
                            <option {{(getValue($input_name, $objData) ==0)?'selected':''}} value="0">Inactive</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="modal-footer">

            <button type="submit" id="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;
            <button type="button"  data-reload="true" class="btn btn-secondary dismiss" data-dismiss="modal">Close</button>
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
    });
</script>
