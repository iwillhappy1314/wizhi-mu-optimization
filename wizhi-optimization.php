<?php
/*
Plugin Name:        Wizhi MU Optimization
Plugin URI:         http://www.wpzhiku.com/wizhi-optimization-2/
Description:        WordPress 多站点网络管理体验优化
Version:            1.1
Author:             WordPress 智库
Author URI:         http://www.wpzhiku.com/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

define('WIZHI_PATH', plugin_dir_path(__FILE__));

function wizhi_mu_load_modules() {
    require_once(WIZHI_PATH . 'modules/optimization.php');
}
add_action('after_setup_theme', 'wizhi_mu_load_modules');