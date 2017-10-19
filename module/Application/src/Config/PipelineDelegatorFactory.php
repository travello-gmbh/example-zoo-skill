<?php
/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

namespace Application\Config;

use Interop\Container\ContainerInterface;
use TravelloAlexaZf\Middleware\CheckApplicationMiddleware;
use TravelloAlexaZf\Middleware\ConfigureSkillMiddleware;
use TravelloAlexaZf\Middleware\LogAlexaRequestMiddleware;
use TravelloAlexaZf\Middleware\SetLocaleMiddleware;
use TravelloAlexaZf\Middleware\ValidateCertificateMiddleware;
use Zend\Expressive\Application;
use Zend\Expressive\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Middleware\ImplicitOptionsMiddleware;
use Zend\Expressive\Middleware\NotFoundHandler;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Zend\Stratigility\Middleware\ErrorHandler;
use Zend\Stratigility\Middleware\OriginalMessages;

/**
 * Class PipelineDelegatorFactory
 *
 * @package Application\Config
 */
class PipelineDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $name
     * @param callable           $callback
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        /** @var Application $application */
        $application = $callback();

        $application->pipe(OriginalMessages::class);

        $application->pipe(ErrorHandler::class);

        $application->pipeRoutingMiddleware();
        $application->pipe(ConfigureSkillMiddleware::class);
        $application->pipe(LogAlexaRequestMiddleware::class);
        $application->pipe(CheckApplicationMiddleware::class);
        $application->pipe(ValidateCertificateMiddleware::class);
        $application->pipe(SetLocaleMiddleware::class);
        $application->pipe(ImplicitHeadMiddleware::class);
        $application->pipe(ImplicitOptionsMiddleware::class);
        $application->pipeDispatchMiddleware();

        $application->pipe(NotFoundHandler::class);

        return $application;
    }
}
