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
 * Add Pagination to Navigation Links URL UCP module.
 */
class main_module
{
	public $page_title;
	public $tpl_name;
	public $u_action;

	/**
	 * Main UCP module
	 *
	 * @param int    $id   The module ID
	 * @param string $mode The module mode (for example: manage or settings)
	 */
	public function main($id, $mode)
	{
		global $phpbb_container;

		/** @var \lansingred\lastviewedforumpageoffset\controller\ucp_controller $ucp_controller */
		$ucp_controller = $phpbb_container->get('lansingred.lastviewedforumpageoffset.controller.ucp');

		/** @var \phpbb\language\language $language */
		$language = $phpbb_container->get('language');

		// Load a template for our UCP page
		$this->tpl_name = 'ucp_settings';

		// Set the page title for our UCP page
		$this->page_title = $language->lang('UCP_LASTVIEWEDFORUMPAGEOFFSET_TITLE');

		// Make the $u_action url available in our UCP controller
		$ucp_controller->set_page_url($this->u_action);

		// Load the display options handle in our UCP controller
		$ucp_controller->display_options();
	}
}
