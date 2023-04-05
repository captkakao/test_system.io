<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ORM\Table(name: '`countries`')]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\OneToOne(mappedBy: 'country', cascade: ['persist', 'remove'])]
    private ?CoutryTax $coutryTax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCoutryTax(): ?CoutryTax
    {
        return $this->coutryTax;
    }

    public function setCoutryTax(CoutryTax $coutryTax): self
    {
        // set the owning side of the relation if necessary
        if ($coutryTax->getCountry() !== $this) {
            $coutryTax->setCountry($this);
        }

        $this->coutryTax = $coutryTax;

        return $this;
    }
}
