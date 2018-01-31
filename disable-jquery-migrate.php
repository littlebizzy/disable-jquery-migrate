<?php
/*
Plugin Name: Disable jQuery Migrate
Plugin URI: https://www.littlebizzy.com/plugins/disable-jquery-migrate
Description: Easily prevent the jQuery migrate script that is included with WordPress core from being loaded to slim down source code (for advanced users only).
Version: 1.0.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Prefix: DSJQMG
*/

// Plugin namespace
namespace LittleBizzy\DisableJQueryMigrate;

// Block direct calls
if (!function_exists('add_action'))
	die;

// Plugin constants
const FILE = __FILE__;
const PREFIX = 'dsjqmg';
const VERSION = '1.0.0';

// Loader
require_once dirname(FILE).'/helpers/loader.php';

// Run the main class
Helpers\Runner::start('Core\Core', 'instance');