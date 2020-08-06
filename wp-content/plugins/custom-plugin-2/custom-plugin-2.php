<?php
/**
 * @package custom-plugin-2
 * @version 1.7.2
 */
/*
Plugin Name: custom-plugin-2
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Utkarsh Saxena
Version: 1.7.2
Author URI: http://ma.tt/
*/

add_action('woocommerce_product_options_general_product_data',function(){
    woocommerce_wp_text_input(
        array(
          'id'          => '_custom_product_text_field',
          'label'       => __( 'My Text Field', 'woocommerce' ),
          'placeholder' => 'Enter unique key',
          'desc_tip'    => 'true'
        )
      );

});

add_action( 'woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save' );

function woocommerce_product_custom_fields_save($post_id){
    // Custom Product Text Field
    $woocommerce_custom_product_text_field = $_POST['_custom_product_text_field'];
    if (!empty($woocommerce_custom_product_text_field))
        update_post_meta($post_id, '_custom_product_text_field', esc_attr($woocommerce_custom_product_text_field));



}

add_action( 'woocommerce_after_add_to_cart_form', 'content_after_addtocart_button' );  // one more action hook can be used named 'woocommerce_single_product_summary'.
// to add any custom text before the add to cart button use 'woocommerce_short_description' action hook. 
// woocommerce_after_add_to_cart_button
// woocommerce_before_add_to_cart_button
// woocommerce_before_add_to_cart_form
function content_after_addtocart_button(){
    //echo '</br>';

    
    
    
    //echo "I AM HERE";
   
    
    
   echo '<strong>Unique id:</strong>';
   echo get_post_meta(get_the_ID(), '_custom_product_text_field', true);
    

}

 add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
 function woo_new_product_tab( $tabs ) {
	
 	// Adds the new tab
	
	$tabs['test_tab'] = array(
		'title' 	=> __( 'Additional information', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_new_product_tab_content'
    );
    
    //print_r($tabs);

    return $tabs;
    
   

}
function woo_new_product_tab_content() {

	// The new tab content

	echo '<h2>New Product Tab</h2>';
    echo '<p>Here\'s your new product tab.</p>';
    echo get_post_meta(get_the_ID(), '_custom_product_text_field', true);

    global $product;
    $pro = $product;
    //$name = $product->get_name();
    echo '<pre>';
    //echo $name;
    print_r($pro);
     //print_r($pro['data']);
    echo '</pre>';
	
}

// add_action('woocommerce_product_after_tabs',function(){

//     echo "YES I AM HERE";
// });


//add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
//function woo_custom_description_tab( $tabs ) {

	//$tabs['description']['callback'] = 'woo_custom_description_tab_content';	// Custom description callback

    //return $tabs;
    //echo '<pre>';
   // print_r($tabs);
    //echo '</pre>';
//}

// function woo_custom_description_tab_content() {
// 	echo '<h2>Custom Description</h2>';
// 	echo '<p>Here\'s a custom description</p>';
// }

//function iconic_display_engraving_text_cart( $item_data, $cart_item ) {

   // $data = get_post_meta(get_the_ID(), '_custom_product_text_field', true);

    // if ( empty( $cart_item['iconic-engraving'] ) ) {


    //     return $item_data;


    // }

 


    //$item_data[] = array(


        //'key'     => __( 'Engraving', 'iconic' ),


        //'value'   => ,


        //'display' => '',


    //);

 


    //return $item_data;

    //print_r($item_data);

//}

 


//add_filter( 'woocommerce_get_item_data', 'iconic_display_engraving_text_cart', 10, 2 );

add_action('woocommerce_before_cart', function(){

    //$woo = WC();
    echo '<pre>';
    //print_r($woo);
    

    echo '</pre>';

     //$cart = WC()->cart->get_cart();
    // //$=$cart['data'];
    // foreach($cart as $cart_item_key => $cart_item){
    //     $product = $cart_item['data'];
    //     //$price = WC()->cart->get_product_price( $product );
    //     echo '<pre>';
    //     //print_r($cart_item['data']);
    //     //echo $price;
    //     //print_r($product);
    //     $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
    //     echo $subtotal;
    //     echo '</pre>';
    // }
    // //echo $cart->get_customer();
     //echo '<pre>';
     //print_r($cart);
     //echo '</pre>';
});

function skyverge_shop_display_skus() {

	global $product;
	
	if ( $product->get_type() ) {
		echo '<div class="product-meta">SKU: ' . $product->get_type() . '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'skyverge_shop_display_skus', 9 );

