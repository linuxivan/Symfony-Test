<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="App\Repository\UsuariosRepository")
 */
class Usuarios
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=55, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=55, nullable=true)
     */
    private $password;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="admin", type="boolean", nullable=true)
     */
    private $admin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fotoPerfil", type="string", length=155, nullable=true)
     */
    private $fotoperfil;

    /**
     * @param string|null $username
     * @param string|null $password
     * @param bool|null $admin
     * @param string|null $fotoperfil
     */
    public function __construct(?string $username, ?string $password, ?bool $admin, ?string $fotoperfil)
    {
        $this->username = $username;
        $this->password = $password;
        $this->admin = $admin;
        $this->fotoperfil = $fotoperfil;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

 //   /**
 //   * @return string|null
 //    */
 //   public function getPassword(): ?string
 //   {
 //       return $this->password;
 //   }
    

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return bool|null
     */
    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    /**
     * @param bool|null $admin
     */
    public function setAdmin(?bool $admin): void
    {
        $this->admin = $admin;
    }

    /**
     * @return string|null
     */
    public function getFotoperfil(): ?string
    {
        return $this->fotoperfil;
    }

    /**
     * @param string|null $fotoperfil
     */
    public function setFotoperfil(?string $fotoperfil): void
    {
        $this->fotoperfil = $fotoperfil;
    }

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }



}
