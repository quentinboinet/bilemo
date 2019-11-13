<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get"={
 *          "normalization_context"={
 *              "groups"={"mobile:collection:get"},
 *              "swagger_definition_name": "Lire",
 *          }
 *     }},
 *     itemOperations={"get"={
 *          "normalization_context"={
 *              "groups"={"mobile:item:get"},
 *              "swagger_definition_name": "Lire"
 *          }
 *     }},
 *     attributes={
 *          "pagination_items_per_page"=10
 *     },
 *
 * )
 * @ApiFilter(SearchFilter::class, properties={"model": "partial", "brand.name" : "exact"})
 * @ApiFilter(RangeFilter::class, properties={"year", "price"})
 * @ORM\Entity(repositoryClass="App\Repository\MobileRepository")
 */
class Mobile
{
    private $JWTTokenAuthenticator;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="mobiles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"mobile:item:get", "mobile:collection:get"})
     * @Assert\Valid()
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"mobile:item:get", "mobile:collection:get"})
     * @Assert\NotBlank(
     *     message="Le modèle ne peut pas être vide."
     * )
     * @Assert\Length(
     *     min=2,
     *     minMessage="Le modèle du mobile doit contenir au minimum 2 caractères."
     * )
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"mobile:item:get", "mobile:collection:get"})
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"mobile:item:get"})
     * @Assert\Length(
     *     min=50,
     *     minMessage="La description du mobile doit contenir au minimum 50 caractères."
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"mobile:item:get", "mobile:collection:get"})
     * @Assert\NotBlank(
     *     message="L'année du mobile ne peut pas être vide."
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="L'année du mobile doit être un nombre."
     * )
     */
    private $year;

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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

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
