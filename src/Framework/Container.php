<?php

declare(strict_types=1);

namespace Acme\Framework;

use Acme\Framework\exceptions\ContainerException;
use ReflectionClass, ReflectionNamedType;

class Container
{
    private array $definitions = [];

    private array $resolved = [];

    public function addDefinition(array $newDefinitions): void
    {
        // $this->definitions = [...$this->definitions, ...$newDefinitions];
        $this->definitions = array_merge($this->definitions, $newDefinitions);
    }

    public function resolve(string $className)
    {
        $refrectionClass = new ReflectionClass($className);

        if (!$refrectionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable.");
        }

        $contructor = $refrectionClass->getConstructor();

        if (!$contructor) {
            return new $className;
        }

        $params = $contructor->getParameters();

        if (count($params) === 0) {
            return new $className;
        }

        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve class {$className} because param {$name} is missing a type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className} because invalid param name");
            }
            
            $dependencies[] = $this->get($type->getName());
        }

        return $refrectionClass->newInstanceArgs($dependencies);
    }

    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} is not exist in the container.");
        }

        $factory = $this->definitions[$id];
        $dependency = $factory();

        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}
