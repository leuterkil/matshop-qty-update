<?php 
    /**
     * Update the products quantity
     * 
     * If you are not familiar with programming don't edit this file
     * 
     * Made by Left4Dev Webservices
     * 
     * @param int qty   The total instock products on site.
     */

     function updateQty($qty)
     {
        global $wpdb;
        $table_name = $wpdb->prefix . 'matshop_products_qty';
    
        $wpdb->update(
            $table_name,
            array(
                'qty'=>$qty
            ),
            array(
                'id'=>1,
            )
        );
     }


     /**
      * Get the products quantity
      * 
      * If you are not familiar with programming don't edit this file
      * 
      * Made by Left4Dev Webservices
      */

     function getQty()
     {
        global $wpdb;
        $table_name = $wpdb->prefix . 'matshop_products_qty';
    
       $results = $wpdb->get_results(
           "SELECT qty FROM $table_name WHERE id=1"
       );
       return $results;
     }



     function get_instock_products_count(){
        global $wpdb;
        
        // The SQL query
        $result = $wpdb->get_col( "
            SELECT COUNT(p.ID)
            FROM {$wpdb->prefix}posts as p
            INNER JOIN {$wpdb->prefix}postmeta as pm ON p.ID = pm.post_id
            WHERE p.post_type LIKE '%product%'
            AND p.post_status LIKE 'publish'
            AND pm.meta_key LIKE '_stock_status'
            AND pm.meta_value LIKE 'instock'
        " );
        $count  = $result;
        return reset($count);
    }



    add_filter( 'cron_schedules', 'bbloomer_check_every_24_hours2' );
    function bbloomer_check_every_24_hours2( $schedules ) {
       $schedules['every_24_hours'] = array(
           'interval' => 86400,
           'display'  => __( 'Every 24 Hours' ),
       );
       return $schedules;
   }
   
   add_action( 'wp', 'bbloomer_custom_cron_job_qty' );
    function bbloomer_custom_cron_job_qty() {
      if ( ! wp_next_scheduled( 'bl_cron_hook_qty' ) ) {
         wp_schedule_event( time(), 'every_24_hours', 'bl_cron_hook_qty' );
      }
   }
   
   
   add_action( 'bl_cron_hook_qty', 'setStock' );
   
   function setStock(){
       updateQty(get_instock_products_count());
   }
?>