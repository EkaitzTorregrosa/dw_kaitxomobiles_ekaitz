<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pass;

    /**
     * @ORM\OneToMany(targetEntity=mobiles::class, mappedBy="users")
     */
    private $mobiles;

    public function __construct()
    {
        $this->mobiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * @return Collection|mobiles[]
     */
    public function getMobiles(): Collection
    {
        return $this->mobiles;
    }

    public function addMobile(mobiles $mobile): self
    {
        if (!$this->mobiles->contains($mobile)) {
            $this->mobiles[] = $mobile;
            $mobile->setUsers($this);
        }

        return $this;
    }

    public function removeMobile(mobiles $mobile): self
    {
        if ($this->mobiles->removeElement($mobile)) {
            // set the owning side to null (unless already changed)
            if ($mobile->getUsers() === $this) {
                $mobile->setUsers(null);
            }
        }

        return $this;
    }
}
