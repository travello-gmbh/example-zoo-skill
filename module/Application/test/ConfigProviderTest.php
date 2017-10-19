<?php
/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

namespace ApplicationTest;

use Application\ConfigProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigProviderTest
 *
 * @package ApplicationTest
 */
class ConfigProviderTest extends TestCase
{
    /**
     *
     */
    public function testConfiguration()
    {
        $configProvider = new ConfigProvider();

        $configData = $configProvider();

        $this->assertTrue(is_array($configData));

        $this->assertArrayHasKey('dependencies', $configData);
        $this->assertArrayHasKey('templates', $configData);
    }
}
