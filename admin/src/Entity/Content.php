<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentRepository::class)]
class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\Column(nullable: true)]
    private ?int $order = null;

    #[ORM\Column]
    private ?bool $isOk = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $toolTip = null;

    #[ORM\ManyToOne(inversedBy: 'contents')]
    private ?ContentType $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function isIsOk(): ?bool
    {
        return $this->isOk;
    }

    public function setIsOk(bool $isOk): static
    {
        $this->isOk = $isOk;

        return $this;
    }

    public function getToolTip(): ?string
    {
        return $this->toolTip;
    }

    public function setToolTip(?string $toolTip): static
    {
        $this->toolTip = $toolTip;

        return $this;
    }

    public function getType(): ?ContentType
    {
        return $this->type;
    }

    public function setType(?ContentType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
