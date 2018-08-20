<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Loan extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id'=>$this->id,
            'serial'=>$this->serial,
            'amount'=>$this->amount,
            'status'=>$this->status,
            'status_label'=>$this->status_label,
            'expire_at'=>$this->expire_at,
            'detail'=> new Loan_detailResource($this->detail),
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
           
        ];
    }
}
