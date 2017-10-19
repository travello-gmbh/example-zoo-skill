<?php
/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;

define('PROJECT_ROOT', realpath(__DIR__ . '/..'));

define(
    'APPLICATION_ENV',
    getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'
);

chdir(dirname(__DIR__));
require PROJECT_ROOT . '/vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require PROJECT_ROOT . '/config/container.php';

/** @var Application $app */
$app = $container->get(Application::class);
$app->run();
