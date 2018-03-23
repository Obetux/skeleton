<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 * @ORM\Table(
 *     indexes={
 *          @ORM\Index(name="indice_extra", columns={"index"})
 *     })
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $index
     *
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    protected $index;

    /**
     * @var string $string
     *
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
     */
    protected $string;

    /**
     * @var string $roles
     *
     * @ORM\Column(type="array", nullable=true)
     */
    protected $array;

    /**
     * @var boolean $boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $boolean;

    /**
    * @var \DateTime $created
    *
    * @ORM\Column(type="datetime")
    */
    protected $created;


}
