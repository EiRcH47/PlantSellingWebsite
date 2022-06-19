<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage greenmart
 * @since greenmart 2.1.6
 */


$sidebar = greenmart_get_sidebar_dokan();

if(!isset($sidebar['id']) || empty($sidebar['id'])) return;

?> <div class="greenmart-sidebar-vendor sidebar"><?php dynamic_sidebar( $sidebar['id'] ); ?></div>




