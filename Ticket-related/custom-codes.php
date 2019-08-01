<?php 
//Sonaar Theme conflict

add_action('wp_footer', 'remove_player');

function remove_player(){

	$post_type = get_post_type();
	
	if( 'cartflows_step' == $post_type ){
		remove_action('wp_footer', 'sonaar_player', 12);
	}
}

==================================================================================================== 

// Remove the header & footer from the CartFlows Step pages. Flat people theme
function remove_header_footer_from_cpt(){ 
	
	$post_type = get_post_type();

	if( 'cartflows_step' == $post_type ){
		remove_filter('template_include', array( 'Fitpeople_Wrapping', 'wrap' ), 99);
	}
}

add_action( 'wp', 'remove_header_footer_from_cpt' );


==================================================================================================== 

// entrepreneurx theme conflict

add_action( 'wp', 'remove_conflict_actions' );

function remove_conflict_actions(){

    $post_type = get_post_type();

    if( 'cartflows_step' == $post_type ){

        remove_filter('template_include', array('Roots_Wrapping', 'wrap'), 99);
    }   
}
==================================================================================================== 

// Remove the extra html eduma theme conflict
add_action( 'wp', 'remove_conflict_actions' );

function remove_conflict_actions(){

	$post_type = get_post_type();

	if( 'cartflows_step' == $post_type ){

		remove_action( 'wp_footer', 'thim_display_login_popup_form', 5 );
	}	
}
==================================================================================================== 

// Remove extra html Avada Theme conflict
add_action( 'wp', 'remove_avada_conflict_actions' );

function remove_avada_conflict_actions(){

	$post_type = get_post_type();

	global $avada_woocommerce;
	if( 'cartflows_step' == $post_type ){

		remove_action( 'woocommerce_before_account_navigation', array ( $avada_woocommerce, 'avada_top_user_container' ), 10 );
		remove_action( 'woocommerce_before_checkout_form', array ( $avada_woocommerce, 'avada_top_user_container' ), 1 );
		remove_action( 'woocommerce_before_checkout_form', array( $avada_woocommerce, 'before_checkout_form' ) );
	}	
}
==================================================================================================== 

add_action( 'wp', 'change_variation_position' );

function change_variation_position(){

	$post_type = get_post_type();

	if( 'cartflows_step' == $post_type ){
		if(class_exists('Cartflows_Pro_Variation_Product')){

			remove_action( 'woocommerce_checkout_after_customer_details', array( Cartflows_Pro_Variation_Product::get_instance(), 'product_selection_option' ) );

			add_action( 'woocommerce_before_checkout_form', array( Cartflows_Pro_Variation_Product::get_instance(), 'product_selection_option' ) );
		}
	}
}

==================================================================================================== 

add_action( 'cartflows_body_top', 'ga_add_ga_code_below_body' );

function ga_add_ga_code_below_body(){
	$field_code = '';

	$field_code = "add_your_code_here_which_should_be_in_the_body_tag";

	echo $field_code;
}

=====================================================================================================

add_action( 'wp_head', 'ga_add_ga_code_in_head' );

function ga_add_ga_code_in_head(){
	$head_code = '';

	$post_type = get_post_type();

	if( 'cartflows_step' === $post_type ){
		$head_code = "add_your_code_here_which_should_be_in_the_head";
	}

	echo $head_code;
}

====================================================================================================

function sa_change_order_received_title( $order ) {
	
	$post_type = get_post_type();

	if( $order && 'cartflows_step' === $post_type ){

		$title = "Order Summary"; // You can add your own text here.
	}
	
	return $title;
}

add_filter( 'woocommerce_thankyou_order_received_text', 'sa_change_order_received_title' );

====================================================================================================

add_filter( 'woocommerce_paypal_icon', 'bbloomer_replace_paypal_icon' );
  
function bbloomer_replace_paypal_icon() {
   return 'https://your_image_url';
}

====================================================================================================
add_filter('cartflows_variation_popup_toggle_text', 'ma_change_popup_toggle_text');

