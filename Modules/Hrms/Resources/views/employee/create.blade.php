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
									<label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}<code> *</code></label>

									<div class="col-sm-4">
                                        <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
									</div>
                                    @php
                                        $input_name = 'id_number';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label">{{str_replace('_',' ',$input_name)}}<code> *</code></label>

                                    <div class="col-sm-4">
                                        <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
								</div>


                            <div class="form-group row">
                                @php
                                    $input_name = 'father_name';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'mother_name';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror"
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'mobile';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}<code> *</code></label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'email';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}<code> *</code></label>


                                <div class="col-sm-4">
                                    <input type="email" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'birth_date';
                                @endphp
                                <label  class="col-sm-2 col-form-label text-capitalize">Date of Birth</label>
                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ dateFormat(getValue($input_name, $objData))}}" autocomplete="off" class="form-control dateOfBirth @error($input_name) is-invalid @enderror" placeholder="{{getPlaceholderDate()}}" readonly>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'joining_date';
                                @endphp
                                <label class="col-sm-2 col-form-label">Joining Date</label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ dateFormat(getValue($input_name, $objData))}}" autocomplete="off" class="form-control dateOfBirth @error($input_name) is-invalid @enderror" placeholder="{{getPlaceholderDate()}}" readonly>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'religion_id';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                        <option value=""> Select {{str_replace(['_','id'],' ',$input_name)}} </option>
                                        @if (!empty($religions))
                                            @foreach ($religions as $value)
                                                <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'blood_group_id';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                        <option value=""> Select {{str_replace(['_','id'],' ',$input_name)}} </option>
                                        @if (!empty($blood_groups))
                                            @foreach ($blood_groups as $value)
                                                <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'nid';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','_id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'gender_id';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}<code> *</code></label>

                                <div class="col-sm-4">
                                    <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                        <option value=""> Select Gender </option>
                                        @if (!empty($genders))
                                            @foreach ($genders as $gender)
                                                <option {{getValue($input_name, $objData)==$gender->id?'selected':''}}  value="{{$gender->id}}"> {{$gender->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'department_id';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}} <code>*</code></label>

                                <div class="col-sm-4">
                                    <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                        <option value=""> Select {{str_replace(['_','id'],' ',$input_name)}} </option>
                                        @if (!empty($departments))
                                            @foreach ($departments as $value)
                                                <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'designation_id';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                        <option value=""> Select {{str_replace(['_','id'],' ',$input_name)}} </option>
                                        @if (!empty($designation))
                                            @foreach ($designation as $value)
                                                <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'basic_salary';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','_id'],' ',$input_name)}} <code>*</code></label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control number @error($input_name) is-invalid @enderror" >
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'total_salary';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control number @error($input_name) is-invalid @enderror"
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'picture';
                                @endphp
                                <label  class="col-sm-2 col-form-label text-capitalize">Profile Picture </label>

                                <div class="col-sm-3 position-relative">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text"   readonly value="{{ getValue($input_name, $objData)}}" data-multiple="no" id="{{$input_name}}" name="{{$input_name}}"  class="form-control featured_image">
                                        <div class="input-group-text">
                                            <a class="featured_tag" data-id="{{$input_name}}" style="cursor: pointer" ><span class="fa fa-image"></span></a>
                                        </div>
                                    </div>
                                    <span id="{{$input_name}}_preview" data-input_id="{{$input_name}}" style="position:absolute; top:0%; left:102%; width:250px" class="preview"></span>
                                </div>
                                <div class="col-sm-1"></div>
                                @php
                                    $input_name = 'document';
                                @endphp
                                <label class="col-sm-2 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror"
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                @php
                                    $input_name = 'present_address';
                                @endphp
                                <label  class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}} </label>

                                <div class="col-sm-4">
                                    <textarea name="{{$input_name}}" id="{{$input_name}}" class="form-control @error($input_name) is-invalid @enderror" rows="2" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 100px;">{{ getValue($input_name, $objData) }}</textarea>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'permanent_address';
                                @endphp
                                <div class="col-sm-2">
                                    <label class="col-sm-12 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}</label>
                                    <input type="checkbox" id="address_equity" onclick="check_address_equity(this.value)" name="address_equity" value="0" {{ old('address_equity') == 1 ? 'checked' : '' }} style="position: absolute; width: 20px; height: 20px; margin-top: 5px">
                                    <label for="address_equity" style="margin-left: 23px">
                                        Same as Present Address
                                    </label>
                                </div>

                                <div class="col-sm-4">
                                    <textarea name="{{$input_name}}" id="{{$input_name}}" class="form-control @error($input_name) is-invalid @enderror" rows="2" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 100px;">{{ getValue($input_name, $objData) }}</textarea>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>


                            <div class="form-group row">

                                @php
                                    $input_name = 'social_media';
                                @endphp
                                @php
                                    $social_all = json_decode(getValue($input_name, $objData));
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','_id'],' ',$input_name)}}</label>

                                <div id="social_aria" class="col-sm-4">
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <input type="text" placeholder="Media Name" value="{{$social_all[0]->media_name??''}}" name="media_name[]" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" value="{{$social_all[0]->media_link??''}}" placeholder="Media Link" name="media_link[]" class="form-control">
                                        </div>
                                        <div class="col-sm-1">
                                            <a style="cursor: pointer" class="input_add btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    @if (!empty($social_all))
                                        @php
                                            $sl =0;
                                        @endphp
                                        @foreach($social_all as $key=>$value )
                                            @if($sl++ >0)
                                                <div class="row mb-3" id="remove_div_{{$sl}}">
                                                    <div class="col-sm-4">
                                                        <input type="text" placeholder="Media Name" value="{{$value->media_name??''}}" name="media_name[]" class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" value="{{$value->media_link??''}}" placeholder="Media Link" name="media_link[]" class="form-control">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <a style="cursor: pointer" onclick="removeSocialDiv({{$sl}})"  class="input_remove btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
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

@push('js')
    <script>
        /// Address Equity ///
        function check_address_equity(value) {
            if(value == 0) {
                let present_address = $("#present_address").val();
                $("#permanent_address").val(present_address);
                $("#address_equity").val(1);
            } else {
                $("#permanent_address").val('');
                $("#address_equity").val(0);
            }
        }
    </script>
    <script type="text/javascript">
        count = {{count($social_all??[])}};
        $('.input_add').on('click', function () {
            var html ='' +
                '<div class="row mb-3" id="remove_div_'+count+'">' +
                '<div class="col-sm-4">' +
                '<input type="text" placeholder="Media Name" value="" name="media_name[]" class="form-control">' +
                '</div>' +
                '<div class="col-sm-6">' +
                ' <input type="text" value="" placeholder="Media Link" name="media_link[]" class="form-control">' +
                '</div>' +
                '<div class="col-sm-1">' +
                '<a style="cursor: pointer" onclick="removeSocialDiv('+count+')"  class="input_remove btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>' +
                '</div>' +
                '</div>';
            $('#social_aria').append(html);
            count++;
        })
        function removeSocialDiv(id) {
            $('#remove_div_'+id).remove();
        }
    </script>
@endpush
