<?php

/**
 * @see       https://github.com/laminas/laminas-di for the canonical source repository
 * @copyright https://github.com/laminas/laminas-di/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-di/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Di;

/**
 * Interface that defines the dependency injector
 */
interface InjectorInterface
{
    /**
     * Check if this dependency injector can handle the given class
     *
     * @param string $name
     * @return bool
     */
    public function canCreate(string $name) : bool;

    /**
     * Create a new instance of a class or alias
     *
     * @param mixed $name Class name or service alias
     * @param array $options Parameters used for instanciation
     * @return object The resulting instace
     * @throws Exception\ExceptionInterface When an error occours during instanciation
     */
    public function create(string $name, array $options = []);
}
