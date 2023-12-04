<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index (){
        $products = DB::table('products')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->select('products.id', 'products.name', 'categories.name as category_name', 'products.price')
        ->get();
        return view('customer.home',[
            'products' => $products
        ]);
    }

    public function productDetail($id){
        $datas = DB::table('products')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->select('products.id','products.stock', 'products.name', 'categories.name as category_name', 'products.price');
        $products = $datas->get();
        $product = $datas->where('products.id', '=', $id)->get()->first();
        return view('customer.product',[
            'products' => $products,
            'product' => $product
        ]);
    }

    public function register(){
        return view('customer.register');
    }

    public function registerStore(Request $request) {
        // dd($request);
        $validated = $request->validate([
            'name' => 'max:255|required',
            'email' => 'max:255|required|email:dns', // Check for unique email
            'mobile_no' => 'required',
            'address' => 'required',
            'password' => 'min:8|required',
        ]);

        // dd($validated);
    
        $newPassword = Hash::make($request->password);
        $validated['password'] = $newPassword;
    
        // Create a new customer record
        $customer = new User();
        $customer->name = $validated['name'];
        $customer->username = $validated['name'];
        $customer->email = $validated['email'];
        $customer->role = 'customer';
        $customer->mobile_no = $validated['mobile_no'];
        $customer->address = $validated['address'];
        $customer->password = $validated['password'];
        $customer->save();
    
        return redirect()->route('login');
    }

    public function viewCart(){

        $datas = DB::table('carts')
        ->join('users', 'users.id', '=', 'carts.customer_id')
        ->join('products', 'products.id', '=', 'carts.product_id')
        ->where('carts.customer_id', '=', auth()->user()->id)
        ->select('products.name', 'products.price', 'carts.id', 'carts.quantity', 'carts.is_paid', 'carts.is_sell')
        ->get();

        return view('customer.cart', [
            'datas' => $datas
    ]);

    }

    public function addToCart(Request $request){
        $validated = $request->validate([
            'name_product' => 'max:255|required',
            'quantity' => 'numeric|required'
        ]);
        $product = Product::where('name',$validated['name_product'])->first();
        $customer_id = auth()->user()->id;
        
        $addCart = new Cart();
        $addCart->product_id = $product->id;
        $addCart->customer_id = $customer_id;
        $addCart->quantity = $validated['quantity'];
        $addCart->save();
        return redirect()->route('customer.cart.view');
    }

    public function buyProductCart($id){
        DB::table('carts')
        ->where('id', $id)
        ->update(['is_paid' => 1]);
        return redirect()->route('customer.cart.view');
    }

    public function confirmPaidCart($id){
        $cart = DB::table('carts')
            ->where('id', $id)
            ->first();
    
        if ($cart) {
            // Update status penjualan pada tabel carts
            DB::table('carts')
                ->where('id', $id)
                ->update(['is_sell' => 1]);
    
            // Kurangi stok produk
            $product = DB::table('products')
                ->where('id', $cart->product_id)
                ->first();
    
            if ($product) {
                $newStock = $product->stock - $cart->quantity;
    
                // Pastikan stok tidak negatif
                if ($newStock >= 0) {
                    DB::table('products')
                        ->where('id', $cart->product_id)
                        ->update(['stock' => $newStock]);
                } else {
                    // Handle jika stok tidak mencukupi
                    // Misalnya, dengan memberikan pesan kepada pengguna
                    return redirect()->back();
                }
            }
    
            // Tampilkan informasi keranjang yang dikonfirmasi
        }
    
        // Jika keranjang tidak ditemukan, kembalikan ke halaman sebelumnya
        return redirect()->back();
    }
    

    
}
