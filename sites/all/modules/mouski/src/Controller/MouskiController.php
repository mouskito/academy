<?php
namespace Drupal\mouski\Controller;
class MouskiController
{
	public function hello()
	{
		return array(
			'#title' => 'Mon module',
			'#description' => 'Ceci est mon module'
		);
	}
}
?>