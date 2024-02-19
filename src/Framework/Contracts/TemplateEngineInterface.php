<?php

declare(strict_types=1);

namespace Acme\Framework\Contracts;

interface TemplateEngineInterface
{
    public function getView(string $templatePath = null): mixed;

    public function renderView(string $view = null, array $params = []);

    public function addParam(string $key, string $value);

    public function setTemplateBasePath(string $path);
}
