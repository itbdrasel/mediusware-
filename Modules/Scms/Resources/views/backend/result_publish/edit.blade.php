
<style type="text/css">
    .alert{ padding:6px 10px; margin-top:10px}
    .alert-warning{display:none;}
    .alert-success{display:none;}
    .alert-warning ul{
        margin-bottom: 0px !important;
    }
</style>

<form class="mb-0" method="post" action="{{url($bUrl.'/store')}}" enctype="multipart/form-data" id="crud">
    @csrf
    <div class="modal-header">
        <h4 class="m-0" style="margin: 0 !important; font-size: 19px; font-weight: bold" > {!! $page_icon !!} {{$title}} </h4>
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
                                $input_name = 'exam_id';
                            @endphp
                            <label for="{{$input_name}}" class="col-sm-12 col-form-label"> {{ucfirst(str_replace(['_id','_'],' ',$input_name))}} <code>*</code> </label>
                            <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                @if(!empty($exams))
                                    @foreach($exams as $value)
                                        <option {{(getValue($input_name, $objData) ==$value->id)?'selected':''}} value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                        </div>
                        <div class="col-sm-6">
                            @php
                                $input_name = 'year';
                            @endphp
                            <label for="{{$input_name}}" class="col-sm-12 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                            <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                            @php
                                $year           = substr(getValue($input_name, $objData),5,9)-6;
                                $year_2         = $year+1;
                            @endphp
                            @for($x = 0; $x <= 10; $x++)
                                @php
                                    $y = $year + $x;
                                    $y_2 = $year_2 + $x;
                                    $format_year = $y.'-' .$y_2;
                                @endphp
                                <option {{(getValue($input_name, $objData, getRunningYear()) ==$format_year)?'selected':''}} value="{{$format_year}}">{{getFormatYear($format_year)}}</option>
                            @endfor
                            </select>
                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="submit" class="btn btn-primary">@if (empty(getValue($tableID, $objData)))<i class="fas fa-save"></i> Save @else <i class="fas fa-sync-alt"></i> Update @endif</button>&nbsp;&nbsp;
        <button type="button"  data-reload="true" class="btn btn-secondary dismiss" data-bs-dismiss="modal">Close</button>
    </div>
</form>

<script>
    $(function(){
        $('form#crud').each(function(){
            $this = $(this);
            $this.find('#submit').on('click', function(event){
                event.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url:"{{url($bUrl.'/store')}}",
                    type : 'POST',
                    data : $this.serialize(),
                    beforeSend:function(){
                        getBeforeSendCrudBtn('#submit')
                    },
                    success:function (response) {
                        $('#blankModal').modal('hide')
                        toastr.success(response);
                        $('#tableData').load(location.href)
                    },error:function (err) {
                        getCrudBtn(id, '#submit')
                        getCrudErrorMessage(err);
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
