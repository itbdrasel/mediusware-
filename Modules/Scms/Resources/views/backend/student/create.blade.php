@extends("core::master")
@section("content")
    <section class="content from_body">
        <!-- Default box -->
        <div class="row">

            <div class="col-md-12">
				<form action="{{url($bUrl.'/store')}}" method="post">
                    @csrf
                    <input type="hidden" id="" name="id" value="{{getValue('id', $objData)}}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-gray">
                                <div class="card-header">
                                    <h2 class="card-title"> {!! $page_icon !!} &nbsp; Student  General Info</h2>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body mt-4">
                                    {{ validation_errors($errors) }}
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'name';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}<code> *</code></label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'phone';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}<code> *</code></label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        @php
                                            $input_name = 'gender_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}<code> *</code></label>

                                        <div class="col-sm-8">
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
                                        <label  class="col-sm-4 col-form-label text-capitalize">Date of Birth</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ dateFormat(getValue($input_name, $objData))}}" autocomplete="off" class="form-control dateOfBirth @error($input_name) is-invalid @enderror" placeholder="{{getPlaceholderDate()}}" readonly>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'religion_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                        <div class="col-sm-8">
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
                                    </div>


                                    <div class="form-group row">
                                        @php
                                            $input_name = 'blood_group_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                        <div class="col-sm-8">
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




                                </div>
                            </div>

                            <div class="card card-gray">
                                <div class="card-header">
                                    <h2 class="card-title"> {!! $page_icon !!} &nbsp; Student  Class Info</h2>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body mt-4">


                                    <div class="form-group row">
                                        @php
                                            $input_name = 'id_number';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}<code> *</code></label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        @php
                                            $input_name = 'class_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}<code> *</code></label>

                                        <div class="col-sm-8">
                                            <select id="{{$input_name}}" onchange="classBySections()" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
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
                                            $input_name = 'section_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}<code> *</code></label>

                                        <div class="col-sm-8">
                                            <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                                <option value=""> Select Section </option>
                                            </select>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        @php
                                            $input_name = 'class_roll';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace('_',' ',$input_name)}}</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        @php
                                            $input_name = 'group_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}<code> *</code></label>

                                        <div class="col-sm-8">
                                            <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                                <option value=""> Select Groups </option>
                                                @if (!empty($groups))
                                                    @foreach ($groups as $value)
                                                        <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        @php
                                            $input_name = 'shift_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}} </label>

                                        <div class="col-sm-8">
                                            <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                                <option value=""> Select Shift </option>
                                                @if (!empty($shifts))
                                                    @foreach ($shifts as $value)
                                                        <option {{getValue($input_name, $objData)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-gray">
                                <div class="card-header">
                                    <h2 class="card-title"> {!! $page_icon !!} &nbsp; Parent Info</h2>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body mt-4">
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'father_name';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Father's Name<code> *</code></label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'father_contact';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Father's Contact </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'father_profession';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Father's Profession </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'mother_name';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Mother Name<code> *</code></label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'mother_contact';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Mother Contact</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'mother_profession';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Mother Profession </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-gray">
                                <div class="card-header">
                                    <h2 class="card-title"> {!! $page_icon !!} &nbsp; Guardian Info</h2>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body mt-4">
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'guardian_name';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Name<code> *</code></label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'guardian_phone';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Phone<code> *</code></label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'guardian_email';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">E-mail</label>
                                        <div class="col-sm-8">
                                            <input type="email" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'guardian_address';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Address</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'guardian_professiongit ';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-4 col-form-label text-capitalize">Profession</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ getValue($input_name, $objData)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-footer">
                                    <div class="offset-md-4 col-sm-8">
                                        @php
                                            $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                        @endphp
                                        <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>&nbsp;
                                        <a href="{{url($bUrl)}}" class="btn btn-warning">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

				</form>
	</div>
 </div>
</section>

@endsection

@push('js')
    <script>
            function classBySections() {
                let class_id    = $('#class_id').val();
                var _token      = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:"{{url('scms/ajax/class-by-sections')}}",
                    type: 'POST',
                    data: { _token : _token, class_id : class_id  },
                    success:function (response) {
                        if (response !=false){
                            let html = '<option value=""> Select Section </option>';
                            for (var i = 0; i < response.length; i++) {
                                html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                            }
                            $('#section_id').html(html);
                        }
                    }
                });
            }
    </script>

@endpush
