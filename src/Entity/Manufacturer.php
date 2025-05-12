<?php

namespace App\Entity;

use App\Repository\ManufacturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManufacturerRepository::class)]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    /**
     * @var Collection<int, VehicleInformation>
     */
    #[ORM\OneToMany(targetEntity: VehicleInformation::class, mappedBy: 'manufacturer')]
    private Collection $manufacturer;

    public function __construct()
    {
        $this->manufacturer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, VehicleInformation>
     */
    public function getManufacturer(): Collection
    {
        return $this->manufacturer;
    }

    public function addManufacturer(VehicleInformation $manufacturer): static
    {
        if (!$this->manufacturer->contains($manufacturer)) {
            $this->manufacturer->add($manufacturer);
            $manufacturer->setManufacturer($this);
        }

        return $this;
    }

    public function removeManufacturer(VehicleInformation $manufacturer): static
    {
        if ($this->manufacturer->removeElement($manufacturer)) {
            // set the owning side to null (unless already changed)
            if ($manufacturer->getManufacturer() === $this) {
                $manufacturer->setManufacturer(null);
            }
        }

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            '_id' => $this->id,
            'name' => $this->name,
            'country' => $this->country,
        ];
    }
}
