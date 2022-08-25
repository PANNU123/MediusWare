<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        return $data = Product::with('product_variants')->latest()->get();
        if ($request->ajax()){
            if(!empty($request->title)){
                $data = Product::with('product_variants')->where('title', 'LIKE', "%$request->title%")->get();
            }elseif(!empty($request->priceFrom ) && !empty($request->priceTo )){
                $data = Product::with('product_variants')
                    ->whereBetween('price', [$request->priceFrom, $request->priceTo])
                    ->get();
            }elseif(!empty($request->date)){
                $date = Carbon::parse($request->date)->format('Y-m-d');
                $data = Product::with('product_variants')->whereDate('created_at', $date)->get();
            }
            else{
                $data = Product::with('product_variants')->latest()->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn ='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBlog">Edit</a>';
//                    $btn ='<a href="' . route('product.edit', $data->id) . '" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm">Edit</a>';
                    return $btn;
                })
                ->editColumn('Title', function ($data) {
                    return Str::limit($data->title, 15);
                })
                ->editColumn('Variant', function ($data) {
//                    return 'ok';
                    $html='';
//                    foreach($data->product_variants as $pv){
//                        $html= $html.'<span style="margin-left: 5px;font-size: 15px;color:white" class="badge bg-success">'.$pv->variant.'</span>';
//                    }
                    foreach($data->product_variants as $pv){
                        foreach($pv->variant as $item){
                            $html= $html.'<span style="margin-left: 5px" class="badge bg-success">'.$item.'</span>';
                        }

                    }
                    $price=$data->price;
                    $qty=$data->qty;
                    return 'Variant:'.$html .'<span style="margin-left: 5px; font-size: 15px;color:white" class="badge bg-primary">$'.$price.'</span>'.'<span style="margin-left: 5px; font-size: 15px;color:white" class="badge bg-danger">qty-'.$qty.'</span>';
                })
                ->editColumn('Price', function ($data) {
                    return $data->price;
                })
                ->editColumn('Quantity', function ($data) {
                    return $data->qty;
                })

                ->editColumn('Description', function ($data) {
                    return Str::limit($data->description, 15);
                })
                ->rawColumns(['action', 'Title','Variant','Description','Image'])
                ->make(true);
        }
        return view('products.index');
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
        if($request->ajax()){
            $pro=ProductImage::where('product_id',$request->id)->first();

            if (!empty($request->image)) {
                $image = fileUpload($request->image, product_image());
            }elseif (!empty($request->hidden_image)){
                $image = $pro->thumbnail;
            }else{
                return redirect()->back();
            }

            $product=Product::create([
                'title'=>$request->title,
                'sku'=>$request->sku,
                'description'=>$request->description,
                'price'=> $request->price,
                'qty'=> $request->qty,
            ]);
            if($product){
                $productImage =  ProductImage::create([
                    'product_id'=>$product->id,
                    'thumbnail'=>$image,
                ]);

                if($productImage){

                            $one = ProductVariant::create([
                                 'variant'=>$request->tag,
                                 'variant_id'=>$request->variant_one,
                                 'product_id'=>$product->id,
                             ]);
                            if($one){
                               $two = ProductVariant::create([
                                    'variant'=>$request->tags,
                                    'variant_id'=>$request->variant_two,
                                    'product_id'=>$product->id,
                                ]);
                               if ($two){
                                   ProductVariant::create([
                                       'variant'=>$request->tagss,
                                       'variant_id'=>$request->variant_two,
                                       'product_id'=>$product->id,
                                   ]);
                               }
                            }
                }
            }
        }
        return response()->json(['success' => true]);
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
//    public function edit($product)
//    {
////        return $product;
//        $variants = Variant::all();
//        $edit=Product::with('product_variants','images')->where('id',$product)->first();
//        return view('products.edit', compact('variants','edit'));
//    }
    public function edit($id){
        // $blog_edit=Product::with('product_variants','images')->where('id',$id)->first();
        $blog_edit = Product::with('product_variants','product_variants.variant','images')->where('id',$id)->first();
        return response()->json($blog_edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request)
    {
        if($request->ajax()){
            $pro=ProductImage::where('product_id',$request->id)->first();

            if (!empty($request->image)) {
                $image = fileUpload($request->image, product_image());
            }elseif (!empty($request->hidden_image)){
                $image = $pro->thumbnail;
            }else{
                return redirect()->back()->with(Toastr::error('Image is Required', 'Title', ["positionClass" => "toast-top-center"]));
            }

            $product=Product::updateOrCreate(['id' => $request->id],[
                'title'=>$request->title,
                'sku'=>$request->sku,
                'description'=>$request->description,
                'price'=> $request->price,
                'qty'=> $request->qty,
            ]);
            if($product){
                $productImage =  ProductImage::updateOrCreate(['product_id' => $request->id],[
                    'product_id'=>$product->id,
                    'thumbnail'=>$image,
                ]);

                if($productImage){
                    $variant_one = ProductVariant::updateOrCreate(['product_id' => $request->id,'variant_id'=>$request->variant_one,],[
                        'variant'=>$request->tag,
                        'variant_id'=>$request->variant_one,
                        'product_id'=>$product->id,
                    ]);
                    if($variant_one){
                        $variant_two=ProductVariant::updateOrCreate(['product_id' => $request->id,'variant_id'=>$request->variant_two,],[
                            'variant'=>$request->tags,
                            'variant_id'=>$request->variant_two,
                            'product_id'=>$product->id,
                        ]);
                        if ($variant_two){
                            ProductVariant::updateOrCreate(['product_id' => $request->id,'variant_id'=>$request->variant_three,],[
                                'variant'=>$request->tagss,
                                'variant_id'=>$request->variant_three,
                                'product_id'=>$product->id,
                            ]);
                        }
                    }

                }
            }
        }
        return response()->json(['success' => true]);

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
