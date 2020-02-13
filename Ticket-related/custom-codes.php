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

/* Remove extra html Jupiter Theme conflict */
add_action( 'wp', 'remove_jupiter_conflict_actions' );

function remove_jupiter_conflict_actions(){

	global $post;

	$post_type = get_post_type();

	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );

	if( 'cartflows_step' == $post_type && 'cartflows-canvas' === $page_template || 'cartflows-default' === $page_template ){
		remove_action( 'wp_footer', 'mk_get_single_post_prev_next' );
	}	
}
/* Remove extra html Jupiter Theme conflict */

==================================================================================================== 

// Remove extra html NaturLife Theme conflict
add_action( 'wp', 'remove_naturalife_conflict_actions' );

function remove_naturalife_conflict_actions(){

	global $post;

	$post_type = get_post_type();

	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );

	if( 'cartflows_step' == $post_type && 'cartflows-canvas' === $page_template || 'cartflows-default' === $page_template  ){

		remove_action( "wp_footer","rtframework_popup_search", 1 );
		remove_action( "wp_footer","rtframework_popup_share", 1 );
		remove_action( "wp_footer","rtframework_side_panel", 10 );
	}	
}

==================================================================================================== 

// Triger the action
add_action( 'wp', 'add_default_woocommerce_coupon_field' );

function add_default_woocommerce_coupon_field(){

	// Get theme instance.
	global $avada_woocommerce;

	// Get current post type.
	$post_type = get_post_type();

	// Check for the post type condition.
	if( 'cartflows_step' === $post_type ){

		//Remove the modified coupons form.
		remove_action( 'woocommerce_before_checkout_form', array( $avada_woocommerce, 'checkout_coupon_form' ), 10 );
		
		// Add the default coupons form.
		add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
	}
}

==================================================================================================== 
/* Change the variation position 1 */
add_action( 'wp', 'change_variation_position' );

function change_variation_position(){

	$post_type = get_post_type();

	if( 'cartflows_step' == $post_type ){
		if(class_exists('Cartflows_Pro_Variation_Product')){

			remove_action( 'woocommerce_checkout_after_customer_details', array( Cartflows_Pro_Variation_Product::get_instance(), 'product_selection_option' ) );

			add_action( 'woocommerce_before_checkout_form', array( Cartflows_Pro_Variation_Product::get_instance(), 'product_selection_option' ) );
			
			// OR below actions
			// add_action( 'woocommerce_checkout_before_customer_details', array( Cartflows_Pro_Variation_Product::get_instance(), 'product_selection_option' ) );
		}
	}
}
/* Change the variation position 1 */

/* Change the variation position 2 */
add_action( 'cartflows_add_before_main_section', 'change_variation_position' );

function change_variation_position(){

	$post_type = get_post_type();
	
	if( 'cartflows_step' == $post_type ){
		if(class_exists('Cartflows_Pro_Variation_Product')){

			remove_action( 'woocommerce_checkout_after_customer_details', array( Cartflows_Pro_Variation_Product::get_instance(), 'product_selection_option' ) );

			add_action( 'woocommerce_before_checkout_billing_form', array( Cartflows_Pro_Variation_Product::get_instance(), 'product_selection_option' ) );
		}
	}
}
/* Change the variation position 2 */

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

==================================================================================================== 

// Disable the Autocomplete zipcode.
add_filter( 'cartflows_autocomplete_zip_data', 'wa_disable_autocomplete_zipcode' );

function wa_disable_autocomplete_zipcode(){
	return 'no';
}
==================================================================================================== 

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

==================================================================================================== 

add_filter( 'cartflows_allow_persistace', 'vi_do_not_store_persistance_data' );

function vi_do_not_store_persistance_data(){

	$allow = 'no';

	retun $allow;
}

==================================================================================================== 
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

==================================================================================================== 

// All other custom codes with respect to Astra and other plugins

