<?php

// Subpackage namespace
namespace LittleBizzy\DisableJQueryMigrate\Core;

/**
 * Core class
 *
 * @package Disable jQuery Migrate
 * @subpackage Core
 */
final class Core {



	// Properties
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Single class instance
	 */
	private static $instance;



	// Initialization
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Create or retrieve instance
	 */
	public static function instance($plugin = null) {

		// Check instance
		if (!isset(self::$instance))
			self::$instance = new self($plugin);

		// Done
		return self::$instance;
	}



	/**
	 * Constructor
	 */
	private function __construct($plugin) {

		// Exit if the context is not the frontend area
		if ( is_admin() ||
			(defined('DOING_CRON') && DOING_CRON) ||
			(defined('DOING_AJAX') && DOING_AJAX) ||
			(defined('XMLRPC_REQUEST') && XMLRPC_REQUEST)) {
			return;
		}

		// Scripts loader hook
		add_action('wp_default_scripts', [&$this, 'defaultScripts']);
	}



	// WP Hooks
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Default scripts hook
	 */
	public function defaultScripts(&$scripts) {

		// Check the jQuery registry
		if (!isset($scripts->registered['jquery'])) {
			return;
		}

		// Check dependencies and if jQuery Migrate exists
		$script = $scripts->registered['jquery'];
		if (empty($script->deps) || !is_array($script->deps) || !in_array('jquery-migrate', $script->deps)) {
			return;
		}

		// Remove jQuery Migrate dependency
		$scripts->registered['jquery']->deps = array_diff($script->deps, ['jquery-migrate']);
	}



}