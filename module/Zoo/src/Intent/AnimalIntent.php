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
        $randomAnimal = $this->getRandomAnimal();

        $zooMessage = $this->getTextHelper()->getAnimalMessage($randomAnimal);

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

    /**
     * @return string
     */
    private function getRandomAnimal()
    {
        $locale = $this->getAlexaRequest()->getRequest()->getLocale();

        $animals = $this->getAlexaResponse()->getSessionContainer()->getAttribute('animals');

        do {
            $randomType      = array_rand($this->animalList[$locale]);
            $randomAnimalKey = array_rand($this->animalList[$locale][$randomType]);
            $randomAnimal    = $this->animalList[$locale][$randomType][$randomAnimalKey];

        } while(in_array($randomAnimal, $animals));

        if (count($animals) >= 5) {
            array_shift($animals);
        }

        $animals[] = $randomAnimal;

        $this->getAlexaResponse()->getSessionContainer()->setAttribute('animals', $animals);

        return $randomAnimal;
    }
}
