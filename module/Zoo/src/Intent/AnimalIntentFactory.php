<?php
/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

namespace Zoo\Intent;

use Interop\Container\ContainerInterface;
use TravelloAlexaLibrary\Configuration\SkillConfiguration;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\TextHelper\TextHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AnimalIntentFactory
 *
 * @package Zoo\Intent
 */
class AnimalIntentFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return AnimalIntent
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var SkillConfiguration $skillConfiguration */
        $skillConfiguration = $container->get(SkillConfiguration::class);

        /** @var AlexaRequest $alexaRequest */
        $alexaRequest = $container->get(AlexaRequest::class);

        /** @var AlexaResponse $alexaResponse */
        $alexaResponse = $container->get(AlexaResponse::class);

        /** @var TextHelper $textHelper */
        $textHelper = $container->get($skillConfiguration->getTextHelperClass());

        $animalList = include PROJECT_ROOT . '/data/zoo/animals.php';

        /** @var AnimalIntent $intent */
        $intent = new AnimalIntent($alexaRequest, $alexaResponse, $textHelper);
        $intent->setAnimalList($animalList);

        return $intent;
    }
}
