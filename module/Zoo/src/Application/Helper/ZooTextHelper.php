<?php
/**
 * PHP Magazin Alexa mit PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/RalfEggert/phpmagazin.alexa
 *
 */

namespace Zoo\Application\Helper;

use TravelloAlexaLibrary\Application\Helper\AbstractTextHelper;

/**
 * Class ZooTextHelper
 *
 * @package Zoo\Application\Helper
 */
class ZooTextHelper extends AbstractTextHelper implements ZooTextHelperInterface
{
    /**
     * Get the animal title
     *
     * @return string
     */
    public function getAnimalTitle(): string
    {
        return $this->commonTexts['alexaAnimalTitle'];
    }

    /**
     * Get a animal message
     *
     * @param string $animal
     *
     * @return string
     */
    public function getAnimalMessage(string $animal): string
    {
        return sprintf($this->commonTexts['alexaAnimalMessage'], $animal);
    }

    /**
     * Get the count title
     *
     * @return string
     */
    public function getCountTitle(): string
    {
        return $this->commonTexts['alexaCountTitle'];
    }

    /**
     * Get a count message
     *
     * @param int $count
     *
     * @return string
     */
    public function getCountMessage(int $count): string
    {
        return sprintf($this->commonTexts['alexaCountMessage'], $count);
    }
}
