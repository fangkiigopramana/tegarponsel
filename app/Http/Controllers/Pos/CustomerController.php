<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function customerAll (Request $request)
    {
        // $customers = Customer::all();
        $customers = User::where('role', 'customer')->get();

        return view('backend.customer.customer_all', compact('customers'));
    }

    public function customerAdd (Request $request)
    {
        return view('backend.customer.customer_add');
    }

    public function customerStore (Request $request)
    {
        Customer::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array (
            'message' => 'Customer Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);
    }

    public function customerEdit ($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit', compact('customer'));
    }

    public function customerUpdate (Request $request)
    {
        $customer_id = $request->id;

        User::findOrFail($customer_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array (
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);
    }

    public function customerDelete ($id)
    {
        User::findOrFail($id)->delete();

        $notification = array (
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function creditCustomer(){

        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.customer.customer_credit',compact('allData'));

    } // End Method

    public function creditCustomerPrintPdf(){

        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.pdf.customer_credit_pdf',compact('allData'));

    }// End Method

    public function customerEditInvoice($invoice_id){

        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.customer.edit_customer_invoice',compact('payment'));

    }// End Method

    public function customerUpdateInvoice(Request $request,$invoice_id){

        if ($request->new_paid_amount < $request->paid_amount) {

            $notification = array(
            'message' => 'Sorry You Paid Maximum Value',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        } else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)
                ->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;

            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)
                ->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)
                ->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;

            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

            $notification = array(
            'message' => 'Invoice Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('credit.customer')->with($notification);
        }

    }// End Method

    public function customerInvoiceDetails($invoice_id){

        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.pdf.invoice_details_pdf',compact('payment'));

    }// End Method

    public function paidCustomer(){
        $allData = Payment::where('paid_status','!=','full_due')->get();
        return view('backend.customer.customer_paid',compact('allData'));
    }// End Method

    public function paidCustomerPrintPdf(){

        $allData = Payment::where('paid_status','!=','full_due')->get();
        return view('backend.pdf.customer_paid_pdf',compact('allData'));
    }// End Method

    public function customerWiseReport(){

        $customers = Customer::all();
        return view('backend.customer.customer_wise_report',compact('customers'));

    }// End Method

    public function customerWiseCreditReport(Request $request){

        $allData = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.pdf.customer_wise_credit_pdf',compact('allData'));
    }// End Method

    public function customerWisePaidReport(Request $request){

        $allData = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
        return view('backend.pdf.customer_wise_paid_pdf',compact('allData'));
    }// End Method

}
