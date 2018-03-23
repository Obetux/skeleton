<?php
/*
 * MODELO DE EJEMPLO
 * Usar para referencia de como declarar los modelos y que queden documentos con SWAGGER
 * Deben implemnetar la serializacion
 */

namespace App\Model;

use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @SWG\Definition(
 *     type="object",
 *     definition="Test"
 * )
 * @Serializer\ExclusionPolicy("all")
 */
class Test implements \JsonSerializable
{

    /**
     * @Serializer\Type("integer")
     * @Serializer\Expose
     *
     * @SWG\Property(description = "User id",
     *     example=1232152154, default = null)
     */
    private $id;

    /**
     * @Serializer\Type("string")
     * @Serializer\Expose
     *
     * @SWG\Property(
     *   property="username",
     *   type="string",
     *   example="PatoDonald",
     *   description="username"
     * )
     */
    private $username;



    /**
     * Test constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $test
     * @return $this
     */
    public function hydrate($test)
    {
        /*
         * Metodo para hidratar un Modelo TEST con las ENTITIES que hagan falta
         */
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        /*
         * Serializacion para devolver el objeto como JSON
         */
        $test = array(
            'id' => $this->id,
            'username' => $this->username,

        );

        return $test;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Test
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return Test
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }




}