// Change the place order button on checkout page. 
add_filter( 'gettext', 'show_custom_button_text', 20, 3 );
function show_custom_button_text( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Proceed to PayPal' : // you can remove this if you don't want to change the button text for PayPal
			$translated_text = __( 'Your new Paypal button text here', 'woocommerce' );
			break;
		case 'Place order' : // This text will change for all other firstly with the COD option and for those payment gateways who don't change the text.
			$translated_text = __( 'Your new COD button text here', 'woocommerce' );
			break;
	}
	return $translated_text;
}

==================================================================================================== 

add_filter( 'cartflows_show_coupon_field', 'ma_hide_coupon_field' );

function ma_hide_coupon_field(){
	return false;
}

==================================================================================================== 

add_action( 'cartflows_body_top', 'add_gtm_code_below_body' );

function add_gtm_code_below_body(){
	$field_code = '';

	$field_code = "<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': 
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-XXXXXX');</script>
	<!-- End Google Tag Manager --> ";

	echo $field_code;
}

==================================================================================================== 

function wc_billing_field_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Billing details' :
            $translated_text = __( 'Billing Info', 'woocommerce' );
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );

==================================================================================================== 

update_option( 'thrive_license', array( 'all' ) );      
update_option( 'tve_leads_license_email', 'License Activated');                                                                                                
update_option( 'tve_leads_license', 'License Activated');                                                                                                
update_option( 'tve_leads_license_status', 'ACTIVE'); 

add_filter( 'cartflows_show_applied_coupon_message', '__return_false' );

==================================================================================================== 


add_action( 'template_redirect', 'set_custom_data_wc_session' );

function set_custom_data_wc_session () {
    if ( isset( $_GET['tu_em'] ) || isset( $_GET['tu_name'] ) ) {
        $em   = isset( $_GET['tu_em'] )   ? esc_attr( $_GET['tu_em'] )   : '';
        $name = isset( $_GET['tu_name'] ) ? esc_attr( $_GET['tu_name'] ) : '';

        // Set the session data
        WC()->session->set( 'custom_data', array( 'email' => $em, 'name' => $name ) );
    }
}

==================================================================================================== 



/* Autofill checkout fields from user data provided from the */
add_filter( 'woocommerce_checkout_fields' , 'mi_prefill_billing_fields' );

function mi_prefill_billing_fields ( $address_fields ) {

    // Get the data from the URL
	if ( isset( $_GET['fname'] ) || isset( $_GET['lname'] ) || isset( $_GET['email'] ) ) 
	{
	// wp_die();
        $fname = isset( $_GET['fname'] ) ? esc_attr( $_GET['fname'] ) : '';
        $lname = isset( $_GET['lname'] ) ? esc_attr( $_GET['lname'] ) : '';
        $em    = isset( $_GET['email'] ) ? esc_attr( $_GET['email'] ) : '';


        // First Name
	    if( isset($_GET['fname']) && ! empty($_GET['fname']) ){
	    	if( isset( $address_fields['billing']['billing_first_name'] ) ){

	        	$address_fields['billing']['billing_first_name']['default'] = $fname;
	    	}
	    }

	    // Last Name
	    if( isset($_GET['lname']) && ! empty($_GET['lname']) ){
	        if( isset( $address_fields['billing']['billing_last_name'] ) ){

	        	$address_fields['billing']['billing_last_name']['default'] = $lname;
	        }
	    }

	    // Email
	    if( isset($_GET['email']) && ! empty($_GET['email']) ){
	        if(isset( $address_fields['billing']['billing_email'] )){

	        	$address_fields['billing']['billing_email']['default'] = $em;
	        }
	    }
        
    }

    return $address_fields;
}
/* Autofill checkout fields from user data provided from the */

====================================================================================================

/* Change the add-to-cat button text & URL */

// Trigure the action
add_filter('woocommerce_add_to_cart_redirect', 'cw_redirect_add_to_cart');

