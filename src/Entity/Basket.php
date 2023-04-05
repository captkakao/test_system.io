<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
class Basket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'baskets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $buser = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Good $good = null;

    #[ORM\Column]
    private ?int $count = null;

    public function __construct(User $buser, Good $good, int $count = 1)
    {
        $this->buser = $buser;
        $this->good  = $good;
        $this->count = $count;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuser(): ?User
    {
        return $this->buser;
    }

    public function setBuser(?User $buser): self
    {
        $this->buser = $buser;

        return $this;
    }

    public function getGood(): ?Good
    {
        return $this->good;
    }

    public function setGood(?Good $good): self
    {
        $this->good = $good;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
