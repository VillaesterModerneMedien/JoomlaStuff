<?php

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );



class ModSimpleRepeatable

{

	public static function getMarkenlogos($params)
	{
		$content = $params->get('quicklinks');
		$size = $params->get('imageSize');
		$markenlogos = array();

		if(!empty($content))
		{
			foreach ($content as $item)
			{
                $markenlogos['items'][] = array(
					'logo'      => $item->logo,
					'title'     => $item->title,
					'link'      => $item->link
                );
                $markenlogos['size'] = $size;
			}

			return $markenlogos;
		}
		else{
			return false;
		}
	}

}

?>
