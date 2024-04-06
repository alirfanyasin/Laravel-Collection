<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ZippingTest extends TestCase
{

    // Zipping
    public function test_zip()
    {
        $collection1 = collect([1, 2, 3, 4, 5]);
        $collection2 = collect([6, 7, 8, 9, 10]);

        // Menggabungkan collection menggunakan zipping
        $collection3 = $collection1->zip($collection2);

        assertEquals([
            collect([1, 6]),
            collect([2, 7]),
            collect([3, 8]),
            collect([4, 9]),
            collect([5, 10])
        ], $collection3->all());
    }


    // Concat
    public function test_concat()
    {
        $collection1 = collect([1, 2, 3]);
        $collection2 = collect([4, 5, 6]);
        $collection3 = $collection1->concat($collection2);


        assertEquals([1, 2, 3, 4, 5, 6], $collection3->all());
    }




    // Combine
    public function test_combine()
    {
        $collection1 = ["name", "country"];
        $collection2 = ["Irfan", "Indonesia"];

        $collection3 = collect($collection1)->combine($collection2);


        assertEquals([
            "name" => "Irfan",
            "country" => "Indonesia"
        ], $collection3->all());
    }
}
