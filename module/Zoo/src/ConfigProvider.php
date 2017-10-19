<?php
/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

namespace Zoo;

use TravelloAlexaLibrary\Application\AlexaApplication;
use TravelloAlexaLibrary\TextHelper\TextHelper;
use Zend\Expressive\Application;
use Zoo\Config\RouterDelegatorFactory;
use Zoo\Intent\AbstractIntentFactory;
use Zoo\Intent\AnimalIntent;
use Zoo\Intent\CountIntent;

/**
 * Class ConfigProvider
 *
 * @package Zoo
 */
class ConfigProvider
{
    /** Name of skill for configuration */
    const NAME = 'zoo-skill';

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'skills'       => $this->getSkills(),
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

    /**
     * @return array
     */
    public function getSkills(): array
    {
        return [
            self::NAME => [
                'applicationId'    => 'amzn1.ask.skill.place-your-skill-id-here',
                'applicationClass' => AlexaApplication::class,
                'textHelperClass'  => TextHelper::class,
                'sessionDefaults'  => [
                    'animals' => [],
                ],
                'smallImageUrl'    => 'https://www.travello.audio/cards/zoo-480x480.png',
                'largeImageUrl'    => 'https://www.travello.audio/cards/zoo-800x800.png',
                'intents'          => [
                    'aliases' => [
                        AnimalIntent::NAME => AnimalIntent::class,
                        CountIntent::NAME  => CountIntent::class,
                    ],

                    'factories' => [
                        AnimalIntent::class => AbstractIntentFactory::class,
                        CountIntent::class  => AbstractIntentFactory::class,
                    ],
                ],
                'texts'            => [
                    'de-DE' => include PROJECT_ROOT . '/data/texts/zoo.common.texts.de-DE.php',
                    'en-US' => include PROJECT_ROOT . '/data/texts/zoo.common.texts.en-US.php',
                ],
            ]
        ];
    }
}
