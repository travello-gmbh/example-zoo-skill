<?php
/**
 * PHP Magazin Alexa mit PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/RalfEggert/phpmagazin.alexa
 *
 */

namespace Zoo\Application\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ZooTextHelperFactory
 *
 * @package Zoo\Application\Helper
 */
class ZooTextHelperFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return ZooTextHelper
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ZooTextHelper
    {
        return new ZooTextHelper(
            [
                'de-DE' => include PROJECT_ROOT . '/data/texts/zoo.common.texts.de-DE.php',
                'en-US' => include PROJECT_ROOT . '/data/texts/zoo.common.texts.en-US.php',
            ]
        );
    }
}
