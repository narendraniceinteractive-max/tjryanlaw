<?php

use App\Providers\ThemeServiceProvider;
use Roots\Acorn\Application;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

Application::configure()
    ->withProviders([
        ThemeServiceProvider::class,
    ])
    ->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });








collect(['setup', 'filters', 'post-types', 'widget-cta-shortcodes', 'get-related-cpt'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

if (file_exists($acfInit = locate_template('app/acf/init.php'))) {
    require $acfInit;
}



add_filter('gform_disable_css', function () {
    return true;
});




 
/** CTA Shortcode */
 
function page_cta_box($atts) {
    $atts = shortcode_atts(array(
        'title' => 'The Facts Behind Today’s',
        'title_part' => 'Reverse Mortgage',
        'sub_title' => 'Start Your Reverse Mortgage Evaluation',
        'button_text' => '',
        'button_link' => 'http://reverseyourthink.local/contact/',
        'phone_title' => 'call us today',
        'phone_number' => '310-447-5266',
        'phone_text' => '',
        'background' => '#ffffff',
        'title_color' => '#25202D',
        'title_part_color' => '#68B0F2',
        'sub_title_color' => '#000000',
        'button_color' => '#5691C7',
        'button_text_color' => '#ffffff',
        'phone_color' => '#000000',
    ), $atts, 'cta_block');
 
    // Clean the phone number for tel: link
    $clean_phone = preg_replace('/[^0-9]/', '', $atts['phone_number']);
 
    ob_start();
    ?>
    <div class="cmn-box" style="background-color: <?php echo esc_attr($atts['background']); ?>;">
        <h2 style="color: <?php echo esc_attr($atts['title_color']); ?>;"> <?php echo esc_html($atts['title']); ?> <strong style="color: <?php echo esc_attr($atts['title_part_color']); ?>;"> <?php echo esc_html($atts['title_part']); ?> </strong> </h2>
        <p style="color: <?php echo esc_attr($atts['sub_title_color']); ?>;"><?php echo esc_html($atts['sub_title']); ?></p>
        <div class="cmn-box-cnslt-btn">
            <div class="cnslt-btn">
                <a href="<?php echo esc_url($atts['button_link']); ?>" class="cmn-btn" style="background-color: <?php echo esc_attr($atts['button_color']); ?>; color: <?php echo esc_attr($atts['button_text_color']); ?>;">
                    <?php echo esc_html($atts['button_text']); ?>
                </a>
            </div>
            <div class="cnslt-call">
                <p><?php echo esc_html($atts['phone_title']); ?></p>
                <a href="tel:<?php echo esc_attr($clean_phone); ?>" style="color: <?php echo esc_attr($atts['phone_color']); ?>;">
                    <?php echo esc_html($atts['phone_number']); ?>
                </a>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('cta_block', 'page_cta_box');
 
/**
 * CTA Shortcode Meta Box
 */
function add_cta_shortcode_meta_box() {
    add_meta_box('cta_shortcode_box', 'CTA Shortcode', 'display_cta_shortcode_meta_box', 'page', 'side', 'high');
}
add_action('add_meta_boxes', 'add_cta_shortcode_meta_box');
 
function display_cta_shortcode_meta_box($post) {
    $shortcode = '[cta_block title="The Facts Behind Today’s" title_part="Reverse Mortgage" sub_title="Start Your Reverse Mortgage Evaluation" button_text="schedule a consultation" button_link="http://reverseyourthink.local/contact/" phone_text="call us today" phone_number="310-447-5266" border_color="1px solid #5691C7" background="#fffff" title_color="#25202D" title_part_color="#68B0F2" sub_title_color="#000000" button_color="#5691C7" button_text_color="#FFFFFF" phone_color="#000000"]';
   
    echo '<textarea readonly style="width:100%; height:150px;" onclick="this.select();">' . esc_textarea($shortcode) . '</textarea>';
    echo '<p style="font-size: 12px;">Copy this shortcode and paste it where you want the CTA block to appear. You can also modify the colors directly in the shortcode.</p>';
}
 
 
/** Second CTA Shortcode */
function second_cta_box($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Where Great Ideas Find',
        'sub_title' => '',
        'button_text' => 'Schedule a Free Discovery Call',
        'button_link' => 'https://rizemedia.net/demo-theme/contact/',
        'phone_number' => '',
        'phone_text' => ' ',
        'image_link'=> 'http://reverseyourthinking.local/wp-content/uploads/2026/09/scnd-cta-attrny-img.webp',
        'phone_title_color' => '#ffffff',
        'title_color' => '#ffffff',
        'sub_title_color' => '#ffffff',
        'button_color' => '#e91d8b',
        'button_text_color' => '#ffffff',
        'phone_color' => '#e91d8b',
            ), $atts, 'cta_block_two');
    $clean_phone = preg_replace('/[^0-9]/', '', $atts['phone_number']);
    ob_start();
    ?>
    <div class="inn-cmn-blk scnd-cmnblk" >
        <div class="left-cont">
             <h2 style="color: <?php echo esc_attr($atts['title_color']); ?>;"> <?php echo esc_html($atts['title']); ?></h2>
            <div class="inn-schdl-btn">
                <a href="<?php echo esc_url($atts['button_link']); ?>" class="cmn-btn" style="background-color: <?php echo esc_attr($atts['button_color']); ?>; color: <?php echo esc_attr($atts['button_text_color']); ?>;">
                    <?php echo esc_html($atts['button_text']); ?>
                </a>
            </div>
        </div>
        <div class="rght-attrny-image">
            <img src="<?php echo esc_url($atts['image_link']); ?>" alt="attrny-image" width="358" height="400">
        </div>
 
    </div>
    <?php
    return ob_get_clean();
}
 
add_shortcode('cta_block_two', 'second_cta_box');
 
function add_second_cta_shortcode_meta_box() {
 
    add_meta_box('second_cta_shortcode_box', 'Second CTA Shortcode', 'display_second_cta_shortcode_meta_box', 'page', 'side', 'high');
}
 
add_action('add_meta_boxes', 'add_second_cta_shortcode_meta_box');
 
function display_second_cta_shortcode_meta_box($post) {
    $shortcode = '[cta_block_two title="A Smarter Way to Use Your Home Equity" button_text="schedule a consultation" button_link="http://reverseyourthink.local/contact/"       title_color="#ffffff" image_link="http://reverseyourthinking.local/wp-content/uploads/2026/09/scnd-cta-attrny-img.webp" sub_title_color="#ffffff" button_color="#233E56" button_text_color="#ffffff" ]';
    echo '<textarea readonly style="width:100%; height:150px;" onclick="this.select();">' . esc_textarea($shortcode) . '</textarea>';
    echo '<p style="font-size: 12px;">Copy this shortcode and paste it where you want the CTA block to appear. You can also modify the colors directly in the shortcode.</p>';
}