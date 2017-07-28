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

use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;

/**
 * Class ZooTextHelper
 *
 * @package Zoo\Application\Helper
 */
interface ZooTextHelperInterface extends TextHelperInterface
{
    /**
     * Get the animal title
     *
     * @return string
     */
    public function getAnimalTitle(): string;

    /**
     * Get a animal message
     *
     * @param string $animal
     *
     * @return string
     */
    public function getAnimalMessage(string $animal): string;

    /**
     * Get the count title
     *
     * @return string
     */
    public function getCountTitle(): string;

    /**
     * Get a count message
     *
     * @param int $count
     *
     * @return string
     */
    public function getCountMessage(int $count): string;
}
