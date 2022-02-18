<?php
/**
 * Fired during plugin activation
 *
 * @link       echarissopoulos.herokuapp.com
 * @since      1.0.0
 *
 * @package    Matshop_Products
 * @subpackage Matshop_Products/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Matshop_Products
 * @subpackage Matshop_Products/includes
 * @author     left4dev <echarissopoulos@gmail.com>
 */
class Matshop_Products_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . 'matshop_products_qty';

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL,
			qty mediumint(9) NOT NULL,
			UNIQUE KEY id (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

	
		$wpdb->insert( 
			$table_name, 
			array( 
				'id'=>1,
				'qty' => 0
			) 
		);



	}

}
