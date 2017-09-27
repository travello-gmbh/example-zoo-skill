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

use TravelloAlexaLibrary\Application\AbstractAlexaApplication;
use TravelloAlexaLibrary\Request\RequestType\IntentRequestType;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;
use Zoo\Application\Helper\ZooTextHelperInterface;

/**
 * Class ZooApplication
 *
 * @package Zoo\Application
 */
class ZooApplication extends AbstractAlexaApplication
{
    /** @var string */
    protected $applicationId = 'amzn1.ask.skill.7e43651b-adee-4e0d-b618-bc444a9c5218';

    /** @var string */
    protected $smallImageUrl = 'https://www.travello.audio/cards/zoo-480x480.png';

    /** @var string */
    protected $largeImageUrl = 'https://www.travello.audio/cards/zoo-800x800.png';

    /** @var ZooTextHelperInterface */
    protected $textHelper;

    /** @var array */
    private $animalList = [];

    /** @var array */
    private $sessionAnimals = [];

    /**
     * ZooApplication constructor.
     *
     * @param ZooTextHelperInterface $textHelper
     * @param array                  $animalList
     */
    public function __construct(ZooTextHelperInterface $textHelper, array $animalList)
    {
        parent::__construct($textHelper);

        $this->animalList = $animalList;
    }

    /**
     * Initialize the attributes
     *
     * @return bool
     */
    protected function initSessionAttributes(): bool
    {
        if ($this->alexaRequest->getSession()->getAttribute('animals')) {
            $this->sessionAnimals = $this->alexaRequest->getSession()->getAttribute('animals');
        } else {
            $this->sessionAnimals = [];
        }

        return true;
    }

    /**
     * Get the session attributes
     *
     * @return array
     */
    protected function getSessionAttributes(): array
    {
        return [
            'animals' => $this->sessionAnimals,
        ];
    }

    /**
     * Reset the session attributes
     */
    protected function resetSessionAttributes()
    {
    }

    /**
     * Handle custom application intents
     *
     * @return bool
     */
    protected function handleIntentRequest(): bool
    {
        /** @var IntentRequestType $intentRequest */
        $intentRequest = $this->alexaRequest->getRequest();

        switch ($intentRequest->getIntent()->getName()) {
            case 'AnimalIntent':
                return $this->animalIntent();
            // no break

            case 'CountIntent':
                return $this->countIntent();
            // no break

            case 'AMAZON.StopIntent':
                return $this->stopIntent();
            // no break

            case 'AMAZON.CancelIntent':
                return $this->cancelIntent();
            // no break

            case 'AMAZON.HelpIntent':
            default:
                return $this->helpIntent();
        }
    }

    /**
     * Handle the animal intent
     *
     * @return bool
     */
    private function animalIntent(): bool
    {
        $randomAnimal = $this->getRandomAnimal();

        $zooMessage = $this->textHelper->getAnimalMessage($randomAnimal);

        $this->alexaResponse->setOutputSpeech(
            new SSML($zooMessage)
        );

        $this->alexaResponse->setCard(
            new Standard(
                $this->textHelper->getAnimalTitle(),
                $zooMessage,
                $this->smallImageUrl,
                $this->largeImageUrl
            )
        );

        $this->alexaResponse->addSessionAttribute('animals', $this->sessionAnimals);

        return true;
    }

    /**
     * @return string
     */
    private function getRandomAnimal()
    {
        $locale = $this->alexaRequest->getRequest()->getLocale();

        do {
            $randomType      = array_rand($this->animalList[$locale]);
            $randomAnimalKey = array_rand($this->animalList[$locale][$randomType]);
            $randomAnimal    = $this->animalList[$locale][$randomType][$randomAnimalKey];

        } while(in_array($randomAnimal, $this->sessionAnimals));

        if (count($this->sessionAnimals) >= 5) {
            array_shift($this->sessionAnimals);
        }

        $this->sessionAnimals[] = $randomAnimal;

        return $randomAnimal;
    }

    /**
     * Handle the count intent
     *
     * @return bool
     */
    private function countIntent(): bool
    {
        $count = $this->getAnimalCount();

        $zooMessage = $this->textHelper->getCountMessage($count);

        $this->alexaResponse->setOutputSpeech(
            new SSML($zooMessage)
        );

        $this->alexaResponse->setCard(
            new Standard(
                $this->textHelper->getCountTitle(),
                $zooMessage,
                $this->smallImageUrl,
                $this->largeImageUrl
            )
        );

        return true;
    }

    /**
     * @return string
     */
    private function getAnimalCount()
    {
        $count = 0;

        foreach ($this->animalList as $type => $typeList) {
            $count += count($typeList);
        }

        return $count;
    }
}
