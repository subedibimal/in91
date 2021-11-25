<?php

namespace App\Http\Controllers\Api\V2;

use App\CustomerProduct;
use App\Utility\CategoryUtility;
use Auth;
use Illuminate\Http\Request;

class ClassifiedProductController extends Controller
{
    public function index()
    {
        $products = CustomerProduct::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        //return $products;
        $products->getCollection()->transform(function($data){
            return [
                'id' => $data->id,
                'name' => $data->name,
                'slug' => $data->slug,
                'price' => single_price($data->unit_price),
                'status' => $data->status,
                'published' => $data->published
                 ];
        });
        return $products;
    }

    public function update($id, Request $request)
    {
            $product = CustomerProduct::where('user_id', Auth::user()->id)->find($id);
            $product->fill($request->toArray());

            if($request->has('slug'))
            {
                $product->slug = strtolower($request->slug);
            }
            $product->save();

            return response()->json([
                'success' => true,
                'message' => 'The product is updated'
            ]);
    }

    public function store(Request $request)
    {
        $product = new CustomerProduct();
        $product->user_id= Auth::user()->id;

        $product->fill($request->toArray());
        $product->slug = strtolower($request->slug);

        $product->added_by = Auth::user()->user_type;

        if($product->save()){
            $user = Auth::user();
            $user->remaining_uploads -= 1;
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'The product is added'
        ]);

    }

    public function destroy($id)
    {
        $product = CustomerProduct::where('user_id', Auth::user()->id)->findOrFail($id);

        foreach ($product->customer_product_translations as $key => $customer_product_translations) {
            $customer_product_translations->delete();
        }
        if (CustomerProduct::destroy($id))
        {
            return response()->json([
                'success' => true,
                'message' => translate('Product has been deleted successfully')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product couldn\'t removed'
        ]);
    }

    public function updatePublished($id,Request $request){
        $product = CustomerProduct::find($id);
        $product->published = $request->published;
        $product->save();

        if($product->published==1)$msg='Product is published';
        else $msg = 'Product is not published';
        return response()->json([
            'success' => true,
            'message' => $msg
        ]);
    }
}
