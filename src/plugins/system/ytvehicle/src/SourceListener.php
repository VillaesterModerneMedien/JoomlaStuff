<?php

use Joomla\CMS\Table\ContentType;
use YOOtheme\Builder\Joomla\Source\Type\CustomContactsQueryType;
use YOOtheme\Builder\Source;
use YOOtheme\Config;
use YOOtheme\Metadata;
use YOOtheme\Url;

class SourceListenerVehicle
{
    /**
     * @param Source $source
     */
    public static function initSource($source)
    {

        //$source->queryType(CustomContactsQueryType::config());

        $source->objectType('VehicleType', VehicleType::config());
        $source->queryType(VehicleQueryType::config());

    }

    public static function initCustomizer(Config $config, Metadata $metadata)
    {

        $config->add('customizer.vehicle', array(
            [
                'value' => 1,
                'text' => 'text',
            ],
        ));

        $config->add('customizer.templates', [

            'com_sercosysmia.vehicle' => [
                'label' => 'Fahrzeug Single',
                'fieldset' => [
                    'default' => [
                        'fields' => [
                            'my_field' => [
                                'label' => 'My Field',
                                'description' => 'My field description ...',
                                'type' => 'text',
                            ],
                        ],
                    ],
                ],
            ],

        ]);

        $config->add('customizer.vehicles', array(
            [
                'value' => 1,
                'text' => 'text',
            ],
        ));

        $config->add('customizer.templates', [

            'com_sercosysmia.vehicles' => [
                'label' => 'Fahrzeug Listing'
            ],

        ]);

        $metadata->set('script:customizer.vehicle', ['src' => Url::to('plugins/system/ytvehicle/vehicle.js'), 'defer' => true]);
    }
}
