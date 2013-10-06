<?php
/**
 * developer: Reydel Leon
 * company: rideIT
 * Date: 10/2/13
 */

include_once('synved-options/synved-options.php');

/*
namespace: "flex-",             //{NEW} String: Prefix string attached to the class of every element generated by the plugin
selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
animation: "fade",              //String: Select your animation type, "fade" or "slide"
easing: "swing",                //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
reverse: false,                 //{NEW} Boolean: Reverse the animation direction
animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
slideshow: true,                //Boolean: Animate slider automatically
slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
randomize: false,               //Boolean: Randomize slide order
thumbCaptions: false,           //Boolean: Whether or not to put captions on thumbnails when using the "thumbnails" controlNav.

// Usability features
pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
pauseInvisible: true,   		//{NEW} Boolean: Pause the slideshow when tab is invisible, resume when visible. Provides better UX, lower CPU usage.
useCSS: true,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
video: false,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches

// Primary Controls
controlNav: true,               //Boolean: Create navigation for paging control of each slide? Note: Leave true for manualControls usage
directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
prevText: "Previous",           //String: Set the text for the "previous" directionNav item
nextText: "Next",               //String: Set the text for the "next" directionNav item

// Secondary Navigation
keyboard: true,                 //Boolean: Allow slider navigating via keyboard left/right keys
multipleKeyboard: false,        //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
mousewheel: false,              //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
pausePlay: false,               //Boolean: Create pause/play dynamic element
pauseText: "Pause",             //String: Set the text for the "pause" pausePlay item
playText: "Play",               //String: Set the text for the "play" pausePlay item

// Special properties
controlsContainer: "",          //{UPDATED} jQuery Object/Selector: Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be $(".flexslider-container"). Property is ignored if given element is not found.
manualControls: "",             //{UPDATED} jQuery Object/Selector: Declare custom control navigation. Examples would be $(".flex-control-nav li") or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
sync: "",                       //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
asNavFor: "",                   //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider

// Carousel Options
itemWidth: 0,                   //{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
itemMargin: 0,                  //{NEW} Integer: Margin between carousel items.
minItems: 1,                    //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
maxItems: 0,                    //{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
move: 0,                        //{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.
allowOneSlide: true,           //{NEW} Boolean: Whether or not to allow a slider comprised of a single slide

// Callback API
start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
end: function(){},              //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
added: function(){},            //{NEW} Callback: function(slider) - Fires after a slide is added
removed: function(){}           //{NEW} Callback: function(slider) - Fires after a slide is removed
*/

$rwps_options = array(
    'page_appearance' => array(
        'type' => 'options-page',
        'label' => __('WooPruducts Showcase', 'wooproducts_showcase'),
        'parent' => 'settings',
        'role' => 'manage_options',
        'sections' => array(
            'section_anim' => array(
                'type' => 'options-section',
                'label' => __('Animation', 'my-test'),
                'tip' => __('Animation settings', 'my-test'),
                'settings' => array(
                    'animation' => array(
                        'default' => 'fade',
                        'label' => __('Animation', 'my-test')
                    ),
                    'pauseOnHover' => array(
                        'default' => true,
                        'label' => __('Pause on Hover', 'my-test')
                    ),
                    'move' => array(
                        'default' => 0,
                        'label' => __('Number of slides to move', 'my-test')
                    ),
                )
            ),
            'section_nav' => array(
                'type' => 'options-section',
                'label' => __('Navigation', 'my-test'),
                'tip' => __('Navigation settings', 'my-test'),
                'settings' => array(
                    'controlNav' => array(
                        'default' => false,
                        'label' => __('Show Navigation Controls', 'my-test')
                    ),
                    'prevText' => array(
                        'default' => "Previous",
                        'tip' => "Leave blank if you don't want to show any text",
                        'label' => __('Text For Left Navigation Control', 'my-test')
                    ),
                    'nextText' => array(
                        'default' => "Next",
                        'tip' => "Leave blank if you don't want to show any text",
                        'label' => __('Text For Left Navigation Control', 'my-test')
                    ),
                )
            ),
            'section_behav' => array(
                'type' => 'options-section',
                'label' => __('Behaviour', 'my-test'),
                'tip' => __('Behaviour settings', 'my-test'),
                'settings' => array(
                    'minItems' => array(
                        'default' => 1,
                        'label' => __('Minimum Visible Products', 'my-test')
                    ),
                    'maxItems' => array(
                        'default' => 3,
                        'label' => __('Maximum Visible Products', 'my-test')
                    ),
                    'itemMargin' => array(
                        'default' => 3,
                        'label' => __('Margin Betwen Items', 'my-test')
                    ),
                    'itemWidth' => array(
                        'default' =>  300,
                        'label' => __('Width of individual carousel items', 'my-test')
                    )
                )
            )
        )
    )
);

synved_option_register('wooproduct_Showcase', $rwps_options);

class WooProductsShowcaseOptions
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
//        add_action( 'admin_init', array( $this, 'page_init' ) );
//        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {

        add_menu_page( 'WooProducts Showcase', 'WooProducts Showcase', 'manage_options', 'woo-products-showcase-menu', array( $this, 'create_admin_page' ) );
        add_submenu_page( 'woo-products-showcase-menu', 'Settings', 'Settings', 'manage_options', 'woo-products-showcase-settings', array( $this, 'create_admin_page' ) );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'rwps_options' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>WooProducts Showcase Settings</h2>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'rwps_options' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'rwps_options', // Option group
            'rwps_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'rwsp_section_main', // ID
            'Main Settings', // Title
            array( $this, 'print_section_main_info' ), // Callback
            'my-setting-admin' // Page
        );

        add_settings_field(
            'minItems', // ID
            'Minimum Visible Items', // Title
            array( $this, 'id_number_callback' ), // Callback
            'my-setting-admin', // Page
            'rwsp_section_main' // Section
        );

        add_settings_field(
            'maxItems',
            'Maximum Visible Items',
            array( $this, 'is_number_callback' ),
            'my-setting-admin',
            'rwsp_section_main'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        if( !is_numeric( $input['id_number'] ) )
            $input['id_number'] = '';

        if( !empty( $input['title'] ) )
            $input['title'] = sanitize_text_field( $input['title'] );

        return $input;
    }

    /**
     * Print the Section text
     */
    public function print_section_main_info()
    {
        print 'Enter your settings below';
    }
}

if( is_admin() )
    $my_settings_page = new WooProductsShowcaseOptions();
?>