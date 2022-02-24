<?php

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );



class ModSimpleRepeatable

{

	public static function getQuicklinks($params)
	{
		$content = $params->get('quicklinks');
		$quicklinks = array();

		if(!empty($content))
		{
			foreach ($content as $item)
			{
                $quicklinks[] = array(
					'titel'   => $item->titel,
					'link'    => $item->link,
					'icon'    => $item->icon,
					'target'  => $item->target,
				);
			}

			return $quicklinks;
		}
		else{
			return false;
		}
	}

}

?>
