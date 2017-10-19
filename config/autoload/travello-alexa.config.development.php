<?php
/**
 * Beispielanwendung für Alexa Skill Mein Zoo
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/example-zoo-skill
 */

return [
    'travello_alexa' => [
        'validate_signature' => false,
        'log_requests'       => false,
        'cache_flag'         => false,
        'cache_dir'          => PROJECT_ROOT . '/data/cache/',
    ],
];
