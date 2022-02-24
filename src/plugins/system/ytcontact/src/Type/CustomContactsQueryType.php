<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

//use YOOtheme\Builder\Joomla\Source\ContactsHelper;

class CustomContactsQueryType
{
    /**
     * @return array
     */
    public static function config()
    {


        return [

            'fields' => [

                'customContacts' => [

                    'type' => [
                        'listOf' => 'ContactType',
                    ],

                    'args' => [
                        'featured' => [
                            'type' => 'Boolean',
                        ],
                        'offset' => [
                            'type' => 'Int',
                        ],
                        'limit' => [
                            'type' => 'Int',
                        ],
                        'order' => [
                            'type' => 'String',
                        ],
                        'order_direction' => [
                            'type' => 'String',
                        ],
                        'order_alphanum' => [
                            'type' => 'Boolean',
                        ],
                    ],

                    'metadata' => [
                        'label' => 'Custom Contacts',
                        'group' => 'Custom',
                        'fields' => [
                            'featured' => [
                                'label' => 'Limit by Featured Articles',
                                'type' => 'checkbox',
                                'text' => 'Load featured articles only',
                            ],
                            '_offset' => [
                                'description' => 'Set the starting point and limit the number of articles.',
                                'type' => 'grid',
                                'width' => '1-2',
                                'fields' => [
                                    'offset' => [
                                        'label' => 'Start',
                                        'type' => 'number',
                                        'default' => 0,
                                        'modifier' => 1,
                                        'attrs' => [
                                            'min' => 1,
                                            'required' => true,
                                        ],
                                    ],
                                    'limit' => [
                                        'label' => 'Quantity',
                                        'type' => 'limit',
                                        'default' => 10,
                                        'attrs' => [
                                            'min' => 1,
                                        ],
                                    ],
                                ],
                            ],
                            '_order' => [
                                'type' => 'grid',
                                'width' => '1-2',
                                'fields' => [
                                    'order' => [
                                        'label' => 'Order',
                                        'type' => 'select',
                                        'default' => 'publish_up',
                                        'options' => [
                                            'Published' => 'publish_up',
                                            'Created' => 'created',
                                            'Modified' => 'modified',
                                            'Alphabetical' => 'title',
                                            'Hits' => 'hits',
                                            'Article Order' => 'ordering',
                                            'Featured Articles Order' => 'front',
                                            'Random' => 'rand',
                                        ],
                                    ],
                                    'order_direction' => [
                                        'label' => 'Direction',
                                        'type' => 'select',
                                        'default' => 'DESC',
                                        'options' => [
                                            'Ascending' => 'ASC',
                                            'Descending' => 'DESC',
                                        ],
                                    ],
                                ],
                            ],
                            'order_alphanum' => [
                                'text' => 'Alphanumeric Ordering',
                                'type' => 'checkbox',
                            ],
                        ],
                    ],

                    'extensions' => [
                        'call' => __CLASS__ . '::resolve',
                    ],

                ],
            ],

        ];
    }

    public static function resolve($root, array $args)
    {

        require_once JPATH_ROOT . '/plugins/system/ytcontact/src/ContactsHelper.php';

        $model = new \ContactsHelper();

       return $model->query($args);
    }
}
