<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Loan;
use App\Loans_detail;
use App\Http\Resources\Loan as LoanResource;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->view('welcome');

    }

    //APIs/

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        if(empty($id)){
            $Loans = Loan::with('detail')->orderBy('created_at', 'desc')->paginate(10);
            return LoanResource::collection($Loans);
        }else{
            $Loan = Loan::findOrFail($id);
            return new LoanResource($Loan);
        }
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Loan = $request->isMethod('put') ? Loan::findOrFail( $request->input('loan_id')) : new Loan;
        $Loan_detail = $request->isMethod('put') ? Loans_detail::where('loan_id', $request->input('loan_id') )->firstOrFail(): new Loans_detail;
        $Loan->id = $request->input('loan_id');
        $Loan->serial = $request->input('serial');
        $Loan->amount = $request->input('amount');
        $Loan->status = $request->input('status');
        $Loan->status_label = $request->input('status_label');
        $Loan->expire_at = $request->input('expire_at');

        $Loan->save();

        $Loan_detail->loan_id = $Loan->id;
        $Loan_detail->period = $request->input('period');
        $Loan_detail->purpose = $request->input('purpose');
        $Loan_detail->description = $request->input('description');
        $Loan_detail->credit_level = $request->input('credit_level');
        $Loan_detail->apr = $request->input('apr');
        $Loan_detail->pgr = $request->input('pgr');

        $Loan_detail->save();
        
        return new LoanResource($Loan);
        
        
    }

    

    
}
