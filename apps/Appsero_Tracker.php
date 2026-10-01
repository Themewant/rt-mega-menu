<?php
namespace RtMega\MegaMenu\Tracking;

use Appsero\Client;

if ( ! defined( 'ABSPATH' ) ) exit;

class Appsero_Tracker {

    private static $instance = null;
    private $client;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->includes();
        $this->init();
    }

    private function includes() {
        // The Composer autoloader in apps/vendor/autoload.php is required by the
        // main plugin file immediately before this class is loaded, so
        // \Appsero\Client resolves through it. There is no bundled fallback copy
        // to require -- a missing autoloader is a packaging fault, not something
        // to paper over here.
        if ( ! class_exists( '\\Appsero\\Client' ) ) {
            $autoload = RTMEGA_MENU_PL_PATH . 'apps/vendor/autoload.php';
            if ( file_exists( $autoload ) ) {
                require_once $autoload;
            }
        }
    }

    private function init() {

        // Appsero Client init
        $this->client = new Client(
            '1e51d718-e4b3-4fb7-bc97-7845f1f2d007',
            'RT Mega Menu',
            RTMEGA_MENU_PL_ROOT
        );

        $this->client->set_textdomain( 'rt-mega-menu' );

        $insights = $this->client->insights();

        $insights
            ->add_plugin_data()
            ->add_extra( $this->extra_data() )
            ->init();

        // Appsero's own opt-in gate covers the weekly send and the activation
        // send, but not its deactivation survey: submitting a reason posts the
        // full tracking payload -- site URL, admin email and name, user counts,
        // the active plugin list, server details and a freshly fetched public IP
        // -- with no consent check of its own. Unhook that path entirely unless
        // the site owner has actually opted in.
        if ( 'yes' !== get_option( $this->client->slug . '_allow_tracking', 'no' ) ) {
            remove_action( 'admin_footer', array( $insights, 'deactivate_scripts' ) );
            remove_action( 'wp_ajax_' . $this->client->slug . '_submit-uninstall-reason', array( $insights, 'uninstall_reason_submission' ) );
        }
    }

    private function extra_data() {
        return [
            'is_pro_active' => defined( 'RTMEGA_MENU_PRO_VERSION' ) ? 'Yes' : 'No',
            'pro_version'   => defined( 'RTMEGA_MENU_PRO_VERSION' ) ? RTMEGA_MENU_PRO_VERSION : '',
        ];
    }
}

// Appsero_Tracker::instance();
