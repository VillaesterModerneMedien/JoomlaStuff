<?php

/**
 * @package		PLG_SYS_VGRD_EXTERNALLINKS
 * @copyright	Copyright (C) 2010 - 2016 Michael Richey. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');


class plgSystemVgrd_externallinks extends JPlugin {

    function onBeforeRender() {
        $app = JFactory::getApplication();

        $doc = JFactory::getDocument();

        JFactory::getLanguage()->load('plg_system_vgrd_externallinks', JPATH_ADMINISTRATOR);

        JText::script('PLG_SYS_VGRD_EXTERNALLINKS_WARNINGTEXT');
        $options = array(
            'sitename'=>$app->getCfg('sitename',false),
            'excludedclasses'=>$this->_cleanArrayValues('classes','excludedclasses'),
            'excludeddomains'=>$this->_cleanArrayValues('domains','excludeddomains'),
            'excludedurls'=>$this->_cleanArrayValues('urls','excludedurls')
        );

        $doc->addScriptOptions('plg_system_externallinkwarningpro',$options);
        JHtml::_('jquery.framework');
        $doc->addScript(JURI::root(true).'/media/plg_system_vrgd_externallinks/js/vgrdlinks.js');
        return true;
    }

    public function onAfterRender()
    {
        $app = JFactory::getApplication();
        $currentBodyToChange = $app->getBody();
        JFactory::getLanguage()->load('plg_system_vgrd_externallinks', JPATH_ADMINISTRATOR);
        $modal = $this->displayModal();
        $bodyChanged = str_replace('</body>', $modal, $currentBodyToChange);
        if ($app->getName() !== 'administrator')
        {
            $app->setBody($bodyChanged);
        }
    }

    private function _cleanArrayValues($iprop,$param) {
        $params = (array)$this->params->get($param,array());
        $mapped = array();
        foreach($params as $param) {
            $value = trim($param->$iprop);
            if(!strlen($value)) continue;
            $mapped[] = $value;
        }
        $values = array_values($mapped);
        return array_filter($values);

    }

    /**
     * Displays the voting area
     *
     * @param   string   $context  The context of the content being passed to the plugin
     * @param   object   &$row     The article object
     * @param   object   &$params  The article params
     * @param   integer  $page     The 'page' number
     *
     * @return  string|boolean  HTML string containing code for the votes if in com_content else boolean false
     *
     * @since   3.7.0
     */
    private function displayModal()
    {

        // Get the path for the rating summary layout file
        $modalTemplate = (int) $this->params->get('modalTemplate');

        if($modalTemplate === 0)
        {
            $path = JPluginHelper::getLayoutPath('system', 'vgrd_externallinks', $layout = 'modal_uikit2');
        }
        else if($modalTemplate === 1)
        {
            $path = JPluginHelper::getLayoutPath('system', 'vgrd_externallinks', $layout = 'modal_uikit3');
        }

        // Render the layout
        ob_start();
        include $path;
        $html = ob_get_clean();
        //var_dump($html);

        /*
        if ($this->app->input->getString('view', '') === 'article' && $row->state == 1)
        {
            // Get the path for the voting form layout file
            $path = JPluginHelper::getLayoutPath('content', 'vote', 'vote');

            // Render the layout
            ob_start();
            include $path;
            $html .= ob_get_clean();
        }
*/
        return $html;
    }

}
