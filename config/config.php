<?php
/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$cacheConfig = [
    'config_cache_path' => 'data/config-cache.php',
];

$pattern = 'config/autoload/{{,*.}global,{,*.}'
    . APPLICATION_ENV . ',{,*.}local}.php';

$aggregator = new ConfigAggregator(
    [
        Zend\Router\ConfigProvider::class,
        Zend\Validator\ConfigProvider::class,

        TravelloAlexaZf\ConfigProvider::class,

        Zoo\ConfigProvider::class,
        Application\ConfigProvider::class,

        new ArrayProvider($cacheConfig),
        new PhpFileProvider($pattern),
    ],
    $cacheConfig['config_cache_path']
);

return $aggregator->getMergedConfig();
