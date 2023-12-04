<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function purchaseAll (Request $request)
    {
        $allData = DB::table('carts')
        ->join('users', 'users.id', '=', 'carts.customer_id')
        ->join('products', 'products.id', '=', 'carts.product_id')
        ->select('carts.id AS purchase_no', 'users.name AS customer_name', 'carts.created_at AS date', 'products.name AS product_name', 'carts.quantity', 'carts.is_paid', 'carts.is_sell')
        ->get();

        return view('backend.purchase.purchase_all', compact('allData'));
    }

    public function purchaseAdd(Request $request)
    {
        $supplier = Supplier::all();
        $unit = Unit::all();
        $category = Category::all();

        return view('backend.purchase.purchase_add', compact('supplier', 'unit', 'category'));
    }

    public function purchaseStore(Request $request)
    {
        if ($request->category_id == null){
            $notification = array (
                'message' => 'Sorry you do not select any item',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category ; $i++) {
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];

                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];

                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }
        $notification = array (
            'message' => 'Data Save Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase.all')->with($notification);
    }

    public function purchaseDelete($id)
    {
        Purchase::findOrFail($id)->delete();

        $notification = array (
            'message' => 'Purchased Item Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function purchasePending(Request $request)
    {
        $allData = DB::table('carts')
        ->join('users', 'users.id', '=', 'carts.customer_id')
        ->join('products', 'products.id', '=', 'carts.product_id')
        ->select('carts.id AS purchase_no', 'users.name AS customer_name', 'carts.created_at AS date', 'products.name AS product_name', 'carts.quantity', 'carts.is_paid', 'carts.is_sell')
        ->where('is_paid', '=', '1', 'AND', 'is_sell', '=', '1')
        ->get();

        return view('backend.purchase.purchase_pending', compact('allData'));
    }

    public function purchaseApprove($id)
    {
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){
            Purchase::findOrFail($id)->update([
                'status' => '1',
            ]);

            $notification = array (
                'message' => 'Status Approved Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('purchase.all')->with($notification);
        }
    }

    public function dailyPurchaseReport(){
        return view('backend.purchase.daily_purchase_report');
    }// End Method


    public function dailyPurchasePdf(Request $request){

        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->get();


        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('backend.pdf.daily_purchase_report_pdf',compact('allData','start_date','end_date'));

    }// End Method
}
