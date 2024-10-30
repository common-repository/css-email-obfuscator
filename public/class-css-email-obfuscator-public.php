<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://blog.kastner.wtf/
 * @since      1.0.0
 *
 * @package    Css_Email_Obfuscator
 * @subpackage Css_Email_Obfuscator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Css_Email_Obfuscator
 * @subpackage Css_Email_Obfuscator/public
 * @author     Cedric Kastner <cedric@kastner.wtf>
 */
class Css_Email_Obfuscator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Shortcode default attributes
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array     $shortcode_default_atts    Shortcode default attributes
	 */
	private $shortcode_default_atts;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    string    $plugin_name       The name of the plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->shortcode_default_atts = array(
			'mailto' => false,
			'email'  => false
		);

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Css_Email_Obfuscator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Css_Email_Obfuscator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/css-email-obfuscator-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Css_Email_Obfuscator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Css_Email_Obfuscator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/css-email-obfuscator-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Shortcode callback function
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    string    $atts       Attributes within start tag
	 * @param    string    $content    Content endclosed by start and end tag
	 * @return   string    $content    Replaced shortcode string
	 */
	public function css_email_obfuscator( $atts, $content = null ) {

		if ( $content ) {

			$atts = shortcode_atts( $this->shortcode_default_atts, $atts );
			$atts['mailto'] = $this->shortcode_att_bool( $atts['mailto'] );

			if ($atts['mailto'] === true ) {

				$html = '<a href="%2$s" class="css-email-obfuscator">%1$s</a>';

			} else {

				$html = '<span class="css-email-obfuscator">%1$s</span>';

			}

			return sprintf( $html, strrev( $content ), $this->encode_ascii($atts['email']) ?: $this->encode_ascii($content) );

		}

	}

	/**
	 * Helper function to translate different shortcode attribute values into bool
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    string    $val    Value of the attribute
	 * @return   bool      $val    Boolean representation of the $val
	 */
	private function shortcode_att_bool( $val ) {

		$falsely = array( '0', 'n', 'no', 'false' );
		return ( !$val || in_array( strtolower($val), $falsely ) ) ? false : true;

	}

	/**
	 * Helper function to convert email address into ASCII values
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    string    $email  Email address
	 * @return   string    $email  Encoded $email
	 */
	private function encode_ascii( $email ) {

		if ($email)
		{
			$encoded = 'mailto:';
			$email = preg_split( '//u', $email, -1, PREG_SPLIT_NO_EMPTY );

			foreach( $email as $char) {

				$encoded .= sprintf( '&#%1$d;', $this->utf8_ord( $char ) );
			}

			return $encoded;

		}

		return false;

	}

	/**
	 * Helper function to get char value from UTF-8 charachters
	 *
	 * @since     1.0.0
	 * @access    private
	 * @param     string     $char    Single charachter
	 * @return    mixed      $val     Character value of $char or false if invalid character
	 */
	private function utf8_ord( $char ) {

		$len = strlen($char);
		if($len <= 0) return false;

		$h = ord($char{0});
		if ($h <= 0x7F) return $h;
		if ($h < 0xC2) return false;
		if ($h <= 0xDF && $len>1) return ($h & 0x1F) <<  6 | (ord($char{1}) & 0x3F);
		if ($h <= 0xEF && $len>2) return ($h & 0x0F) << 12 | (ord($char{1}) & 0x3F) << 6 | (ord($char{2}) & 0x3F);
		if ($h <= 0xF4 && $len>3) return ($h & 0x0F) << 18 | (ord($char{1}) & 0x3F) << 12 | (ord($char{2}) & 0x3F) << 6 | (ord($char{3}) & 0x3F);

		return false;

	}

}
