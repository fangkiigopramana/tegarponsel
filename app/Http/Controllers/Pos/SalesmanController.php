<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salesman;
use Auth;
use Illuminate\Support\Carbon;

class SalesmanController extends Controller
{
    public function salesmanAll ()
    {
        // $salesmans = Salesman::all();
        $salesmans = Salesman::latest()->get();

        return view('backend.salesman.salesman_all', compact('salesmans'));
    }

    public function salesmanAdd ()
    {
        return view('backend/salesman.salesman_add');
    }

    public function salesmanStore(Request $request)
    {
        Salesman::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'companyaddress' => $request->companyaddress,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array (
            'message' => 'Salesman Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('salesman.all')->with($notification);
    }

    public function salesmanEdit ($id)
    {
        $salesman = Salesman::findOrFail($id);
        return view('backend.salesman.salesman_edit', compact('salesman'));
    }

    public function salesmanUpdate (Request $request)
    {
        $salesman_id = $request->id;

        Salesman::findOrFail($salesman_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'companyaddress' => $request->companyaddress,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array (
            'message' => 'Salesman Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('salesman.all')->with($notification);
    }

    public function salesmanDelete ($id)
    {
        Salesman::findOrFail($id)->delete();

        $notification = array (
            'message' => 'Salesman Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
