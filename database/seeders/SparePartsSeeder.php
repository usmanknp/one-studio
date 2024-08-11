<?php

namespace Database\Seeders;

use App\Models\SparePart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;



class SparePartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spare_parts = [
            [
                'name' => 'Plug',
                'quantity' => 10,
                'description' => 'This is testing for the following plugins',
                'code' => 'P-100',
            ],
            [
                'name' => 'Switches',
                'quantity' => 50,
                'description' => 'This is testing for the following plugins',
                'code' => 'P-101',
            ],
            [
                'name' => 'Oil',
                'quantity' => 11,
                'description' => 'This is testing for the following plugins',
                'code' => 'P-102',
            ],
   
        ];

        foreach($spare_parts as $part)
        {
            $spare_part = SparePart::where('code',$part['code'])->first();
            if(empty($spare_part))
            {
                $spare_part = new SparePart();
                $spare_part->uuid =Str::uuid();
                $spare_part->name = $part['name'];
            }
            $spare_part->description = $part['description'];
            $spare_part->quantity = $part['quantity'];
            $spare_part->code = $part['code'];
            $spare_part->save();
        }

        return "done";
    }
}
