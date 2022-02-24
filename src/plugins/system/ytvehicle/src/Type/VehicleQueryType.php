<?php

//use YOOtheme\Builder\Joomla\Source\ContactsHelper;

/**
 * @package    plg_system_studiogongcontact
 *
 * @author     Kicktemp GmbH <hello@kicktemp.com>
 * @copyright  Copyright © 2020 Kicktemp GmbH. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://kicktemp.com
 */

class VehicleQueryType
{
    public static function config()
    {
        return [

            'fields' => [

                'vehicle' => [
                    'type' => 'VehicleType',
                    'metadata' => [
                        'label' => 'Fahrzeug',
                        'view' => ['com_sercosysmia.vehicle'],
                        'group' => 'Page',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::vehicle',
                    ],
                ],

                'customVehicle' => [

                    'type' => 'VehicleType',

                    'args' => [
                        'id' => [
                            'type' => 'String'
                        ],

                    ],

                    'metadata' => [

                        'label' => 'Single Fahrzeug',
                        'group' => 'Page',

                        'fields' => [
                            'id' => [
                                'label' => 'Select Manually',
                                'description' => "Pick a manually or use filter options to specify which  should be loaded dynamically.",
                                'type' => 'select-item',
                                'module' => 'vehicle',
                                'item_type' => 'ta',
                                'labels' => [
                                    'type' => 'Vehicle',
                                ],
                            ],
                        ],

                    ],

                    'extensions' => [
                        'call' => __CLASS__ . '::resolve',
                    ],

                ],

            ]

        ];
    }

    public static function vehicle($root)
    {
        if (isset($root['item'])) {
            return $root['item'];
        }
    }

    public static function resolve($root, array $args)
    {

        $args += ['id' => 0, 'limit' => 1];

        if (!empty($args['id'])) {
            $vehicle = VehicleTypeProvider::get($args['id']);
        } else {
            $vehicle = VehicleTypeProvider::query($args);
        }

        return $vehicle[0];
    }
}
