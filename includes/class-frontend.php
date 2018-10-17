<?php
/**
 * RDMobile Frontend
 *
 * @since 0.1.0
 * @package RDMobile
 */

/**
 * RDMobile Frontend.
 *
 * @since 0.1.0
 */

class RDM_Frontend {
    /**
     * Parent plugin class
     *
     * @var   RDMobile
     * @since 0.1.0
     */
    protected $plugin = null;

    /**
     * Constructor
     *
     * @since  0.1.0
     * @param  RDMobile $plugin Main plugin object.
     * @return void
     */
    public function __construct( $plugin ) {
        $this->plugin = $plugin;
        $this->hooks();
    }

    /**
     * Initiate our hooks
     *
     * @since  0.1.0
     * @return void
     */
    public function hooks() {
			add_action( 'wp_enqueue_scripts', array( $this, 'rdmobile_load_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'rdmobile_load_styles' ) );
			add_action( 'wp_footer', array( $this, 'rdmobile_display' ) );
    }

    public function rdmobile_load_scripts($hook) {
			// if ( !is_admin() ) :
      wp_register_script( 'rdmjs', plugins_url( 'rdmobile/assets/js/rdm.min.js' ) );
      wp_enqueue_script('rdmjs');
			// endif;
    }

    public function rdmobile_load_styles($hook) {
			// if ( !is_admin() ) :
      wp_register_style( 'rdmcss', plugins_url( 'rdmobile/assets/css/rdm.min.css' ) );
      wp_enqueue_style('rdmcss');
			// endif;
    }

		public function rdm_get_option( $key = '', $default = false ) {
			if ( function_exists( 'cmb2_get_option' ) ) {
				// Use cmb2_get_option as it passes through some key filters.
				return cmb2_get_option( 'rdmobile', $key, $default );
			}

			// Fallback to get_option if CMB2 is not loaded yet.
			$opts = get_option( 'rdm_main_options', $default );

			$val = $default;

			if ( 'all' == $key ) {
				$val = $opts;
			} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
				$val = $opts[ $key ];
			}

			return $val;
		}

		public function rdmobile_display() {
			$countrycode = $this->rdm_get_option( 'rdm_countrycode', '62' );
			$phone = $this->rdm_get_option( 'rdm_phone', '082127602518' );
			$whatsapp = $this->rdm_get_option( 'rdm_whatsapp', '082127602518' );
			$whatsapp_msg = $this->rdm_get_option( 'rdm_whatsapp_msg', 'Hello World' );
			$position = $this->rdm_get_option( 'rdm_position', 'bottom' );
			$icon = $this->rdm_get_option( 'rdm_icon', 'icon' );

			echo '<div id="rdmobile" class="' . esc_html( $icon ) . ' ' . esc_html( $position ) . '">';
			echo '<ul>';
			echo '<li class="rdm_phone">';
			echo '<a href="tel:' . esc_html( $countrycode . ltrim( $phone, "0" ) ) . '">';
			echo '<i class="fa fa-phone"></i>';
			echo '<span>' . __( 'Call Us','rdmobile' ) . '</span>';
			echo '</li>';
			echo '<li class="rdm_whatsapp">';
			if ( '' !== $whatsapp_msg ) :
			echo '<a href="https://wa.me/' . esc_html( $countrycode . ltrim( $whatsapp, "0" ) . '?text=' . $whatsapp_msg ) . '" target="blank" rel="noopener">';
			else :
			echo '<a href="https://wa.me/' . esc_html( $countrycode . ltrim( $whatsapp, "0" ) ) . '" target="blank" rel="noopener">';
			endif;
			echo '<i class="fa fa-whatsapp"></i>';
			echo '<span>' . __( 'Chat Us', 'rdmobile' ) . '</span>';
			echo '</li>';
			echo '</ul>';
			echo '</div>';
		}

}