function cw_redirect_add_to_cart() {
    
    // Your checkout page URl
    $cw_redirect_url_checkout = "add_your_checkout_page_url_here";

    // Return your URL.
    return $cw_redirect_url_checkout;
}
 
add_filter( 'woocommerce_product_single_add_to_cart_text', 'cw_btntext_cart' );

add_filter( 'woocommerce_product_add_to_cart_text', 'cw_btntext_cart' );

function cw_btntext_cart() {
    return __( 'Go To Checkout', 'woocommerce' );
}

/* Change the add-to-cat button text & URL */

/* Change the add-to-cat button URL */
add_filter( 'woocommerce_add_to_cart_form_action', 'change_butn_url' );

function change_butn_url( $url ){
	global $post

	if( "your_product_id" === $post->ID ){

		$url =  "add_your_landing_page_url";
	}

	return $url;
}
/* Change the add-to-cat button URL */


====================================================================================================

/* Remove the add to cart message/notice from the CartFlows checkout page only */
function remove_added_to_cart_notice()
{
	// Get all notices.
    $notices = WC()->session->get('wc_notices', array());

    // Check array is blank or not. Means any notices are present or not.
    if( is_array( $notices ) && !empty( $notices ) ){

    	// Search for only sucess message.
	    foreach( $notices['success'] as $key => &$notice){
	        if( strpos( $notice, 'has been added' ) !== false){
	            $added_to_cart_key = $key;
	            break;
	        }
	    }

	    // If the add to cart message found then unset it.
	    unset( $notices['success'][$added_to_cart_key] );

    }

    // Display rest of the notices/messages. 
    WC()->session->set('wc_notices', $notices);
}

// Trigure the action. This will only work on the CartFlows Checkout page.
add_action( 'cartflows_checkout_before_shortcode' , 'remove_added_to_cart_notice', 1 );

/* Remove the add to cart message/notice from the CartFlows checkout page only */

====================================================================================================

/* Modify the CPT's arguments */

/**
 * Filter for CPT to register more options.
 *
 * @param $args       array    The original CPT args.
 * @param $post_type  string   The CPT slug.
 *
 * @return array
 */
function ada_client_filter_products_cpt( $args, $post_type ) {
    
    // If not cartflows_step CPT, bail out.
    if ( 'cartflows_step' !== $post_type ) {
        return $args;
    }

    // Add additional cartflows_step CPT options.
    $product_args = array(
        'show_in_rest' => true, // Enable the Gutenberg for the CartFlows Step post type.
    );
    
    // Merge args together.
    return array_merge( $args, $product_args );
}

// trigure the action to modify the arguments
add_filter( 'register_post_type_args', 'ada_client_filter_products_cpt', 10, 2 );

/* Modify the CPT's arguments */

====================================================================================================

/* Custom Fix for the klarna Payment gateway */

add_action( 'after_setup_theme', 'klarna_custom_fix_plugins_loaded_action', 99 );

function klarna_custom_fix_plugins_loaded_action() {
	
	if ( ! defined( 'CARTFLOWS_VER' ) ) {
	return;
	}

	remove_filter( 'woocommerce_ajax_get_endpoint', array( Cartflows_Checkout_Markup::get_instance(), 'get_ajax_endpoint' ) );

	add_filter( 'woocommerce_get_checkout_url', 'klarna_custom_global_checkout_fix', 1 );

}

function klarna_custom_global_checkout_fix( $link ) {
	
	$global_checkout = get_option('_cartflows_common');
	$global_checkout = isset( $global_checkout['global_checkout'] ) ? $global_checkout['global_checkout'] : 0;
	
		if ( $global_checkout ) {
			$temp_link = get_permalink( $global_checkout );
		if ( ! empty( $temp_link ) ) {
			$link = $temp_link;
			}
		}
	
	return $link;
}

/* Custom Fix for the klarna Payment gateway */

====================================================================================================

