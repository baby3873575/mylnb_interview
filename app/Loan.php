<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    public function detail()
    {
        return $this->hasOne('App\Loans_detail');
    }

}