function ma_change_popup_toggle_text(){
	return __('Open this up', 'cartflows-pro');
}
====================================================================================================

// Apply Coupon from the URL

add_action( 'wp', 'sarang_add_the_coupon_from_url' );

function sarang_add_the_coupon_from_url() {
		
	$discount_coupon = '';

	if( isset( $_GET['auto_coupon']  ) ){

		$discount_coupon = $_GET['auto_coupon'] ;
	}
	
	if ( is_array( $discount_coupon ) && ! empty( $discount_coupon ) ) {
		$discount_coupon = reset( $discount_coupon );
	}

	if ( ! empty( $discount_coupon ) ) {

		$show_coupon_msg = apply_filters( 'mycustom_filter_action', true );

		if ( ! $show_coupon_msg ) {
			add_filter( 'woocommerce_coupon_message', '__return_empty_string' );
		}

		WC()->cart->add_discount( $discount_coupon );

		if ( ! $show_coupon_msg ) {
			remove_filter( 'woocommerce_coupon_message', '__return_empty_string' );
		}
	}
}

====================================================================================================

// Disable the payment gateway for the specific Flow, using the Flow ID. 

add_filter( 'woocommerce_available_payment_gateways', 'sarang_disable_payment_gateway' );
  
function sarang_disable_payment_gateway( $available_gateways ) {
     
    // To be executed in the frontend. 
	if ( ! is_admin() ) {

		global $post;
		
		// Get post type.
		$post_type = get_post_type();

		// To make sure this must execute on the CartFlows pages.
		if( 'cartflows_step' === $post_type ){

			$step_id = strval( $post->ID ); // Step ID
			$flow_id = get_post_meta( $step_id, 'wcf-flow-id', true ); // Flow ID

			// Condition to check for the is it a checkout page & the flow if for which gateway has to disable.
			if ( 'checkout' === get_post_meta( $step_id, 'wcf-step-type', true ) && '1497' === $flow_id ){

				if( isset( $available_gateways['bacs'] ) ){

					// Unset the gateway for this flow id.
					unset( $available_gateways['bacs'] );
				}
			}
		}

	}

	// Returning all the gateways for display.
	return $available_gateways; 
}

// Disable the Autocomplete zipcode.
add_filter( 'cartflows_autocomplete_zip_data', 'wa_disable_autocomplete_zipcode' );

function wa_disable_autocomplete_zipcode(){
	return 'no';
}

// Remove the Smart Coast Theme conflict
// Call the function
add_action( 'wp', 'ma_remove_conflict_actions' );

// Function to remove the action which is causing the conflict .
function ma_remove_conflict_actions(){

	global $post;

	// Get current Post Type.
	$post_type = get_post_type();

	// Get current page template type
	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );

	// This code will execute only on the CartFlows Pages and not others.
	if( 'cartflows_step' == $post_type &&  'default' != $page_template){
		// Solve the conflict
		remove_action('wp_footer', 'mk_get_single_post_prev_next');

	}
}


add_filter( 'cartflows_allow_persistace', 'vi_do_not_store_persistance_data' );

function vi_do_not_store_persistance_data(){

	$allow = 'no';

	retun $allow;
}

============================
/**
 * Force WooCommerce terms and conditions link to open in a new page when clicked on the checkout page
 *
 * @author   Golden Oak Web Design <info@goldenoakwebdesign.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GPLv2+
 */
function st_woocommerce_checkout_terms_and_conditions() {
  remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );
}
add_action( 'wp', 'st_woocommerce_checkout_terms_and_conditions' );

============================

// All other custom codes with respect to Astra and other plugins

// Change the place order button on checkout page. 
// add_filter( 'gettext', 'show_custom_button_text', 20, 3 );
// function show_custom_button_text( $translated_text, $text, $domain ) {
// 	switch ( $translated_text ) {
// 		case 'Proceed to PayPal' : // you can remove this if you don't want to change the button text for PayPal
// 			$translated_text = __( 'Your new Paypal button text here', 'woocommerce' );
// 			break;
// 		case 'Place order' : // This text will change for all other firstly with the COD option and for those payment gateways who don't change the text.
// 			$translated_text = __( 'Your new COD button text here', 'woocommerce' );
// 			break;
// 	}
// 	return $translated_text;
// }