/**
 * Change the URL of the Global Checkout page.
 *
 * @param link $link of your global checkout page.
 *
 * @return link $your_link of ypur custom page.
 */
add_filter( 'cartflows_global_checkout_url', 'your_callback_function' );

function your_callback_function( $link ){

	// Return your custom page URL. 
	return  $your_link = get_permalink( $post->ID ); // Add your custom page's post ID

}

====================================================================================================


/* Display order bump image in the mobile view */

@media only screen and (max-width: 768px){
	.wcf-bump-order-wrap .wcf-bump-order-offer-content-left {
	    display: block;
	    width:100%;
	}

	.wcf-bump-order-wrap .wcf-bump-order-offer-content-left img{
		padding: 20px;
	}
}

/* Display order bump image in the mobile view */


====================================================================================================


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


// Call the function.
add_action( 'woocommerce_product_query', 'sa_show_only_sale_products' );

// Function with the logic.
function sa_show_only_sale_products( $query ){

	// Get only those products which are on the sale.
    $product_ids_on_sale = wc_get_product_ids_on_sale();

    // set it in the query to return those products only.
    $query->set( 'post__in', $product_ids_on_sale );
}



// Add the extra checkout option from the custom code

add_filter( 'cartflows_checkout_meta_options', 'change_place_order_button_text_default', 10, 2 );

function change_place_order_button_text_default( $checkout_fields, $post_id ){

	$checkout_fields['wcf-checkout-place-order-text']   = array(
		'default'  => '',
		'sanitize' => 'FILTER_DEFAULT',
	);

	return $checkout_fields;
}

add_action( 'cartflows_checkout_style_tab_content', 'tab_style_checkout_button_text' );

/**
 * Tab style
 *
 * @param array $options options.
 * @param int   $post_id post ID.
 */
function tab_style_checkout_button_text( $options ) {

	if( function_exists('wcf') ){
		
		echo "<div class='wcf-cs-button-texts'>";

		echo wcf()->meta->get_text_field(
			array(
				'label' => __( 'Place Order button Text', 'cartflows-pro' ),
				'name'  => 'wcf-checkout-place-order-text',
				'value' => $options['wcf-checkout-place-order-text'],
				'attr'  => array(
					'placeholder' => __( 'Place Order button Text', 'cartflows-pro' ),
				),
			)
		);

		echo '</div>';
	}
}

// Add the extra checkout option from the custom code


// Change the place order button text for different checkout pages


// Add action to run to run the function.
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 

// Function.
function woo_custom_order_button_text() {

	global $post;
	
	$post_id = $post->ID;

	if( 'cartflows_step' === $post->post_type ){

		switch ( $post_id ) {
			case '1737':
				
				return __( 'Your Button Text', 'woocommerce' ); 

				break;
			// === if you want to add the more condition then copy-paste this block of code and change the post id infront of the case word.=== 
			case '1741':
				
				return __( 'Your Button Text', 'woocommerce' ); 

				break;
			// === if you want to add the more condition then copy-paste this block of code and change the post id infront of the case word.=== 			
			default:
				
				return __( 'Place Order', 'woocommerce' ); 

				break;
		}
	}
    
    return __( 'Place Order', 'woocommerce' ); 

}
// Change the place order button text for different checkout pages


// Change the URL of the specific product from the shop page. 

// Trigure the action.
add_filter( 'woocommerce_loop_product_link', 'da_change_product_permalink_shop', 99, 2 );
 
// Function with the main redirect logic.
function da_change_product_permalink_shop( $link, $product ) {
	
	// Get the current product id.
	$this_product_id = $product->get_id();
	
	// add the condition cases for the product which you want to set the custom URL.
	switch ($this_product_id) {

		// Repeat this code from here to add more custom URL for the products.
		case 99:
			$link = 'add_your_landing_page_url_here';
			break;
		// Repeat this code from here to add more custom URL for the products.
		
		// case your_product_id:
		// 	$link = 'add_your_landing_page_url_here';
		// 	break;

		// case your_product_id:
		// 	$link = 'add_your_landing_page_url_here';
		// 	break;
				
		default:
			return $link;
			break;
	}

	return $link;
}
// Change the URL of the specific product from the shop page. 

