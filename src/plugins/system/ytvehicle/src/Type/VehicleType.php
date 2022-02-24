<?php

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Router\Route;

class VehicleType
{
    public static function config()
    {
        return [

            'fields' => [

                'vehicleid' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'ID',
                        'filters' => ['limit'],
                    ],
                ],
                'shortdescription' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Name (Shortdescription)',
                        'filters' => ['limit'],
                    ],
                ],
                'equipmentflags' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'equipmentflags (Shortdescription)',
                        'filters' => ['limit'],
                    ],
                ],
                'images' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Images',
                        'filters' => ['limit'],
                    ],
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => 'Fahrzeug'
            ]

        ];
    }
}
