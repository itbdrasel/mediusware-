

<style type="text/css">
	.alert{ padding:6px 10px; margin-top:10px}
	.alert-warning{display:none;}
	.alert-success{display:none;}
	.alert-warning ul{
		margin-bottom: 0px !important;
	}
</style>
<form method="post" action="{{url($bUrl.'/update')}}" enctype="multipart/form-data" id="edit">
	@csrf
	<div class="modal-content">
		<div class="modal-header">
            <h4 class="m-0" style="margin: 0 !important; font-size: 19px; font-weight: bold" > <i class="fa fa-edit"></i> {{$title}} </h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="card-body">
				<div class="col-md-12">
					<div id="error_message"></div>
					<div class="alert alert-warning" role="alert">&nbsp;</div>
					<div class="alert alert-success" role="alert">&nbsp;</div>
					<input type="hidden"  value="{{ getValue('id', $objData) }}" id="id" name="id">

					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Full Name<code>*</code></label>
						<div class="col-sm-8">
							<div class="input-group">
							<input type="text" name="full_name" value="{{getValue('full_name', $objData) }}" id="full_name" class="form-control" placeholder="Your Name">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Email <code>*</code></label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="email" id="email" name="email" readonly value="{{getValue('email', $objData) }}" class="form-control" placeholder="Email">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
							</div>
						</div>
					</div>
                    <div class="form-group row">
                        @php
                            $input_name = 'user_name';
                        @endphp
                        <label for="{{$input_name}}" class="col-sm-4 col-form-label">User Name</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="{{$input_name}}" name="{{$input_name}}" readonly value="{{getValue($input_name, $objData) }}" class="form-control" placeholder="{{ucfirst(str_replace('_',' ',$input_name))}} ">
                                <div class="input-group-text">
                                    <span class="fas fa-user-clock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        @php
                            $input_name = 'phone';
                        @endphp
                        <label for="{{$input_name}}" class="col-sm-4 col-form-label">Phone Number</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="{{$input_name}}" name="{{$input_name}}" readonly value="{{getValue($input_name, $objData) }}" class="form-control" placeholder="{{ucfirst(str_replace('_',' ',$input_name))}} ">
                                <div class="input-group-text">
                                    <span class="fas fa-user-clock"></span>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="form-group row">
						<label class="col-sm-4 col-form-label">User Role <code>*</code></label>
						<div class="col-sm-8">
							<div class="input-group">
								<select id="role" name="role" class="form-select"  >
                                    <option value=""> Select User Role </option>
                                    @if (!empty($roles))
                                        @foreach ($roles as $role)
										<option {{($objData->role->role_id == $role->id )?'selected':''}} value=" {{ $role->id }}"> {{ $role->name }}</option>
									@endforeach
                                    @endif
								</select>
                                <div class="input-group-text">
                                    <span class="fas fa-user-circle"></span>
                                </div>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-4 col-form-label">User Status</label>
						<div class="col-sm-8">
							<div class="input-group">
								<select name="status" class="form-control"  >
									<option {{$objData->status==1?'selected':''}} value="1">Active</option>
									<option  {{$objData->status=='0'?'selected':''}}  value="0">Inactive</option>
								</select>
                                <div class="input-group-text">
                                    <span class="fas fa-ban"></span>
                                </div>
							</div>
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
			<button type="button"  data-reload="true" class="btn btn-secondary dismiss" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>


<script>
	$(function(){
		$('form#edit').each(function(){
			$this = $(this);
			$this.find('#submit').on('click', function(event){
				event.preventDefault();
				$.ajax({
					url:"{{url($bUrl.'/update')}}",
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
	});
</script>