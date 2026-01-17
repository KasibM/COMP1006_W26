<?php 
declare(strict_types=1); //variable types must be declared

class Car { 
    // variable declarations
    public string $make; 
    public string $model;
    public int $year;
    // constructor
    public function __construct(string $make, string $model, int $year){
        //passes arguments to this instance of Car object
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }
    // methods 
    public function describe(): string{
        // returns string with make, model and year information.
        return "Make: {$this->make} | Model: {$this->model} | Year: {$this->year}";
    }
}
?>