==================================================================================================== 

/* Change the Text & URL of the ADD TO CART button on the shop page */
add_filter( 'woocommerce_loop_add_to_cart_link', 'an_replacing_add_to_cart_button_link', 10, 2 );

function an_replacing_add_to_cart_button_link( $button, $product  ) {

	// Get the current product id.
	$this_product_id = $product->get_id();
	
	// add the condition cases for the product which you want to set the custom URL.
	switch ($this_product_id) {

		// Repeat this code from here to add more custom URL for the products.
		case 134: // Change your product's id here for which you want to redirect to its separate checkout page. 
			$link = 'http://localhost/sarang/cartflows/cartflows_step/checkout-page/';
			
			$button_text = __("View product", "woocommerce");

    		$button = '<a class="button" href="'. $link .'">' . $button_text . '</a>';

			break;

		// Repeat this code from here to add more custom URL for the products.

		default:
			return $button;
			break;
	}

    return $button;
}
/* Change the Text & URL of the ADD TO CART button on the shop page */

==================================================================================================== 

/* Show sale & regular price on the checkout page */
add_filter("woocommerce_cart_item_subtotal", "al_display_discount_price", 10, 3);

function al_display_discount_price($product_price, $cart_item, $cart_item_key)
{
    $regular_price = wc_price( $cart_item['data']->get_regular_price() );
    if( $product_price != $regular_price )
    {
    if(isset( $cart_item['cartflows_bump'] ) && 1 == $cart_item['cartflows_bump'])
        {
       $product_price = wc_format_sale_price( $cart_item['data']->get_regular_price(), $cart_item['custom_price'] );
    }else{
       $product_price = wc_format_sale_price( $cart_item['data']->get_regular_price(), $cart_item['data']->get_sale_price() );
    }
    }
    return $product_price;
}
/* Show sale & regular price on the checkout page */

==================================================================================================== 

/* Coupon field text change filter */
add_filter( 'cartflows_custom_coupon_text', 'be_change_coupon_fields_text' );

function be_change_coupon_fields_text( $coupon_text ){
	
	$coupon_text['field_text'] = 'Tuzya';
	$coupon_text['button_text'] = 'Mazya';

	return $coupon_text;
}
/* Coupon field text change filter */

==================================================================================================== 

<script type="text/javascript">
	// Initiate jQuery Function to register all the logic.
	jQuery( function($) {

		// Get the mobile width.
		var mobile_width = $(window).width();

		// Check for the mobile width.
	    if ( mobile_width <= 320 || mobile_width <= 360 || mobile_width <= 480 ){
	  		
	  		// Get each product boxs.
	  		var product_box = $('ul.products').find('li.ast-article-post');

	  		// Logic for moving each product title before the Image in only mobile view.

		  	$( product_box ).each(function( $this ) {
		  		var $this = $(this),
		    		p_title = $this.find('.astra-shop-summary-wrap a.ast-loop-product__link'),
		    		p_image = $this.find('.astra-shop-thumbnail-wrap .woocommerce-loop-product__link'); 
		  		
		  		// Move the title before the image in that box.
		    	p_title.insertBefore( p_image );
		  		
		  	});
	  	}

	} );
</script>

<-- Change the order review title from product to course -->
jQuery(document).ready(function(){
  
    jQuery(".cartflows_step-template .woocommerce-checkout-review-order-table").find("thead tr th.product-name").text("Coursesss");
});
<-- Change the order review title from product to course -->

==================================================================================================== 

add_action( 'woocommerce_thankyou', 'set_cancel_url' );

