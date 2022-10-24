<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursosUsuarios
 *
 * @ORM\Table(name="cursos_usuarios", indexes={@ORM\Index(name="alumno", columns={"alumno"}), @ORM\Index(name="curso", columns={"curso"})})
 * @ORM\Entity(repositoryClass="App\Repository\CursosUsuariosRepository")
 */
class CursosUsuarios
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
     * @var int|null
     *
     * @ORM\Column(name="nota", type="integer", nullable=true)
     */
    private $nota;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno", referencedColumnName="id")
     * })
     */
    private $alumno;

    /**
     * @var \Cursos
     *
     * @ORM\ManyToOne(targetEntity="Cursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="curso", referencedColumnName="id")
     * })
     */
    private $curso;

    public function __construct()
    {
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
     * @return int|null
     */
    public function getNota(): ?int
    {
        return $this->nota;
    }

    /**
     * @param int|null $nota
     */
    public function setNota(?int $nota): void
    {
        $this->nota = $nota;
    }

    /**
     * @return Usuarios
     */
    public function getAlumno(): Usuarios
    {
        return $this->alumno;
    }

    /**
     * @param Usuarios $alumno
     */
    public function setAlumno(Usuarios $alumno): void
    {
        $this->alumno = $alumno;
    }

    /**
     * @return Cursos
     */
    public function getCurso(): Cursos
    {
        return $this->curso;
    }

    /**
     * @param Cursos $curso
     */
    public function setCurso(Cursos $curso): void
    {
        $this->curso = $curso;
    }



}
