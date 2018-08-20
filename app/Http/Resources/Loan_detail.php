<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Loan;
use Loan_detail;


class Loan_detailResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'period'=> $this->period,
            'purpose'=>$this->purpose,
            'description'=>$this->description,
            'credit_level'=>$this->credit_level,
            'apr'=>$this->apr,
            'pgr'=>$this->pgr
        ];
    
    }
}


