<?php
/**
 * RDMobile Backend
 *
 * @since 0.1.0
 * @package RDMobile
 */

/**
 * RDMobile Backend.
 *
 * @since 0.1.0
 */
class RDM_Backend {
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
      add_action( 'wp_before_admin_bar_render', array( $this, 'rdm_remove_admin_bar_links' ) );
    }

  public function rdm_remove_admin_bar_links() {
    global $wp_admin_bar, $current_user;
    if ($current_user->ID != 1) {
      $wp_admin_bar->remove_menu('wp-logo');
      $wp_admin_bar->remove_menu('updates');          // Remove the updates link
      // $wp_admin_bar->remove_menu('comments');         // Remove the comments link
      // $wp_admin_bar->remove_menu('new-content');      // Remove the content link
      // $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
      // $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
    }
  }
  // add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

}
