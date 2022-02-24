<?php

use Joomla\CMS\Object\CMSObject;

class VehicleTypeProvider
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
        if (!class_exists('SercosysMiaModelVehicle')) {
            require_once JPATH_ROOT . '/components/com_sercosysmia/models/vehicle.php';
        }

        $model = new \SercosysMiaModelVehicle(['ignore_request' => true]);
        $model->setState('vehicle.vehicleid', $ids);
        $model->setState('filter.state', 1);
        $model->setState('params', new JRegistry());

        foreach ($args as $name => $value) {
            $model->setState($name, $value);
        }


        return $model->getItemYootheme($ids);
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
        // var_dump(JPATH_ROOT);die;
        $model = new \SercosysMiaModelVehicles(['ignore_request' => true]);

        if (!empty($args['order'])) {

            if ($args['order'] === 'rand') {
                $args['order'] = Factory::getDbo()->getQuery(true)->Rand();
            } elseif ($args['order'] === 'front') {
                $args['order'] = 'fp.ordering';
            } else {
                $args['order'] = "a.{$args['order']}";
            }
        }

        $props = [
            'offset' => 'list.start',
            'limit' => 'list.limit',
            'order' => 'list.ordering',
            'order_direction' => 'list.direction',
            'order_alphanum' => 'list.alphanum'
        ];

        foreach (array_intersect_key($props, $args) as $key => $prop) {
            $model->setState($prop, $args[$key]);
        }
        return $model->getItems();
    }
}
