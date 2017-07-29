<?php
/**
 * PHP Magazin Alexa mit PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/RalfEggert/phpmagazin.alexa
 *
 */

namespace Zoo\Application;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zoo\Application\Helper\ZooTextHelper;

/**
 * Class ZooApplicationFactory
 *
 * @package Zoo\Application
 */
class ZooApplicationFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return ZooApplication
     */
    public function __invoke(
        ContainerInterface $container, $requestedName, array $options = null
    ): ZooApplication {
        $textHelper = $container->get(ZooTextHelper::class);
        $animalList = include PROJECT_ROOT . '/data/zoo/animals.php';

        return new ZooApplication($textHelper, $animalList);
    }
}
