<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use App\Entity\VehicleInformation;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleInformationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manufacturer1 = $this->createManufacturer('Toyota', 'Japan');
        $manufacturer2 = $this->createManufacturer('Ford', 'USA');
        $manufacturer3 = $this->createManufacturer('Honda', 'Japan');

        $manager->persist($manufacturer1);
        $manager->persist($manufacturer2);
        $manager->persist($manufacturer3);

        $manager->persist($this->createVehicleInformation(
            'Ford',
            'F-150',
            2010,
            'white',
            'SUV',
            '1G1YY22L2J5176666',
            new DateTime('2010-01-01'),
            '573K78',
            'GB',
            $manufacturer2
        ));

        $manager->persist( $this->createVehicleInformation(
            'Toyota',
            'Camry',
            2009,
            'black',
            'Truck',
            '1F1YK22K2J5148232',
            new DateTime('2011-01-01'),
            '64HT',
            'GB',
            $manufacturer1
        ));

        $manager->persist( $this->createVehicleInformation(
            'Toyota',
            'Yaris',
            2009,
            'black',
            'Luxury',
            '1G2XK22K2J5148232',
            new DateTime('2011-01-01'),
            '63HT',
            'GB',
            $manufacturer1
        ));

        $manager->persist( $this->createVehicleInformation(
            'Toyota',
            'Jazz',
            2008,
            'black',
            'Luxury',
            '1G2XK22K2J5148232',
            new DateTime('2012-01-01'),
            '5467T',
            'GB',
            $manufacturer3
        ));

        $manager->flush();
    }

    private function createManufacturer(
        string $name,
        string $country,
    ): Manufacturer {
        return (new Manufacturer())
            ->setName($name)
            ->setCountry($country);
    }

    private function createVehicleInformation(
        string $make,
        string $model,
        int $year,
        string $colour,
        string $type,
        string $vehicleIdentificationNumber,
        DateTime $registrationDate,
        string $licencePlate,
        string $country,
        Manufacturer $manufacturer
    ): VehicleInformation {
        return (new VehicleInformation())
            ->setMake($make)
            ->setModel($model)
            ->setYear($year)
            ->setColour($colour)
            ->setType($type)
            ->setVehicleIdentificationNumber($vehicleIdentificationNumber)
            ->setRegistrationDate($registrationDate)
            ->setLicencePlate($licencePlate)
            ->setCountry($country)
            ->setManufacturer($manufacturer);
    }
}
