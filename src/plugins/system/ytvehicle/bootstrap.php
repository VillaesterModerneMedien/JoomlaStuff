<?php
/**
 * @package    plg_system_studiogongcontact
 *
 * @author     Kicktemp GmbH <hello@kicktemp.com>
 * @copyright  Copyright © 2020 Kicktemp GmbH. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://kicktemp.com
 */

use YOOtheme\Builder;
use YOOtheme\Path;


include_once __DIR__ . '/src/SourceController.php';
include_once __DIR__ . '/src/SourceListener.php';
include_once __DIR__ . '/src/TemplateListener.php';
//include_once __DIR__ . '/src/Type/CustomContactsQueryType.php';
include_once __DIR__ . '/src/VehicleTypeProvider.php';
include_once __DIR__ . '/src/Type/VehicleQueryType.php';
include_once __DIR__ . '/src/Type/VehicleType.php';

return [

    'routes' => [

        ['get', '/vehicle/vehicles', [SourceControllerVehicle::class, 'vehicles']],

    ],

    'events' => [
        'source.init' => [
            SourceListenerVehicle::class => ['initSource', -20],
        ],

        'customizer.init' => [
            SourceListenerVehicle::class => ['initCustomizer', -5],
        ],

        'builder.template' => [
            TemplateListenerVehicle::class => 'matchTemplate',
        ],
    ]

];
