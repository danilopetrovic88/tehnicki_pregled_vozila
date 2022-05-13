<?php 

// Zadatak 2
// - Napraviti aplikaciju koja simulira tehnički pregled vozila.
// - Napraviti interfejs Vehicle koji predstavlja apstrakciju vozila i ima metodu za inspect koja simulira tehnički pregled.
// - Napraviti dve konkretne klase vozila, Car i Bike. 
// - Iskoristiti Abstract factory pattern za instanciranje gore pomenutih objekata.
// - Na kraju, kreirati klasu InspectionService koji prima vozila i radi tehnicki pregled na njima. Ova klasa treba da je singleton. Ova klasa treba da prati broj pregledanih vozila.
// - Ispisati na kraju ukupan broj pregledanih vozila.

interface VehicleInterface {
    public function inspect();
}

class InspectionService  {
    private static $instance;
    private $allVehicles = [];
    private $count = 0;

    private function __construct(){}

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new InspectionService();
        }

        return self::$instance;
    }

    public function addVehicle(Vehicle $vehicle, $num) {
        for ($i=0; $i < $num; $i++) { 
            $this->allVehicles[] = $vehicle;
        }
    }

    public function getAllVehicles() {
        return $this->allVehicles;
    }

    public function getCount() {
        return $this->count;
    }

    public function inspectVehicle() {
        foreach ($this->allVehicles as $vehicle) {
            $vehicle->inspect($vehicle->getVehicleType());
            $this->count++;
        }

        return;
    }
}




abstract class Vehicle implements VehicleInterface {
    protected $vehicleType;

    public function __construct($vehicleType) {
        $this->vehicleType = $vehicleType;
    }

    public function inspect() {
        echo "Uradi tehnicki pregled za vozilo " . $this->getVehicleType() . " <br/>";
    }

    public function getVehicleType() {
        return $this->vehicleType;
    }
}

class Car extends Vehicle {

}

class Bike extends Vehicle {
    
}

class VehicleFactory {
    public static function make($vehicleType) {
        if($vehicleType == 'Car') {
            return new Car('Car');
        } else if($vehicleType == 'Bike') {
            return new Bike('Bike');
        }
    }
}


$inspectionService = InspectionService::getInstance();
$car = VehicleFactory::make('Car');
$bike = VehicleFactory::make('Bike');

$inspectionService->addVehicle($car, 3);
$inspectionService->addVehicle($bike, 5);

$inspectionService->inspectVehicle();




echo "<pre>";
var_dump($inspectionService->getCount());
echo "<pre/>";
