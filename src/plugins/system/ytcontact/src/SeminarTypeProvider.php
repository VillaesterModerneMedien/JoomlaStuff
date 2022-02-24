<?php

use Joomla\CMS\Object\CMSObject;

class SeminarTypeProvider
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
        if (!class_exists('ContactModelContact')) {
            require_once JPATH_ROOT . '/components/com_fourtexx/models/seminar.php';
        }

        $model = new \ContactModelContact(['ignore_request' => true]);
        $model->setState('seminar.id', (array) $ids);
        $model->setState('filter.state', 1);
        $model->setState('params', new JRegistry());

        foreach ($args as $name => $value) {
            $model->setState($name, $value);
        }

        return $model->getItem();
    }
}
