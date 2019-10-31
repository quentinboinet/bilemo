<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *    collectionOperations={
 *     "get"={
 *          "normalization_context"={
 *              "groups"={"user:collection:get"},
 *              "swagger_definition_name": "Lire",
 *          }
 *     },
 *     "post"={
            "denormalization_context"={
 *              "groups"={"user:collection:post"},
 *              "swagger_definition_name": "Ecrire",
 *          }
 *     }},
 *     itemOperations={
 *     "get"={
 *          "normalization_context"={
 *              "groups"={"user:item:get"},
 *              "swagger_definition_name": "Lire"
 *          }
 *     },
 *     "delete"},
 *     attributes={
 *          "pagination_items_per_page"=10
 *     },
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="Ce nom d'utilisateur est déjà pris.")
 * @UniqueEntity(fields={"email"}, message="Cette adresse e-mail est déjà associée à un compte existant.")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"user:collection:get", "user:item:get", "user:collection:post"})
     * @Assert\NotBlank(
     *     message="Le nom d'utilisateur ne peut être vide."
     * )
     * @Assert\Length(
     *     min=2,
     *     minMessage="Le nom d'utilisateur doit contenir au minimum 2 caractères."
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"user:collection:get", "user:item:get", "user:collection:post"})
     * @Assert\NotBlank(
     *     message="L'adresse e-mail ne peut pas être vide."
     * )
     * @Assert\Email(
     *     message="L'adresse e-mail entrée n'est pas sous un format correct."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @Groups({"user:collection:post"})
     * @SerializedName("password")
     * @Assert\NotBlank(
     *     message="Le mot de passe ne peut être vide."
     * )
     * @Assert\Length(
     *     min=5,
     *     minMessage="Le mot de passe doit comprendre au minimum 5 caractères."
     * )
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"user:collection:get", "user:item:get", "user:collection:post"})
     * @Assert\Length(
     *     min=2,
     *     minMessage="Le prénom doit contenir au minimum 2 caractères."
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"user:collection:get", "user:item:get", "user:collection:post"})
     * @Assert\Length(
     *     min=2,
     *     minMessage="Le nom de famille doit contenir au minimum 2 caractères."
     * )
     */
    private $lastName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
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

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }


    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
