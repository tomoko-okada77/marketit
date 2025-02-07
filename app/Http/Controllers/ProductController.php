<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $product;
    private $category;

    public function __construct(Product $product, Category $category) {
        $this->product = $product;
        $this->category = $category;
    }

    public function create(){
        $all_categories = $this->category->all();
        return view('product.create')
                ->with('all_categories', $all_categories);
    }

    public function store(Request $request) {
        $request->validate([
            'category' => 'required|array|between:1,3',
            'name' => 'required|min:1|max:1000',
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:1048',
            'price' => 'required|min:1'
        ]);

        $this->product->user_id = Auth::user()->id;
        $this->product->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->product->name = $request->name;
        $this->product->description = $request->description;
        $this->product->price = $request->price;
        $this->product->save();

        foreach($request->category as $category_id) {
            $category_product[] = ['category_id' => $category_id];
        }

        $this->product->productCategories()->createMany($category_product);

        return redirect()->route('index');
    }

    public function show($id) {
        $product = $this->product->findOrFail($id);

        return view('product.show')
                ->with('product', $product);
    }

    public function edit($id) {
        $product = $this->product->findOrFail($id);

        if(Auth::user()->id != $product->user->id) {
            return redirect()->route('index');
        }

        $all_categories = $this->category->all();
        
        $selected_categories = [];
        foreach($product->productCategories as $category_product) {
            $selected_categories[] = $category_product->category_id;
        }

        return view('product.edit')
                ->with('product', $product)
                ->with('all_categories', $all_categories)
                ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'category' => 'required|array|between:1,3',
            'name' => 'required|min:1|max:1000',
            'description' => 'required|min:1|max:1000',
            'image' => 'mimes:jpg,jpeg,png,gif|max:1048',
            'price' => 'required|min:1'
        ]);

        $product = $this->product->findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if($request->image) {
            $product->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $product->save();

        $product->productCategories()->delete();

        foreach($request->category as $category_id) {
            $category_product[] = ['category_id' => $category_id];
        }

        $product->productCategories()->createMany($category_product);

        return redirect()->route('product.show', $id);
    }

    public function destroy($id) {
        $this->product->destroy($id);

        return redirect()->route('index');
    }
}
