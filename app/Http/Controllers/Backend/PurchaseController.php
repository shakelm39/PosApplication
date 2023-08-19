<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
    	return view('backend.purchase.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['suppliers'] = Supplier::all();
    	$data['brands'] = Brand::all();
    	$data['units'] = Unit::all();
        $data['products'] = Product::all();
    	$data['categories'] = Category::all();
        return view('backend.purchase.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->category_id == null) {
            return redirect()->back()->with('error','sorry! You do not select any item');

        }else{
            $count_category = count($request->category_id);
            for ($i=0; $i <$count_category ; $i++) { 
                $purchase = new Purchase();
                $purchase->date = date("Y-m-d",strtotime($request->date[$i]));
                $purchase->purchase_no  = $request->purchase_no[$i];
                $purchase->brand_id     = $request->brand_id[$i];
                $purchase->supplier_id  = $request->supplier_id[$i];
                $purchase->category_id  = $request->category_id[$i];
                $purchase->product_id   = $request->product_id[$i];
                $purchase->buying_qty   = $request->buying_qty[$i];
                $purchase->unit_price   = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description  = $request->description[$i];
                $purchase->created_by   = Auth::user()->id;
                $purchase->status       = '0';
                $purchase->save();
            }
        }
        return redirect()->route('purchase.index')->with('success','Data Save Successfull!!');
    }


    //purchase pending approval function
    public function pendingList(){
        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.purchase.view-pending-list',compact('allData'));
    }

    //purchase approval function
    public function approve($id){
        $purchase = Purchase::find($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')
            ->where('id',$id)
            ->update(['status'=>1]);
        }
        return redirect()->route('purchase.pending.list')->with('success','Data Approved Successfull!!');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Product Delete Function
    public function delete($id)
    {
        
        $purchase = Purchase::find($id);
        $purchase->delete();
        return redirect()->route('purchase.index')->with('success',"Data Deleted Successfully!!");
    }


     //Daily Purchase Report
        public function purchaseReport(){
            return view('backend.purchase.daily-purchase-report');
        }

        //Daily Purchase report pdf
        public function purchaseReportPdf(Request $request){
            $startDate          = date('Y-m-d',strtotime($request->start_date));
            $endDate            = date('Y-m-d',strtotime($request->end_date));
            $data['allData']    = Purchase::whereBetween('date',[$startDate,$endDate])->where('status','1')->orderBy('supplier_id')->orderBy('category_id')->orderBy('product_id')->get();
            $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
            $data['end_date']   = date('Y-m-d',strtotime($request->end_date));
            $pdf                = PDF::loadView('backend.pdf.daily-purchase-report-pdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
            
        }


}
