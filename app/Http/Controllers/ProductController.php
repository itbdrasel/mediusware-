<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    protected $data;
    protected $title;
    protected $model;


    public function __construct(){
        $this->model     = Product::class;
    }


    public function layout($pageName){
        echo view( 'products.'.$pageName, $this->data);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        /** get variant & Product Variants **/
        $variants = Variant::with(['productVariants' => function ($query) {
//            $query->groupBy('variant');
            }])
            ->get()->filter();


        /** product query */
        $perPage = 10;
        $productsQuery   = $this->model::with('productVariantPrice', 'productVariantPrice.variantOne', 'productVariantPrice.variantTwo', 'productVariantPrice.variantThree');

        /** Product Filtering Request Variable  */
        $productTitle   = request()->get('title');
        $variant        = request()->get('variant');
        $priceFrom      = request()->get('price_from');
        $priceTo        = request()->get('price_to');
        $date           = request()->get('price_to');

        /** Product Filtering Request Query  */
        if ($productTitle){
            $productsQuery->where('title', 'like', '%'.$productTitle.'%');
        }
        if ($date){
            $productsQuery->whereDate('created_at',date('Y-m-d', strtotime($date)));
        }
        if ($variant){
            $productsQuery->whereHas('productVariants', function ($query) use ($variant){
                $query->where('variant', $variant);
            });
        }
        if ($priceFrom && $priceTo){
            $productsQuery->whereHas('productVariantPrice', function ($query) use ($priceFrom, $priceTo){
                $query->whereBetween('price', [$priceFrom, $priceTo]);
            });
        }

        /** get Products  */
        $products = $productsQuery->paginate($perPage)->appends( request()->query() );

        $this->data = [
            'variants'      => $variants,
            'products'      => $products,
            'serial'        => ( (request()->get('page') ?? 1)-1) * $perPage
        ];

        return $this->layout('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name'          => 'required',
            'product_sku'           => 'required',
            'product_description'   => 'required',
        ];
        $attribute = [
            'product_sku'           => 'product SKU',
            'product_description'   => 'description',
        ];
        $request->validate($rules,[], $attribute);

        $productData = [
            'title'         => $request['product_name'],
            'sku'           => $request['product_sku'],
            'description'   => $request['product_description'],
        ];

        $productId = $this->model::create($productData)->id;
        $productVariants = $request['product_variant'];
        if ($productVariants){
            foreach ($productVariants as $key=>$productVariant){
                $values = $productVariant['value'];
                if ($values){
                    $variantId = $productVariant['option'];
                    foreach ($values as $value){
                        $variantData = [
                            'variant'       => $value,
                            'variant_id'    => $variantId,
                            'product_id'    => $productId,
                        ];
                        ProductVariant::create($variantData);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Product Saved');

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
