<?php
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
 * Class CountIntent
 *
 * @package Zoo\Intent
 */
class CountIntent extends AbstractIntent
{
    const NAME = 'CountIntent';

    /** @var array */
    private $animalList = [];

    /**
     * @param array $animalList
     */
    public function setAnimalList(array $animalList)
    {
        $this->animalList = $animalList;
    }

    /**
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(string $smallImageUrl, string $largeImageUrl): AlexaResponse
    {
        $count = $this->getAnimalCount();

        $zooMessage = $this->getTextHelper()->getCountMessage($count);

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($zooMessage)
        );

        $this->getAlexaResponse()->setCard(
            new Standard(
                $this->getTextHelper()->getCountTitle(),
                $zooMessage,
                $smallImageUrl,
                $largeImageUrl
            )
        );

        return $this->getAlexaResponse();
    }

    /**
     * @return string
     */
    private function getAnimalCount()
    {
        $locale = $this->getAlexaRequest()->getRequest()->getLocale();

        $count = 0;

        foreach ($this->animalList[$locale] as $type => $typeList) {
            $count += count($typeList);
        }

        return $count;
    }
}