function set_cancel_url( $order_id ){
	global $post, $wp;

	$post_type = $post->post_type;

	$order = wc_get_order($order_id); //<--check this line

    $orderstat = $order->get_status();

    print $orderstat;
    die();
	if( 'cartflows_step' === $post_type && 'thankyou' === get_post_meta( $post->ID, 'wcf-step-type', true ) ){

		if( $orderstat === 'failed' ){ // completed, pending, processing, cancelled, refunded

			$URL = 'add_your_full_URL_here_if_the_orde_is_fail';

			wp_redirect( $URL );

		}
	}
}

==================================================================================================== 

/* Steps to integrate the one-click with the CartFlows*/
1. We have provided an array of supported payment gateways. You need to add a payment gateway here with the class which will be required later.
  File - "cartflows-pro/classes/class-cartflows-pro-gateways.php"

2. Then goto "cartflows-pro/modules/gateways"
  - You need to add your gateway class file here.

3. In "process_offer_payment" we actually charge for the upselling products. You one click upsell code will go here.

4. You can refer to the COD and PayPal gateway class file for further reference. It will give you a better idea.

If you need any new action, filter then let us know we will add it.

We need to work closely to achieve it. I am happy to help you.

Looking forward to hearing from you.
/* Steps to integrate the one-click with the CartFlows*/

==================================================================================================== 

/* Custom code to apply the variation from the URL*/
jQuery(window).load(function(){
    jQuery.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);

            return (results !== null) ? results[1] || 0 : false;
    }

    results = jQuery.urlParam('prod');

    console.log('result'+results);

    if(results){
        jQuery('#wcf-item-product-'+results).click();
    }
});
/* Custom code to apply the variation from the URL*/

==================================================================================================== 

/* Custom css to highlight specific variation */

.wcf-embed-checkout-form .wcf-product-option-wrap .wcf-qty-row:nth-child(2){
	background-color: #F6E100;
	margin: 0 -10px;
	padding: 10px 10px;
	box-shadow: 0px 3px 9px -3px #555;
}

.wcf-embed-checkout-form-two-step .wcf-qty-options .wcf-item{
	flex:6;
}

.wcf-embed-checkout-form-two-step .woocommerce-checkout .wcf-product-option-wrap .wcf-qty-options .wcf-qty{
	display:none;
}

/* Custom css to highlight specific variation */

==================================================================================================== 

/* Add Extra div in the variation box to display the image */
	
	// JS code 
	jQuery(document).ready(function() {

	    var wcf_row = document.querySelectorAll('.wcf-qty-options .wcf-qty-row');
		var first_row = wcf_row[0],
			second_row = wcf_row[1];
			
		jQuery(second_row).find('.wcf-item').append("<div class='extra-div'></div>");

	});
	// JS code 

	// CSS Code
	.wcf-embed-checkout-form .wcf-product-option-wrap .wcf-qty-options .wcf-item .extra-div::after{
	    content:url("add_your_image_full_path");
	}
	// CSS Code

/* Add Extra div in the variation box to display the image */

==================================================================================================== 

/* Disable the DIVI icons only on the CartFlows Pages*/
jQuery(document).ready(function(e){
	if( cartflows ){
			if( jQuery('body').hasClass('et_button_icon_visible et_button_custom_icon')){
				jQuery("body").removeClass("et_button_icon_visible et_button_custom_icon");
			}
	}
});
/* Disable the DIVI icons only on the CartFlows Pages*/

==================================================================================================== 

/* Get User's License Key */
add_action( 'admin_head', function() {
    
    if( ! isset( $_GET['debug'] ) ) {
        return;
    }
    
    echo '<pre>';
    print_r( get_option( 'wc_am_client_cartflows_api_key' ) );
    echo "</pre>";

});
/* Get User's License Key */

==================================================================================================== 

a992b5a28386e564032c83fabd944bd6918665d1


.cartflows_step-template-default .clearfix{
	padding-top:0px !important;
}


.cartflows_step-template-default .single-post-media{
	display:none;
}

