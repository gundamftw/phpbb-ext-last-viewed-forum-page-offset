<?php
/**
 *
 * Add Pagination to Navigation Links URL. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, lansingred
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace lansingred\lastviewedforumpageoffset\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Add Pagination to Navigation Links URL Event listener.
 */
class main_listener implements EventSubscriberInterface
{
	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\user */
	protected $user;

	/* @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/* @var \phpbb\language\language */
	protected $language;

	/* @var \phpbb\request\request */
	protected $request;

	/**
	 * Constructor
	 *
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template\template	$template	Template object
	 * @param \phpbb\language\language	$language	Language object
	 *
	 */
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\controller\helper $helper,
		\phpbb\template\template $template,
		\phpbb\language\language $language,
		\phpbb\user $user,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\request\request $request)
	{
		$this->config				= $config;
		$this->helper   			= $helper;
		$this->template 			= $template;
		$this->language 			= $language;
		$this->user 				= $user;
		$this->db					= $db;
		$this->request				= $request;
	}


	public static function getSubscribedEvents()
	{
		return array(
			'core.viewforum_generate_page_after'		=> 'store_viewforum_page_offset',
			'core.generate_forum_nav'					=> 'get_page_offset_in_viewtopic',
		);
	}

	public function store_viewforum_page_offset($event)
	{
		// check ucp switch, 1 = run, 0 = don't run
		if ($this->config['ucp_navlink_page_offset_switch'] == 1)
		{
			// get start(offset) of the pagination and stores to the $config array
			$start = $this->request->variable('start', 0);
			$this->config->set('forum_url_pagination_start', $start, false);
		}

	}

	public function get_page_offset_in_viewtopic($event)
	{
		// check ucp switch, 1 = run, 0 = don't run
		if ( $this->config['ucp_navlink_page_offset_switch'] == 1)
		{
			// check if user is on a viewtopic page
			$forum_data = $event['forum_data'];

			if ( isset($forum_data['topic_id']) )
			{
				if ( isset($this->config['forum_url_pagination_start']))
				{
					// retrieve the start(offset) parameter from $config array stored from viewforum page
					$navlinks = $event['navlinks'];

					$start = $this->config['forum_url_pagination_start'] ;
					$start_string = $start == 0 ? '' : '&start='.$start;
					$navlinks['U_VIEW_FORUM'] = $navlinks['U_VIEW_FORUM'] . $start_string;

					$event['navlinks'] = $navlinks;

					//$this->config->delete('forum_url_pagination_start');
				}
			}
		}


	}
}
