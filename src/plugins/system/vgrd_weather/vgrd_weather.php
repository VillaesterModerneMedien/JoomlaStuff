<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.log
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;

defined('_JEXEC') or die;

/**
 * Joomla! System Logging Plugin.
 *
 * @since  1.5
 */
class PlgSystemVGRD_Weather extends JPlugin
{

    protected $app;
    protected $document;

    protected static $url = 'api.openweathermap.org/data/2.5/weather';

    protected static $file_lifetime = 3600;

    protected $icons = array(
        '04d' => 'sun-cloud',
        '04n' => 'moon-cloud',
        '01d' => 'sun',
        '01n' => 'moon',
        '02d' => 'clouds-sun',
        '02n' => 'clouds-moon',
        '50d' => 'fog',
        '50n' => 'fog',
        '10d' => 'cloud-sun-rain',
        '10n' => 'cloud-moon-rain',
        '03d' => 'cloud-sun',
        '03n' => 'cloud-moon',
        '09d' => 'cloud-showers-heavy',
        '09n' => 'cloud-showers-heavy',
        '13d' => 'cloud-snow',
        '13n' => 'cloud-snow',
        '11d' => 'thunderstorm',
        '11n' => 'thunderstorm-moon'
    );

    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config);
    }

    /**
     * Render the checkboxes / radio
     * return HTML
     */


    public function onAfterRender()
    {
        $app    = JFactory::getApplication();

        if($app->isClient('site'))
        {

            $params = $this->params;

            $appid = $params->get('apikey');
            $cityid = $params->get('city');

            $cache = JPATH_SITE . '/plugins/system/vgrd_weather/cache';
            $cachefile = $cache . '/' . $cityid . '.json';

            JFolder::create($cache);

            if(File::exists($cachefile) && filemtime($cachefile) > time() - self::$file_lifetime)
            {
                $data = file_get_contents($cachefile);

            }
            else {
                $data = self::getWeatherData();

                File::write($cachefile, $data);
            }

            //return self::prepareData($data);

            $sHtml = $app->getBody();

            $wetterDaten = json_decode($data);

            $wetterAktuell = [
                'icon'  =>  $this->icons[$wetterDaten->weather[0]->icon],
                'stadt' =>  $wetterDaten->name,
                'temp'  =>  round($wetterDaten->main->temp,0),
                'desc'  =>  $wetterDaten->weather[0]->description,
            ];

            $layout = new JLayoutFile('wetter', JPATH_ROOT .'/plugins/system/vgrd_weather/layouts');
            $html = $layout->render($wetterAktuell);

            $sHtml = str_replace('[wetter]', $html, $sHtml);

            $app->setBody($sHtml);
        }
    }

    protected function getWeatherData()
    {

        $params = $this->params;
        $appid = $params->get('apikey');
        $cityid = $params->get('city');


        $url = self::$url;
        $url .= '?q=' . $cityid . ',DE';
        $url .= '&appid=' . $appid;
        $url .= '&units=metric';
        $url .= '&lang=de';

        $curl = curl_init();
        $headers = array();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        $json = curl_exec($curl);
        curl_close($curl);

        return $json;
    }
}
