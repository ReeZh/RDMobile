<?php
/**
 * RDMobile Options.
 *
 * @since   0.1.0
 * @package RDMobile
 */

require_once dirname( __FILE__ ) . '/../vendor/cmb2/init.php';

/**
 * RDMobile Options class.
 *
 * @since 0.1.0
 */
class RDM_Options {
	/**
	 * Parent plugin class.
	 *
	 * @var    RDMobile
	 * @since  0.1.0
	 */
	protected $plugin = null;

	/**
	 * Option key, and option page slug.
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected $key = 'rdmobile';

	/**
	 * Options page metabox ID.
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected $metabox_id = 'rdmobile_metabox';

	/**
	 * Options Page title.
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected $title = '';

	/**
	 * Options Page hook.
	 *
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor.
	 *
	 * @since  0.1.0
	 *
	 * @param  RDMobile $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		// Set our title.
		$this->title = esc_attr__( 'RD Mobile', 'rdmobile' );
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.1.0
	 */
	public function hooks() {

		// Hook in our actions to the admin.
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );

	}

	/**
	 * Register our setting to WP.
	 *
	 * @since  0.1.0
	 */
	public function admin_init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page.
	 *
	 * @since  0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page(
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'admin_page_display' ),
      'dashicons-admin-settings',
      3
		);

		$this->options_page = add_submenu_page(
      $this->key,
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'admin_page_display' )
		);

		// Include CMB CSS in the head to avoid FOUC.
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2.
	 *
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo esc_attr( $this->key ); ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add custom fields to the options page.
	 *
	 * @since  0.1.0
	 */
	public function add_options_page_metabox() {

		// Add our CMB2 metabox.
		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove.
				'key'   => 'options-page',
				'value' => array( $this->key ),
			),
		) );

		// Add your fields here.
		$cmb->add_field( array(
			'name'    => __( 'Country Code', 'rdmobile' ),
			'desc'    => __( 'Choose your country code', 'rdmobile' ),
			'id'      => 'rdm_countrycode', // No prefix needed.
			'type'    => 'select',
			'show_option_none' => false,
			'default' => __( '62', 'rdmobile' ),
			'options'	=> array(
				'93'		=> __( 'Afghanistan | 93', 'rdmobile' ),
				'355'		=> __( 'Albania | 355', 'rdmobile' ),
				'213'		=> __( 'Algeria | 213', 'rdmobile' ),
				'1-684'	=> __( 'American Samoa | 1-684', 'rdmobile' ),
				'376'		=> __( 'Andorra | 376', 'rdmobile' ),
				'244'		=> __( 'Angola | 244', 'rdmobile' ),
				'1-264'	=> __( 'Anguilla | 1-264', 'rdmobile' ),
				'672'		=> __( 'Antarctica | 672', 'rdmobile' ),
				'1-268'	=> __( 'Antigua and Barbuda | 1-268', 'rdmobile' ),
				'54'		=> __( 'Argentina | 54', 'rdmobile' ),
				'374'		=> __( 'Armenia | 374', 'rdmobile' ),
				'297'		=> __( 'Aruba | 297', 'rdmobile' ),
				'61'		=> __( 'Australia, Christmas Island, Cocos Islands | 61', 'rdmobile' ),
				'43'		=> __( 'Austria | 43', 'rdmobile' ),
				'994'		=> __( 'Azerbaijan | 994', 'rdmobile' ),
				'1-242'	=> __( 'Bahamas | 1-242', 'rdmobile' ),
				'973'		=> __( 'Bahrain | 973', 'rdmobile' ),
				'880'		=> __( 'Bangladesh | 880', 'rdmobile' ),
				'1-246'	=> __( 'Barbados | 1-246', 'rdmobile' ),
				'375'		=> __( 'Belarus | 375', 'rdmobile' ),
				'32'		=> __( 'Belgium | 32', 'rdmobile' ),
				'501'		=> __( 'Belize | 501', 'rdmobile' ),
				'229'		=> __( 'Benin | 229', 'rdmobile' ),
				'1-441'	=> __( 'Bermuda | 1-441', 'rdmobile' ),
				'975'		=> __( 'Bhutan | 975', 'rdmobile' ),
				'591'		=> __( 'Bolivia | 591', 'rdmobile' ),
				'387'		=> __( 'Bosnia and Herzegovina | 387', 'rdmobile' ),
				'267'		=> __( 'Botswana | 267', 'rdmobile' ),
				'55'		=> __( 'Brazil | 55', 'rdmobile' ),
				'246'		=> __( 'British Indian Ocean Territory | 246', 'rdmobile' ),
				'1-284'	=> __( 'British Virgin Islands | 1-284', 'rdmobile' ),
				'673'		=> __( 'Brunei | 673', 'rdmobile' ),
				'359'		=> __( 'Bulgaria | 359', 'rdmobile' ),
				'226'		=> __( 'Burkina Faso | 226', 'rdmobile' ),
				'257'		=> __( 'Burundi | 257', 'rdmobile' ),
				'855'		=> __( 'Cambodia | 855', 'rdmobile' ),
				'237'		=> __( 'Cameroon | 237', 'rdmobile' ),
				'1'			=> __( 'Canada | 1', 'rdmobile' ),
				'238'		=> __( 'Cape Verde | 238', 'rdmobile' ),
				'1-345'	=> __( 'Cayman Islands | 1-345', 'rdmobile' ),
				'236'		=> __( 'Central African Republic | 236', 'rdmobile' ),
				'235'		=> __( 'Chad | 235', 'rdmobile' ),
				'56'		=> __( 'Chile | 56', 'rdmobile' ),
				'86'		=> __( 'China | 86', 'rdmobile' ),
				'57'		=> __( 'Colombia | 57', 'rdmobile' ),
				'269'		=> __( 'Comoros | 269', 'rdmobile' ),
				'682'		=> __( 'Cook Islands | 682', 'rdmobile' ),
				'506'		=> __( 'Costa Rica | 506', 'rdmobile' ),
				'385'		=> __( 'Croatia | 385', 'rdmobile' ),
				'53'		=> __( 'Cuba | 53', 'rdmobile' ),
				'599'		=> __( 'Curacao | 599', 'rdmobile' ),
				'357'		=> __( 'Cyprus | 357', 'rdmobile' ),
				'420'		=> __( 'Czech Republic | 420', 'rdmobile' ),
				'243'		=> __( 'Democratic Republic of the Congo | 243', 'rdmobile' ),
				'45'		=> __( 'Denmark | 45', 'rdmobile' ),
				'253'		=> __( 'Djibouti | 253', 'rdmobile' ),
				'1-767'	=> __( 'Dominica | 1-767', 'rdmobile' ),
				'1-809' => __( 'Dominican Republic | 1-809', 'rdmobile' ),
				'1-829'	=> __( 'Dominican Republic | 1-829', 'rdmobile' ),
				'1-849'	=> __( 'Dominican Republic | 1-849', 'rdmobile' ),
				'670'		=> __( 'East Timor | 670', 'rdmobile' ),
				'593'		=> __( 'Ecuador | 593', 'rdmobile' ),
				'20'		=> __( 'Egypt | 20', 'rdmobile' ),
				'503'		=> __( 'El Salvador | 503', 'rdmobile' ),
				'240'		=> __( 'Equatorial Guinea | 240', 'rdmobile' ),
				'291'		=> __( 'Eritrea | 291', 'rdmobile' ),
				'372'		=> __( 'Estonia | 372', 'rdmobile' ),
				'251'		=> __( 'Ethiopia | 251', 'rdmobile' ),
				'500'		=> __( 'Falkland Islands | 500', 'rdmobile' ),
				'298'		=> __( 'Faroe Islands | 298', 'rdmobile' ),
				'679'		=> __( 'Fiji | 679', 'rdmobile' ),
				'358'		=> __( 'Finland | 358', 'rdmobile' ),
				'33'		=> __( 'France | 33', 'rdmobile' ),
				'689'		=> __( 'French Polynesia | 689', 'rdmobile' ),
				'241'		=> __( 'Gabon | 241', 'rdmobile' ),
				'220'		=> __( 'Gambia | 220', 'rdmobile' ),
				'995'		=> __( 'Georgia | 995', 'rdmobile' ),
				'49'		=> __( 'Germany | 49', 'rdmobile' ),
				'233'		=> __( 'Ghana | 233', 'rdmobile' ),
				'350'		=> __( 'Gibraltar | 350', 'rdmobile' ),
				'30'		=> __( 'Greece | 30', 'rdmobile' ),
				'299'		=> __( 'Greenland | 299', 'rdmobile' ),
				'1-473'	=> __( 'Grenada | 1-473', 'rdmobile' ),
				'1-671'	=> __( 'Guam | 1-671', 'rdmobile' ),
				'502'		=> __( 'Guatemala | 502', 'rdmobile' ),
				'44-1481'		=> __( 'Guernsey | 44-1481', 'rdmobile' ),
				'224'		=> __( 'Guinea | 224', 'rdmobile' ),
				'245'		=> __( 'Guinea-Bissau | 245', 'rdmobile' ),
				'592'		=> __( 'Guyana | 592', 'rdmobile' ),
				'509'		=> __( 'Haiti | 509', 'rdmobile' ),
				'504'		=> __( 'Honduras | 504', 'rdmobile' ),
				'852'		=> __( 'Hong Kong | 852', 'rdmobile' ),
				'36'		=> __( 'Hungary | 36', 'rdmobile' ),
				'354'		=> __( 'Iceland | 354', 'rdmobile' ),
				'91'		=> __( 'India | 91', 'rdmobile' ),
				'62'		=> __( 'Indonesia | 62', 'rdmobile' ),
				'98'		=> __( 'Iran | 98', 'rdmobile' ),
				'964'		=> __( 'Iraq | 964', 'rdmobile' ),
				'353'		=> __( 'Ireland | 353', 'rdmobile' ),
				'44-1624'		=> __( 'Isle of Man | 44-1624', 'rdmobile' ),
				'972'		=> __( 'Israel | 972', 'rdmobile' ),
				'39'		=> __( 'Italy | 39', 'rdmobile' ),
				'225'		=> __( 'Ivory Coast | 225', 'rdmobile' ),
				'1-876'	=> __( 'Jamaica | 1-876', 'rdmobile' ),
				'81'		=> __( 'Japan | 81', 'rdmobile' ),
				'44-1534'		=> __( 'Jersey | 44-1534', 'rdmobile' ),
				'962'		=> __( 'Jordan | 962', 'rdmobile' ),
				'7'			=> __( 'Kazakhstan | 7', 'rdmobile' ),
				'254'		=> __( 'Kenya | 254', 'rdmobile' ),
				'686'		=> __( 'Kiribati | 686', 'rdmobile' ),
				'383'		=> __( 'Kosovo | 383', 'rdmobile' ),
				'965'		=> __( 'Kuwait | 965', 'rdmobile' ),
				'996'		=> __( 'Kyrgyzstan | 996', 'rdmobile' ),
				'856'		=> __( 'Laos | 856', 'rdmobile' ),
				'371'		=> __( 'Latvia | 371', 'rdmobile' ),
				'961'		=> __( 'Lebanon | 961', 'rdmobile' ),
				'266'		=> __( 'Lesotho | 266', 'rdmobile' ),
				'231'		=> __( 'Liberia | 231', 'rdmobile' ),
				'218'		=> __( 'Libya | 218', 'rdmobile' ),
				'423'		=> __( 'Liechtenstein | 423', 'rdmobile' ),
				'370'		=> __( 'Lithuania | 370', 'rdmobile' ),
				'352'		=> __( 'Luxembourg | 352', 'rdmobile' ),
				'853'		=> __( 'Macau | 853', 'rdmobile' ),
				'389'		=> __( 'Macedonia | 389', 'rdmobile' ),
				'261'		=> __( 'Madagascar | 261', 'rdmobile' ),
				'265'		=> __( 'Malawi | 265', 'rdmobile' ),
				'60'		=> __( 'Malaysia | 60', 'rdmobile' ),
				'960'		=> __( 'Maldives | 960', 'rdmobile' ),
				'223'		=> __( 'Mali | 223', 'rdmobile' ),
				'356'		=> __( 'Malta | 356', 'rdmobile' ),
				'692'		=> __( 'Marshall Islands | 692', 'rdmobile' ),
				'222'		=> __( 'Mauritania | 222', 'rdmobile' ),
				'230'		=> __( 'Mauritius | 230', 'rdmobile' ),
				'262'		=> __( 'Mayotte | 262', 'rdmobile' ),
				'52'		=> __( 'Mexico | 52', 'rdmobile' ),
				'691'		=> __( 'Micronesia | 691', 'rdmobile' ),
				'373'		=> __( 'Moldova | 373', 'rdmobile' ),
				'377'		=> __( 'Monaco | 377', 'rdmobile' ),
				'976'		=> __( 'Mongolia | 976', 'rdmobile' ),
				'382'		=> __( 'Montenegro | 382', 'rdmobile' ),
				'1-664'	=> __( 'Montserrat | 1-664', 'rdmobile' ),
				'212'		=> __( 'Morocco | 212', 'rdmobile' ),
				'258'		=> __( 'Mozambique | 258', 'rdmobile' ),
				'95'		=> __( 'Myanmar | 95', 'rdmobile' ),
				'264'		=> __( 'Namibia | 264', 'rdmobile' ),
				'674'		=> __( 'Nauru | 674', 'rdmobile' ),
				'977'		=> __( 'Nepal | 977', 'rdmobile' ),
				'31'		=> __( 'Netherlands | 31', 'rdmobile' ),
				'599'		=> __( 'Netherlands Antilles | 599', 'rdmobile' ),
				'687'		=> __( 'New Caledonia | 687', 'rdmobile' ),
				'64'		=> __( 'New Zealand | 64', 'rdmobile' ),
				'505'		=> __( 'Nicaragua | 505', 'rdmobile' ),
				'227'		=> __( 'Niger | 227', 'rdmobile' ),
				'234'		=> __( 'Nigeria | 234', 'rdmobile' ),
				'683'		=> __( 'Niue | 683', 'rdmobile' ),
				'850'		=> __( 'North Korea | 850', 'rdmobile' ),
				'1-670'	=> __( 'Northern Mariana Islands | 1-670', 'rdmobile' ),
				'47'		=> __( 'Norway | 47', 'rdmobile' ),
				'968'		=> __( 'Oman | 968', 'rdmobile' ),
				'92'		=> __( 'Pakistan | 92', 'rdmobile' ),
				'680'		=> __( 'Palau | 680', 'rdmobile' ),
				'970'		=> __( 'Palestine | 970', 'rdmobile' ),
				'507'		=> __( 'Panama | 507', 'rdmobile' ),
				'675'		=> __( 'Papua New Guinea | 675', 'rdmobile' ),
				'595'		=> __( 'Paraguay | 595', 'rdmobile' ),
				'51'		=> __( 'Peru | 51', 'rdmobile' ),
				'63'		=> __( 'Philippines | 63', 'rdmobile' ),
				'64'		=> __( 'Pitcairn | 64', 'rdmobile' ),
				'48'		=> __( 'Poland | 48', 'rdmobile' ),
				'351'		=> __( 'Portugal | 351', 'rdmobile' ),
				'1-787' => __( 'Puerto Rico | 1-787', 'rdmobile' ),
				'1-939' => __( 'Puerto Rico | 1-939', 'rdmobile' ),
				'974'		=> __( 'Qatar | 974', 'rdmobile' ),
				'242'		=> __( 'Republic of the Congo | 242', 'rdmobile' ),
				'262'		=> __( 'Reunion | 262', 'rdmobile' ),
				'40'		=> __( 'Romania | 40', 'rdmobile' ),
				'7'			=> __( 'Russia | 7', 'rdmobile' ),
				'250'		=> __( 'Rwanda | 250', 'rdmobile' ),
				'590'		=> __( 'Saint Barthelemy | 590', 'rdmobile' ),
				'290'		=> __( 'Saint Helena | 290', 'rdmobile' ),
				'1-869'	=> __( 'Saint Kitts and Nevis | 1-869', 'rdmobile' ),
				'1-758'	=> __( 'Saint Lucia | 1-758', 'rdmobile' ),
				'590'		=> __( 'Saint Martin | 590', 'rdmobile' ),
				'508'		=> __( 'Saint Pierre and Miquelon | 508', 'rdmobile' ),
				'1-784'	=> __( 'Saint Vincent and the Grenadines | 1-784', 'rdmobile' ),
				'685'		=> __( 'Samoa | 685', 'rdmobile' ),
				'378'		=> __( 'San Marino | 378', 'rdmobile' ),
				'239'		=> __( 'Sao Tome and Principe | 239', 'rdmobile' ),
				'966'		=> __( 'Saudi Arabia | 966', 'rdmobile' ),
				'221'		=> __( 'Senegal | 221', 'rdmobile' ),
				'381'		=> __( 'Serbia | 381', 'rdmobile' ),
				'248'		=> __( 'Seychelles | 248', 'rdmobile' ),
				'232'		=> __( 'Sierra Leone | 232', 'rdmobile' ),
				'65'		=> __( 'Singapore | 65', 'rdmobile' ),
				'1-721'	=> __( 'Sint Maarten | 1-721', 'rdmobile' ),
				'421'		=> __( 'Slovakia | 421', 'rdmobile' ),
				'386'		=> __( 'Slovenia | 386', 'rdmobile' ),
				'677'		=> __( 'Solomon Islands | 677', 'rdmobile' ),
				'252'		=> __( 'Somalia | 252', 'rdmobile' ),
				'27'		=> __( 'South Africa | 27', 'rdmobile' ),
				'82'		=> __( 'South Korea | 82', 'rdmobile' ),
				'211'		=> __( 'South Sudan | 211', 'rdmobile' ),
				'34'		=> __( 'Spain | 34', 'rdmobile' ),
				'94'		=> __( 'Sri Lanka | 94', 'rdmobile' ),
				'249'		=> __( 'Sudan | 249', 'rdmobile' ),
				'597'		=> __( 'Suriname | 597', 'rdmobile' ),
				'47'		=> __( 'Svalbard and Jan Mayen | 47', 'rdmobile' ),
				'268'		=> __( 'Swaziland | 268', 'rdmobile' ),
				'46'		=> __( 'Sweden | 46', 'rdmobile' ),
				'41'		=> __( 'Switzerland | 41', 'rdmobile' ),
				'963'		=> __( 'Syria | 963', 'rdmobile' ),
				'886'		=> __( 'Taiwan | 886', 'rdmobile' ),
				'992'		=> __( 'Tajikistan | 992', 'rdmobile' ),
				'255'		=> __( 'Tanzania | 255', 'rdmobile' ),
				'66'		=> __( 'Thailand | 66', 'rdmobile' ),
				'228'		=> __( 'Togo | 228', 'rdmobile' ),
				'690'		=> __( 'Tokelau | 690', 'rdmobile' ),
				'676'		=> __( 'Tonga | 676', 'rdmobile' ),
				'1-868'	=> __( 'Trinidad and Tobago | 1-868', 'rdmobile' ),
				'216'		=> __( 'Tunisia | 216', 'rdmobile' ),
				'90'		=> __( 'Turkey | 90', 'rdmobile' ),
				'993'		=> __( 'Turkmenistan | 993', 'rdmobile' ),
				'1-649'	=> __( 'Turks and Caicos Islands | 1-649', 'rdmobile' ),
				'688'		=> __( 'Tuvalu | 688', 'rdmobile' ),
				'1-340'	=> __( 'U.S. Virgin Islands | 1-340', 'rdmobile' ),
				'256'		=> __( 'Uganda | 256', 'rdmobile' ),
				'380'		=> __( 'Ukraine | 380', 'rdmobile' ),
				'971'		=> __( 'United Arab Emirates | 971', 'rdmobile' ),
				'44'		=> __( 'United Kingdom | 44', 'rdmobile' ),
				'1'			=> __( 'United States | 1', 'rdmobile' ),
				'598'		=> __( 'Uruguay | 598', 'rdmobile' ),
				'998'		=> __( 'Uzbekistan | 998', 'rdmobile' ),
				'678'		=> __( 'Vanuatu | 678', 'rdmobile' ),
				'379'		=> __( 'Vatican | 379', 'rdmobile' ),
				'58'		=> __( 'Venezuela | 58', 'rdmobile' ),
				'84'		=> __( 'Vietnam | 84', 'rdmobile' ),
				'681'		=> __( 'Wallis and Futuna | 681', 'rdmobile' ),
				'212'		=> __( 'Western Sahara | 212', 'rdmobile' ),
				'967'		=> __( 'Yemen | 967', 'rdmobile' ),
				'260'		=> __( 'Zambia | 260', 'rdmobile' ),
				'263' 	=> __( 'Zimbabwe | 263', 'rdmobile' ),
			),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Phone Number', 'rdmobile' ),
			'desc'    => __( 'Add your phone / mobile number', 'rdmobile' ),
			'id'      => 'rdm_phone', // No prefix needed.
			'type'    => 'text',
			'default' => __( '082127602518', 'rdmobile' ),
		) );

		// Add your fields here.
		$cmb->add_field( array(
			'name'    => __( 'WhatsApp Number', 'rdmobile' ),
			'desc'    => __( 'Add your whatsapp number', 'rdmobile' ),
			'id'      => 'rdm_whatsapp', // No prefix needed.
			'type'    => 'text',
			'default' => __( '082127602518', 'rdmobile' ),
		) );

		// Add your fields here.
		$cmb->add_field( array(
			'name'    => __( 'WhatsApp Message', 'rdmobile' ),
			'desc'    => __( 'Add your message for whatsapp', 'rdmobile' ),
			'id'      => 'rdm_whatsapp_msg', // No prefix needed.
			'type'    => 'text',
			'default' => __( 'Hello World', 'rdmobile' ),
		) );

		// Add your fields here.
		$cmb->add_field( array(
			'name'    => __( 'Display Position', 'rdmobile' ),
			'desc'    => __( 'Set display position', 'rdmobile' ),
			'id'      => 'rdm_position', // No prefix needed.
			'type'    => 'select',
			'show_option_none' => false,
			'default' => 'bottomfull',
			'options'	=> array(
				'bottom'				=> __( 'Bottom', 'rdmobile' ),
				'bottomfull'		=> __( 'Bottom Full', 'rdmobile' ),
				'left'					=> __( 'Left', 'rdmobile' ),
				'right'					=> __( 'Right', 'rdmobile' ),
				'bottomleft'		=> __( 'Bottom Left', 'rdmobile' ),
				'bottomright'		=> __( 'Bottom Right', 'rdmobile' ),
				),
		) );

		// Add your fields here.
		$cmb->add_field( array(
			'name'    => __( 'Display Icon', 'rdmobile' ),
			'desc'    => __( 'Set display icon and text', 'rdmobile' ),
			'id'      => 'rdm_icon', // No prefix needed.
			'type'    => 'select',
			'show_option_none' => false,
			'default' => 'icon',
			'options'	=> array(
				'icon'			=> __( 'Icon Only', 'rdmobile' ),
				'icontext'	=> __( 'Icon Text', 'rdmobile' ),
			),
		) );

	}

	/**
	 * Wrapper function around cmb2_get_option
	 * @since  0.1.0
	 * @param  string $key     Options array key
	 * @param  mixed  $default Optional default value
	 * @return mixed           Option value
	 */
	public function rdm_get_option( $key = '', $default = false ) {
		if ( function_exists( 'cmb2_get_option' ) ) {
			// Use cmb2_get_option as it passes through some key filters.
			return cmb2_get_option( $this->metabox_id , $key, $default );
		}
		// Fallback to get_site_option if CMB2 is not loaded yet.
		$opts = get_site_option( $this->metabox_id , $default );
		$val = $default;
		if ( 'all' == $key ) {
			$val = $opts;
		} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
			$val = $opts[ $key ];
		}
		return $val;
	}

}
