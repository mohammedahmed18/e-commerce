<?php

namespace App\Http\Controllers;

use App\Models\Categorize;
use App\Models\Category;
use App\Models\Image;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function store(Request $request){
    
        // validation
        $validated = $request->validate(
            [
                'p_name' => 'required|min:3',
                'p_description' => 'required|min:10',
                'p_price' => 'required',
                'p_stock' => 'required',
                'categories' => 'required'
            ]
        );
        // create the product
        $product = new Product();
        $product->name = $validated['p_name'];
        $product->description = $validated['p_description'];
        $product->price = $validated['p_price'];
        $product->stock = $validated['p_stock'];
        $product->admin_id = Auth::guard('admin')->id();
        // save the product
        $product->save();
        //create the link between category and the product
        $cats_array = explode(',', $validated['categories']);
        foreach ($cats_array as $cat) {
            $id = Category::where('name' , $cat)->first()->id;
            $product->categories()->attach($id);
        }
        // save the images
        $input=$request->all();
        $images=array();
        if($files=$request->file('_images')){
            if(count($files) > 4){
            return Redirect::back()->with('error', 'You can upload only up to 4 images')->withInput();
            }
            foreach($files as $file){
                // save images
                $name=Str::random(20).$file->getClientOriginalName();
                $img = new Image();
                $img->image_name = $name;
                $img->product_id = $product->id;
                $img->save();
                $file->move('images/stock',$name);
                $images[]=$name;
            }
        }else{
            return Redirect::back()->with('error', 'upload at least one image')->withInput();
        }
      return redirect('/dashboard/products');

    }


    // clear unsed images in the storage
    public function clear(){
        $stockImages = Storage::disk("stock")->allFiles();
        foreach ($stockImages as $image) {
            // check if the stock image exist in the database
            $db_stock = Image::where('image_name' , $image)->first();
            $product = $db_stock->product;
            
            if(! $product){
                // delete the image if it doesn't exist
                unlink(public_path('images/stock/'.$image));
            }
        }

        return redirect('/dashboard/products');
    
    }

    public function search(Request $req){
        $req->validate([
            'category' => 'required'
        ]);

    if($req->to < $req->from && $req->to && $req->from){
        return Redirect::back()->with('error', 'the to price should be greater than the from price')->withInput();
    }
    return redirect('/products?from='.$req->from.'&to='.$req->to.'&category='.Category::where('name' , $req->category)->first()->id);
    }

    public function productDetails($id){
        $items = [];
        $added = false;

        if(Auth::user()){
            $items = Auth::user()->cart_items;
            $item = collect($items)->where('product_id' , $id)->first();
            if($item) $added = true;
        }
        $product = Product::find($id);
        if(!$product) abort(404);
        return view('pages.landpage.productDetails', ['product' => $product , 'addedToCart' => $added]);
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        // check if there is orders with this product
        $item = OrderItem::where('product_id' , $product->id)->first();
        if($item){
            Session::flash('toast-error' , 'product can\'t be deleted because there is orders with this product');
            return;
        }
        $product->delete();
        Categorize::where('product_id',$id)->delete();
        Session::flash('toast-info' , 'product is deleted');
        return;
    }

}
