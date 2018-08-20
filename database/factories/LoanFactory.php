<?php

use Faker\Generator as Faker;

$factory->define(App\Loan::class, function (Faker $faker) {
    return [
        'serial'=> $faker->text(8),
        'amount' => $faker->numberBetween(1,5000000),
        'status'  => "expired",
        'status_label'=> "已過期",
        'expire_at'=> $faker->date('Y-m-d'),

    ];
});
