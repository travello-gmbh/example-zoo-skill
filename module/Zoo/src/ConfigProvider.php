<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace Zoo;

use Zoo\Action\PrivacyAction;
use Zoo\Action\PrivacyActionFactory;
use Zoo\Action\ZooAction;
use Zoo\Action\ZooActionFactory;
use Zoo\Application\Helper\ZooTextHelper;
use Zoo\Application\Helper\ZooTextHelperFactory;
use Zoo\Application\ZooApplication;
use Zoo\Application\ZooApplicationFactory;
use Zoo\Config\RouterDelegatorFactory;
use Zend\Expressive\Application;

/**
 * Class ConfigProvider
 *
 * @package Zoo
 */
class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [
                    RouterDelegatorFactory::class,
                ],
            ],
            'factories'  => [
                ZooAction::class     => ZooActionFactory::class,
                PrivacyAction::class => PrivacyActionFactory::class,

                ZooApplication::class => ZooApplicationFactory::class,
                ZooTextHelper::class  => ZooTextHelperFactory::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'zoo' => [__DIR__ . '/../templates/zoo'],
            ],
        ];
    }
}
