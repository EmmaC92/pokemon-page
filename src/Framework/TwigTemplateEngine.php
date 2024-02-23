<?php

declare(strict_types=1);

namespace Acme\Framework;

use Acme\Framework\Contracts\TemplateEngineInterface;

use Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class TwigTemplateEngine implements TemplateEngineInterface
{
    private ?FilesystemLoader $loader = null;
    private ?Environment $twig = null;

    public function __construct(
        private string $templateBasePath,
        private array $globalArrayTemplate = [],
    ) {
        $this->setTemplateBasePath($templateBasePath);
        $this->twig = new Environment($this->loader, []);
    }

    public function getView(string $templatePath = null, array $params = []): bool|string
    {
        $params = array_merge($this->globalArrayTemplate, $params);

        $output = $this->twig->render($templatePath, $params);;

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
        $this->loader = new FilesystemLoader($path);
    }
}
