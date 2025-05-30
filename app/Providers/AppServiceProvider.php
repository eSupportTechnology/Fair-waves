<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        View::composer('*', function ($view) {
            $miniCart = [];
            $cartTotal = 0;
            $cartCount = 0;

            if (Auth::check()) {
                $userId = Auth::id();
                $cartItems = CartItem::where('user_id', $userId)->get();

                foreach ($cartItems as $item) {
                    $product = Product::find($item->product_id);
                    $productImage = $product->images()->first();
                    $imagePath = $productImage ? 'storage/' . $productImage->image_path : 'default.png';

                    $miniCart[] = [
                        'name' => $product->product_name,
                        'image' => asset($imagePath),
                        'quantity' => $item->quantity,
                        'subtotal' => number_format($item->price * $item->quantity, 2),
                    ];

                    $cartTotal += $item->price * $item->quantity;
                }

                $cartCount = $cartItems->count();
            }

            $view->with('miniCart', $miniCart)
                ->with('cartTotal', number_format($cartTotal, 2))
                ->with('cartCount', $cartCount);
        });
    }
}
