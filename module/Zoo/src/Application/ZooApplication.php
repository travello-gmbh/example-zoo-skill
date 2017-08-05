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

    /**
     * Initialize the attributes
     *
     * @return bool
     */
    protected function initSessionAttributes(): bool
    {
        return true;
    }

    /**
     * Get the session attributes
     *
     * @return array
     */
    protected function getSessionAttributes(): array
    {
        return [];
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
        $zooMessage = $this->textHelper->getAnimalMessage('Ein Elefant');

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

        return true;
    }
}
