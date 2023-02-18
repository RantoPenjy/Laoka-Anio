<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $day = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $recipe = null;

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

    public function isDay(): ?bool
    {
        return $this->day;
    }

    public function setDay(bool $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getRecipe(): ?string
    {
        return $this->recipe;
    }

    public function setRecipe(?string $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    #[Pure]
    #[ArrayShape(['id' => "int|null", 'name' => "null|string", 'recipe' => "null|string", 'day' => "bool|null"])]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'recipe' => $this->getRecipe(),
            'day' => $this->isDay(),
        ];
    }
}