.cartflows_step-template-default .container{
	width:100%;
	padding:0px;
}

.wcf-embed-checkout-form .woocommerce-checkout .col2-set, 
.wcf-embed-checkout-form .woocommerce-checkout .wcf-col2-set{
	width:55% !important;
}

@media only screen and (max-width: 768px) {
	.wcf-embed-checkout-form .woocommerce-checkout .col2-set, 
	.wcf-embed-checkout-form .woocommerce-checkout .wcf-col2-set{
		width:100% !important;
	}	
}

==================================================================================================== 

/**
* Filter to change the Cron time which is set to auto-complete the order status.
*/
add_filter( 'cartflows_order_status_cron_time', 'is_wcf_set_cron_time' );

/*
* Function to return the cron time in minutes.
*/
function is_wcf_set_cron_time(){

    // Set your cron time in minutes.
    $updated_cron_time = "add_your_cron_time_in_minutes";
    
    // Return the cron time from the function.
    return $updated_cron_time;
}

==================================================================================================== 

/* Display the text on specific checkout pages  */
add_action( 'woocommerce_checkout_before_order_review', 'mi_add_text_after_your_order_heading' );

function mi_add_text_after_your_order_heading(){
	global $post;

	switch ( $post->ID ) {
		case 105: // Add your checkout page id on which you want to display the custom text
			$html_code = '
				<div class="hello">for first checkout page</div> 
			';
			break;
		
		case 396602: // Add your checkout page id on which you want to display the custom text
			$html_code = '
				<div class="hello">for Second checkout page</div>
			';
			break;

		default: // This will be displayd if the id is not matched.
			$html_code = '';
			break;
	}
	
	// Printing the HTML.
	echo $html_code;
}
/* Display the text on specific checkout pages  */

==================================================================================================== 

// add_filter('woocommerce_add_to_cart_redirect', 'nic_redirect_add_to_cart', 1);

function nic_redirect_add_to_cart( $url) {
	
	$redirect_to_page_url = $url;

	foreach ( WC()->cart->get_cart() as $key => $item ) {
		
		switch ($item['product_id']) {
			case 'add_your_product_id_here_for_which_you_want_to_redirect':
				$redirect_to_page_url = "add_your_page_URL_here";
				break;

			case 'add_your_product_id_here_for_which_you_want_to_redirect':
				$redirect_to_page_url = "add_your_page_URL_here";
				break;
			
			default:
				$redirect_to_page_url = $url;
				break;
		}
	}
	
    return $redirect_to_page_url;
}

// add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );


// add_filter( 'woocommerce_gateway_icon', 'remove_all_gateway_icons', 10, 2 );

function remove_all_gateway_icons( $icons, $id ){

	if( isset($icons) ){
		$icons = '';
	}
	return $icons;
}
	// wp_die();


// add_filter("woocommerce_cart_item_subtotal", "display_discount_price", 10, 3);
// function display_discount_price($product_price, $cart_item, $cart_item_key)
// {
//     $regular_price = wc_price( $cart_item['data']->get_regular_price() );
//     if( $product_price != $regular_price )
//     {
//     if(isset( $cart_item['cartflows_bump'] ) && 1 == $cart_item['cartflows_bump'])
//         {
//        $product_price = wc_format_sale_price( $cart_item['data']->get_regular_price(), $cart_item['custom_price'] );
//     }else{
//        $product_price = wc_format_sale_price( $cart_item['data']->get_regular_price(), $cart_item['data']->get_sale_price() );
//     }
//     }
//     return $product_price;
// }

// add_filter( 'cartflows_coupon_field_options', 'aa_change_coupon_field_texts' );

// function aa_change_coupon_field_texts( $coupon_field ){

// 	$coupon_field[ 'field_text' ] = __('Your Text', 'cartflows');
// 	$coupon_field[ 'button_text' ] = __('Your Text', 'cartflows');

// 	return $coupon_field;

// }

==================================================================================================== 



