<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace Zoo\Action;

use Interop\Container\ContainerInterface;
use Zoo\Application\ZooApplication;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ZooActionFactory
 *
 * @package Zoo\Action
 */
class ZooActionFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return ZooAction
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ZooAction
    {
        $zooApplication = $container->get(ZooApplication::class);

        return new ZooAction($zooApplication);
    }
}
