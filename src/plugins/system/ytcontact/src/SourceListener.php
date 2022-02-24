<?php

use Joomla\CMS\Table\ContentType;
use YOOtheme\Builder\Joomla\Source\Type\CustomContactsQueryType;
use YOOtheme\Builder\Source;
use YOOtheme\Config;
use YOOtheme\Metadata;
use YOOtheme\Url;

class SourceListener
{
    /**
     * @param Source $source
     */
    public static function initSource($source)
    {
        $source->objectType('ContactType', ContactType::config());
        $source->queryType(ContactQueryType::config());
        $source->queryType(CustomContactsQueryType::config());
        $source->objectType('SeminarType', SeminarType::config());
        $source->queryType(SeminarQueryType::config());
    }

    public static function initCustomizer(Config $config, Metadata $metadata)
    {
        $config->add('customizer.contact', array(
            [
                'value' => 1,
                'text' => 'text',
            ],
        ));

        $config->add('customizer.templates', [
            'com_contact.contact' => [
                'label' => 'Contact'
            ],

        ]);

        $config->add('customizer.seminar', array(
            [
                'value' => 1,
                'text' => 'text',
            ],
        ));

        $config->add('customizer.templates', [

            'com_fourtexx.seminar' => [
                'label' => 'Seminar'
            ],

        ]);

        $metadata->set('script:customizer.contact', ['src' => Url::to('plugins/system/ytcontact/contact.js'), 'defer' => true]);
        $metadata->set('script:customizer.seminar', ['src' => Url::to('plugins/system/ytcontact/seminar.js'), 'defer' => true]);
    }
}
