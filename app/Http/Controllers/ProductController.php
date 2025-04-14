<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|integer|in:0,1,2,3',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);

        // Send email notification to the user
        $user = Auth::user();
        Mail::send('emails.product-created', ['user' => $user, 'product' => $product], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('New Product Created');
        });

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }
}
