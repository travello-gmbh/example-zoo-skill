<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
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
            include PROJECT_ROOT . '/data/texts/zoo.common.texts.php'
        );
    }
}
