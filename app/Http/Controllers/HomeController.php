<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $product;
    private $category;

    public function __construct(Product $product, Category $category)
    {
        $this->middleware('auth');
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_products = $this->getHomeProducts();
        $recent_products = $this->getRecentProducts();

        return view('index')
            ->with('home_products', $home_products)
            ->with('recent_products', $recent_products)
            ->with('all_categories', $this->getAllCategories());
    }

    private function getHomeProducts() {
        $all_products = $this->product->latest()->get();
        $home_products = [];

        foreach ($all_products as $product) {
            if ($product->transaction == null) {
                $home_products[] = $product;
            }
        }

        return $home_products;
    }

    private function getRecentProducts() {
        $oneWeekAgo = Carbon::now()->subWeek();
        $recentProducts = $this->product
                                ->where('created_at', '>=', $oneWeekAgo)->latest()->get();

        return $recentProducts;
    }

    public function all() {
        $all_products = $this->product->latest()->paginate(12);
        return view('all')
            ->with('all_products', $all_products)
            ->with('all_categories', $this->getAllCategories());
    }

    public function search(Request $request) {
        $products = $this->product
                        ->where('name', 'like', '%' . $request->search . '%')->get();
        return view('search')
                ->with('products', $products)
                ->with('search', $request->search)
                ->with('all_categories', $this->getAllCategories());
    }

    public function category($category_id) {
        $category = $this->category->findOrfail($category_id);

        return view('category')
            ->with('all_categories', $this->getAllCategories())
            ->with('category', $category);
    }

    private function getAllCategories() {
        return $this->category->all();
    }
}