// add_filter( 'cartflows_show_coupon_field', 'hide_it' );

// function hide_it(){
// 	return false;
// }

// add_action( 'init', 'check' );

// function check(){
// 	echo "<pre>";
// 	var_dump(WC()->countries->get_address_fields( WC()->countries->get_base_country(), 'billing' . '_' ) );
// }


// add_action( 'cartflows_body_top', 'add_gtm_code_below_body' );

// function add_gtm_code_below_body(){
// 	$field_code = '';

// 	$field_code = "<!-- Google Tag Manager -->
// 	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': 
// 	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
// 	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
// 	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
// 	})(window,document,'script','dataLayer','GTM-XXXXXX');</script>
// 	<!-- End Google Tag Manager --> ";

// 	echo $field_code;
// }



// function wc_billing_field_strings( $translated_text, $text, $domain ) {
//     switch ( $translated_text ) {
//         case 'Billing details' :
//             $translated_text = __( 'Billing Info', 'woocommerce' );
//             break;
//     }
//     return $translated_text;
// }
// add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );

// update_option( 'thrive_license', array( 'all' ) );      
// update_option( 'tve_leads_license_email', 'License Activated');                                                                                                
// update_option( 'tve_leads_license', 'License Activated');                                                                                                
// update_option( 'tve_leads_license_status', 'ACTIVE'); 

// add_filter( 'cartflows_show_applied_coupon_message', '__return_false' );



// add_action( 'template_redirect', 'set_custom_data_wc_session' );

// function set_custom_data_wc_session () {
//     if ( isset( $_GET['tu_em'] ) || isset( $_GET['tu_name'] ) ) {
//         $em   = isset( $_GET['tu_em'] )   ? esc_attr( $_GET['tu_em'] )   : '';
//         $name = isset( $_GET['tu_name'] ) ? esc_attr( $_GET['tu_name'] ) : '';

//         // Set the session data
//         WC()->session->set( 'custom_data', array( 'email' => $em, 'name' => $name ) );
//     }
// }

// Autofill checkout fields from user data provided from the 
// add_filter( 'woocommerce_checkout_fields' , 'prefill_billing_fields' );

// function prefill_billing_fields ( $address_fields ) {

//     // Get the data from the URL
// 	if ( isset( $_GET['fname'] ) || isset( $_GET['lname'] ) || isset( $_GET['email'] ) ) 
// 	{
// 	// wp_die();
//         $fname = isset( $_GET['fname'] ) ? esc_attr( $_GET['fname'] ) : '';
//         $lname = isset( $_GET['lname'] ) ? esc_attr( $_GET['lname'] ) : '';
//         $em    = isset( $_GET['email'] ) ? esc_attr( $_GET['email'] ) : '';


//         // First Name
// 	    if( isset($_GET['fname']) && ! empty($_GET['fname']) ){
// 	    	if( isset( $address_fields['billing']['billing_first_name'] ) ){

// 	        	$address_fields['billing']['billing_first_name']['default'] = $fname;
// 	    	}
// 	    }

// 	    // Last Name
// 	    if( isset($_GET['lname']) && ! empty($_GET['lname']) ){
// 	        if( isset( $address_fields['billing']['billing_last_name'] ) ){

// 	        	$address_fields['billing']['billing_last_name']['default'] = $lname;
// 	        }
// 	    }

// 	    // Email
// 	    if( isset($_GET['email']) && ! empty($_GET['email']) ){
// 	        if(isset( $address_fields['billing']['billing_email'] )){

// 	        	$address_fields['billing']['billing_email']['default'] = $em;
// 	        }
// 	    }
        
//     }

//     return $address_fields;
// }

