<?php

namespace OxygenzSAS\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{

    private $container = [];

    private static $_instance = null;

    /**
     * Retourne une instance singleton du fichier de config
     * @param null $path_config_file Chemin vers le fichier de config
     * @return null|Container
     */
    public static function getInstance($path_config_file = null){

        if( !(self::$_instance instanceof self) )
            self::$_instance = new self($path_config_file);

        return self::$_instance;

    }

    /**
     * Config constructor.
     * @param string $path_config_file Chemin vers le fichier de configuration
     */
    public function __construct($path_config_file)
    {
        $this->container = require_once($path_config_file);
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        if(!$this->has($id))
            throw new NotFoundException();

        if(is_callable($this->container[$id]))
            return $this->container[$id]();

        return $this->container[$id];

    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id)
    {
        return (isset($this->container[$id]));
    }

}