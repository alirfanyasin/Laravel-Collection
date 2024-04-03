<?php

namespace Tests\Feature;

use App\Class\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertEqualsCanonicalizing;

class CollectionTest extends TestCase
{
    public function testCreateCollection()
    {
        $collection = collect([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $collection->all());
    }



    public function testForEach()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9]);
        foreach ($collection as $key => $value) {
            $this->assertEquals($key + 1, $value);
        }
    }


    public function testCrud()
    {

        // Menambahkan data di paling terakhir menggunakan push()
        $collection = collect([]);
        $collection->push(1, 2, 3);
        assertEqualsCanonicalizing([1, 2, 3], $collection->all());


        // Mengambil data paling belakang menggunakan pop()
        $result = $collection->pop();
        assertEquals(3, $result);
        assertEqualsCanonicalizing([1, 2], $collection->all());
    }



    public function testMap()
    {

        $collection = collect([1, 2, 3]);
        $result = $collection->map(fn ($item) => $item * 2);
        $this->assertEqualsCanonicalizing([2, 4, 6], $result->all());
    }


    public function testMapInto()
    {
        $collection = collect(["Irfan"]);
        $result = $collection->mapInto(Person::class);
        $this->assertEquals([new Person("Irfan")], $result->all());
    }


    public function testMapSpread()
    {
        $collection = collect([
            ["Irfan", "Yasin"],
            ["Dilna", "Azizah"]
        ]);

        $result = $collection->mapSpread(function ($firstName, $lastName) {
            $fullname = $firstName . ' ' . $lastName;
            return new Person($fullname);
        });

        $this->assertEquals([
            new Person("Irfan Yasin"),
            new Person("Dilna Azizah")
        ], $result->all());
    }



    public function testMapToGroups()
    {

        $collection = collect([
            [
                "name" => "Irfan",
                "departement" => "IT"
            ],
            [
                "name" => "Yasin",
                "departement" => "HR"
            ],
            [
                "name" => "Saipul",
                "departement" => "IT"
            ],
            [
                "name" => "Kilab",
                "departement" => "IT"
            ]
        ]);


        $result = $collection->mapToGroups(function ($item) {
            return [$item['departement'] => $item['name']];
        });


        $this->assertEquals([
            "IT" => collect(["Irfan", "Saipul", "Kilab"]),
            "HR" => collect(["Yasin"])
        ], $result->all());
    }
}
