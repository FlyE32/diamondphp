<?php
namespace Hal\Config;

class Config {

	public $setting = [];
	private $db;

	public function __construct() {

		//** Global website settings **//

		# Database Connection
		$this->setting['db_host'] = "localhost"; # Localhost is fine for most; change if necessary
		$this->setting['db_name'] = "name_of_database";
		$this->setting['db_user'] = "db_user";
		$this->setting['db_pass'] = "db_password";

		# Define default controller
		# Enter the name of you controller, without the '_Controller' or .php extension
		# e.g., 'Home_Controller' is just 'Home'
		$this->setting['default_controller'] = 'Home';

		# Define the site name
		$this->setting['site_name'] = 'Diamond PHP';

		# Does your website/company have a tagline or slogan?
		$this->setting['site_slogan'] = 'MVC Framework for PHP 7';

		# Customer service or support email address
		$this->setting['site_email'] = 'your_email';

		# Site admin name
		$this->setting['site_admin'] = 'Admin';

		# Address
		$this->setting['street_address'] = 'street_address';
		$this->setting['city'] = 'city';
		$this->setting['state'] = 'two_letter_state_abbreviation';
		$this->setting['zipcode'] = 'zipcode';

		# Phone
		$this->setting['telephone'] = 'phone_number';

		# Time Zone
		$this->setting['time_zone'] = 'America/New_York';

		# Error reporting levels ( on or off )
		# Turn this off in live environment
		$this->setting['error_reports'] = 'on';

		# Name of the directory storing template files ( css/js/img, etc. )
		$this->setting['template_name'] = 'default';

		# Enable / disable breadcrumb links
		$this->setting['breadcrumbs'] = FALSE;

		# Put site in maintenance mode
		$this->setting['maintenance_mode'] = FALSE;

		/*
		 * Gzip compression
		 * Set to true to enable compression, false to disable
		 *
		 * If you get a blank page when compression is enabled,
		 * it means that you are putting out content before the page
		 * has begun loading.
		 *
		 * Nothing can be sent to the browser before compression begins,
		 * even blank spaces.
		 */
		$this->setting['compression'] = TRUE;

		/**
		 * Two step login process (i.e., should simple math problem be solved
		 * in addition to username / password?)
		 */
		$this->setting['login_math'] = TRUE;

		/*----------------------------------------
		 * Image gallery settings
		 */
		$this->setting['total_img_allowed'] = 10;
		# Maximum allowed image file size in kb ( 1024kb is equal to 1MB )
		$this->setting['img_file_size'] = 2048;
		# Maximum image height in pixels. Set to zero for unlimited
		$this->setting['img_height'] = 0;
		# Maximum image width in pixels. Set to zero for unlimited
		$this->setting['img_width'] = 0;
		# Allowed image types
		$this->setting['img_type'] = ['jpg', 'jpeg', 'gif', 'png'];

		/*----------------------------------------
		 * Global messenger inbox settings
		 */
		# Enable the messenger system by setting this to true
		$this->setting['inbox_enabled'] = TRUE;

		# Max number of saved messages in inbox
		$this->setting['inbox_limit'] = 100;

		# Allow email addresses to be sent in messages?
		$this->setting['inbox_allow_email'] = TRUE;

		# Allow URLs to be sent in messages?
		$this->setting['inbox_allow_url'] = TRUE;

		# Allow links to be sent in messages?
		$this->setting['inbox_allow_link'] = TRUE;

		# Allow images to be sent in messages?
		$this->setting['inbox_allow_image'] = TRUE;

		# Allow HTML formatting ( <strong>, <em>, <h1>, etc. ) to be sent in messages?
		$this->setting['inbox_allow_formatting'] = TRUE;

		$protocol = '';
		if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' )
            $protocol = 'https://';
		elseif( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' )
            $protocol = 'https://';
        else
        	// Fall back to relative url if protocol can't be determined
        	$protocol = '//';


		$uri[] = explode('/', $_SERVER["REQUEST_URI"]);
		/*
		 * Define site url here if default settings are not correct.
		 * Set $this->setting['site_url'] to a string (e.g., $this->setting['site_url'] = 'http://example.com')
		 *
		 * === IF YOUR SITE IS INSTALLED IN A SUBDIRECTORY ===
		 * Change $uri[0][0] to $uri[0][1] below
		 *
		 * NO TRAILING SLASHES AT THE END OF THE URL
		 */
		$this->setting['site_url'] = $protocol . $_SERVER["SERVER_NAME"] . '/' . $uri[0][0];

		################################################################
		# END OF USER EDITABLE SETTINGS -- DO NOT EDIT BELOW THIS LINE #
		################################################################

		/*----------------------------------------
		 * Global system settings
		 */

		# Location of front controller
		$this->setting['BASE_PATH'] = BASE_PATH;

		# Location of the system directory
		$this->setting['system_folder'] = $this->setting['BASE_PATH'] . 'app/code/core/system/';

		# Location of the public directory
		$this->setting['public_folder'] = $this->setting['BASE_PATH'] . 'public/';

		# Location of template directory
		$this->setting['template_folder'] = $this->setting['BASE_PATH'] . 'app/design/frontend/' . $this->setting['template_name'] . '/';

		# Template URL for fetching CSS / JS / IMG files
		$this->setting['template_url'] = $this->setting['site_url'] . 'app/design/frontend/' . $this->setting['template_name'] . '/';

		# Convert image file size setting to kb
		$this->setting['img_size'] = $this->setting['img_file_size'] * 1024;
		$size = $this->setting['img_size'];
		$unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
		$this->setting['notify_img_size'] = number_format(round($size / pow(1024, ($i = floor(log($size, 1024)))), 2)) . ' ' . $unit[$i];

		# Enable / disable Memcached helper
		if (extension_loaded('memcached')) {
			$this->setting['memcached'] = TRUE;
		} else {

			$this->setting['memcached'] = FALSE;
		}

		# Measure script execution time
		$this->setting['execution_time'] = (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]);

		# Release version
		$this->setting['software_version'] = '1.0.2';
	}

	public final function setting($setting = null) {

		return $this->setting["$setting"];
	}

	/**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }

    /**
     * Private clone method to prevent cloning of the instance
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Private unserialize method to prevent unserializing
     *
     * @return void
     */
    private function __wakeup() {}
}