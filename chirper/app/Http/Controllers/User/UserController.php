<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use App\Http\Resources\ProductResource;


class UserController extends Controller
{
    public function index()
    {
        // Get the start and end dates of the current week
        $startOfMonth = now()->startOfWeek();
        $endOfMonth = now()->endOfWeek();

        $latestProducts = Product::with('category', 'brand', 'product_images')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->latest()
            ->take(8)
            ->get();


        return Inertia::render('User/Index', [
            'products' => ProductResource::collection($latestProducts),
            'canLogin' => app('router')->has('login'),
            'canRegister' => app('router')->has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
