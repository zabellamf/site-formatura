
<?php

/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2018 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

class SppollsControllerPoll extends JControllerForm
{
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	protected function allowAdd($data = array())
	{
		return parent::allowAdd($data);
	}

	protected function allowEdit($data = array(), $key = 'id')
	{
		$id = (int) isset($data[$key]) ? $data[$key] : 0;
		if (!empty($id))
		{
			return JFactory::getUser()->authorise('core.edit','com_sppolls.poll.' . $id);
		}
		return parent::allowEdit($data, $key);
	}
}
	
