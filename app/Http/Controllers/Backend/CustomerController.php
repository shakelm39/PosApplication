<?php

namespace App\Http\Controllers\Backend;

use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PaymentDetails;
use Barryvdh\DomPDF\Facade\PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
        //Customer View
        public function view()
        {
            $allData = Customer::all();
            return view('backend.customer.view-customer',compact('allData'));
        }

        //Customer Add
        public function add()
        {
            return view('backend.customer.add-customer');
        }
        
        //Customer Store
        public function store(Request $request)
        {
             // validation 
             $request->validate([
                'name'=>'required',
                'mobile_no'=>'required|min:11|max:11|unique:customers',
                'email'=>'required|unique:customers',
                'address'=>'required',
            ]);

            $customer = new customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->mobile_no = $request->mobile_no;
            $customer->address = $request->address;
            $customer->created_by = Auth::user()->id;
            $customer->save();
            return redirect()->route('customers.view')->with('success','Data Save Successfully!!');
        }

        //Customer Edit Function
        public function edit($id)
        {
            $editData = Customer::find($id);
            return view('backend.customer.edit-customer',compact('editData'));
        }

        //Customer update Function
        public function update(Request $request,$id)
        {
             // validation 
             $request->validate([
                'name'=>'required',
                'mobile_no'=>'required|min:11|max:11|unique:customers,mobile_no,'.$id,
                'email'=>'required|unique:customers,email,'.$id,
                'address'=>'required',
            ]);
           
            $customer =Customer::find($id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->mobile_no = $request->mobile_no;
            $customer->address = $request->address;
            $customer->updated_by = Auth::user()->id;
            $customer->save();
            return redirect()->route('customers.view')->with('success','Data Updated Successfully!!');
        }

        //Delete Function
        public function delete($id)
        {
            $customer = Customer::find($id);
            $customer->delete();
            return redirect()->route('customers.view')->with('success',"Data Deleted Successfully!!");
        }
        //Customer Credit
        public function creditCustomer()
        {
            $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();

            return view('backend.customer.customer-credit',compact('allData'));
        }
        public function creditCustomerPdf()
        {
            $data['allData'] = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
            $pdf = PDF::loadView('backend.pdf.credit-customer-pdf', $data);
            //$pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('epkelectronics.pdf');
        }
        //eidt invoice 
        public function editInvoice($invoice_id)
        {
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            return view('backend.customer.edit-invoice',compact('payment'));
        }

        //update invioce
        public function updateInvoice(Request $request, $invoice_id)
        {
            $request->validate([
                'paid_status'=>'required',
                'date'=>'required',
            ]);
            
            if ($request->new_paid_amount<$request->paid_amount) 
            {
                return redirect()->back()->with('error','Sorry! You have paid maximum value');
            }else{
                    $payment = Payment::where('invoice_id',$invoice_id)->first();
                    $payment_details = new PaymentDetails();
                    $payment->paid_status = $request->paid_status;
                if ($request->paid_status=='full_paid') 
                {
                
                    $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+ $request->new_paid_amount;
                    $payment->due_amount = '0';
                    $payment_details->current_paid_amount = $request->new_paid_amount;

                }elseif($request->paid_status=='partial_paid'){
                    $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                    $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                    $payment_details->current_paid_amount = $request->paid_amount;
                }
                    $payment->save();
                    $payment_details->invoice_id = $invoice_id;
                    $payment_details->date = date('Y-m-d',strtotime($request->date));
                    $payment_details->save();
                    return redirect()->route('customers.credit')->with('success','Invoice Successfully Updated');
                }
        }


        //invoice details pdf

        public function invoiceDetailsPdf($invoice_id)
        {
            $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
            //$pdf = PDF::loadView('backend.pdf.invoice-details-pdf', $data);
            //$pdf->SetProtection(['copy', 'print'], '', 'pass');
            //return $pdf->stream('spkelectronics.pdf');
            return view('backend.pdf.invoice-details-pdf', $data);
        }

        //Customer Paid
        public function paidCustomer()
        {
            $allData = Payment::where('paid_status','!=','full_due')->get();

            return view('backend.customer.customer-paid',compact('allData'));
        }

        public function paidCustomerPdf()
        {
            $data['allData'] = Payment::where('paid_status','!=','full_due')->get();
            $pdf = PDF::loadView('backend.pdf.paid-customer-pdf', $data);
            //$pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('spkelectronics.pdf');
        }

        //customer wise report
        public function customerWiseReport ()
        {
            $customers = Customer::all();
            return view('backend.customer.customer-wise-report',compact('customers'));
        }

        //customer wise credit report
        public function customerWiseCredit(Request $request){
            $data['allData'] = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
            $pdf = PDF::loadView('backend.pdf.customer-wise-credit-pdf', $data);
            //$pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }

        //customer wise Paid report
        public function customerWisePaid(Request $request){
            $data['allData'] = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
            $pdf = PDF::loadView('backend.pdf.customer-wise-paid-pdf', $data);
            //$pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }
}
