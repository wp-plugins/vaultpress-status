<?php
/*
 * Plugin Name: VaultPress Status
 * Plugin URI: http://automattic.com/wordpress-plugins/
 * Description: Adds VaultPress' status to your admin bar. To give you that nice and secured feeling, even in the front-end of your website.
 * Version: 0.3
 * Author: Luc De Brouwer
 * Author URI: http://www.lucdebrouwer.nl/
 *
 */

function LDB_VaultPress_Status_render() {
	global $wp_admin_bar;
	$vp = new VaultPress;
	$ticker = json_decode( $vp->contact_service( 'ticker' ) );
	$wp_admin_bar->add_menu( array(
		'id' => 'LDB_VaultPress_status',
		'title' => 'VaultPress Status',
		'href' => '/wp-admin/admin.php?page=vaultpress'
	) );
	if( $ticker->uploads_progress ) {
		$wp_admin_bar->add_menu( array(
		    'parent' => 'LDB_VaultPress_status',
			'id' => 'LDB_VaultPress_Uploads',
			'title' => '<div class="ldb_vaultpress_status_count">' . $ticker->uploads_progress . ' %</div> Uploads',
			'href' => '#'
		) );
	}
	if( $ticker->plugins_progress ) {
		$wp_admin_bar->add_menu( array(
		    'parent' => 'LDB_VaultPress_status',
			'id' => 'LDB_VaultPress_Plugins',
			'title' => '<div class="ldb_vaultpress_status_count">' . $ticker->plugins_progress . ' %</div> Plugins',
			'href' => '#'
		) );
	}
	if( $ticker->themes_progress ) {
		$wp_admin_bar->add_menu( array(
		    'parent' => 'LDB_VaultPress_status',
			'id' => 'LDB_VaultPress_Themes',
			'title' => '<div class="ldb_vaultpress_status_count">' . $ticker->themes_progress . ' %</div> Themes',
			'href' => '#'
		) );
	}
	if( $ticker->tables_progress ) {
		$wp_admin_bar->add_menu( array(
		    'parent' => 'LDB_VaultPress_status',
			'id' => 'LDB_VaultPress_Database',
			'title' => '<div class="ldb_vaultpress_status_count">' . $ticker->tables_progress . ' %</div> Database',
			'href' => '#'
		) );
	}
	if( $ticker->message ) {
		$wp_admin_bar->add_menu( array(
		    'parent' => 'LDB_VaultPress_status',
			'id' => 'LDB_VaultPress_Message',
			'title' => $ticker->message,
			'href' => '#'
		) );
	}
}

function LDB_VaultPress_Status_css() {
?>
	<style type="text/css">
		#wpadminbar div.ldb_vaultpress_status_count {
			display: block;
			float: right;
			line-height: 28px;			
		}
	</style>
<?php
}

if( class_exists( 'VaultPress' ) ) {
	add_action( 'wp_head', 'LDB_VaultPress_Status_css' );
	add_action( 'wp_before_admin_bar_render', 'LDB_VaultPress_Status_render' );
}