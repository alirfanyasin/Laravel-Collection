<?php

namespace App\Class;

class Person
{
    /**
     * Create a new class instance.
     */

    public $nama;

    public function __construct($nama)
    {
        $this->nama = $nama;
    }
}
