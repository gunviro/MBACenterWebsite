<?php
/**
 *  Live Chat
 *	Copyright Dalegroup Pty Ltd 2014
 *	support@dalegroup.net
 *
 *
 * @package     sts
 * @author      Michael Dale <support@dalegroup.net>
 */
 
namespace sts\plugins;
use sts;

class livechat_support {

	private $database_version = 2;


	public function make_installed() {
		$config 		= &sts\singleton::get('sts\config');

		if (!$config->get('livechat_installed')) {
			$this->install();
		}
		else if ($config->get('livechat_version') < $this->database_version) {
			for ($i = $config->get('livechat_version') + 1; $i <= $this->database_version; $i++) {
				if (method_exists($this, 'dbsv_' . $i)) {
					call_user_func(array($this, 'dbsv_' . $i));		
				}
			}
		}
	}
	
	private function install() {
		global $db;
		
		$config 		= &sts\singleton::get('sts\config');
		$tables 		= &sts\singleton::get('sts\tables');
		$error 			= &sts\singleton::get('sts\error');
		$log 			= &sts\singleton::get('sts\log');
		
		//live chat
		$query = "
			CREATE TABLE IF NOT EXISTS `$tables->live_chat` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `site_id` INT( 11 ) UNSIGNED NOT NULL ,
			  `date_added` datetime NOT NULL,
			  `date_finished` datetime NOT NULL,
			  `last_guest_message` datetime NULL,
			  `name` varchar(255) NOT NULL,
			  `email` varchar(255) NOT NULL,
			  `uuid` varchar(64) NOT NULL,
			  `active` int(1) unsigned NOT NULL DEFAULT '0',
			  PRIMARY KEY (`id`),
			  KEY `email` (`email`),
			  KEY `site_id` (`site_id`),
			  KEY `uuid` (`uuid`),
			  KEY `active` (`active`)
			) DEFAULT CHARSET=utf8;
		";

		try {
			$db->query($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$query = "
			CREATE TABLE IF NOT EXISTS `$tables->chat_messages` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `site_id` INT( 11 ) UNSIGNED NOT NULL ,
			  `date_added` datetime NOT NULL,
			  `chat_id` int(11) unsigned NOT NULL,
			  `user_id` int(11) unsigned NOT NULL,
			  `message` longtext NOT NULL,
			  `guest` int(1) unsigned NOT NULL DEFAULT '0',
			  PRIMARY KEY (`id`),
			  KEY `chat_id` (`chat_id`),
			  KEY `site_id` (`site_id`),
			  KEY `user_id` (`user_id`)
			) DEFAULT CHARSET=utf8;
		";

		try {
			$db->query($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
				
		$config->add('livechat_version', '1');
		$config->add('livechat_installed', 1);
		$config->add('livechat_enabled', 0);
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Live Chat Database Installed.';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'install';
		$log_array['event_source'] = 'livechat_support';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
	}
	
	public function dbsv_2() {
		global $db;
		
		$config 		= &sts\singleton::get('sts\config');
		$tables 		= &sts\singleton::get('sts\tables');
		$error 			= &sts\singleton::get('sts\error');
		$log 			= &sts\singleton::get('sts\log');
		
		$permissions 			= &sts\singleton::get('sts\permissions');
		$permission_groups 		= &sts\singleton::get('sts\permission_groups');
					
		//manage_livechat
		$id = $permissions->add_task(array('name' => 'manage_livechat'));
				
		$permissions->add_task_to_group(array('task_id' => $id, 'group_id' => 2));
		$permissions->add_task_to_group(array('task_id' => $id, 'group_id' => 4));
		$permissions->add_task_to_group(array('task_id' => $id, 'group_id' => 5));
		$permissions->add_task_to_group(array('task_id' => $id, 'group_id' => 6));
		
		$config->set('livechat_version', 2);
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Livechat Database Upgraded.';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'install';
		$log_array['event_source'] = 'livechat_support';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);	
	
	}

}

?>