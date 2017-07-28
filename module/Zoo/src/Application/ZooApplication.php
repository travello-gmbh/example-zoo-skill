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
use Zoo\Application\Helper\ZooTextHelperInterface;

/**
 * Class ZooApplication
 *
 * @package Zoo\Application
 */
class ZooApplication extends AbstractAlexaApplication
{
    /** @var string */
    protected $applicationId = 'amzn1.ask.skill.place-your-skill-id-here';

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
     * Handle custom application intents
     *
     * @return bool
     */
    protected function handleIntentRequest(): bool
    {
        /** @var IntentRequestType $intentRequest */
        $intentRequest = $this->alexaRequest->getRequest();

        switch ($intentRequest->getIntent()->getName()) {
            // add custom intents

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
}
