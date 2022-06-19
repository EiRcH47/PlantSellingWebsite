<?php

$upload_dir = wp_upload_dir();
if ( isset($upload_dir['basedir']) ) {

	$theme_name = 'greenmart';

	$demo_import_base_dir = $upload_dir['basedir'] . '/'.$theme_name.'_import/';
	$demo_import_base_uri = $upload_dir['baseurl'] . '/'.$theme_name.'_import/';
	$path_dir = $demo_import_base_dir . 'data/';
	$path_uri = $demo_import_base_uri . 'data/';

	if ( is_dir($path_dir) ) {
		$demo_datas = array();

		foreach(glob($path_dir . '*', GLOB_ONLYDIR) as $theme_dir) {

			if(is_file($theme_dir . '/data.xml')) {
				$theme_dir_name = basename($theme_dir);
				$demo_data_items = array();
				$id = 0;

				$files = glob($theme_dir . '/*', GLOB_ONLYDIR);
				usort($files, function ($a, $b) {
				    $aIsDir = is_dir($a);
				    $bIsDir = is_dir($b);
				    if ($aIsDir === $bIsDir)
				        return strnatcasecmp($a, $b);
				    elseif ($aIsDir && !$bIsDir)
				        return -1;
				    elseif (!$aIsDir && $bIsDir)
				        return 1;
				});

				foreach( $files as $home_dir) {

					$str = explode("/data/",$home_dir);

					$home_dir_name = basename($home_dir);
					$home_uri 	   = $path_uri.'/'. $str[1];

					if( $home_dir_name != 'revslider' ) {
						$demo_data_items += [$home_dir_name => array(
							'data_dir'      => $home_dir,
							'title'         => ucfirst($home_dir_name),
							'screenshot'	=> 'screenshot.jpg',
						)];
					}
				}
				$demo_datas += [$theme_dir_name => $demo_data_items];
			}
		}
	}
}