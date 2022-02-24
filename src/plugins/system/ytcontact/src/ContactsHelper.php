<?php

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Object\CMSObject;

class ContactsHelper
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
        if (!class_exists('ContentModelArticles')) {
            require_once JPATH_ROOT . '/components/com_contact/models/featured.php';
        }

        $model = new \ContactModelFeatured(['ignore_request' => true]);
        $model->setState('params', ComponentHelper::getParams('com_contact'));
        $model->setState('filter.article_id', (array) $ids);
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



        require_once JPATH_ROOT . '/components/com_contact/models/featured.php';

        $model = new \ContactModelFeatured(['ignore_request' => true]);

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
