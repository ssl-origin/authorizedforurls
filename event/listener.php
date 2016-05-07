<?php
/**
*
* Authorized for urls extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Rich McGirr (RMcGirr83)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace rmcgirr83\authorizedforurls\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;
	
	/** @var \phpbb\config\db_text */
	protected $config_text;	

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	public function __construct(
		\phpbb\auth\auth $auth,
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\user $user,
		$root_path,
		$php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.permissions'						=> 'add_permission',
			'core.posting_modify_message_text'		=> 'modify_message_text',
			'core.ucp_profile_modify_signature'		=> 'modify_message_text',
			'core.ucp_pm_compose_modify_private_message'	=> 'modify_message_text',
		);
	}

	/**
	* Add administrative permissions to manage forums
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function add_permission($event)
	{
		$permissions = $event['permissions'];
		$permissions['u_post_url'] = array('lang' => 'ACL_U_POST_URL', 'cat' => 'post');
		$event['permissions'] = $permissions;
	}

	public function modify_message_text($event)
	{
		if (!$this->auth->acl_get('u_post_url') && ($event['submit'] || $event['preview']))
		{
			
			$this->user->add_lang_ext('rmcgirr83/authorizedforurls', 'common');
			$message = $event['message_parser'];
			$check_text = $message->message;

			// initialize a variable or two
			$auth_msg = $type = '';
			
			// The following will allow img bbcode and email links to be overridden
			// eg if $not_check_email = true, then emails (eg rmcgirr83@rmcgirr83.org, etc)
			// will not be checked for
			 
			$check_email = $this->config['authforurl_email'];
			$check_img_bbcode = $this->config['authforurl_img_bbcode'];

			$tld_list = $this->config_text->get_array(array(
				'authforurl_tlds',
			));
			
			//convert the string to an array
			$tld_list = explode(',', trim($tld_list['authforurl_tlds']));

			//convert the array back into a string
			$disallowed_tld = implode('|',$tld_list);

			// thanks for the regex tut A_Jelly_Doughnut!! :)
			// we want emails to show
			if(!$check_email)
			{
				$check_text = preg_replace("#([a-z0-9\-_]+)@(((?:www.)?\b[a-z0-9\-_]+)\.($disallowed_tld)(\.($disallowed_tld))?\b)#i",'',$check_text);
			}	
			// we want img bbcode tags to show
			if(!$check_img_bbcode)
			{
				$check_text = preg_replace("/\[img\s*\](.+?)\[\/img\]/i", '',$check_text);
			}
			// check the whole darn thang now for any TLD's
			// at least those that >seem< to match from the array
			// and have not been excluded above
			
			preg_match("#(([a-z0-9\-_]+)@)?([a-z]{3,6}://)?(((?:www.)?\b[a-z0-9\-_]+)\.($disallowed_tld)(\.($disallowed_tld))?\b)#i", $check_text, $match);

			// we have a match..uhoh, someone's being naughty
			// time to slap 'em up side the head
			if (sizeof($match))
			{
				if ($check_img_bbcode)
				{
					$type .= $this->user->lang('AUTHED_IMAGES');
				}
				if ($check_email)
				{
					$type .= ',&nbsp;' .  $this->user->lang('AUTHED_EMAIL');
				}
				$type .= !empty($type) ? '&nbsp;' . $this->user->lang('AUTHED_OR') . '&nbsp;' . $this->user->lang('AUTHED_URL') : $this->user->lang('AUTHED_URL');
				$auth_msg = $this->user->lang('URL_UNAUTHED', $type, $match[0]);
				$message->warn_msg[] = $auth_msg;
			}
			
			$event['message_parser'] = $message;
		}
	}
}
