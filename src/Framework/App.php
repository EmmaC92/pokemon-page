<?php

namespace Acme\Framework;

use Acme\Framework\exceptions\{
    InvalidPokemonIdException,
    FileNotFoundException,
    EmptyListException
};

use Acme\Framework\Router;

use Acme\Framework\{
    TemplateEngine,
    Container
};
use Acme\App\Config\Paths;

class App
{
    private Router $router;

    private Container $container;

    private TemplateEngine $views;

    public function __construct(string $containerDefinitionPath = null)
    {
        $this->router = new Router();
        $this->views = new TemplateEngine(Paths::VIEW);
        $this->container = new Container();

        if ($containerDefinitionPath) {
            $containerDefinition = include $containerDefinitionPath;

            $this->container->addDefinition($containerDefinition);
        }
    }

    public function get(string $path, array $controller)
    {
        $this->router->add('GET', $path, $controller);
    }

    public function addMiddleware(string $middleware)
    {
        $this->router->addMiddleware($middleware);
    }

    public function run()
    {
        try {
            error_log("Application running..");

            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $merhod = $_SERVER['REQUEST_METHOD'];

            $this->router->dispatch($path, $merhod, $this->container);
        } catch (InvalidPokemonIdException $ex) {
            error_log("ERROR: " . $ex->getMessage());
            $frontErrorMessage = 'There was an error on Pokemon Id.';
        } catch (FileNotFoundException $ex) {
            error_log("ERROR: " . $ex->getMessage());
            $frontErrorMessage = 'There was an error on Pokemon list file.';
        } catch (EmptyListException $ex) {
            error_log("ERROR: " . $ex->getMessage());
            $frontErrorMessage = 'list of pokemon is empty.';
        } catch (\Exception $ex) {
            error_log("ERROR: " . $ex->getMessage());
            $frontErrorMessage = 'Unknown Error. ' . $ex->getMessage();
        } finally {
            if (isset($frontErrorMessage)) {
                echo $this->views->render('/error.php', [
                    'frontErrorMessage' => $frontErrorMessage
                ]);
            }
        }
    }
}
