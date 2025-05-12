<?php

namespace App\Entity;

use App\Repository\VehicleInformationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VehicleInformationRepository::class)]
class VehicleInformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $make = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $model = null;

    #[ORM\Column]
    #[Assert\Range(min:1886)]
    private ?int $year = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $colour = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $type = null;

    #[ORM\Column(length: 17)]
    #[Assert\NotBlank]
    private ?string $vehicleIdentificationNumber = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\DateTime]
    private ?\DateTime $registration_date = null;

    #[ORM\Column(length: 12)]
    #[Assert\NotBlank]
    private ?string $licencePlate = null;

    #[ORM\Column(length: 2)]
    #[Assert\NotBlank]
    private ?string $country = null;

    #[ORM\ManyToOne(inversedBy: 'manufacturer')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manufacturer $manufacturer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): static
    {
        $this->colour = $colour;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getVehicleIdentificationNumber(): ?string
    {
        return $this->vehicleIdentificationNumber;
    }

    public function setVehicleIdentificationNumber(string $vehicleIdentificationNumber): static
    {
        $this->vehicleIdentificationNumber = $vehicleIdentificationNumber;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTime
    {
        return $this->registration_date;
    }

    public function setRegistrationDate(\DateTime $registration_date): static
    {
        $this->registration_date = $registration_date;

        return $this;
    }

    public function getLicencePlate(): ?string
    {
        return $this->licencePlate;
    }

    public function setLicencePlate(string $licencePlate): static
    {
        $this->licencePlate = $licencePlate;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            '_id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'colour' => $this->colour,
            'type' => $this->type,
            'vehicleIdentificationNumber' => $this->vehicleIdentificationNumber,
            'registrationDate' => $this->registration_date,
            'manufacturuer' => $this->manufacturer->getName(),
        ];
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }
}
