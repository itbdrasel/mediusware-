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
                                    $input_name = 'tin';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                <div class="col-sm-4">
                                    <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror"
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
                                <label for="" class="col-sm-4 col-form-label">User Image </label>
                                <div class="col-sm-5 position-relative">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" readonly value="" data-multiple="no" id="user_image" name="featuredimage"  class="form-control featured_image">
                                        <div class="input-group-text">
                                            <a class="featured_tag" data-id="user_image" style="cursor: pointer" ><span class="fa fa-image"></span></a>
                                        </div>
                                    </div>
                                    <span id="user_image_preview" data-input_id="user_image" style="position:absolute; top:0%; left:102%; width:250px" class="preview"></span>
                                </div>


                            </div>
                            <div class="form-group row d-none" id="branch_aria">
                                @php
                                    $input_name = 'branch_id';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-4 col-form-label">Branch<code>*</code></label>
                                <div class="col-sm-8">
                                    <div class="input-group ">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                            <option value=""> Select User Branch </option>
{{--                                            @if (!empty($allBranch))--}}
{{--                                                @foreach ($allBranch as $branch)--}}
{{--                                                    <option {{getValue($input_name, $objData)==$branch->id?'selected':''}}  value="{{$branch->id}}"> {{$branch->name}} </option>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
                                        </select>
                                        <div class="input-group-text">
                                            <span class="fas fa-code-branch"></span>
                                        </div>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
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
							<button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-save"></i> Register User</button>&nbsp;
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
        $(document).ready(function () {
            activeBranch();
        })
        $('#role').on('change', function () {
            activeBranch();
        });
        function activeBranch() {
           let role = $('#role').val();
           if (role !=''){
               let activeBranch = $('#role').find(':selected').data('branch');
               if (activeBranch ==1){
                $('#branch_aria').removeClass('d-none');
               }else{
                   $('#branch_aria').addClass('d-none');
               }

           }else{
               $('#branch_aria').addClass('d-none');
           }
        }
    </script>
@endpush
