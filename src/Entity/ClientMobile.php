<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientMobileRepository")
 */
class ClientMobile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="clientMobiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mobile", inversedBy="clientMobiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mobile;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"mobile:item:get", "mobile:collection:get"})
     * @Assert\NotBlank(
     *     message="La valeur du stock ne peut être vide."
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="Le stock doit être un nombre."
     * )
     */
    private $stock;

    /**
     * @ORM\Column(type="float")
     * @Groups({"mobile:item:get", "mobile:collection:get"})
     * @Assert\NotBlank(
     *     message="Le prix entré ne peut être vide."
     * )
     * @Assert\Type(
     *     type="float",
     *     message="Le prix entré doit être un nombre."
     * )
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getMobile(): ?Mobile
    {
        return $this->mobile;
    }

    public function setMobile(?Mobile $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
