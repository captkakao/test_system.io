<?php

namespace App\Entity;

use App\Repository\StoreOwnerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoreOwnerRepository::class)]
class StoreOwner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Store::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?int $store = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?int $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStore(): ?int
    {
        return $this->store;
    }

    public function setStore(?int $store): void
    {
        $this->store = $store;
    }

    public function getOwner(): ?int
    {
        return $this->owner;
    }

    public function setOwner(?int $owner): void
    {
        $this->owner = $owner;
    }
}
