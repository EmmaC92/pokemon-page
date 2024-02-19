<?php

declare(strict_types=1);

namespace Acme\Framework;

use Acme\Framework\Contracts\TemplateEngineInterface;

class TemplateEngine implements TemplateEngineInterface
{
    public function __construct(
        private string $templateBasePath,
        private array $globalArrayTemplate = []
    ) {
        $this->setTemplateBasePath($templateBasePath);
    }

    public function getView(string $templatePath = null, array $params = []): bool|string
    {
        ob_start();

        extract($params, EXTR_SKIP);

        extract($this->globalArrayTemplate, EXTR_SKIP);

        include $this->resolvePath($templatePath);

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }

    public function renderView(string $templatePath = null, array $params = []): void
    {
        echo $this->getView($templatePath, $params);
    }

    public function resolvePath(string $path = null): string
    {
        return "{$this->templateBasePath}/{$path}";
    }

    public function addParam(string $key, mixed $value): void
    {
        $this->globalArrayTemplate[$key] = $value;
    }

    public function setTemplateBasePath(string $path): void
    {
        $this->templateBasePath = $path;
    }
}
