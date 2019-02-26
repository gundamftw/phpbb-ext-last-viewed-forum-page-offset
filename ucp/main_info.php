<?php
/**
 *
 * Add Pagination to Navigation Links URL. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, lansingred
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace lansingred\lastviewedforumpageoffset\ucp;

/**
 * Add Pagination to Navigation Links URL UCP module info.
 */
class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\lansingred\lastviewedforumpageoffset\ucp\main_module',
			'title'		=> 'UCP_LASTVIEWEDFORUMPAGEOFFSET_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'UCP_LASTVIEWEDFORUMPAGEOFFSET',
					'auth'	=> 'ext_lansingred/lastviewedforumpageoffset',
					'cat'	=> array('UCP_LASTVIEWEDFORUMPAGEOFFSET_TITLE')
				),
			),
		);
	}
}
