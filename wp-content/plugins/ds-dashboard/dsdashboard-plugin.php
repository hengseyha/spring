<?php
/**
 * Plugin Name:       DS Dashboard
 * @package           dsdashboardPlugin
 * Plugin URI:        https://wordpress.org/plugins/ds-dashboard
 * Description:       This plugin can make your dashboard wordpress to modern.
 * Version:           1.0.0
 * Author:            DS Sombol
 * Text Domain:       dsdashboard
 */

 /*
DS Dashboard is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 1 of the License, or
any later version.
 
DS Dashboard is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class dashboardPlugin{

    function __construct(){

    }
    function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }
    function activation(){

    }
    function deactivation(){

    }
    function enqueue(){
        wp_enqueue_style( 'dashboardstyle', plugins_url( '/assets/dashboardstyle.css', __FILE__ ));
    }
}
if (class_exists('dashboardPlugin')) {
    $dashboardPlugin = new dashboardPlugin();
    $dashboardPlugin -> register();
}
register_activation_hook( __FILE__, array($dashboardPlugin, 'activation'));
register_deactivation_hook( __FILE__, array($dashboardPlugin, 'deactivation'));