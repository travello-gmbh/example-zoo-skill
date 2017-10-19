<?php
/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

namespace Zoo\Intent;

use TravelloAlexaLibrary\Intent\AbstractIntent;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class AnimalIntent
 *
 * @package Zoo\Intent
 */
class AnimalIntent extends AbstractIntent
{
    const NAME = 'AnimalIntent';

    /**
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(string $smallImageUrl, string $largeImageUrl): AlexaResponse
    {
        $animal = $this->getAlexaRequest()->getRequest()->getLocale() === 'de-DE' ? 'Ein Elefant' : 'An elephant';

        $zooMessage = $this->getTextHelper()->getAnimalMessage($animal);

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($zooMessage)
        );

        $this->getAlexaResponse()->setCard(
            new Standard(
                $this->getTextHelper()->getAnimalTitle(),
                $zooMessage,
                $smallImageUrl,
                $largeImageUrl
            )
        );

        return $this->getAlexaResponse();
    }
}
