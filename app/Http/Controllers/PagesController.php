<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class PagesController extends Controller
{

    public function home()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $latestProducts = Product::orderBy('id', 'desc')->take(6)->get();
        return view('pages.landpage.home', ['categories' => $categories, 'products' => $latestProducts]);
    }

    public function signUpPage()
    {
        return view("pages.landpage.sign-up");
    }

    public function dashboard()
    {
        $ordersCount = Order::where('status', 1)->get()->count();
        return view('pages/dashboard/Dashboard', ['ordersCount' => $ordersCount]);
    }

    public function dashboardLogin()
    {
        return view('pages/Dashboard/Dashboard-login');
    }
    public function createProductPage()
    {
        $categories = Category::select("name")->get();
        return view('pages/Dashboard/Dashboard-create-product', ['categories' => $categories]);
    }

    public function dashboardProducts(Request $req)
    {
        $per_page = 5;
        $pages = ceil(Product::count() / $per_page);
        $current_page = $req->page;
        $products = Product::orderBy('id', 'desc')->paginate($per_page);
        return view('pages.Dashboard.Dashboard-products', [
            'products' => $products,
            'pages' => $pages,
            'current_page' => $current_page
        ]);
    }
    public function loginPage(Request $req)
    {
        $redirect = $req->header('referer');
        return view('pages.landpage.login', ['redirect' => $redirect]);
    }

    public function productPage(Request $req)
    {
        $categories = Category::all();
        $per_page = 7;

        if (!$req->category) {
            $products = Product::orderBy('id', 'desc')->paginate($per_page);
            $pages = ceil(Product::all()->count() / $per_page);
            return view("pages.landpage.products", ["products" => $products, 'category' => null, 'categories' => $categories, 'pages' => $pages, 'current_page' => $req->page, 'category_id' => null]);
        }
        $catId = $req->category;
        $from = $req->from ? $req->from : 0;
        $to = $req->to ? $req->to : 9999999999999999999999999999999999;

        $cat = Category::find($catId);
        if (!$cat) {
            return redirect('/products');
        }
        $products = $cat->products()->orderBy('id', 'desc')->get()->whereBetween('price', [$from, $to]);

        $pages = ceil($products->count() / $per_page);
        $current_page = $req->page;
        $products = new LengthAwarePaginator($products->forPage($current_page, $per_page), $products->count(), $per_page, $current_page);
        $products = $products->items();

        $category = Category::find($catId)->name;
        return view("pages.landpage.products", ["products" => $products, 'category' => $category, 'categories' => $categories, 'pages' => $pages, 'current_page' => $current_page, 'category_id' => $catId]);
    }
}
