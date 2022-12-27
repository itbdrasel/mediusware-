@extends("core::master")
@section("content")
    <section class="content from_body">
        <!-- Default box -->
        <div class="row">

            <div class="col-md-12">
                <form action="{{url($bUrl.'/store')}}" method="post">
                    <div class="card  card-outline card-primary">
                        <div class="card-header">
                            <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }}  </h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <button type="button" class="btn btn-tool" >
                                    <a href="{{url($bUrl)}}" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back</a>
                                </button>
                            </div>
                        </div>


                        <div class="card-body mt-4">
                            <div class="pl-3 col-11">

                                @csrf
                                <input type="hidden" id="" name="id" value="{{getValue('id', $objData)}}">
                                {{ validation_errors($errors) }}

                                <div class="form-group row">
                                    @php
                                        $input_name = 'name';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}<code>*</code></label>

                                    <div class="col-sm-4">
                                        <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'subject_code';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}</label>

                                    <div class="col-sm-4">
                                        <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    @php
                                        $input_name = 'subject_type';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}<code>*</code></label>

                                    <div class="col-sm-4">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                            @if (!empty($subject_types))
                                                @foreach ($subject_types as $value)
                                                    <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'class_id';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_id','_'],['',' '],$input_name)}}<code>*</code></label>
                                    <div class="col-sm-4">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="select2 form-select @error($input_name) is-invalid @enderror" >
                                            <option value=""> Select Class </option>
                                            @if (!empty($allClass))
                                                @foreach ($allClass as $value)
                                                    <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @php
                                        $input_name = 'teacher_id';
                                    @endphp
                                    <label for="{{$input_name}}" class=" col-sm-2 col-form-label text-capitalize">{{str_replace(['_id','_'],['',' '],$input_name)}}<code>*</code></label>

                                    <div class="col-sm-4">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="select2 form-select @error($input_name) is-invalid @enderror" >
                                            <option value=""> Select {{str_replace(['_id','_'],['',' '],$input_name)}} </option>
                                            @if (!empty($teachers))
                                                @foreach ($teachers as $value)
                                                    <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'religion_id';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_id','_'],['',' '],$input_name)}}</label>
                                    <div class="col-sm-4">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                            <option value=""> Select {{str_replace(['_id','_'],['',' '],$input_name)}} </option>
                                            @if (!empty($religions))
                                                @foreach ($religions as $value)
                                                    <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @php
                                        $input_name = 'group_id';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_id','_'],['',' '],$input_name)}}</label>

                                    <div class="col-sm-4">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                            <option value=""> Select {{str_replace(['_id','_'],['',' '],$input_name)}} </option>
                                            @if (!empty($groups))
                                                @foreach ($groups as $value)
                                                    <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'gender_id';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_id','_'],['',' '],$input_name)}}</label>
                                    <div class="col-sm-4">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                            <option value=""> Select {{str_replace(['_id','_'],['',' '],$input_name)}} </option>
                                            @if (!empty($genders))
                                                @foreach ($genders as $value)
                                                    <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    @php
                                        $input_name = 'subject_parent_id';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">Relative Subject</label>

                                    <div class="col-sm-4">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="select2 form-select @error($input_name) is-invalid @enderror" >
                                            <option value=""> Select Relative Subject </option>
                                            @if (!empty($relative_subjects))
                                                @foreach ($relative_subjects as $value)
                                                    <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'full_marks';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_id','_'],['',' '],$input_name)}}</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control number @error($input_name) is-invalid @enderror" >
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @php
                                        $input_name = 'status';
                                        $status = [1=>'Active', '0'=>'Inactive'];
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}<code>*</code></label>

                                    <div class="col-sm-4">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                            @if (!empty($status))
                                                @foreach ($status as $key=>$value)
                                                    <option {{getValue($input_name, $objData)===$key?'selected':''}}  value="{{$key}}"> {{$value}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'order_by';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_id','_'],['',' '],$input_name)}}</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control number @error($input_name) is-invalid @enderror" >
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <!-- /.login-card-body -->
                        <div class="card-footer">
                            <div class="offset-md-4 col-sm-8">
                                @php
                                    $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                @endphp
                                <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>&nbsp;
                                <a href="{{url($bUrl)}}" class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </form>
            </div>
        </div>
    </section>

@endsection
