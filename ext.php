<?php
/**
*
* Authorized for urls extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Rich McGirr (RMcGirr83)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace rmcgirr83\authorizedforurls;

/**
* Extension class for custom enable/disable/purge actions
*/
class ext extends \phpbb\extension\base
{
	/**
	 * Enable extension if phpBB version requirement is met
	 *
	 * @return bool
	 * @access public
	 */
	public function is_enableable()
	{
		$enableable = (phpbb_version_compare(PHPBB_VERSION, '3.3.0', '>=') && version_compare(PHP_VERSION, '7.3.0', '>='));
		if (!$enableable)
		{
			$user = $this->container->get('user');
			$user->add_lang_ext('rmcgirr83/authorizedforurls', 'info_acp_authforurl');
			trigger_error($user->lang('REQUIREMENTS_NOT_MET'), E_USER_WARNING);
		}
		return $enableable;
	}
}
