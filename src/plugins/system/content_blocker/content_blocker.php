<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.log
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Menu\SiteMenu;
use Joomla\CMS\Plugin\CMSPlugin;

defined('_JEXEC') or die;


/**
 * Joomla! System Logging Plugin.
 *
 * @since  1.5
 */
class PlgSystemContent_blocker extends CMSPlugin
{

    protected $app;
    protected $document;

    public function __construct(&$subject, $config = array())
    {
        $this->app = Factory::getApplication();
        parent::__construct($subject, $config);
    }

    /**
     * Render the checkboxes / radio
     * return HTML
     */


	public function onAfterRender()
    {
        $app    = Factory::getApplication();
        $component = $app->input->get('option');

        if($app->isClient('site') && $component != 'com_ajax') {

            $youtubeState = false;
            $googleState = false;

            $params = $this->params;

            if (isset($_COOKIE['kcm_data'])) {
                $kcmCookie = json_decode($_COOKIE['kcm_data']);
                $services = $kcmCookie->services;
                $youtubeState = in_array('youtube', $services);
                $googleState = in_array('google-maps', $services);
            }

            $sHtml = $app->getBody();

            if (!$youtubeState) {
                $dom = new DOMDocument;
                libxml_use_internal_errors(true);
                $dom->loadHTML($sHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                foreach ($dom->getElementsByTagName('iframe') as $iframe) {
                    $div = $dom->createElement('div');
                    $div->setAttribute('class', 'youtube-blocked-container blocked-container');
                    //$div->textContent = $params->get('youtube');
                    $fragment = $dom->createDocumentFragment();
                    $fragment->appendXML($params->get('youtube'));
                    $div->appendChild($fragment);
                    $iframe->parentNode->replaceChild($div, $iframe);
                }

                $newHtml = $dom->saveHTML();


                libxml_clear_errors();
                $sHtml = $newHtml;

                $app->setBody($newHtml);
            }

            if (!$googleState) {
                $dom = new DOMDocument;
                libxml_use_internal_errors(true);

                $dom->loadHTML($sHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                $xpath = new DomXPath($dom);

                $nodeList = $xpath->query('//div[contains(@class,"uk-map")]');

                foreach ($nodeList as $map) {
                    $div = $dom->createElement('div');
                    $div->setAttribute('class', 'googleMaps-blocked-container blocked-container');
                    $fragment = $dom->createDocumentFragment();
                    $fragment->appendXML($params->get('google'));
                    $div->appendChild($fragment);
                    $map->parentNode->replaceChild($div, $map);
                }

                $newHtml = $dom->saveHTML();

                libxml_clear_errors();
                $app->setBody($newHtml);
            }
        }
    }

    /**
     * Change css paths in Template based on user state
     * return bool
     */

    public function onBeforeCompileHead()
    {
        $wa = $this->app->getDocument()->getWebAssetManager();
        $wa->registerAndUseScript('test', 'media/plg_system_content_blocker/js/test.js', [], ['defer' => true], ['core']);
    }
}
