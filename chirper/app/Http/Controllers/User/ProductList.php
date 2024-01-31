<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductList extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand', 'product_images');
        $categories = Category::get();
        $brands = Brand::get();
        $filteredProducts = $products->filtered()->paginate(5)->withQueryString();
        return Inertia::render('User/ProductList', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => ProductResource::collection($filteredProducts),
        ]);
    }

    public function getProductDetails($id)
    {
        $products = Product::with('product_images')->findOrFail($id);

        return Inertia::render('User/Components/Details', [
            'products' => $products,
        ]);
    }

    public function updateCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity');
        $user = $request->user();

        if ($user) {
            $cartItem = CartItem::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                // Increment the quantity if the cart item already exists
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $quantity,
                ]);
            } else {
                // Create a new cart item if it doesn't exist
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cart Updated Successfully');
    }
}
