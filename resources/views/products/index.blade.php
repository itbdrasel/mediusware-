@extends('layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>


    <div class="card">
        <form action="" method="get" class="card-header">
            <div class="form-row justify-content-between">
                <div class="col-md-2">
                    <input type="text" name="title" placeholder="Product Title" class="form-control">
                </div>
                <div class="col-md-2">
                    <select name="variant" class="form-control">
                        <optgroup  label="-- Select A Variant--" >
                            <option value="">-- Select A Variant --</option>
                        </optgroup>
                        @if($variants->isNotEmpty())
                            @foreach($variants as $variant)
                                <optgroup label="{{$variant->title}}">
                                    @if($variant->productVariants->isNotEmpty())
                                        @foreach($variant->productVariants->unique('variant') as $productVariant)
                                            <option value="{{$productVariant->variant}}">{{$productVariant->variant}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            @endforeach
                        @endif

                    </select>

{{--                    <select name="variant" id="" class="form-control">--}}
{{--                        <option></option>--}}

{{--                    </select>--}}
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Price Range</span>
                        </div>
                        <input type="text" name="price_from" aria-label="First name" placeholder="From" class="form-control">
                        <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date" placeholder="Date" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-response">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th width="150px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php
                        $sl = $serial;
                    @endphp
                    @if($products->isNotEmpty())
                        @foreach($products as $product)
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td>{{$product->title}} <br> Created at : {{date('d-M-Y', strtotime($product->created_at))}}</td>
                        <td>{!! Str::words($product->description, 5, ' ...') !!}</td>
                        <td>
                            <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">
                                @if($product->productVariantPrice->isNotEmpty())
                                  @foreach($product->productVariantPrice as $productVariantPrice)
                                <dt class="col-sm-3 pb-0">
                                    {{$productVariantPrice->variantOne->variant??''}}/ {{$productVariantPrice->variantTwo->variant??''}}
                                    {{!empty($productVariantPrice->variantThreee)?'/ '.$productVariantPrice->variantThreee->variant:''}}
                                </dt>
                                <dd class="col-sm-9">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4 pb-0">Price : {{ number_format($productVariantPrice->price,2) }}</dt>
                                        <dd class="col-sm-8 pb-0">InStock : {{ number_format($productVariantPrice->price,2) }}</dd>
                                    </dl>
                                </dd>
                                    @endforeach
                                @endif
                            </dl>
                            <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show more</button>
                        </td>

                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-success">Edit</a>
                            </div>
                        </td>
                    </tr>
                        @endforeach
                    @endif
                    </tbody>

                </table>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-9">
                        <div class="pagination_table" style="float: right">
                            {!! $products->render() !!}
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <p>{{getDataTablesInfo($products, $serial, $sl)}}</p>
                </div>
                <div class="col-md-2">

                </div>
            </div>
        </div>
    </div>

    @php
    function getDataTablesInfo($products, $serial, $sl){
        $Showing = $products->total()>0?$serial+1:0;
        return 'Showing '.$Showing. ' to '.$sl.' out of '. $products->total();
    }
    @endphp

@endsection
