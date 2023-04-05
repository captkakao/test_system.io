<?php

namespace App\Entity;

use App\Repository\CoutryTaxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoutryTaxRepository::class)]
#[ORM\Table(name: '`country_taxes`')]
class CoutryTax
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'coutryTax', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    #[ORM\Column]
    private ?float $taxPercentage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getTaxPercentage(): ?float
    {
        return $this->taxPercentage;
    }

    public function setTaxPercentage(float $taxPercentage): self
    {
        $this->taxPercentage = $taxPercentage;

        return $this;
    }
}