// add_action( 'wp_footer', 'remove_conflict_actions' );

// function remove_conflict_actions(){

// 	$post_type = get_post_type();

// 	if( 'cartflows_step' == $post_type ){

// 		remove_action( 'wp_footer', 'quickviewModal' );
// 		remove_action('wp_footer', 'signin' );
// 	}	
// }

// add_action('woocommerce_after_add_to_cart_button','cmk_additional_button');
// function cmk_additional_button() {
// 	global $product;
// 	$id = $product->get_id();
//     $link = '';

//     if( 70 == $id ){
//     	$link = 'http://localhost/sarang/cartflows/checkout-page-2/';
//     }elseif ( 71 == $id ) {
//     	$link = 'http://localhost/sarang/cartflows/checkout-page-3/';
//     }elseif ( 73 == $id ) {
//     	$link = 'http://localhost/sarang/cartflows/checkout-page-4/';
//     }

//     echo '<a href="'. $link .'" class="button alt">CartFlows Checkout</a>';
// }

/*
add_action( 'wp', 'remove_customized_actions' );

add_action( 'woocommerce_checkout_order_review', 'after_custom_checkout_payment', 9 );

// Remove and Re-add default actions
function remove_customized_actions(){
	
	$post_type = get_post_type();

	if( 'cartflows_step' == $post_type ){

		// Add default priorities
		remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 20 );
		remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 10 );
		remove_action( 'woocommerce_review_order_before_payment', 'woocommerce_gzd_template_checkout_payment_title' );
		
		add_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
		add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
		
	}
}

// Add custom order table heading
function after_custom_checkout_payment() {
	
	$post_type = get_post_type();

	if( 'cartflows_step' == $post_type ){
   	
   	?>
   		<h3 id="order_review_heading" class="custom_display"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
   	<?php 
   }
}*/


// Add coupon toggle text. 
/*add_action( 'woocommerce_checkout_order_review', 'display_custom_coupon_field_toggle' );

function display_custom_coupon_field_toggle(){
	if( 'cartflows_step' == get_post_type()){

		$coupon_enabled = apply_filters( 'woocommerce_coupons_enabled', true );
		$cf_show_coupon = apply_filters( 'cartflows_show_coupon_field', true );

		if ( ! ( $coupon_enabled && $cf_show_coupon ) ) {
			return;

		}

		ob_start();
		?>
			<div class="wcf-custom-coupon-field-toggle">
				<div class="wcf-custom-coupon-field-toggle-text">
					<p>Have a Coupon? <a href="#" class="showcoupon"> Click here to enter your code.</a></p>
				</div>
			</div>
		<?php 
		echo ob_get_clean();
	}
}*/

// Add coupon toggle text. 
/*add_action( 'wp_footer', 'add_custom_js' ) ;

function add_custom_js(){

	if( 'cartflows_step' == get_post_type()){

		$coupon_enabled = apply_filters( 'woocommerce_coupons_enabled', true );
		$cf_show_coupon = apply_filters( 'cartflows_show_coupon_field', true );

		if ( ! ( $coupon_enabled && $cf_show_coupon ) ) {
			return;

		}

		if( wp_script_is( 'jquery', 'done' ) ) {
?>
	<script type="text/javascript">

		var wc_checkout_coupons = {
			init: function() {
				jQuery( document.body ).on( 'click', '.wcf-custom-coupon-field-toggle a.showcoupon', this.show_coupon_form );
				jQuery( '.wcf-embed-checkout-form .wcf-custom-coupon-field' ).hide();
			},

			show_coupon_form: function() {
				jQuery( '.wcf-custom-coupon-field' ).slideToggle( 400, function() {
					jQuery( '.wcf-custom-coupon-field' ).find( ':input:eq(0)' ).focus();
				});
				return false;
			},

		};

		jQuery(document).ready(function($) {

			wc_checkout_coupons.init();
		});
			
	</script>
<?php 
		}
	}
}*/

// add_action( 'wp', 'remove_conflict_actions' );

