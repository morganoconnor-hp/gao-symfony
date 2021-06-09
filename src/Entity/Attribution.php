<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AttributionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AttributionRepository::class)
 * @ApiResource
 */
class Attribution
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"assignement"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"assignement"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class)
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"assignement"})
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=Computer::class)
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"assignement"})
     */
    private $computer;

    /**
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"assignement"})
     */
    private $schedule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getComputer(): ?Computer
    {
        return $this->computer;
    }

    public function setComputer(?Computer $computer): self
    {
        $this->computer = $computer;

        return $this;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }
}
