<?php
declare(strict_types=1);

class Car {
    public string $make;
    public string $model;
    public int $year;
    public function __construct(string $make, string $model, int $year){
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    public function Describe(): string{
        

    }

}
?>