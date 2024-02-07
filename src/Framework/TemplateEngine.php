<?php

declare(strict_types=1);

namespace Acme\Framework;

class TemplateEngine
{
    private array $globalArrayTemplate = [];

    public function __construct(
        private string $basePath
    ) {
    }

    public function render(string $template, array $data = [])
    {
        extract($data, EXTR_SKIP);

        extract($this->globalArrayTemplate, EXTR_SKIP);

        ob_start();

        include $this->resolve($template);

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }

    public function resolve(string $path)
    {
        return "{$this->basePath}/{$path}";
    }

    public function addGlobal(string $key, mixed $value)
    {
        $this->globalArrayTemplate[$key] = $value;
    }
}
