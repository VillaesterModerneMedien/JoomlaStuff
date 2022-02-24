<?php

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Object\CMSObject;

class VehiclesHelper
{


    /**
     * Gets the articles.
     *
     * @param int[] $ids
     * @param array $args
     *
     * @return CMSObject[]
     */
    public static function get($ids, array $args = [])
    {


        $model = new \SercosysMiaModelVehicle(['ignore_request' => true]);
        $model->setState('params', ComponentHelper::getParams('com_sercosysmia'));
        $model->setState('filter.vehicleid', (array) $ids);
        $model->setState('filter.access', true);
        $model->setState('filter.published', 1);
        $model->setState('filter.language', Multilanguage::isEnabled());

        foreach ($args as $name => $value) {
            $model->setState($name, $value);
        }

        return $model->getItems();
    }

    /**
     * Query articles.
     *
     * @param array $args
     *
     * @return array
     */
    public static function query(array $args = [])
    {



        require_once JPATH_ROOT . '/components/com_sercosysmia/models/vehicles.php';

        $model = new \SercosysMiaModelVehicle(['ignore_request' => true]);

        if (!empty($args['order'])) {

            if ($args['order'] === 'rand') {
                $args['order'] = Factory::getDbo()->getQuery(true)->Rand();
            } elseif ($args['order'] === 'front') {
                $args['order'] = 'fp.ordering';
            } else {
                $args['order'] = "a.{$args['order']}";
            }
        }

        if (!empty($args['featured'])) {
            $args['featured'] = 'only';
        }

        $props = [
            'offset' => 'list.start',
            'limit' => 'list.limit',
            'order' => 'list.ordering',
            'order_direction' => 'list.direction',
            'order_alphanum' => 'list.alphanum',
            'featured' => 'filter.featured',
            'subcategories' => 'filter.subcategories',
        ];

        foreach (array_intersect_key($props, $args) as $key => $prop) {
            $model->setState($prop, $args[$key]);
        }

        return $model->getItems();
    }
}
