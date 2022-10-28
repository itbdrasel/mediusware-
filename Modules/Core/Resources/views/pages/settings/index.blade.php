@push('css')
    <style type="text/css">
        #settings .tab-content{ padding: 20px 10px;}
        #settings .nav-tabs .nav-link{ background: none; font-weight: bold; color: #666; outline: none;}
        #settings .nav-tabs .nav-link:hover{ border-color: white; border-bottom: 1px solid #1e2e8b;}
        #settings .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
            border: none;
            border-bottom: 1px solid #1e2e8b;
            color: #1e2e8b !important;
        }

        legend {
            font-size: 19px !important;
            font-weight: bold;
            color: #666;
            border-bottom: 1px solid #e5e5e5;
            display: block;
            width: 100%;
            padding: 0;
            margin-bottom: 20px !important;
            line-height: inherit;
        }
    </style>
@endpush
@extends("core::master")
@section("content")
    <!-- Main content -->

    <section class="content">
        <form method="post" action="{{url($bUrl.'/store')}}" enctype="multipart/form-data" >
        @csrf
        <!-- Default box -->
            <div class="card card-outline card-info">
                <div class="card-body" id="settings">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true"> General </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="true"> Contact Information </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tax-tab" data-bs-toggle="tab" data-bs-target="#tax" type="button" role="tab" aria-controls="tax" aria-selected="false">Tax</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="meta-tab" data-bs-toggle="tab" data-bs-target="#meta" type="button" role="tab" aria-controls="meta" aria-selected="false">Meta Settings</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="payment" aria-selected="false">Payment</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab" aria-controls="social" aria-selected="false">Social Networks</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="logo-tab" data-bs-toggle="tab" data-bs-target="#logo" type="button" role="tab" aria-controls="logo" aria-selected="false">Logo Upload</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="col-sm-8"> {!! validation_errors($errors) !!}</div>

                        <!-- General Setting  -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">App Name <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['appName']}}" name="app_name"class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">App URL <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['url']}}" name="app_url" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Currency Symbol <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['c_symbol']}}" name="currency_symbol" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Currency Order <code>*</code></label>
                                    <div class="col-sm-8">
                                        <select class="form-control"  name="currency_order">
                                            <option {{config('settings')['c_order']=='left'?'selected':''}} value="left">left</option>
                                            <option {{config('settings')['c_order']=='right'?'selected':''}} value="right">right</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Date Format <code>*</code></label>
                                    <div class="col-sm-8">
                                        @php
                                            $year = date('Y')-1;
                                        @endphp
                                        <select class="form-control"  name="date_format">
                                            <option {{config('settings')['date_format']=='d-m-Y'?'selected':''}} value="d-m-Y">30-12-{{$year}} (d-m-Y)</option>
                                            <option {{config('settings')['date_format']=='Y-m-d'?'selected':''}} value="Y-m-d">{{$year}}-12-30 (Y-m-d)</option>
                                            <option {{config('settings')['date_format']=='d/m/Y'?'selected':''}} value="d/m/Y">30/12/{{$year}} (d/m/Y)</option>
                                            <option {{config('settings')['date_format']=='Y/m/d'?'selected':''}} value="Y/m/d">{{$year}}/12/30 (Y/m/d)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">USD Rate <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['usd_rate']}}" name="usd_rate" class="form-control number">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Analytics <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['analytics']}}" name="analytics" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Language <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['language']}}" name="language" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- Contact Setting  -->
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">E-mail <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['email']}}" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">App Address <code>*</code></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="3" name="app_address" >{{config('settings')['appAddress']}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Contact <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['contact']}}" name="contact" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tax Setting  -->
                        <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="tax-tab">
                            @if (!empty($allTex))
                                @foreach($allTex as $key=>$tax)
                                    <div class="col-sm-8" id="remove_div_1{{$key}}">
                                        <div class="form-group row">
                                            <input type="hidden" name="tax_id[]" value="{{$tax->tax_id}}">
                                            <label  class="col-sm-3 col-form-label">{{$key <1?'Tax Settings':''}} </label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Tax Name" value="{{$tax->tax_name }}" name="tax_name[]" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$tax->tax_percent }}" placeholder="Tax percent" name="tax_percent[]" class="form-control onlyNumber">
                                            </div>
                                            <div class="col-sm-1">
                                                @if($key <1)
                                                    <a style="cursor: pointer" class="input_add btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                @else
                                                    <a style="cursor: pointer" onclick="removeDiv('{{$key}}')" class="input_remove btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div id="tex_data"></div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Default Tax Rate </label>
                                    <div class="col-sm-7">
                                        <select class="form-control"  name="default_tax">
                                            <option {{config('settings')['default_tax']=='none'?'selected':''}}  value="none">No Tax</option>
                                            @if (!empty($allTex))
                                                @foreach($allTex as $key=>$tax)
                                                    <option {{config('settings')['default_tax']==$tax->tax_percent?'selected':''}} value="{{$tax->tax_percent }}">{{$tax->tax_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label"> </label>
                                    <div class="col-sm-4">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="include_tax" type="checkbox" id="include_tax"  {{config('settings')['include_tax']==1?'checked':''}} value="{{config('settings')['include_tax']?config('settings')['include_tax']:1}}">
                                            <label for="include_tax" class="custom-control-label">Prices include Tax</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="only_default_tax" type="checkbox" {{config('settings')['only_default_tax']==1?'checked':''}}  id="only_default_tax" value="{{config('settings')['only_default_tax']?config('settings')['only_default_tax']:1}}">
                                            <label for="only_default_tax" class="custom-control-label">Apply only default tax on sales</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Meta Setting  -->
                        <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">
                            <div class="col-sm-9">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">App Title <code>*</code></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{config('settings')['appTitle']}}" name="app_title" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-9">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">App Description <code>*</code></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="3" name="description" >{{config('settings')['description']}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Setting  -->
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            @php

                                function paymentChecked($payment,$name){
                                    $paymentData = json_decode($payment);
                                    if (isset($paymentData->$name) && !empty($paymentData->$name)) {
                                        return 'checked=""';
                                    }
                                }

                            @endphp
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" name="paypal" {{paymentChecked($payment,'paypal')}} id="payPal" value="1">
                                    <label for="payPal" class="mr-5">PayPal</label>
                                </div>
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" name="stripe" {{paymentChecked($payment,'stripe')}} id="stripe" value="1">
                                    <label for="stripe" class="mr-5">stripe</label>
                                </div>
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" name="sslcommerz" {{paymentChecked($payment,'sslcommerz')}} id="sslcommerz" value="1">
                                    <label for="sslcommerz">SSLCOMMERZ</label>
                                </div>
                            </div>

                        </div>
                        <!-- Social Media Setting  -->
                        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <div class="col-sm-8" id="social_aria">

                                @php
                                    $social_all = json_decode($social);
                                @endphp
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Network Name </label>
                                    <div class="col-sm-3">
                                        <input type="text" placeholder="Network Name" value="{{$social_all[0]->network_name??''}}" name="network_name[]" class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" value="{{$social_all[0]->network_link??''}}" placeholder="Network Link" name="network_link[]" class="form-control">
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
                                            <div class="form-group row" id="remove_div_{{$sl}}">
                                                <label  class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Network Name" value="{{$value->network_name??''}}" name="network_name[]" class="form-control">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{$value->network_link??''}}" placeholder="Network Link" name="network_link[]" class="form-control">
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

                        <!-- Logo Upload Setting  -->
                        <div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                            <div class="col-sm-9">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">App Logo</label>
                                    <div class="col-sm-2">
                                        <img class="img-thumbnail" height="75" src="{{config('settings')['logo']}}" />
                                    </div>
                                    <div class="col-sm-4">
                                        <a id="action" style="margin-top: 25px" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#windowmodal" href="{{url($bUrl.'/logo/')}}"> Upload Logo</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <div class="offset-md-1 col-sm-9">
                        <button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;
                        <a href="{{url($bUrl)}}"  class="btn btn-warning">Cancel</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </form>

    </section>
    <!-- /.content -->


    <!-- Modal -->
    @include('core::layouts.include.modal')

@endsection

@push('js')
    <script>
        $(document).ready(function(){

            $('#settingsTab button').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $("#settingsTab button[data-bs-toggle='tab']").on("shown.bs.tab", function(e) {

                if($(e.target).attr('id') === 'logo-tab') $('.card-footer').hide();
                else $('.card-footer').show();
                localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
            });

            var activeTab = localStorage.getItem('activeTab');

            if (activeTab) {
                $('#settingsTab button[data-bs-target="'+activeTab+'"]').tab('show');
            }
        });
    </script>
    <script type="text/javascript">
        var total = {{count($allTex)}}
        $('.input_add').on('click', function () {
            var html ='' +
                '<div class="col-sm-8" id="remove_div_1'+total+'">' +
                '<input type="hidden" name="tax_id[]" value="">' +
                '<div class="form-group row">' +
                ' <label  class="col-sm-3 col-form-label"></label>' +
                '<div class="col-sm-4">' +
                '<input type="text" value="" placeholder="Tex Name" name="tax_name[]" class="form-control">' +
                '</div>' +
                '<div class="col-sm-3">' +
                '<input type="text" value="" placeholder="Tax percent" name="tax_percent[]" class="form-control onlyNumber">' +
                '</div>' +
                '<div class="col-sm-1">' +
                '<a style="cursor: pointer" onclick="removeDiv('+total+')"  class="input_remove btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>' +
                '</div>' +
                '</div>' +
                '</div>';
            $('#tex_data').append(html);
            total++
        })
        function removeDiv(id) {
            $('#remove_div_1'+id).remove();
        }
    </script>

    <script type="text/javascript">
        count = {{count($social_all??[])}};
        $('.input_add').on('click', function () {
            var html ='' +
                '<div class="form-group row" id="remove_div_'+count+'">' +
                '<label  class="col-sm-3 col-form-label"></label>' +
                '<div class="col-sm-3">' +
                '<input type="text" placeholder="Network Name" value="" name="network_name[]" class="form-control">' +
                '</div>' +
                '<div class="col-sm-4">' +
                ' <input type="text" value="" placeholder="Network Link" name="network_link[]" class="form-control">' +
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
