<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={"get"},
 *     normalizationContext={
 *          "groups"={"client:read"},
 *          "swagger_definition_name": "Lire"
 *      }
 * )
 * @UniqueEntity(fields={"email"})
 */
class Client implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(
     *     message="L'adresse e-mail ne peut être vide."
     * )
     * @Assert\Email(
     *     message="L'adresse e-mail n'est pas sous un format correct."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"client:read"})
     * @Assert\NotBlank(
     *     message="Le nom du client ne peut être vide."
     * )
     * @Assert\Length(
     *     min=2,
     *     minMessage="Le nom du client doit contenir au minimum 2 caractères."
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClientMobile", mappedBy="client")
     */
    private $clientMobiles;

    public function __construct()
    {
        $this->clientMobiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    /**
     * @return Collection|ClientMobile[]
     */
    public function getClientMobiles(): Collection
    {
        return $this->clientMobiles;
    }

    public function addClientMobile(ClientMobile $clientMobile): self
    {
        if (!$this->clientMobiles->contains($clientMobile)) {
            $this->clientMobiles[] = $clientMobile;
            $clientMobile->setClient($this);
        }

        return $this;
    }

    public function removeClientMobile(ClientMobile $clientMobile): self
    {
        if ($this->clientMobiles->contains($clientMobile)) {
            $this->clientMobiles->removeElement($clientMobile);
            // set the owning side to null (unless already changed)
            if ($clientMobile->getClient() === $this) {
                $clientMobile->setClient(null);
            }
        }

        return $this;
    }
}
