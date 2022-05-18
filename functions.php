// check every 3 minute
add_filter( 'cron_schedules', 'order_schedule' );
function order_schedule( $schedules ) {
  $schedules['every_3_minute'] = array(
    'interval' => 180,
    'display' => __( 'Every 3 Minutes', 'textdomain' )
    );
  return $schedules;
}

if ( ! wp_next_scheduled( 'order_schedule' ) ) {
  wp_schedule_event( time(), 'every_3_minute', 'order_schedule' );
}

add_action( 'order_schedule', 'order_checking' );
function order_checking() {
  // current status : ‘On hold’ 48 hours after -> change to ‘Cancelled’)
  $orders = wc_get_orders( array(
    'status' => 'on-hold',
    'date_modified' => '<' . ( time() - (7 * DAY_IN_SECONDS) ),
    ) );
  if($orders){
    foreach ($orders as $order){
      $order->update_status( 'cancelled' );
    }
  }
}
