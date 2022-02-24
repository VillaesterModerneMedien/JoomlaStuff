<?php
/**
 * @package    plg_system_studiogongcontact
 *
 * @author     Kicktemp GmbH <hello@kicktemp.com>
 * @copyright  Copyright © 2020 Kicktemp GmbH. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://kicktemp.com
 */

class SeminarQueryType
{
    public static function config()
    {
        return [

            'fields' => [

                'seminar' => [
                    'type' => 'SeminarType',
                    'metadata' => [
                        'label' => 'Contact',
                        'view' => ['com_fourtexx.seminar'],
                        'group' => 'Villaester',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::seminar',
                    ],
                ],

                'customSeminar' => [

                    'type' => 'SeminarType',

                    'args' => [
                        'id' => [
                            'type' => 'String'
                        ],

                    ],

                    'metadata' => [

                        'label' => 'Seminar',
                        'group' => 'Villaester',

                        'fields' => [
                            'id' => [
                                'label' => 'Select Manually',
                                'description' => "Pick a manually or use filter options to specify which  should be loaded dynamically.",
                                'type' => 'select-item',
                                'module' => 'seminar',
                                'item_type' => 'ta',
                                'labels' => [
                                    'type' => 'Seminar',
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

    public static function seminar($root)
    {
        if (isset($root['item'])) {
            return $root['item'];
        }
    }

    public static function resolve($root, array $args)
    {
        $args += ['id' => 0, 'limit' => 1];

        if (!empty($args['id'])) {
            $contacts = SeminarTypeProvider::get($args['id']);
        } else {
            $contacts = SeminarTypeProvider::query($args);
        }

        return $contacts;
    }
}
