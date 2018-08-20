<?php

use Illuminate\Database\Seeder;
use App\Loan;
use App\Loan_detail;
use Illuminate\Support\Facades\DB;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Loan::class, 30)->create();

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        

        
        $myfake=json_decode(file_get_contents('https://paris.robowebtech.tw/api/market-place', false, stream_context_create($arrContextOptions)), true);
        
        foreach($myfake["data"] as $loan){
            
            $id = DB::table('loans')->insertGetId( array(
                    'serial'=>$loan['serial'],
                    'amount'=>$loan['amount'],
                    'status'=>$loan['status'],
                    'status_label'=>$loan['status_label'],
                    'expire_at'=>$loan['expire_at'],
                )
            );
            $loan=$loan['loan_detail'];
            DB::table('loans_details')->insertGetId( array(
                'loan_id'=>$id,
                'period'=>$loan['period'],
                'purpose'=>$loan['purpose'],
                'description'=>$loan['description'],
                'credit_level'=>$loan['credit_level'],
                'apr'=>$loan['apr'],
                'pgr'=>$loan['pgr'],
            )
        );

        }
 
    }
}