// function remove_conflict_actions(){

// 	$post_type = get_post_type();

// 	if( 'cartflows_step' == $post_type ){

// 		remove_filter('template_include', array('Roots_Wrapping', 'wrap'), 99);
// 	}	
// }

// add_action( 'wp', 'show_mailchimp_checkbox' );

// add_filter( 'mc4wp_integration_woocommerce_options', 'abc' );

// function show_mailchimp_checkbox(){

// }

// function abc( $options ){

// 	print "<pre>";
// 	var_dump($options);
// 	print "</pre>";
// 	// wp_die();
// }

// add_action( 'wp', 'add_default_actions');

// function add_default_actions(){
// 	global $mc4wp;

// 	if(class_exists('MC4WP_Integration_Manager')){

// 		// add_action( 'woocommerce_checkout_after_customer_details',  );
// 		$object = $mc4wp['integrations'];

// 		print "<pre>";
// 			var_dump($mc4wp['integrations'] );
// 		print "</pre>";
// 	}

// }

// add_action( 'cartflows_checkout_form_before', 'add_default_actions' );


==================================================================================================== 

// Themes present 

// http://screenshots.sharkz.in/sarang/2019/05/2019-05-22_11-36-14.png

// add_filter( 'woocommerce_paypal_icon', 'sh_change_paypal_logo' );
  
// function sh_change_paypal_logo() {
//    return 'https://your_image_url';
// }

/*function change_order_received_title( $order ) {
	
	$post_type = get_post_type();

	if( $order && 'cartflows_step' === $post_type ){

		$title = "Order Summary"; // You can add your own text here.
	}
	
	return $title;
}

add_filter( 'woocommerce_thankyou_order_received_text', 'change_order_received_title' );*/


// function na_ed_change_post_permalink_structure( $post_link, $post, $leavename ){
		
// 	$post_type = get_post_type();
	
// 	// If elementor page preview, return post link as it is.
// 	if ( isset( $_REQUEST['elementor-preview'] ) ) {
// 		return $post_link;
// 	}

// 	if( 'cartflows_step' == $post_type ){

// 		$structure = get_option( 'permalink_structure' );

// 		if ( '/%postname%' === $structure ) {

// 			if ( isset( $post->post_type ) && $post_type == $post->post_type ) {

// 				$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
// 			}
// 		}
// 	}

// 	return $post_link;

// }

// add_filter( 'post_type_link', 'na_ed_change_post_permalink_structure', 9, 3 );


/*// Change the position of order review section & title.
function change_order_review_pos(){
	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
	add_action( 'woocommerce_before_checkout_form', 'change_pos_of_title', 10 );
	add_action( 'woocommerce_before_checkout_form', 'woocommerce_order_review', 20 );
}

// Add new & separate your order heading.
function change_pos_of_title(){

	echo '<h3 id="order_review_heading">Your order</h3>';
}

add_action( 'cartflows_checkout_form_before', 'change_order_review_pos' );*/

/*// Redirect to the Checkout page directly.
add_filter('woocommerce_add_to_cart_redirect', 'in_redirect_add_to_cart');
function in_redirect_add_to_cart() {
    $cw_redirect_url_checkout = wc_get_page_permalink( 'checkout' );
    return $cw_redirect_url_checkout;
}*/

// add_filter( 'woocommerce_cart_item_name', 'ry_product_image_on_checkout', 10, 3 );

// function ry_product_image_on_checkout( $name, $cart_item, $cart_item_key ) {
	
// 	/* Return if not checkout page */
// 	if ( ! is_checkout() ) {
// 		return $name;
// 	}
	
// 	/* Get product object */
// 	$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

// 	/* Get product thumbnail */
// 	$thumbnail = $_product->get_image();

// 	/* Add wrapper to image and add some css */
// 	$image = '<div class="ts-product-image" style="width: 52px; height: 45px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
// 				. $thumbnail .
// 			'</div>'; 

// 	/* Prepend image to name and retun it */ 
// 	return $image . $name;
// }




