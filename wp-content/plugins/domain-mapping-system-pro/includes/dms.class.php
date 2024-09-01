<?php

/**
 * @class DMS
 *        Designed to handle core functionality. Admin side crud and main mapping
 */
class DMS {

	/**
	 * Holds freemius instance
	 *
	 * @since  1.0.0
	 * @access public
	 * @var Freemius $dms_fs we store the freemius instance
	 */
	public $dms_fs;

	/**
	 * Holds wpdb instance
	 *
	 * @since  1.6
	 * @access public
	 * @var wpdb $wpdb we store the wpdb instance
	 */
	public $wpdb;

	/**
	 * Plugin name same as folder name
	 *
	 * @since  1.5.2
	 * @var string $plugin_name
	 */
	public $plugin_name;

	/**
	 * Plugin base name
	 *
	 * @since  1.4.6
	 * @var string $plugin_base_name
	 */
	public $plugin_base_name;

	/**
	 * Plugin dir
	 *
	 * @since  1.4.6
	 * @var string $plugin_dir
	 */
	public $plugin_dir;

	/**
	 * Plugin url
	 *
	 * @since  1.4.6
	 * @var string $plugin_url
	 */
	public $plugin_url;

	/**
	 * Plugin version
	 *
	 * @since  1.4.6
	 * @var string $version
	 */
	public $version;

	/**
	 * Singleton Instance
	 *
	 * @var DMS
	 */
	private static $instance;

	/**
	 * Platform
	 *
	 * @var DMS_Platform
	 */
	public $platform;

	/**
	 * MDM import instance
	 *
	 * @var DMS_Mdm_Import
	 */
	public $mdm_import_instance;

	/**
	 * Holds the flag if external host/domain+[path] is mapped
	 *
	 * @var bool
	 */
	private $domain_path_match = false;

	/**
	 * Requested by main mapping with path
	 *
	 * @var bool
	 */
	private $is_main_mapping_with_path = false;

	/**
	 * Holds the flag if external host is mapped in our side
	 *
	 * @var bool
	 */
	private $host_match = false;

	/**
	 * Current HTTP_HOST
	 *
	 * @var String
	 */
	private $domain;

	/**
	 * Current site host
	 *
	 * @var String
	 */
	private $base_host;

	/**
	 * Current request uri path
	 *
	 * @var String
	 */
	private $path;

	/**
	 * Current requested path pagination
	 *
	 * @var String
	 */
	private $pagination_path;

	/**
	 * Current request uri query string
	 *
	 * @var String
	 */
	private $query_string;

	/**
	 * Custom taxonomy requested
	 *
	 * @var bool
	 */
	private $is_tax = false;

	/**
	 * Signifies whether the current query is for a woo shop.
	 *
	 * @var bool
	 */
	public $is_woo_shop = false;

	/**
	 * Signifies whether the current query is search
	 *
	 * @var bool
	 */
	public $is_search = false;

	/**
	 * Woo shop page ID
	 *
	 * @var int
	 */
	public $woo_shop_page_id;

	/**
	 * Real requested object
	 *
	 * @var mixed
	 */
	public $real_requested_object;

	/**
	 * Real requested object link
	 *
	 * @var string
	 */
	public $real_requested_object_link;

	/**
	 * Real requested object id
	 *
	 * @var int|null
	 */
	public $real_requested_object_id;

	/**
	 * Custom taxonomy requested
	 *
	 * @var bool
	 */
	private $taxonomy_term_requested = [];

	/**
	 * Url rewrite flag
	 *
	 * @var bool
	 */
	private $url_rewrite = false;

	/**
	 * Url rewrite scenario global
	 *
	 * @var bool
	 */
	private $global_url_rewrite = false;

	/**
	 * Url rewrite scenario selective
	 *
	 * @var bool
	 */
	private $selective_url_rewrite = false;

	/**
	 * Map of Host/Post ID
	 *
	 * @var String[int]
	 */
	private $map = array();

	/**
	 * Id of attached favicon
	 *
	 * @var int|null
	 */
	private $dms_favicon_id = null;

	/**
	 * Custom html code for mapping
	 */
	private $map_custom_html = null;

	/**
	 * Keeps current active mapping. Defined at wp hook in self::catchQueriedObject method.
	 *
	 * @var array|object
	 */
	public $active_mapping;

	/**
	 * Flag to mention that page opened not with base host.
	 * This doesn't mean yet that the page opened with one of the mapped domains.
	 *
	 * @var array|object
	 */
	public $is_not_base_host;

	/**
	 * Flag to know if global mapping is enabled or not
	 *
	 * @var string
	 */
	public $global_mapping;

	/**
	 * Flag to know if force redirect is enabled
	 *
	 * @var string
	 */
	public $force_site_visitors;

	/**
	 * Is true when "remove parent page slugs from child pages" is enabled
	 *
	 * @var string
	 */
	public $short_child_page_urls;

	/**
	 * Holds the main mapping object
	 *
	 * @var object
	 */
	protected $main_mapping;

	/**
	 * Current term which must be mapped
	 */
    public $mapping_term;

	/**
     * Flag to know whether home link removed from main header navigation
     *
     * Holds necessary args of navigation
     *
	 * @var null | array
	 */
	public $home_link_args = null;

	/**
	 * DMS constructor.
	 */
	private function __construct() {
	}

	/**
	 * Singleton
	 *
	 * @return DMS
	 */
	public static function getInstance() {
		//TODO global $wpdb left in the sources. Replace with our wpdb property
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Return a current domain.
	 *
	 * @return String
	 *
	 * @since 1.9.4
	 */
	public function getDomain() {
		return $this->domain;
	}

	/**
	 * Return a current domain path.
	 *
	 * @return string
	 *
	 * @since 1.9.4
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * return a domain_path_match
	 *
	 * @return bool
	 *
	 * @since 1.9.4
	 */
	public function getDomainPathMatch() {
		return $this->domain_path_match;
	}

	/**
	 * Define main used class properties
	 *
	 * @param  string  $pluginBaseName
	 * @param  string  $pluginDir
	 * @param  string  $pluginUrl
	 * @param  string  $version
	 * @param  Freemius  $dms_fs
	 * @param  wpdb  $wpdb
	 */
	public static function defineProperties( $pluginBaseName, $pluginDir, $pluginUrl, $version, $dms_fs, $wpdb ) {
		$DMS                   = self::getInstance();
		$DMS->plugin_name      = rtrim( dirname( $pluginBaseName ), '-pro' );
		$DMS->plugin_base_name = $pluginBaseName;
		$DMS->plugin_dir       = $pluginDir;
		$DMS->plugin_url       = $pluginUrl;
		$DMS->version          = $version;
		$DMS->dms_fs           = $dms_fs;
		$DMS->wpdb             = $wpdb;
	}

	/**
	 * Include platform classes
	 */
	public static function includePlatforms() {
		$DMS       = self::getInstance();
		$platforms = scandir( $DMS->plugin_dir . '/includes/platforms' );
		$platforms = array_filter( $platforms, function ( $elem ) {
			return pathinfo( $elem )['extension'] == 'php';
		} );
		$platforms = array_reverse( $platforms );
		foreach ( $platforms as $item ) {
			require_once $DMS->plugin_dir . '/includes/platforms/' . $item;
		}
	}

	/**
	 * This function for including all folders/files connected with seo.
	 * And run
	 *
	 * @return void
	 *
	 * @since 1.9.4
	 */
	public static function includeSeoPlatforms() {
		$DMS = self::getInstance();
		DMS_Helper::includeFiles( $DMS->plugin_dir . 'includes/seo/' );
	}

	/**
	 * Run seo platforms
	 *
	 * @return void
	 */
	public static function runSeoPlatforms() {
		if ( is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) || is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
			DMS_Seo_Yoast::run();
		}
	}

	/**
	 * Load plugin text domain
	 *
	 * @return void
	 */
	public static function loadTextDomain() {
		$instance = self::getInstance();
		load_plugin_textdomain( $instance->plugin_name, false, basename( $instance->plugin_dir ) . '/languages' );
	}

	/**
	 * Uninstall
	 *
	 * @return void
	 */
	public static function uninstall() {
		$DMS  = self::getInstance();
		$wpdb = $DMS->wpdb;
		if ( is_multisite() ) {
			$sites = get_sites();
			foreach ( $sites as $blog ) {
				if ( ! empty( get_blog_option( $blog->id, 'dms_delete_upon_uninstall' ) ) ) {
					$prefix = $wpdb->get_blog_prefix( $blog->id );
					// Custom tables
					$wpdb->query( "DROP TABLE IF EXISTS `" . $prefix . "dms_mappings`" );
					$wpdb->query( "DROP TABLE IF EXISTS `" . $prefix . "dms_mapping_values`" );
					// Options
					delete_blog_option( $blog->id, 'dms_platform_wpcs_domains_retrieved' );
					delete_blog_option( $blog->id, 'dms_platform_wpcs_domains_possible_substitution' );
					delete_blog_option( $blog->id, 'dms_delete_upon_uninstall' );
					delete_blog_option( $blog->id, 'dms_version' );
					delete_blog_option( $blog->id, 'dms_enable_query_strings' );
					delete_blog_option( $blog->id, 'dms_force_site_visitors' );
					delete_blog_option( $blog->id, 'dms_global_mapping' );
					delete_blog_option( $blog->id, 'dms_map' );
					delete_blog_option( $blog->id, 'dms_use_post' );
					delete_blog_option( $blog->id, 'dms_use_page' );
					delete_blog_option( $blog->id, 'dms_use_categories' );
					delete_blog_option( $blog->id, 'dms_mdm_import_note' );
					$types = get_post_types( array(
						'public'   => true,
						'_builtin' => false
					), 'objects' );
					foreach ( $types as $item ) {
						if ( get_blog_option( $blog->id, "dms_use_{$item->query_var}" ) !== false ) {
							delete_blog_option( $blog->id, "dms_use_{$item->query_var}" );
						}
					}
				}
			}
		} elseif ( ! empty( get_option( 'dms_delete_upon_uninstall' ) ) ) {
			// Custom tables
			$wpdb->query( "DROP TABLE `" . $wpdb->prefix . "dms_mappings`" );
			$wpdb->query( "DROP TABLE `" . $wpdb->prefix . "dms_mapping_values`" );
			// Options
			delete_option( 'dms_platform_wpcs_domains_retrieved' );
			delete_option( 'dms_platform_wpcs_domains_possible_substitution' );
			delete_option( 'dms_delete_upon_uninstall' );
			delete_option( 'dms_version' );
			delete_option( 'dms_enable_query_strings' );
			delete_option( 'dms_force_site_visitors' );
			delete_option( 'dms_global_mapping' );
			delete_option( 'dms_map' );
			delete_option( 'dms_use_post' );
			delete_option( 'dms_use_page' );
			delete_option( 'dms_use_categories' );
			delete_option( 'dms_mdm_import_note' );
			$types = get_post_types( array(
				'public'   => true,
				'_builtin' => false
			), 'objects' );
			foreach ( $types as $item ) {
				if ( get_option( "dms_use_{$item->query_var}" ) !== false ) {
					delete_option( "dms_use_{$item->query_var}" );
				}
			}
		}
		// Remove mu file
		$dms_deactivate = new DMS_Activate( $DMS->plugin_base_name, $DMS->version, $DMS->plugin_dir, $DMS->wpdb );
		$dms_deactivate->deleteDMSMuHelper();
	}

	/**
	 * Check plugin version
	 *
	 * @return void
	 * @since 1.6
	 */
	public static function checkVersion() {
		$DMS          = self::getInstance();
		$dms_activate = new DMS_Activate( $DMS->plugin_base_name, $DMS->version, $DMS->plugin_dir, $DMS->wpdb );
		$version      = get_option( 'dms_version' );
		/**
		 * Check if we have version option
		 * If yes then just update once
		 * If no then do migration, cause this means we have installed new version
		 * where data storing structure is changed to table
		 */
		if ( empty( $version ) ) {
			$dms_activate->migrateTo1point6();
		}
		$dms_activate->setVersion( $version );
		$dms_activate->createDMSMuHelper();
		/**
		 * @since 1.7.4
		 * Check 1.7.3 migration requirement
		 * Sets 'host' column's index Non_unique if it is unique
		 * Do this staff only in case we are at admin side.
		 * Ideally this is done via upgrader hook, but in some cases it could fail.
		 * That is why we have placed this here, to check always
		 */
		if ( is_admin() ) {
			$dms_activate->upgraderProcessComplete();
		}
	}

	/**
	 * Define rewrite url
	 */
	public function defineRewriteOption() {
		if ( $this->dms_fs->can_use_premium_code__premium_only() ) {
			$this->url_rewrite = get_option( 'dms_rewrite_urls_on_mapped_page' );
			if ( ! empty( $this->url_rewrite ) ) {
				$rewrite_scenario            = get_option( 'dms_rewrite_urls_on_mapped_page_sc' );
				$this->global_url_rewrite    = $rewrite_scenario == 1;
				$this->selective_url_rewrite = $rewrite_scenario == 2;
			}
		}
	}

	/**
	 * Set global mapping and fore redirect options
	 *
	 * @return void
	 */
	public function setBaseOptions() {
		$this->global_mapping        = get_option( 'dms_global_mapping' );
		$this->force_site_visitors   = get_option( 'dms_force_site_visitors' );
		$this->short_child_page_urls = get_option( 'dms_remove_parent_page_slug_from_child' );
	}

	/**
	 * Runs DMS, executed on WP init-Hook
	 *
	 * @return void
	 */
	public static function run() {
		if ( ! is_admin() ) {
			// Get instance
			$DMS = self::getInstance();
			// Define requested domain/host
			$DMS->setCurrentDomain();
			// Define base host
			$DMS->setBaseHttpHost();
			// Set base options
			$DMS->setBaseOptions();
			// Check if we open the page from the main domain, then do nothing
			if ( strpos( $DMS->domain, (string) $DMS->base_host ) === 0 ) {
				return;
			}
			// Set flag that not the base host requested
			$DMS->is_not_base_host = true;
			// Define rewrite options
			$DMS->defineRewriteOption();
			// Retrieve and declare matching mapping stored in our side
			$mappings = $DMS->getMatch();
			if ( ! empty( $mappings[0] ) ) {
				$DMS->domain_path_match = true;
			}
			// If matched, then check if path exists or no
			if ( $DMS->domain_path_match ) {
				// Set mappings and get first mapping
				$DMS->map = $mappings;
				$mapping  = $mappings[0];
				// Anyway we must store domain match flag
				// Check path emptiness
				if ( empty( $DMS->path ) && $DMS->dms_fs->can_use_premium_code__premium_only() ) {
					/*
					 * If empty, then we must show the primary mapping ( if premium is active )
					 * But anyway needed additional check regarding primary value emptiness
					 */
					$primary = ! empty( $mapping['primary'] ) ? $mapping['primary'] : $mapping['value'];
					$DMS->map( $primary );
				} elseif ( empty( $DMS->path ) && ! $DMS->dms_fs->can_use_premium_code__premium_only() && ! empty( $mapping['value'] ) ) {
					// If empty, but plan is not premium, then we must show regular mapped page
					$DMS->map( $mapping['value'] );
				} elseif ( ! empty( $DMS->path ) && ! empty( $mapping['path'] ) && $DMS->dms_fs->can_use_premium_code__premium_only() ) {
					//If not empty, but we have full match $DMS->path == $mapping['path'] + $mapping['value_permalink_path']
					$DMS->map( $mapping['value'] );
				} elseif( ! empty( $mapping['value'] ) && ! empty( $DMS->short_child_page_urls ) && $child_page = DMS_Helper::getChildByParentAndSlug( $mapping['value'], $DMS->path ) ) {
					// Check is there child page mapping or not
					$DMS->map( $child_page->ID );
				} elseif ( ! empty( $DMS->path ) && $secondary_mapping = DMS_Helper::isSecondaryTerm( $DMS->path, $mappings ) ) {
                    // If secondary page was requested
					$DMS->map( 'term_'.$secondary_mapping->term_id );
				} else {
					// Do nothing, WordPress will handle the rest and couple actions will catch what is needed
					// Check if we have case when the real path requested with
					// main mapped domain. In that case we must check if
					// $DMS->path contains this -> [main-path] + real-path
					if ( empty( $mapping['main_host'] ) || empty( $mapping['main_path'] ) ) {
						// do nothing
					} else {
						$real_path = strpos( $DMS->path, $mapping['main_path'] ) === 0 ? $DMS->strReplaceOnce( $mapping['main_path'], '', $DMS->path ) : null;
						if ( ! empty( $real_path ) ) {
							$_SERVER['PATH_INFO'] = trim( $real_path, '/' );
						} else {
							// do nothing
						}
					}
				}
				// Store active mapping at this stage
				$DMS->active_mapping = $mapping;
				// Check favicon existence
				$DMS->dms_favicon_id  = ! empty( $mapping['attachment_id'] ) ? $mapping['attachment_id'] : null;
				$DMS->map_custom_html = ! empty( $mapping['custom_html'] ) ? $mapping['custom_html'] : null;
			} else {
				/**
				 * Possible case if we have "host" matching, but no mappings
				 * or not matching host , but externally pointing to our root
				 * In that case store flag that host match exist
				 * and redirect to main mapping if any
				 * but keeping in mind that host needs to be not equal to main host
				 * in case fully equal, then do nothing
				 */
				$global_mapping_on = ! empty( get_option( 'dms_global_mapping' ) );
				if ( $global_mapping_on && $DMS->dms_fs->can_use_premium_code__premium_only() ) {
					$main_mapping = $DMS->getMainMapping();
					if ( ! empty( $main_mapping->host )
                         && ( ! class_exists( 'DMS_Seo_Yoast' ) || ! DMS_Seo_Yoast::getInstance()->isSitemapRequested() )
					     && ( $DMS->domain != $main_mapping->host
					          || ( ! empty( $DMS->path )
					               && ! empty( $main_mapping->path )
					               && strpos( $DMS->path, (string) $main_mapping->path ) !== 0 ) ) ) {
						if ( empty( $_SERVER['PLESK_INTERNAL_PHP_EXEC'] ) ) {
							self::redirectTo( $main_mapping->host, $main_mapping->path, $DMS->path, $DMS->query_string, $DMS->pagination_path );
						}
					}
					/**
					 * Case when matched with main mapping
					 * Then fetch the real path and assign to SERVER PATH_INFO var
					 * NOTE: but before assigning check maybe we have another mapping
					 * connected with that native path and if force redirect is active
					 * we need to move to redirect to that mapping
					 */
					if ( ! empty( $DMS->path )
					     && ! empty( $main_mapping->path ) ) {
						$real_path = strpos( $DMS->path, (string) $main_mapping->path ) === 0 ? trim( $DMS->strReplaceOnce( $main_mapping->path, '', $DMS->path ), '/' ) : null;
						if ( ! empty( $real_path ) && ! empty( get_option( 'dms_force_site_visitors' ) ) ) {
							// First check in posts table by post_name
							$mapping = $DMS->getMatchingHostByPostName( $real_path );
							if ( empty( $mapping->host ) ) {
								// Then check in our mapping table, by value_permalink_path
								$mapping = DMS_Helper::getMatchingHostByValuePermalinkPath( $DMS->wpdb, $real_path );
							}
							if ( ! empty( $mapping->host ) ) {
								self::redirectTo( $mapping->host, $mapping->path, $real_path, $DMS->query_string, $DMS->pagination_path );
							}
						}
						$_SERVER['PATH_INFO'] = $real_path;
						// Store flag
						$DMS->is_main_mapping_with_path = true;
					} else {
						// do nothing,
						// almost impossible case, just left as it is
						// cause $DMS->path won't be empty here
					}
					// Check favicon existence
					$DMS->dms_favicon_id  = ! empty( $main_mapping->attachment_id ) ? $main_mapping->attachment_id : null;
					$DMS->map_custom_html = ! empty( $main_mapping->custom_html ) ? $main_mapping->custom_html : null;
				} else {
					$DMS->host_match = true;
				}
			}
		}
	}

	/**
	 * Str replace once
	 * TODO later move this to helpers class
	 *
	 * @param  string  $str_pattern
	 * @param  string  $str_replacement
	 * @param  string  $string
	 *
	 * @return array|mixed|string|string[]
	 */
	public function strReplaceOnce( $str_pattern, $str_replacement, $string ) {

		if ( strpos( $string, $str_pattern ) !== false ) {
			return substr_replace( $string, $str_replacement, strpos( $string, $str_pattern ), strlen( $str_pattern ) );
		}

		return $string;
	}

	/**
	 * Get matching mapping
	 *
	 * @return array|object|null
	 * @since 1.6
	 */
	public function getMatch() {
		$wpdb = $this->wpdb;

		//TODO remove path related query when using free version
		return $wpdb->get_results( $wpdb->prepare( "SELECT 
            m.id, 
            m.host, 
            m.path,
            m.attachment_id,
			m.custom_html,
            mv.value, 
            mv.value_permalink_path, 
            mvp.value AS `primary`, 
            (mv.value=mvp.value) AS is_primary,
            mm.host AS main_host,
            mm.path AS main_path
        FROM `" . $wpdb->prefix . "dms_mappings` m 
		INNER JOIN `" . $wpdb->prefix . "dms_mapping_values` mv ON m.id=mv.host_id
		LEFT JOIN `" . $wpdb->prefix . "dms_mappings` mm ON mm.main=1
		LEFT JOIN `" . $wpdb->prefix . "dms_mapping_values` mvp ON m.id=mvp.host_id AND mvp.primary=1
		WHERE 
		    m.host=%s AND 
		    (   (m.path IS NULL) OR 
		        (m.path = '' AND mv.value_permalink_path IS NULL) OR
		        (mv.value_permalink_path IS NOT NULL AND 
		            ( CONCAT(m.path, '/', mv.value_permalink_path)=%s OR 
		              CONCAT(m.path, '/', mv.value_permalink_path)=%s OR
		              ( m.path= %s AND mv.value=mvp.value)
                    )
                )
            )
        ORDER BY m.path DESC, is_primary DESC", $this->domain, $this->path, $this->path . '/', $this->path ), ARRAY_A );
	}

	/**
	 * Save default config options at very first install
	 * The first conditions is implemented by the 'dms_use_page' option existence
	 *
	 * @return void
	 */
	public static function activate() {
		$DMS          = self::getInstance();
		$dms_activate = new DMS_Activate( $DMS->plugin_base_name, $DMS->version, $DMS->plugin_dir, $DMS->wpdb );
		$dms_activate->activate();
	}

	/**
	 * Updates database, sets column 'host' none unique
	 *
	 * @param  WP_Upgrader|null  $upgrader
	 * @param  array  $hook_extra
	 */
	public static function upgraderProcessComplete( $upgrader = null, $hook_extra = [] ) {
		if ( ! is_null( $upgrader ) ) {
			$DMS          = self::getInstance();
			$dms_activate = new DMS_Activate( $DMS->plugin_base_name, $DMS->version, $DMS->plugin_dir, $DMS->wpdb );
			$dms_activate->upgraderProcessComplete( $upgrader );
		}
	}

	/**
	 * Unregister WP settings, executed on Plugin deactivation
	 *
	 * @return void
	 */
	public static function deactivate() {
		$DMS            = self::getInstance();
		$dms_deactivate = new DMS_Activate( $DMS->plugin_base_name, $DMS->version, $DMS->plugin_dir, $DMS->wpdb );
		$dms_deactivate->deactivate();
	}

	/**
	 * Register DMS Settings and enqueue Scripts and Styles
	 *
	 * @return void
	 */
	public static function adminInit() {
		$DMS = self::getInstance();
		$DMS->startSession();
		// Below detection will work only in admin side
		$DMS->autoDetectPlatform();
		$DMS->addActions();
        $DMS->defineAjaxHooks();
	}

	/**
	 * Auto-detect platform that runs WordPress
	 */
	public function autoDetectPlatform() {
		$this->platform = DMS_Helper::detectPlatform( $this );
	}

	/**
	 * Detect MDM plugin presence
	 * and define mdm import class
	 */
	public static function detectMdmPresence() {
		if ( DMS_Helper::checkMdmPluginPresence() ) {
			$DMS                      = self::getInstance();
			$DMS->mdm_import_instance = new DMS_Mdm_Import( $DMS );
		}
	}

	/**
	 * Admin side wp related save actions
	 */
	public function addActions() {
		add_action( 'admin_post_save_dms_mapping', array( $this, 'saveMapping' ) );
		add_action( 'admin_post_save_dms_screen_options', array( $this, 'saveScreenOptions' ) );
	}

	/**
     * Save screen options
     *
	 * @return void
	 */
	public function saveScreenOptions() {
		$check_nonce = check_admin_referer( 'save_dms_screen_options', 'save_dms_screen_options_nonce' );
		$referer     = wp_get_referer();
		if ( $check_nonce ) {
			$values_per_mapping  = ! empty( $_POST['dms_values_per_mapping'] ) ? sanitize_text_field( $_POST['dms_values_per_mapping'] ) : 5;
			$mappings_per_page = ! empty( $_POST['dms_mappings_per_page'] ) ? sanitize_text_field( $_POST['dms_mappings_per_page'] ) : 10;

			update_option( 'dms_mappings_per_page', $mappings_per_page );
			update_option( 'dms_values_per_mapping', $values_per_mapping );
		}
		wp_redirect( site_url() . $referer );
	}

	/**
	 * Save all the data sent
	 * The data is one page content of mappings and couple configurations.
	 * Mapped data need to be saved in separate folder
	 *
	 * @since 1.6
	 */
	public function saveMapping() {
		// Check nonce
		check_admin_referer( 'save_dms_mapping_action', 'save_dms_mapping_nonce' );
		$referer = wp_get_referer();
		// Check session
		if ( empty( session_id() ) ) {
			session_start();
		}
		// Save dms configs.
		$dms_use_page       = isset( $_POST['dms_use_page'] ) ? 'on' : '';
		$dms_use_post       = isset( $_POST['dms_use_post'] ) ? 'on' : '';
		$dms_use_categories = isset( $_POST['dms_use_categories'] ) ? 'on' : '';
		// Update options
		update_option( 'dms_use_post', $dms_use_post );
		update_option( 'dms_use_page', $dms_use_page );
		update_option( 'dms_use_categories', $dms_use_categories );
		// Update post taxonomies
		$post_taxonomies = get_taxonomies( array(
			'object_type' => array( 'post' ),
			'_builtin'    => false,
		) );
		foreach ( $post_taxonomies as $key => $taxonomy ) {
			$taxonomy_option = isset( $_POST[ 'dms_use_cat_post_' . $key ] ) ? 'on' : '';
			update_option( 'dms_use_cat_post_' . $key, $taxonomy_option );
		}

		// Update page taxonomies
		$page_taxonomies = get_taxonomies( array(
			'object_type' => array( 'page' ),
			'_builtin'    => false,
		) );
		foreach ( $page_taxonomies as $key => $taxonomy ) {
			$taxonomy_option = isset( $_POST[ 'dms_use_cat_page_' . $key ] ) ? 'on' : '';
			update_option( 'dms_use_cat_page_' . $key, $taxonomy_option );
		}

		$types = get_post_types( array(
			'public'   => true,
			'_builtin' => false
		), 'objects' );
		foreach ( $types as $item ) {
			$opt_name = "dms_use_{$item->query_var}";
			$opt      = isset( $_POST[ $opt_name ] ) ? 'on' : '';
			update_option( $opt_name, $opt );
			if ( ! empty( $item->has_archive ) ) {
				$opt_name = "dms_use_{$item->query_var}_archive";
				$opt      = isset( $_POST[ $opt_name ] ) ? 'on' : '';
				update_option( $opt_name, $opt );
			}
			if ( $this->dms_fs->can_use_premium_code__premium_only() ) {
				$taxonomies = get_object_taxonomies( $item->query_var, 'objects' );
				if ( ! empty( $taxonomies ) ) {
					foreach ( $taxonomies as $taxonomy ) {
						$opt_name = "dms_use_cat_{$item->query_var}_{$taxonomy->name}";
						$opt      = isset( $_POST[ $opt_name ] ) ? 'on' : '';
						update_option( $opt_name, $opt );
					}
				}
			}
		}
		// Save dms mappings.
		if ( empty( $this->platform ) || $this->platform->allowMappingSave() ) {
			// Check/set post data
			$primary_host                           = trim( wp_parse_url( get_site_url() )['host'] );
			$dms_enable_query_strings               = isset( $_POST['dms_enable_query_strings'] ) ? 'on' : '';
			$dms_force_site_visitors                = isset( $_POST['dms_force_site_visitors'] ) ? 'on' : '';
			$dms_global_mapping                     = isset( $_POST['dms_global_mapping'] ) ? 'on' : '';
			$dms_delete_upon_uninstall              = isset( $_POST['dms_delete_upon_uninstall'] ) ? 'on' : '';
			$dms_archive_global_mapping             = isset( $_POST['dms_archive_global_mapping'] ) ? 'on' : '';
			$dms_woo_shop_global_mapping            = isset( $_POST['dms_woo_shop_global_mapping'] ) ? 'on' : '';
			$dms_global_parent_page_mapping         = isset( $_POST['dms_global_parent_page_mapping'] ) ? 'on' : '';
			$dms_seo_sitemap_per_domain             = isset( $_POST['dms_seo_sitemap_per_domain'] ) ? 'on' : '';
			$dms_seo_options_per_domain             = isset( $_POST['dms_seo_options_per_domain'] ) ? 'on' : '';
			$dms_rewrite_urls_on_mapped_page        = isset( $_POST['dms_rewrite_urls_on_mapped_page'] ) ? 'on' : '';
			$dms_remove_parent_page_slug_from_child = isset( $_POST['dms_remove_parent_page_slug_from_child'] ) ? 'on' : '';
			$dms_rewrite_urls_on_mapped_page_sc     = isset( $_POST['dms_rewrite_urls_on_mapped_page_sc'] ) ? (int) sanitize_text_field( $_POST['dms_rewrite_urls_on_mapped_page_sc'] ) : '';
			$dms_main_domain_post_data              = $_POST['dms_main_domain'] ?? null;
			$dms_main_domain                        = ! empty( $dms_main_domain_post_data ) ? esc_url_raw( $dms_main_domain_post_data ) : null;
			$dms_main_domain                        = ! empty( $dms_main_domain ) ? @wp_parse_url( $dms_main_domain, PHP_URL_HOST ) . @wp_parse_url( $dms_main_domain, PHP_URL_PATH ) : null;
			$dms_main_domain                        = $dms_main_domain_post_data == $dms_main_domain ? $dms_main_domain : null;
			$domains                                = ! empty( $_POST['dms_map']['domains'] ) && is_array( $_POST['dms_map']['domains'] ) ? $_POST['dms_map']['domains'] : [];
			$domains_to_remove                      = ! empty( $_POST['dms_map']['domains_to_remove'] ) ? sanitize_text_field( $_POST['dms_map']['domains_to_remove'] ) : '';
			// Update options
			update_option( 'dms_enable_query_strings', $dms_enable_query_strings );
			update_option( 'dms_force_site_visitors', $dms_force_site_visitors );
			update_option( 'dms_global_mapping', $dms_global_mapping );
			update_option( 'dms_delete_upon_uninstall', $dms_delete_upon_uninstall );
			update_option( 'dms_archive_global_mapping', $dms_archive_global_mapping );
			update_option( 'dms_woo_shop_global_mapping', $dms_woo_shop_global_mapping );
			update_option( 'dms_global_parent_page_mapping  ', $dms_global_parent_page_mapping );
			update_option( 'dms_seo_sitemap_per_domain', $dms_seo_sitemap_per_domain );
			update_option( 'dms_seo_options_per_domain', $dms_seo_options_per_domain );
			update_option( 'dms_rewrite_urls_on_mapped_page', $dms_rewrite_urls_on_mapped_page );
			update_option( 'dms_remove_parent_page_slug_from_child', $dms_remove_parent_page_slug_from_child );
			if ( ! empty( $dms_rewrite_urls_on_mapped_page ) ) {
				update_option( 'dms_rewrite_urls_on_mapped_page_sc', $dms_rewrite_urls_on_mapped_page_sc );
			} else {
				update_option( 'dms_rewrite_urls_on_mapped_page_sc', '' );
			}
			// Add rewrite rules, in case sitemap per domain is enabled
			if ( ! empty( $dms_seo_sitemap_per_domain ) ) {
				add_rewrite_rule( '([^?]+)\/sitemap_index\.xml$', 'index.php?sitemap=1', 'top' );
				add_rewrite_rule( '([^?]+)\/([^\/]+?)-sitemap([0-9]+)?\.xml', 'index.php?sitemap=$matches[2]&sitemap_n=$matches[3]', 'top' );
			}
			add_action( 'shutdown', 'flush_rewrite_rules' );
			// Store shop page flag
			$shop_page_association = ! empty( $dms_woo_shop_global_mapping ) ? DMS_Helper::getShopPageAssociation() : false;
			// Check mapped objects emptiness
			$wpdb = $this->wpdb;
			// Check platform existence
			$config_exists = true;
			if ( ! empty ( $this->platform ) ) {
				// So we need to check pre-requirements
				if ( ! $this->platform->isAllowedToSaveMapping() ) {
					$config_exists                   = false;
					$warning                         = true;
					$_SESSION['dms_admin_warning'][] = $this->platform->getMessages()['is_not_allowed_to_save_mapping'];
				}
			}
			// Check warning at this stage
			if ( $config_exists ) {
				// Check ids for delete
				if ( ! empty( $domains_to_remove ) ) {
					$domains_to_remove_arr = explode( ',', $domains_to_remove );
					$domains_to_remove_arr = array_map( function ( $value ) {
						return (int) esc_sql( $value );
					}, $domains_to_remove_arr );
					if ( ! empty( $domains_to_remove_arr ) ) {
						// Check in case platform exists
						$external_delete_could_be_proceeded = true;
						if ( ! empty( $this->platform ) ) {
							try {
								// Collect real hosts
								$hosts = $wpdb->get_results( "SELECT `host`, `id` FROM `" . $wpdb->prefix . "dms_mappings` WHERE `id` IN (" . $domains_to_remove . ")" );
								// Remove external host , then add new one
								$external_deleted_domains = $this->platform->deleteDomains( $hosts );
								$deleted_hosts_result     = array_diff( $domains_to_remove_arr, $external_deleted_domains );
								if ( ! empty( $deleted_hosts_result ) ) {
									$external_delete_could_be_proceeded = false;
								}
							} catch ( \Exception $e ) {
								$external_delete_could_be_proceeded = false;
							}
						}
						if ( $external_delete_could_be_proceeded ) {
							$domains_to_remove = implode( ',', $domains_to_remove_arr );
							$delete_mappings   = $wpdb->query( "DELETE FROM `" . $wpdb->prefix . "dms_mappings` WHERE id IN (" . $domains_to_remove . ")" );
							if ( $delete_mappings ) {
								$delete_values = $wpdb->query( "DELETE FROM `" . $wpdb->prefix . "dms_mapping_values` WHERE host_id IN (" . $domains_to_remove . ")" );
							}
						}
					}
					// Check if succeed
					if ( ( isset( $delete_mappings ) && $delete_mappings === false ) || ( isset( $delete_values ) && $delete_values === false ) ) {
						$_SESSION['dms_admin_warning'][] = __( 'Failed trying to remove the mappings', $this->plugin_name );
					}
				}
				// Retrieve highest order
				$highest_order = $wpdb->get_var( "SELECT MAX(`order`) FROM `" . $wpdb->prefix . "dms_mappings`" );
				$highest_order = ! empty( $highest_order ) ? $highest_order : 1;
				// Validate mapping data
				$primary_hosts         = [];
				$invalid_hosts         = [];
				$invalid_paths         = [];
				$duplicate_entries     = [];
				$invalid_values        = [];
				$empty_primaries       = [];
				$update_failed         = [];
				$add_failed            = [];
				$empty_values          = [];
				$strict_platform_check = false;
				foreach ( $domains as $key => $item ) {
					// Validate host
					$item['host'] = trim( $item['host'], '/' );
					if ( function_exists( 'idn_to_ascii' ) ) {
						$item['host'] = idn_to_ascii( $item['host'] );
					}
					//check if there is mapping with same host in other blogs
					$is_there = false;
					if ( is_multisite() ) {
						$sites = get_sites();
						foreach ( $sites as $blog ) {
							if ( $blog != get_site() ) {
								$prefix = $wpdb->get_blog_prefix( $blog->id );
								$table  = $wpdb->get_row( "SHOW TABLES LIKE '" . $prefix . "dms_mappings'" );
								if ( ! empty( $table ) ) {
									$result = $wpdb->get_row( "SELECT * FROM " . $prefix . "dms_mappings WHERE `host` = '" . $item['host'] . "'" );
								}
								if ( ! empty( $result ) ) {
									$is_there = true;
									break;
								}
							}
						}
					}
					if ( $is_there ) {
						$existing_hosts[] = $item['host'];
						continue;
					}
					// Check emptiness
					if ( empty( $item['host'] ) && empty( $item['mappings']['values'][0] ) ) {
						// Just ignore in case the fields are empty and save was clicked
						continue;
					}
					$parsed_host = wp_parse_url( 'http://' . $item['host'], PHP_URL_HOST );
					if ( $parsed_host != $item['host']
					     || strpos( $item['host'], '.' ) === false
					     || 'http://' . $item['host'] != esc_url_raw( $item['host'] ) ) {
						$invalid_hosts[] = $item['host'];
						continue;
					}
					// Check if host is our primary domain and throw error
					if ( $parsed_host == $primary_host ) {
						$primary_hosts[] = $item['host'];
						continue;
					}
					// Validate path
					if ( $this->dms_fs->can_use_premium_code__premium_only() ) {
						if ( isset( $item['path'] ) ) {
							$item['path'] = trim( $item['path'], '/' );
							$parsed_path  = wp_parse_url( 'http://' . $item['host'] . '/' . $item['path'], PHP_URL_PATH );
							if ( $parsed_path != '/' . $item['path'] || 'http://' . $item['host'] . '/' . $item['path'] != esc_url_raw( $item['host'] . '/' . $item['path'] ) ) {
								$invalid_paths[] = $item['host'];
								continue;
							}
						}
					} else {
						// Assign null, just to avoid any missed PRO checking issue
						$item['path'] = null;
					}
					// Check if mappings exists
					$values_sent = ! empty( $item['mappings']['values'][0] );
					if ( $values_sent ) {
						// Check if primary is in
						if ( $this->dms_fs->can_use_premium_code__premium_only() ) {
							if ( ! in_array( $item['mappings']['primary'], $item['mappings']['values'] ) && ! $item['primary_hidden'] ) {
								$empty_primaries[] = $item['host'];
								continue;
							}
						}
						/**
						 * Loop through values,
						 * validate them
						 * In case there is single invalid value then avoid saving
						 */
						foreach ( $item['mappings']['values'] as $value ) {
							if ( $value != sanitize_text_field( $value ) ) {
								$invalid_values[] = $item['host'];
								break;
							}
						}
					} else {
						$empty_values[] = $item['host'] . ( ! empty( $item['path'] ) ? '/' . $item['path'] : '' );
						continue;
					}
					if ( in_array( $item['host'], $invalid_values ) ) {
						continue;
					}
					/**
					 * Assign little logic depending on $item['path'] emptiness
					 * Retrieve host + path duplicates
					 * Generate right value arrays for update and insert functionality
					 */
					if ( ! is_null( $item['path'] ) ) {
						$duplicate_where        = "m.host=%s AND m.path=%s";
						$duplicate_where_values = array( $item['host'], $item['path'] );
						$update_values          = array(
							'host' => $item['host'],
							'main' => $dms_main_domain == $item['host'] . ( empty( $item['path'] ) ? '' : '/' . $item['path'] ),
							'path' => $item['path']
						);
						$update_where_values    = array(
							'%s',
							'%d',
							'%s'
						);
					} else {
						$duplicate_where        = "m.host=%s AND m.path IS NULL";
						$duplicate_where_values = array( $item['host'] );
						$update_values          = array(
							'host' => $item['host'],
							'main' => $dms_main_domain == $item['host']
						);
						$update_where_values    = array(
							'%s',
							'%d'
						);
					}
					// Custom HTML code existance check
					if ( isset( $item['custom_html'] ) && $this->dms_fs->can_use_premium_code__premium_only() ) {
						$update_values['custom_html'] = $item['custom_html'];
						$update_where_values[]        = '%s';
					}
					// Favicon existence check
					if ( isset( $item['attachment_id'] ) ) {
						$item['attachment_id']          = (int) sanitize_text_field( $item['attachment_id'] );
						$update_values['attachment_id'] = $item['attachment_id'];
						$update_where_values[]          = '%d';
					}
					// Check duplicates
					$duplicate = $wpdb->get_var( $wpdb->prepare( "SELECT `id` FROM `" . $wpdb->prefix . "dms_mappings` m WHERE $duplicate_where", $duplicate_where_values ) );
					/**
					 * Start saving
					 * Check if we have row with that id already,
					 * Check duplicate entries
					 * if yes then replace with new collection and update host
					 * if no then insert new mapping.
					 * Will be great to implement sql transactions.
					 */
					$mapping = ! empty( $item['id'] ) ? $wpdb->get_row( $wpdb->prepare( "SELECT `id`, `host` FROM `" . $wpdb->prefix . "dms_mappings` m WHERE m.id=%d", $item['id'] ) ) : null;
					if ( ! empty( $mapping->id ) ) {
						$host_id = $mapping->id;
						if ( ! empty( $duplicate ) && $duplicate != $host_id ) {
							$duplicate_entries[] = $item['host'] . ( ! empty( $item['path'] ) ? '/' . $item['path'] : '' );
							continue;
						}
						// Check in case platform exists
						if ( ! empty( $this->platform ) ) {
							try {
								// Check weather host is updated
								if ( $mapping->host != $update_values['host'] ) {
									// Remove external host , then add new one
									$external_delete = $this->platform->deleteDomain( $mapping->host );
									if ( empty( $external_delete ) ) {
										$update_failed[] = $mapping->host;
										continue;
									}
									// Now add new one
									$external_add = $this->platform->addDomain( $update_values['host'] );
									if ( empty( $external_add ) ) {
										if ( $strict_platform_check ) {
											$update_failed[] = $update_values['host'];
											continue;
										}
									}
								}
							} catch ( \Exception $e ) {
								if ( $strict_platform_check ) {
									continue;
								}
							}
						}
						$ok = $wpdb->update( $wpdb->prefix . 'dms_mappings', $update_values, array(
							'id' => $host_id
						), $update_where_values, array( '%d' ) );
						if ( $ok === false ) {
							$update_failed[] = $mapping->host;
							continue;
						} else {
							$item['mappings']['values'] = array_unique($item['mappings']['values']);
                            //If shop mapping remove all products
							if ( $dms_woo_shop_global_mapping ) {
								$table_name = $wpdb->prefix . 'dms_mapping_values';
								$products   = $this::getAllWooProducts();
								if ( ! empty( $products ) ) {
									foreach ( $products as $product ) {
										$query = $wpdb->delete( $table_name, [
											'host_id' => $host_id,
											'value'   => $product
										] );
									}
								}
							}
							$table_name = $wpdb->prefix . 'dms_mapping_values';
							$query = $wpdb->prepare("DELETE FROM {$table_name}
                                        WHERE host_id = %d
                                        ORDER BY `order` ASC 
                                        LIMIT %d
                                    ", $host_id, intval($item['count']));
							$ok = $wpdb->query($query);
							if ( $ok === false ) {
								$update_failed[] = $mapping->host;
								continue;
							}
						}
					} else {
						if ( ! empty( $duplicate ) ) {
							$duplicate_entries[] = $item['host'] . ( ! empty( $item['path'] ) ? '/' . $item['path'] : '' );
							continue;
						}
						// Check in case platform exists
						if ( ! empty( $this->platform ) ) {
							try {
								// Then first we need to save domain there
								$external_add = $this->platform->addDomain( $update_values['host'] );
								if ( empty( $external_add ) ) {
									if ( $strict_platform_check ) {
										$add_failed[] = $update_values['host'];
										continue;
									}
								}
							} catch ( \Exception $e ) {
								if ( $strict_platform_check ) {
									$add_failed[] = $update_values['host'];
									continue;
								}
							}
						}
						$update_values['order'] = $highest_order;
						$update_where_values[]  = '%d';
						$ok                     = $wpdb->insert( $wpdb->prefix . 'dms_mappings', $update_values, $update_where_values );
						if ( empty( $ok ) ) {
							$add_failed[] = $item['host'];
							continue;
						}
						$host_id = $wpdb->insert_id;
					}
					// Check if values sent then proceed this
					if ( $values_sent ) {
						$ok_values = 0;
						// Loop through mappings
						foreach ( $item['mappings']['values'] as $value ) {
							// Prepare insert for single $value
                            if ($value == 'load-more'){
                                continue;
                            }
							$insert_result = $this->prepareMappingInsert( $value, $item, $host_id, $ok_values );
							if ( $insert_result === 0 ) {
								break;
							} elseif ( $insert_result === 2 || $insert_result === 1 ) {
								/**
								 * So either duplicate or successful insert.
								 * 1) Check if $value is taxonomy
								 * 2) Or shop page
								 * and save connected posts.
								 * Note that category is simple posts related category for now
								 */
								if ( $this->dms_fs->can_use_premium_code__premium_only() && ! empty( $dms_archive_global_mapping ) ) {
									// Native posts category related mapping
									if ( $this::isTaxonomyTerm( $value ) ) {
										// Collect all posts connected with taxonomy ( weather native category or taxonomy )
										$term_taxonomy = $this::getTaxonomyTermFromValue( $value );
										$term          = get_term_by( 'slug', $term_taxonomy[1], $term_taxonomy[0] );
										$posts         = $this::getPostsByTaxonomyTermId( $term_taxonomy[0], $term->term_id );
										foreach ( $posts as $post_id ) {
											$insert_result = $this->prepareMappingInsert( $post_id, $item, $host_id, $ok_values );
											if ( $insert_result === 0 ) {
												break;
											}
										}
									}
								}
								if ( $this->dms_fs->can_use_premium_code__premium_only() && ! empty( $dms_woo_shop_global_mapping ) ) {
									if ( $shop_page_association == $value ) {
										// Get all products and associate with
										$products = $this::getAllWooProducts();
										if ( ! empty( $products ) ) {
											foreach ( $products as $product_id ) {
												$insert_result = $this->prepareMappingInsert( $product_id, $item, $host_id, $ok_values );
												if ( $insert_result === 0 ) {
													break;
												}
											}
										}
									}
								}
								if ( $this->dms_fs->can_use_premium_code__premium_only() && ! empty( $dms_global_parent_page_mapping ) ) {
									if ( DMS_Helper::isPagePostType( $value ) ) {
										$this::addChildPagesDb( $value, $item, $host_id );
									}
								}
								if ( $this->dms_fs->can_use_premium_code__premium_only() && ! empty( $dms_remove_parent_page_slug_from_child ) ) {
                                    // In case of subdirectory existence save new values in DB without parent slug
									if ( DMS_Helper::isPagePostType( $value )) {
										$this::addChildPagesDbWithoutParentSlug( $value, $item, $host_id );
									}
								}
							}
						}

						/**
						 * Get duplicated values and remove them
						 */
						$table_name     = $wpdb->prefix . 'dms_mapping_values';
						$duplicate_rows = $wpdb->get_results( $wpdb->prepare( "
                                    SELECT `host_id`, `value`, `value_permalink_path`, COUNT(*) AS num_duplicates
                                    FROM {$table_name}
                                    WHERE `host_id` = %d
                                    GROUP BY host_id, value, value_permalink_path
                                    HAVING COUNT(*) > 1
                                ", $item['id'] ) );

						$ids_to_delete = [];
						foreach ( $duplicate_rows as $row ) {
							$host_id               = $row->host_id;
							$value                 = $row->value;
							$value_permalink_path  = $row->value_permalink_path;
							$duplicate_ids_to_delete = $wpdb->get_col( $wpdb->prepare( "
                            SELECT `order`
                            FROM {$table_name}
                            WHERE `host_id` = %d AND `value` = %s AND `value_permalink_path` = %s
                            ORDER BY 'order' DESC
                        ", $host_id, $value, $value_permalink_path ) );

							if ( ! empty( $duplicate_ids_to_delete ) ) {
								unset( $duplicate_ids_to_delete[0] );
							}
							$ids_to_delete = array_merge( $ids_to_delete, $duplicate_ids_to_delete );
						}
						if ( ! empty( $ids_to_delete ) ) {
							$ids_to_delete = implode( ',', $ids_to_delete );
							$wpdb->query( "DELETE FROM $table_name WHERE `order` IN ($ids_to_delete)" );
						}

						//TODO this check should be only to show that failed to add mapping value (like some DB issue) and not in case when there were no mapping to add
						// if ( empty( $ok_values ) ) {
						//	  $add_failed[] = $item['host'];
						//	  continue;
						// }
					}
					$highest_order ++;
				}
				// Check if global domain mapping is enabled and domains count is equal to 1
				// Then mark that domain as main
				if ( $dms_global_mapping == 'on' && $this->getMappingsCount() == 1 ) {
					$wpdb->query( "UPDATE `" . $wpdb->prefix . "dms_mappings` SET `main`=1" );
				}
			}
		} else {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = $this->platform->getMessages()['is_not_allowed_to_save_mapping_user_case'];
		}
		// Check external add/delay and set delay for next save
		if ( ! empty( $this->platform ) && ! empty( $this->platform->delay_after_save ) && ( ! empty( $external_add ) || ! empty( $external_delete_could_be_proceeded ) ) ) {
			$platform = $this->platform;//todo move this assignment to the top and replace all $this->platform
			update_option( 'dms_' . strtolower( $platform::NAME ) . '_last_save_delay', time() + $platform->delay_after_save );
		}
		// Check validness of the host
		if ( ! empty( $invalid_hosts ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'Invalid host specified.', $this->plugin_name ) . ' ( <b>' . implode( ',', $invalid_hosts ) . '</b> ) ';
		}
		// Check primary host existence in the mappings
		if ( ! empty( $primary_hosts ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'Unable to map primary domain.', $this->plugin_name ) . ' ( <b>' . implode( ',', $primary_hosts ) . '</b> ) ';
		}
		// Check path validness
		if ( ! empty( $invalid_paths ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'Invalid paths specified.', $this->plugin_name ) . ' ( <b>' . implode( ',', $invalid_paths ) . '</b> ) ';
		}
		// Check primary object existence
		if ( ! empty( $empty_primaries ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'Please set a Microsite homepage for each mapped domain.', $this->plugin_name ) . ' ( <b>' . implode( ',', $empty_primaries ) . '</b> ) ';
		}
		// Check if some hosts is not mapped.
		if ( ! empty( $empty_values ) ) {
			$warning                       = true;
			$_SESSION['dms_admin_error'][] = __( 'Please select at least one published resource for mapping.', $this->plugin_name ) . ' ( <b>' . implode( ',', $empty_values ) . '</b> ) ';
		}
		// Check primary object values validness
		if ( ! empty( $invalid_values ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'Invalid values exist.', $this->plugin_name ) . ' ( <b>' . implode( ',', $invalid_values ) . '</b> ) ';
		}
		// Check duplicate entries
		if ( ! empty( $duplicate_entries ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'Duplicate entries detected with the same root domain and subdirectory.', $this->plugin_name ) . ' ( <b>' . implode( ',', $duplicate_entries ) . '</b> ) ';
		}
		// Check if add new mapping worked
		if ( ! empty( $add_failed ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'Failed to add new mapping.', $this->plugin_name ) . ' ( <b>' . implode( ',', $add_failed ) . '</b> ) ';
		}
		// Check if update worked
		if ( ! empty( $update_failed ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'Failed to update mapping.', $this->plugin_name ) . ' ( <b>' . implode( ',', $update_failed ) . '</b> ) ';
		}
		// Check if mappings already exist
		if ( ! empty( $existing_hosts ) ) {
			$warning                         = true;
			$_SESSION['dms_admin_warning'][] = __( 'The same domain is already mapped to another site on your Multisite Network. Contact your administrator for assistance.', $this->plugin_name ) . ' ( <b>'
			                                   . implode( ',', $existing_hosts ) . '</b> ) ';
		}
		// Check if succeed
		if ( empty( $warning ) ) {
			$_SESSION['dms_admin_success'][] = __( 'Successfully saved.', $this->plugin_name );
		}
		wp_safe_redirect( $referer );
		exit();
	}

	/**
	 * This function for adding all pages in db, which is had parent page.
	 *
	 * @param $parent_id
	 * @param $item
	 * @param $host_id
	 *
	 * @return void
	 */
	private function addChildPagesDb( $parent_id, $item, $host_id ) {
		$child_pages = DMS_Helper::getChildPages( $parent_id );
		if ( count( $child_pages ) > 0 ) {
			foreach ( $child_pages as $page ) {
				$next_child_pages = DMS_Helper::getChildPages( $page->ID );
				if ( count( $next_child_pages ) > 0 ) {
					$this->prepareMappingInsert( $page->ID, $item, $host_id );
					foreach ( $next_child_pages as $page2 ) {
						$this->prepareMappingInsert( $page2->ID, $item, $host_id );
						self::addChildPagesDb( $page2->ID, $item, $host_id );
					}
				} else {
					$this->prepareMappingInsert( $page->ID, $item, $host_id );
				}
			}
		}
	}

	/**
     * Recursively dd child pages to db excluding parent slugs
	 * @param $parent_id
	 * @param $item
	 * @param $host_id
	 *
	 * @return void
	 */
	private function addChildPagesDbWithoutParentSlug( $parent_id, $item, $host_id, $parent_slugs = array() ) {
		$args     = array(
			'post_type'      => 'page',
			'post_parent'    => $parent_id,
			'posts_per_page' => - 1,
		);
		$children = get_children( $args );
		foreach ( $children as $child ) {
			$child_slug  = $child->post_name;
			$child_id    = $child->ID;
			$child_slugs = array_merge( $parent_slugs, array( $child_slug ) );
			$final_slug  = implode( '/', $child_slugs );
			$this->prepareMappingInsertWithoutParentSlug( $child_id, $item, $host_id, $final_slug );
			// Recursively get child slugs
			$this->addChildPagesDbWithoutParentSlug( $child_id, $item, $host_id, $child_slugs );
		}
	}

	/**
     * Single mapping insert without parent slug
     *
	 * @param $value
	 * @param $item
	 * @param $host_id
	 * @param $ok_values
	 *
	 * @return int
	 */
	public function prepareMappingInsertWithoutParentSlug( $value, $item, $host_id, $path, &$ok_values = null ) {
		$wpdb                       = $this->wpdb;
		$isPrimary                  = ! empty( $item['mappings']['primary'] ) && $item['mappings']['primary'] === $value;
		$mapping_values             = array(
			'host_id' => $host_id,
			'value'   => $value,
			'primary' => (int) ( $this->dms_fs->can_use_premium_code__premium_only() && $isPrimary )
		);
		$mapping_values_placeholder = array( '%d', '%s', '%d' );

		/**
		 * Get the highest value for the order
		 */
		$order = $this->getMappingValuesHighestOrder( $wpdb );

		if ( empty( $order ) ) {
			$order = 1;
		} else {
			$order ++;
		}

		$mapping_values['order']      = $order;
		$mapping_values_placeholder[] = '%d';
		// Check path emptiness

		if ( ! empty( $item['path'] ) ) {
			$permalink_path = $this->getObjectPermalinkPathByValue( $value );

			if ( ! empty( $permalink_path ) ) {
				$mapping_values['value_permalink_path'] = $path;
				$mapping_values_placeholder[]           = '%s';
			}
        }
		$permalink_path = !empty($mapping_values['value_permalink_path']) ? $mapping_values['value_permalink_path'] : '';
		$exists = DMS_Helper::checkMappingExistance( $wpdb, $mapping_values['host_id'], $mapping_values['value'], $mapping_values['primary'], $permalink_path );
		if ( ! $exists ) {
			$ok_values = $wpdb->insert( $wpdb->prefix . 'dms_mapping_values', $mapping_values, $mapping_values_placeholder );
			// Check for successful insert
			if ( empty( $ok_values ) ) {
				return 0;
			}
		}

		return 1;
	}

	/**
	 * Single mapping insert
	 *
	 * @param $value
	 * @param $item
	 * @param $host_id
	 * @param $ok_values
	 *
	 * @return int
	 */
	public function prepareMappingInsert(
		$value,
		$item,
		$host_id,
		&$ok_values = null
	) {
		$wpdb                       = $this->wpdb;
		$isPrimary                  = ! empty( $item['mappings']['primary'] ) && $item['mappings']['primary'] === $value;
		$mapping_values             = array(
			'host_id' => $host_id,
			'value'   => $value,
			'primary' => (int) ( $this->dms_fs->can_use_premium_code__premium_only() && $isPrimary )
		);
		$mapping_values_placeholder = array(
			'%d',
			'%s',
			'%d'
		);
		/**
		 * Get the highest value for the order
		 */
		$order = $this->getMappingValuesHighestOrder( $wpdb );
		if ( empty( $order ) ) {
			$order = 1;
		} else {
			$order ++;
		}
		$mapping_values['order']      = $order;
		$mapping_values_placeholder[] = '%d';
		// Check path emptiness
		if ( ! empty( $item['path'] ) ) {
			$permalink_path = $this->getObjectPermalinkPathByValue( $value );
			if ( ! empty( $permalink_path ) ) {
				$mapping_values['value_permalink_path'] = trim( $this->getObjectPermalinkPathByValue( $value ), '/' );
				$mapping_values_placeholder[]           = '%s';
			}
		}
        $permalink_path = !empty($mapping_values['value_permalink_path']) ? $mapping_values['value_permalink_path'] : '';
		$exists = DMS_Helper::checkMappingExistance( $wpdb, $mapping_values['host_id'], $mapping_values['value'], $mapping_values['primary'], $permalink_path );
		if ( ! $exists ) {
			$ok_values = $wpdb->insert( $wpdb->prefix . 'dms_mapping_values', $mapping_values, $mapping_values_placeholder );
			// Check for successful insert
			if ( empty( $ok_values ) ) {
				return 0;
			}
		}

		return 1;
	}

	/**
	 * Get the highest order
	 *
	 * @param  null  $wpdb
	 *
	 * @return mixed
	 */
	public function getMappingValuesHighestOrder( $wpdb = null ) {
		if ( empty( $wpdb ) ) {
			global $wpdb;
		}

		return $wpdb->get_var( "SELECT MAX(`order`) FROM `" . $wpdb->prefix . "dms_mapping_values` mv" );
	}

	/**
	 * Hook after post saving.
	 * Then check weather we have mapping with category connected with that post
	 *
	 * @param  string  $new_status
	 * @param  string  $old_status
	 * @param  WP_Post  $post
	 */
	public static function hookAfterSavePost( $new_status, $old_status, $post ) {
		$DMS = self::getInstance();
		// Check only insert case
		if ( $DMS->dms_fs->can_use_premium_code__premium_only() ) {
			// Check with published status
			if ( $new_status === 'publish' ) {
				global $wpdb;
				$post_type                  = $post->post_type;
				$dms_archive_global_mapping = get_option( 'dms_archive_global_mapping' );
				if ( ! empty( $dms_archive_global_mapping ) ) {
					/**
					 * Check for native posts
					 */
					if ( $post_type == 'post' ) {
						$category_support = get_option( 'dms_use_categories' ) === 'on';
						if ( $category_support ) {
							$terms = wp_get_post_terms( $post->ID, 'category' );
						}
					} else {
						// Check for custom posts with archive mapping
						$archive_support = get_option( "dms_use_{$post_type}_archive" ) === 'on';
						$terms           = array();
						if ( $archive_support ) {
							$custom_post_taxonomies = get_object_taxonomies( [ 'post_type' => $post_type ] );
							if ( ! empty( $custom_post_taxonomies ) ) {
								foreach ( $custom_post_taxonomies as $tax ) {
									$tax = get_taxonomy( $tax );
									if ( ! empty( $tax ) && $tax->public && $tax->publicly_queryable ) {
										$tmp_terms = wp_get_post_terms( $post->ID, $tax->name );
										if ( is_array( $tmp_terms ) ) {
											$terms = array_merge( $terms, $tmp_terms );
										}
									}
								}
							}
						}
					}
					// Loop through collected terms
					if ( ! empty( $terms ) ) {
						if ( ! empty( $category_support ) ) {
							foreach ( $terms as $term ) {
								// Break at first match
								$matchingMapping = DMS_Helper::getMatchingHostByValue( $DMS->wpdb, 'category-' . $term->slug );
								if ( ! empty( $matchingMapping->host ) ) {
									break;
								}
							}
						} elseif ( ! empty( $archive_support ) ) {
							foreach ( $terms as $term ) {
								// Break at first match
								$matchingMapping = DMS_Helper::getMatchingHostByValue( $DMS->wpdb, implode( '#', array( $term->taxonomy, $term->slug, $post_type ) ) );
								if ( ! empty( $matchingMapping->host ) ) {
									break;
								}
							}
						}
						if ( ! empty( $matchingMapping->host ) ) {
							// Insert new mapping for that post
							$DMS->prepareMappingInsert( $post->ID, [ 'path' => ( ! empty( $matchingMapping->path ) ? $matchingMapping->path : null ) ], $matchingMapping->host_id );

							return;
						}
					}
				}
				/**
				 * Check for products with shop
				 */
				$dms_woo_shop_global_mapping = get_option( 'dms_woo_shop_global_mapping' );
				if ( ! empty( $dms_woo_shop_global_mapping ) && $post_type == 'product' && ! empty( wc_get_product( $post->ID ) ) ) {
					$shop_page_association = DMS_Helper::getShopPageAssociation();
					$matchingMapping       = DMS_Helper::getMatchingHostByValue( $DMS->wpdb, $shop_page_association );
					if ( ! empty( $matchingMapping ) ) {
						// Insert new mapping for that post
						$DMS->prepareMappingInsert( $post->ID, [ 'path' => ( ! empty( $matchingMapping->path ) ? $matchingMapping->path : null ) ], $matchingMapping->host_id );
					}
				}
			}
		}
	}

	/**
	 * Get native permalink's path for the mapping value.
	 *
	 * @return array|false|string|string[]|WP_Error|null
	 */
	public function getObjectPermalinkPathByValue( $value ) {
		// Remove filters to get clear permalinks at this stage
		DMS_Helper::removeKnownPermalinkFilters();
		if ( is_numeric( $value ) ) {
			$permalink = get_permalink( $value );
		} else {
			if ( $this::isTaxonomyTerm( $value ) ) {
				$term_taxonomy = $this::getTaxonomyTermFromValue( $value );
				$permalink     = get_term_link( $term_taxonomy[1], $term_taxonomy[0] );
			}
		}
		if ( ! empty( $permalink ) && is_string( $permalink ) ) {
			$permalink_path = str_replace( home_url(), '', $permalink );
		} else {
			$permalink_path = null;
		}

		return $permalink_path;
	}

	/**
	 * Check if value is taxonomy/term
	 *
	 * @param $value
	 *
	 * @return bool
	 */
	public static function isTaxonomyTerm( $value ) {
		if ( strpos( $value, 'category-' ) === 0 || strpos( $value, 'term_' ) === 0 ) {
			return true;
		} elseif ( strpos( $value, '#' ) > 1 ) {
			$value_arr = explode( '#', $value );

			return count( $value_arr ) >= 2 && taxonomy_exists( $value_arr[0] )
			       && term_exists( $value_arr[1], $value_arr[0] );
		}

		return false;

	}

	/**
	 * Get taxonomy and term as array.
	 * Note this needs to be called only in case $value is checked dms-mapping-value which really contains
	 *
	 * @param $value
	 *
	 * @return false|string[]
	 */
	public static function getTaxonomyTermFromValue( $value ) {
		if ( strpos( $value, '#' ) > 1 ) {
			return explode( '#', $value );
		} elseif ( str_starts_with( $value, 'term' ) ) {
            $term_id = ltrim($value, 'term_');
            $term = get_term($term_id);

            return array( $term->taxonomy, $term->slug );
        } else {
			// Category related
			$category = substr( $value, 9 );

			return array( 'category', $category );
		}
	}

	/**
	 * Get posts by taxonomy term
	 *
	 * @param  string  $taxonomy
	 * @param  int  $term_id
	 *
	 * @return int[]|WP_Post[]
	 */
	public static function getPostsByTaxonomyTermId( $taxonomy, $term_id ) {
		return get_posts( [
			'numberposts' => - 1,
			'post_status' => 'publish',
			'post_type'   => 'any',
			'fields'      => 'ids',
			'tax_query'   => array(
				array(
					'taxonomy'         => $taxonomy,
					'field'            => 'term_id',
					'terms'            => $term_id,
					'include_children' => false
				)
			)
		] );
	}

	/**
	 * Get all woocommerce products
	 *
	 * @return array|stdClass
	 */
	public static function getAllWooProducts() {
		return get_posts( array(
			'post_type'   => 'product',
			'numberposts' => - 1,
			'post_status' => 'publish',
			'fields'      => 'ids',
		) );
	}

	/**
	 * Adds Admin Options Page
	 *
	 * @return void
	 */
	public static function adminMenu() {
		$instance = self::getInstance();
		$page     = add_menu_page( __( 'Domain Mapping', $instance->plugin_name ), __( 'Domain Mapping', $instance->plugin_name ), 'manage_options', $instance->plugin_name, array(
			'DMS',
			'includeTemplate'
		), 'dashicons-admin-site-alt3' );
		add_action( 'admin_print_styles-' . $page, array( 'DMS', 'registerStyles' ) );
		add_action( 'admin_print_scripts-' . $page, array( 'DMS', 'registerScripts' ) );
	}

	/**
	 * Include DMS Option Template
	 *
	 * @return void
	 */
	public static function includeTemplate() {
		$instance = self::getInstance();
		$dms_fs   = $instance->dms_fs;
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'You do not have the permissions to access this page.' ) );
		}
		require_once $instance->plugin_dir . '/templates/option-page.php';
	}

	/**
	 * Start session when our page requested
	 * Will be used mainly for showing error message to user
	 */
	private function startSession() {
		if ( empty( session_id() ) && get_admin_page_parent() == $this->plugin_name ) {
			session_start();
		}
	}

	/**
	 * Show admin notice in case of existence. Check based on session 'dms_admin_warning'
	 */
	public function showAdminNotice() {
		if ( ! empty( $_SESSION['dms_admin_warning'] ) ) {
			foreach ( $_SESSION['dms_admin_warning'] as $warning ) {
				?>
                <div class="notice notice-warning is-dismissible">
                    <p><?= wp_kses( $warning, array(
							'br' => array(),
							'u'  => array(),
							'b'  => array(),
							'a'  => array( 'href' => array(), 'target' => array() )
						) ); ?></p>
                </div>
				<?php
			}
			unset( $_SESSION['dms_admin_warning'] );
		}
		if ( ! empty( $_SESSION['dms_admin_error'] ) ) {
			foreach ( $_SESSION['dms_admin_error'] as $warning ) {
				?>
                <div class="notice notice-error is-dismissible">
                    <input type="hidden" name="sunrise">
                    <p><?= wp_kses( $warning, array(
							'br'   => array(),
							'u'    => array(),
							'b'    => array(),
							'pre'  => array(),
							'code' => array(),
							'a'    => array( 'href' => array(), 'target' => array() )
						) ); ?></p>
                </div>
				<?php
			}
			unset( $_SESSION['dms_admin_error'] );
		}
		if ( ! empty( $_SESSION['dms_admin_success'] ) ) {
			foreach ( $_SESSION['dms_admin_success'] as $success ) {
				?>
                <div class="notice notice-success is-dismissible">
                    <p><?= wp_kses( $success, array(
							'br' => array(),
							'u'  => array(),
							'b'  => array(),
							'a'  => array( 'href' => array(), 'target' => array() )
						) ); ?></p>
                </div>
				<?php
			}
			unset( $_SESSION['dms_admin_success'] );
		}
		session_write_close();
	}

	/**
	 * Register & enqueue CSS
	 */
	public static function registerStyles() {
		$instance = self::getInstance();
		wp_register_style( 'dms-min-css', $instance->plugin_url . 'assets/css/dms.min.css', array(), $instance->version, 'all' );
		wp_enqueue_style( 'dms-min-css' );
	}

	/**
	 * Register & enqueue JS
	 */
	public static function registerScripts() {
		$instance = self::getInstance();
		$dms_fs   = $instance->dms_fs;
		// Fetch translations for js files
		$translations = include_once $instance->plugin_dir . 'assets/js/localizations/js-translations.php';
		/**
		 * Collect data to localize
		 * translations for JS
		 * premium flag
		 */
		$dms_fs_data = array(
			'nonce'               => wp_create_nonce( 'dms_nonce' ),
			'scheme'              => DMS_Helper::getScheme(),
			'ajax_url'            => admin_url( 'admin-ajax.php' ),
			'translations'        => $translations,
			'is_premium'          => (int) $instance->dms_fs->can_use_premium_code__premium_only(),
			'upgrade_url'         => $dms_fs->get_upgrade_url(),
			'values_per_mapping' => get_option( 'dms_values_per_mapping', 5 )
		);
		if ( $instance->dms_fs->can_use_premium_code__premium_only() ) {
			// Load media library
			wp_enqueue_media();
		}
		// Register main js dependencies
		// Woo is using same js, that is why deregister first to avoid conflicts
		wp_deregister_script( 'select2' );
		// Deregister another script used by woo, which causes issues
		wp_deregister_script( 'wc-enhanced-select' );
		wp_register_script( 'select2', $instance->plugin_url . 'assets/js/select2.full.min.js', array(
			'jquery'
		), $instance->version );
		wp_register_script( 'dms-js', $instance->plugin_url . 'assets/js/dms.js', array(
			'jquery'
		), $instance->version );
		wp_enqueue_script( 'select2' );
		wp_enqueue_script( 'dms-js' );
		// Include js data into dms-js
		wp_localize_script( 'dms-js', 'dms_fs', $dms_fs_data );

		// Dequeue Wc Vendors Pro js file to avoid from conflicts
        wp_dequeue_script( 'wcv-admin-js' );
	}

	/**
	 * Set current HTTP_HOST
	 */
	private function setCurrentDomain() {
		if ( empty( $this->domain ) ) {
			$url_parsed = ! empty( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( $_SERVER['REQUEST_URI'] ) : null;
			// Store up query existence
			if ( ! empty( $url_parsed['query'] ) ) {
				//TODO according to earlier logic query string use case if only connected with PRO version. But what is under it ??
				$this->query_string = $url_parsed['query'];
			}
			// Store up uri path
			if ( ! empty( $url_parsed['path'] ) ) {
				$this->path = trim( $url_parsed['path'], '/' );
				/**
				 * Check if pagination exists and exclude it from the link
				 * Check matching pagination
				 */
				if ( preg_match( '/page\/([0-9]{1,})\/?$/', $this->path, $matches ) ) {
					$this->pagination_path = trim( $matches[0], '/' );
					$this->path            = trim( preg_replace( '/page\/([0-9]{1,})\/?$/', '', $this->path, 1 ), '/' );
				}
			}
			// Set up host/domain
			$this->domain = ! empty( $_SERVER['HTTP_HOST'] ) ? trim( $_SERVER["HTTP_HOST"], '/' ) : ( ! empty( $_SERVER['SERVER_NAME'] ) ? trim( $_SERVER["SERVER_NAME"], '/' ) : null );
		}
	}

	/**
	 * Set base HTTP_HOST
	 */
	private function setBaseHttpHost() {
		if ( empty( $this->base_host ) ) {
			$this->base_host = DMS_Helper::getBaseHost();
		}
	}

	/**
	 * DMS Magic
	 *
	 * Checks if current host is set to a certain wordpress object (page/post/category/etc ...).
	 * Call only for primary mapped object
	 *
	 * @param  mixed  $pageID
	 */
	private function map( $pageID ) {
		/*
		 * If $pageID is numeric, it is a Page, Post or CPT ID.
		 * Thus, we configure the query_post arguments to the single object.
		 */
		if ( is_numeric( $pageID ) ) {
			if ( ! empty( $_GET['s'] ) ) {
				$this->is_search = true;
				$args            = array(
					'p' => $pageID
				);
				query_posts( $args );

				return;
			}
			$postType = get_post_type( $pageID );
			if ( $postType != 'page' ) {
				$args = array(
					'post_type' => $postType,
					'p'         => $pageID
				);
			} else {
				$this->woo_shop_page_id = DMS_Helper::getShopPageAssociation();
				if ( $pageID == $this->woo_shop_page_id ) {
					$this->is_woo_shop = true;
				} else {
					$args = array(
						'page_id' => $pageID
					);
				}
			}
			if ( ! empty( $args ) ) {
				query_posts( $args );
			}
		} else {
			/**
			 * If $pageID is NOT numeric, then it is taxonomy-term
			 * either category with '-' separator or custom taxonomy '#' separator.
			 */
			$taxonomy_term = $this::getTaxonomyTermFromValue( $pageID );
			if ( ! empty( $taxonomy_term ) ) {
				if ( $taxonomy_term[0] === 'category' ) {
					$args = array(
						'category_name' => $taxonomy_term[1]
					);
					query_posts( $args );
				} elseif( $term = get_term_by('slug', $taxonomy_term[1], $taxonomy_term[0] ) ){
					$args = array(
						'tax_query' => array(
							array(
								'taxonomy' => $term->taxonomy,
								'field'    => 'term_id',
								'terms'    => $term->term_id,
							),
						),
					);
					$this->mapping_term = $term;
                    query_posts($args);
				} else {
					$this->taxonomy_term_requested = array(
						'taxonomy'    => $taxonomy_term[0],
						'term'        => $taxonomy_term[1],
						'custom_post' => $taxonomy_term[2],
					);
					$this->is_tax                  = true;
				}
			}
		}
	}

	/**
	 * Get clean array of CPT
	 *
	 * @return array
	 */
	public static function getCustomPostTypes() {
		$DMS = DMS::getInstance();
		$types      = get_post_types( array(
			'public'   => true,
			'_builtin' => false
		), 'objects' );
		$cleanTypes = array();
		foreach ( $types as $singular => $item ) {
			$cleanType = array(
				'name'        => $item->query_var,
				'label'       => $item->labels->name,
				'has_archive' => $item->has_archive
			);
			if ( $DMS->dms_fs->can_use_premium_code__premium_only() ) {
				$taxonomies = get_object_taxonomies( $singular, 'objects' );
				if ( ! empty( $taxonomies ) ) {
					foreach ( $taxonomies as $taxonomy ) {
						if ( $taxonomy->public && $taxonomy->publicly_queryable ) {
							$cleanType['taxonomies'][] = [
								'name'  => $taxonomy->name,
								'label' => $taxonomy->label,
							];
						}
					}
				}

			}
			$cleanTypes[] = $cleanType;
		}


		return $cleanTypes;
	}

	/**
	 * Remove "paged=1" query string ( as it is done in redirect_canonical method of wp ).
	 * This will work only in case we have tax mapping to domain without path.
	 */
	public function removePagedOneQueryParam() {
		global $wp_query;
		if ( $wp_query->get( 'paged' ) == 1 ) {
			$this->query_string = remove_query_arg( 'paged', $this->query_string );
			$this::redirectTo( $this->domain, $this->path, null, $this->query_string, $this->pagination_path );
		}
	}

	/**
	 * Remove path from query string
	 * This will work only in case we have search
	 */
	public function removePathOneQueryParam() {
		if ( $this->is_search ) {
			$this::redirectTo( $this->domain, null, null, $this->query_string, $this->pagination_path );
		}
	}

	/**
	 * Force redirects in case flag is enabled. Will redirect to the mapped domain in case
	 * requested object matches with the saved map item
	 */
	public static function forceRedirect() {
		global $wp_query;
		$DMS = self::getInstance();
		/**
		 * Check if premium
		 * Also check if elementor-preview page isn't requested, to not break elementor's job
		 */
		if ( $DMS->dms_fs->can_use_premium_code__premium_only() && ! isset( $_GET['elementor-preview'] ) ) {
			// Check force flag
			if ( empty( get_option( 'dms_force_site_visitors' ) ) ) {
				return;
			}
			// If current page has mapped parent and "short child page urls" mode is turned on force redirect without parent slug
			if ( $DMS->short_child_page_urls && is_page() && $mapped_parent = DMS_Helper::hasMappedParent( $DMS->wpdb ) ) {
				$primary_mapping_path = DMS_Helper::getPrimaryParentMappingPath( $DMS->wpdb, $mapped_parent[0]['id'] );
				if ( $primary_mapping_path ) {
					$current_path         = explode( '/', trim( wp_parse_url( get_the_permalink(), PHP_URL_PATH ), '/' ) );
					$primary_mapping_path = explode( '/', $primary_mapping_path );
					$difference           = implode( '/', ( array_diff( $current_path, $primary_mapping_path ) ) );
					$difference = ! empty( $mapped_parent[0]['path'] ) ? $mapped_parent[0]['path'] . '/' . $difference : $difference;
					if ( $DMS->domain . '/' . $DMS->path !== $mapped_parent[0]['host'] . '/' . $difference ) {
						self::redirectTo( $mapped_parent[0]['host'], $difference );
					}
				}
			}
			// Set vars
			$dms_global_mapping = get_option( 'dms_global_mapping' );
			// Check if we open the page not from the main domain, then do nothing
			if ( $DMS->domain !== $DMS->base_host && ! DMS_Helper::isSubDirectoryInstall() ) {
				return;
			}
			// Get queried object
			if ( is_category() ) {
				$key = 'category-' . $wp_query->get_queried_object()->slug;
			} elseif ( is_single() || is_page() ) {
				$key = $wp_query->get_queried_object_id();
			} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
				$key = DMS_Helper::getShopPageAssociation();
			} else {
				global $wp_taxonomies;
				$custom_post_type = ! empty( $wp_query->get_queried_object()->taxonomy ) && isset( $wp_taxonomies[ $wp_query->get_queried_object()->taxonomy ] )
					? $wp_taxonomies[ $wp_query->get_queried_object()->taxonomy ]->object_type : null;
				if ( $wp_query->is_tax && ! empty( $custom_post_type[0] ) ) {
					$term = $wp_query->get_queried_object();
					if ( $mappings = DMS_Helper::getMappingsByValue( $DMS->wpdb, 'term_' . $term->term_id ) ) {
						$path = ! empty( $mappings[0]['path'] ) ? $mappings[0]['path'] . '/' . $DMS->path : $DMS->path;
						self::redirectTo( $mappings[0]['host'], $path );
					}
					$key = implode( '#', [
						$wp_query->get_queried_object()->taxonomy,
						$wp_query->get_queried_object()->slug,
						$custom_post_type[0]
					] );
				}
			}
			/**
			 * Check queried object emptiness
			 * If empty it is empty and gdm is active then redirect to it
			 * if no then do nothing
			 * if no then check exact mapping
			 * if found point to it, otherwise point to main domain, otherwise do nothing
			 */
			if ( empty( $key ) ) {
				if ( ! empty( $dms_global_mapping ) ) {
					$main_mapping = $DMS->getMainMapping();
					$host         = ! empty( $main_mapping->host ) ? $main_mapping->host : null;
					$path         = ! empty( $main_mapping->path ) ? $main_mapping->path : null;
					if ( ! empty( $host ) ) {
						$match = true;
					} else {
						return;
					}
				} else {
					return;
				}
			} else {
				// Loop through mappings, and find the match
				$mapping = DMS_Helper::getMatchingHostByValue( $DMS->wpdb, $key );
				$host    = ! empty( $mapping->host ) ? $mapping->host : null;
				$path    = ! empty( $mapping->path ) ? $mapping->path : null;
				$match   = ! empty( $host );
				/**
				 * If there is no match then check global mapping flag
				 * and redirect to main domain
				 */
				if ( ! empty( $dms_global_mapping ) && ! $match ) {
					$main_mapping = $DMS->getMainMapping();
					$host         = ! empty( $main_mapping->host ) ? $main_mapping->host : null;
					$path         = ! empty( $main_mapping->path ) ? $main_mapping->path : null;
					$match        = ! empty( $host );
					if ( is_front_page() ) {
						// Special front page case, when there native path is empty 
						// then we need to get slug of connected page
						$DMS->path = ! empty( $wp_query->post ) && ! empty( $wp_query->post->post_name ) ? $wp_query->post->post_name : $DMS->path;
					}
				}
				/**
				 * If there is no match then do not redirect
				 */
				if ( ! $match && is_single() && $cptMapping = DMS_Helper::isMappedCPT( $key ) ) {
					$host  = $cptMapping['host'];
					$match = true;
				} elseif ( ! empty( $DMS->getMatch() ) ) {
					$match = false;
				}
			}
			if ( DMS_Helper::isSubDirectoryInstall() && strpos( $DMS->path, (string) $path ) === false ) {
				$subdirectory = DMS_Helper::getBasePath();
				if ( strripos( $DMS->path, $subdirectory ) !== false ) {
					$DMS->path = substr_replace( $DMS->path, '', strripos( $DMS->path, $subdirectory ), strlen( $subdirectory ) + 1 );
				}
			}
			/**
			 * Check conditions
			 * Matching ok, mapped link existence, requested the original website url is true
			 * Means we open the link from the main site url
			 * Do redirect mapped one
			 */
			if ( $match && ( ( ! empty( $path ) && strpos( $DMS->path, (string) $path ) === false ) || empty( $path ) ) ) {
				self::redirectTo( $host, $path, $DMS->path, $DMS->query_string, $DMS->pagination_path );
			}
		}
	}

	/**
	 * Get matching domain by post slug
	 *
	 * @param  string  $post_name
	 *
	 * @return array|object|void|null
	 * @since 1.6
	 */
	public function getMatchingHostByPostName( $post_name ) {
		$wpdb = $this->wpdb;

		return $wpdb->get_row( $wpdb->prepare( "SELECT `host`, `path` FROM `" . $wpdb->prefix . "dms_mapping_values` mv
	    INNER JOIN `" . $wpdb->prefix . "dms_mappings` m on mv.host_id=m.id
	    INNER JOIN `" . $wpdb->posts . "` p ON mv.value=p.ID
	    WHERE mv.value_permalink_path IS NULL AND p.post_status='publish' AND p.post_name=%s", $post_name ) );
	}

	/**
	 * Prevent redirection to base domain in case mapped domain requested without path.
	 * Will work only if front page requested and mapped domain is connected with front page as primary
	 *
	 * @param  string  $redirectTo
	 * @param  string  $redirectFrom
	 *
	 * @return string|false
	 */
	public static function preventHomeRedirect( $redirectTo, $redirectFrom ) {
		$DMS = self::getInstance();
		if ( ( $DMS->domain_path_match || $DMS->is_main_mapping_with_path ) && is_front_page() ) {
			return false;
		}

		return $redirectTo;
	}

	/**
	 * Method connected with wp_head with very late priority(99),
	 * which make sures that yoast changes ended. Then Rewrites back the initial global post var,
	 * which was stored in global $wp_query at the very beginning of our match.
	 * todo also prepare something for Yoast page title change fix, mainly for all meta tags left by Yoast.
	 * Cause in case empty path mapping, Yoast prepares metas for homepage.
	 */
	public static function postRewriteBack() {
		$DMS = self::getInstance();
		// Check if Yoast is active
		if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
			global $wp_query, $post;
			// Check if values are not equal
			if ( ( $DMS->domain_path_match || $DMS->is_main_mapping_with_path )
			     && ! empty( $wp_query->post )
			     && $wp_query->post instanceof WP_Post
			     && $post instanceof WP_Post
			     && $post->ID !== $wp_query->post->ID ) {
				// Setup post data back
				$post = $wp_query->post;
				setup_postdata( $post );
			}
		}
	}

	/**
	 * This method designed to specify the right data to be loaded in case of custom taxonomy mapping (with empty path)
	 *
	 * @param  WP_Query  $query
	 */
	public static function preGetPosts( $query ) {
		if ( ! is_admin() ) {
			$instance = self::getInstance();
			if ( $query->is_main_query() ) {

				if ( $instance->is_tax ) {
					// Disable the flag to avoid second entrance to this method
					$instance->is_tax = false;
					// Replace tax and term values
					// Consider woo related logic and also other cpt logic
					// TODO try to include additional tax query regarding woo products that needs to be removed. In order to do var_dump global query in "wp" action 
					$query->is_single   = false;
					$query->is_page     = false;
					$query->is_home     = false;
					$query->is_singular = false;
					$query->is_tax      = true;
					$query->is_archive  = true;
					$query->set( 'page_id', false );
					$query->set( 'post_type', $instance->taxonomy_term_requested['custom_post'] );
					if ( $instance->taxonomy_term_requested['custom_post'] == 'product' ) {
						$query->set( 'wc_query', 'product_query' );
					}
					$query->set( $instance->taxonomy_term_requested['taxonomy'], $instance->taxonomy_term_requested['term'] );
					$query->set( 'tax_query', array(
						array(
							'taxonomy'         => $instance->taxonomy_term_requested['taxonomy'],
							'field'            => 'slug',
							'terms'            => $instance->taxonomy_term_requested['term'],
							'include_children' => true,
							'operator'         => 'IN'
						)
					) );
					// Check if our custom path applied
					// and empty the generated query array and name/page vars
					if ( ! empty( $instance->path ) ) {
						$query->set( 'name', '' );
						$query->set( 'page', '' );
						$query->set( 'pagename', '' );
						$query->query = [];
					}
					// Prevent canonical redirect because it will include the real domain
					add_filter( 'redirect_canonical', '__return_false' );
					// Exclude paged query param in case it equal to 1
					// the below functionality done, because we have missed it by preventing the canonical redirect
					add_action( 'template_redirect', array( $instance, 'removePagedOneQueryParam' ) );
				} elseif ( $instance->is_woo_shop ) {
					$query->set( 'post_type', 'product' );
					$query->set( 'page_id', '' );
					$query->is_attachment        = false;
					$query->is_singular          = false;
					$query->is_home              = false;
					$query->is_single            = false;
					$query->is_page              = false;
					$query->is_post_type_archive = true;
					$query->is_archive           = true;
					$query->is_404               = false;
					$query->set( 'wc_query', 'product_query' );
					$query->set( 'error', '' );
					// Check if our custom path applied
					// and empty the generated query array and name/page vars
					if ( ! empty( $instance->path ) ) {
						$query->set( 'attachment', '' );
						$query->set( 'name', '' );
						$query->set( 'page', '' );
						$query->set( 'pagename', '' );
						$query->set( 'category_name', '' );
						$query->query = [];
					}
					// Prevent canonical redirect because it will include the real domain
					if ( empty( $instance->path ) ) {
						// Exclude paged query param in case it equal to 1
						// the below functionality done, because we have missed it by preventing the canonical redirect
						add_filter( 'redirect_canonical', '__return_false' );
						add_action( 'template_redirect', array( $instance, 'removePagedOneQueryParam' ) );
					}
				} elseif ( $instance->is_search ) {
					$query->is_attachment        = false;
					$query->is_singular          = false;
					$query->is_home              = false;
					$query->is_single            = false;
					$query->is_page              = false;
					$query->is_search            = true;
					$query->is_post_type_archive = false;
					$query->is_archive           = false;
					$query->is_404               = false;
					$query->set( 'attachment', '' );
					$query->set( 'name', '' );
					$query->set( 'page', '' );
					$query->set( 'pagename', '' );
					$query->set( 'category_name', '' );
					$query->query = [];
					add_filter( 'redirect_canonical', '__return_false' );
					add_action( 'template_redirect', array( $instance, 'removePathOneQueryParam' ) );
				}
			}
		}
	}

	/**
	 * Runs when query variable object is ready , but before query is executed.
	 * This way we can check if the queried object is mapped or no.
	 * Note: this needs to work only if domain matches and path exists
	 *
	 * @param  WP  $wp
	 */
	public static function catchQueriedObject( $wp ) {
		global $wp_query;
		$DMS = self::getInstance();
		if ( $DMS->domain_path_match || $DMS->is_main_mapping_with_path ) {
			// Check if queried object is mapped in our side
			$global_mapping_on = ! empty( get_option( 'dms_global_mapping' ) );
			if ( is_category() ) {
				$key       = 'category-' . $wp_query->get_queried_object()->slug;
				$link      = get_term_link( $wp_query->get_queried_object()->term_id, 'category' );
				$object_id = $wp_query->get_queried_object()->term_id;
			} elseif ( is_single() || is_page() || is_home() ) {
				$key       = $wp_query->get_queried_object_id();
				$link      = get_permalink( $key );
				$object_id = $key;
			} elseif ( $DMS->is_woo_shop || ( function_exists( 'is_shop' ) && is_shop() ) ) {
				$key       = $DMS->is_woo_shop ? $DMS->woo_shop_page_id : DMS_Helper::getShopPageAssociation();
				$link      = get_permalink( $key );
				$object_id = $key;
			} else {
				// Check custom term/taxonomy existence
				if ( ! empty( $DMS->taxonomy_term_requested ) ) {
					$key       = implode( '#', $DMS->taxonomy_term_requested );
					$link      = get_term_link( $DMS->taxonomy_term_requested['term'], $DMS->taxonomy_term_requested['taxonomy'] );
					$term      = get_term_by( 'slug', $DMS->taxonomy_term_requested['term'], $DMS->taxonomy_term_requested['taxonomy'] );
					$object_id = $term->term_id ?? null;
				} elseif ( empty( $DMS->mapping_term ) ) {
					global $wp_taxonomies;
					$custom_post_type = ! empty( $wp_query->get_queried_object()->taxonomy ) && isset( $wp_taxonomies[ $wp_query->get_queried_object()->taxonomy ] )
						? $wp_taxonomies[ $wp_query->get_queried_object()->taxonomy ]->object_type : null;
					if ( $wp_query->is_tax && ! empty( $custom_post_type[0] ) ) {
						$key       = implode( '#', [
							$wp_query->get_queried_object()->taxonomy,
							$wp_query->get_queried_object()->slug,
							$custom_post_type[0]
						] );
						$link      = get_term_link( $wp_query->get_queried_object()->term_id, $wp_query->get_queried_object()->taxonomy );
						$object_id = $wp_query->get_queried_object()->term_id;
					}
				}
			}
			// Store for later use
			if ( ! empty( $key ) && ! empty( $link ) ) {
				$DMS->real_requested_object      = $key;
				$DMS->real_requested_object_link = $link;
				$DMS->real_requested_object_id   = $object_id ?? null;
			}
			// Check path emptiness
			if ( ! empty( $DMS->path ) && $DMS->domain_path_match ) {
				// Check possible scenarios
				if ( empty( $key ) ) {

					/**
					 * Nothing found by that path
					 * Move to main domain first if premium
					 * Is free show not found
					 */
					if ( $DMS->dms_fs->can_use_premium_code__premium_only() && $global_mapping_on ) {
						$main_mapping = $DMS->getMainMapping();
						if ( ! empty( $main_mapping->host )
						     && $DMS->domain != $main_mapping->host
						     && !empty( $main_mapping->path )
						     && strpos( $DMS->path, (string) $main_mapping->path ) !== 0
                             && !$DMS->mapping_term ) {
							self::redirectTo( $main_mapping->host, $main_mapping->path, null, $DMS->query_string, $DMS->pagination_path );
						}
					}
					if ( empty( $DMS->mapping_term ) ) {
						$wp_query->set_404();
						status_header( 404 );
					}
				} elseif ( $DMS->dms_fs->can_use_premium_code__premium_only() && $key == $DMS->map[0]['primary']
				           && ! is_null( $DMS->map[0]['path'] )
				           && ( $DMS->map[0]['path'] === '' || strpos( $DMS->path, (string) $DMS->map[0]['path'] ) === 0 )
				           && $DMS->path != $DMS->map[0]['path'] ) {
					/**
					 * Found by that path and equal to matching domain primary value
					 * So redirect to matching domain without real path
					 * by checking if real path is not equal to path
					 * if there is no real path, and we left only mapping path , then it is ok
					 */
					self::redirectTo( $DMS->domain, $DMS->map[0]['path'], '', $DMS->query_string, $DMS->pagination_path );
				} else {
					// Check most matching host
					$mapping = DMS_Helper::getMatchingHostByAllParams( $DMS->wpdb, $key, $DMS->path, $DMS->domain );
					if ( ! empty( $mapping->host ) ) {
						/**
						 * $key exists and matches with mapping value
						 * alongside with mapping host and mapping path
						 * then do nothing
						 */
						$DMS->active_mapping = $mapping;
					} else {
						$mapping = DMS_Helper::getMatchingHostByValue( $DMS->wpdb, $key );
						/**
						 * $key exists and matches with mapping value
						 * but domain not matches with mapping host and mapping path
						 * then redirect to the matched domain with path
						 */
						if ( ! empty( $mapping->host ) ) {
							// Here we need to avoid including dms->path into redirect, instead leave this to work with empty path
							self::redirectTo( $mapping->host, $mapping->path, '', $DMS->query_string, $DMS->pagination_path );
						} else {
							if ( ! DMS_Helper::isMappedCPT( $key ) ) {
								/**
								 * $key exists but don't match with mapped domain any values
								 * then check global mapping flag and premium enabled
								 * If yes then show with main domain.
								 * If mapped domain is not main domain then redirect to main
								 * Else do nothing
								 * Else show 404
								 */
								if ( $global_mapping_on && $DMS->dms_fs->can_use_premium_code__premium_only() ) {
									// Redirect to main domain
									$main_mapping = $DMS->getMainMapping();
									if ( ! empty( $main_mapping->host ) && $DMS->domain != $main_mapping->host ) {
										self::redirectTo( $main_mapping->host, $main_mapping->path, $DMS->path, $DMS->query_string, $DMS->pagination_path );
									}
									// Do nothing
									$DMS->active_mapping = $mapping;
								} else {
									$wp_query->set_404();
									status_header( 404 );
								}
							}
						}
					}
					// Check favicon existence
					$DMS->dms_favicon_id = ! empty( $mapping->attachment_id ) ? $mapping->attachment_id : null;
				}
			}
		} elseif ( $DMS->host_match && ! empty( $DMS->path ) ) {

			$wp_query->set_404();
			status_header( 404 );
		}
	}

	/**
	 * Used only inside this method for redirecting to main domain
	 *
	 * @param  string  $host
	 * @param  string|null  $path
	 * @param  string|null  $real_path
	 * @param  string|null  $query_string
	 * @param  string|null  $paged_path
	 */
	private static function redirectTo(
		$host,
		$path = null,
		$real_path = null,
		$query_string = null,
		$paged_path = null
	) {
		//TODO check this earlier, also note that is_ssl will check current domain ssl, and we are not sure about external website ssl
		$scheme     = is_ssl() ? 'https://' : 'http://';
		$path       = ! empty( $path ) ? $path . '/' : '';
		$real_path  = ! empty( $real_path ) ? $real_path . '/' : '';
		$paged_path = ! empty( $paged_path ) ? $paged_path . '/' : '';
		wp_redirect( $scheme . $host . '/' . $path . $real_path . $paged_path . ( ! empty( $query_string ) ? '?' . $query_string : '' ) );
		exit();
	}

	/**
	 * Get count of mappings
	 *
	 * @return string|null
	 */
	public function getMappingsCount() {
		$wpdb = $this->wpdb;

		return $wpdb->get_var( "SELECT COUNT(*) FROM `" . $wpdb->prefix . "dms_mappings`" );
	}

	/**
	 * Get mappings data
	 *
	 * @param  int  $item_per_page
	 * @param  null|int  $page
	 * @param  bool  $use_page_query
	 *
	 * @return array|object|null
	 * @since 1.6
	 */
	public function getData( $item_per_page = 10, $values_per_row = 5, $page = null, $use_page_query = false ) {
		global $wpdb;
		$page          = is_null( $page ) ? 1 : (int) $page;

		$offset = ( $page - 1 ) * $item_per_page;
		$limit  = $wpdb->prepare( "LIMIT %d, %d", $offset, $item_per_page );

		$count = $wpdb->get_var( "SELECT COUNT(id) FROM {$wpdb->prefix}dms_mappings" );

		$sql = $wpdb->prepare( "
        SELECT mappings.*,
        GROUP_CONCAT(mapping_values.value SEPARATOR ',') AS mapped_values,
        GROUP_CONCAT(mapping_values.primary SEPARATOR ',') AS primary_values
        FROM {$wpdb->prefix}dms_mappings AS mappings
        LEFT JOIN (SELECT *, ROW_NUMBER() OVER (PARTITION BY host_id ORDER BY `order` ASC) AS row_num
        FROM {$wpdb->prefix}dms_mapping_values) AS mapping_values ON mappings.id = mapping_values.host_id
        GROUP BY mappings.id " . $limit);

		$result = $wpdb->get_results( $sql );
		$archive_global_mapping         = get_option( 'dms_archive_global_mapping' );
		$woo_shop_global_mapping        = get_option( 'dms_woo_shop_global_mapping' );
		$dms_global_parent_page_mapping = get_option( 'dms_global_parent_page_mapping' );
		$global_parent_match            = false;
		$shop_page_association          = ! empty( $woo_shop_global_mapping ) ? DMS_Helper::getShopPageAssociation() : false;
        if (!empty($result)){
            foreach ($result as $key => $mapping){
                $values = [];
                if (!empty($mapping->mapped_values)){
                    $mapping_values = explode(',', $mapping->mapped_values);
                    $primary_values = explode(',', $mapping->primary_values);
	                $is_shop_mapping = in_array($shop_page_association, $mapping_values);
                    $primary = array_search(1, $primary_values);
                    unset($mapping->primary_values);
                    $mapping->primary = $mapping_values[$primary];

	                foreach ( $mapping_values as $map ) {
		                // Collect cats or archives
		                if ( DMS::isTaxonomyTerm( $map) ) {
			                // We consider that first we will get category, then related connection needs to be checked
			                $taxonomy_term = DMS::getTaxonomyTermFromValue( $map);
			                $values[]      = $map;
		                } elseif ( $shop_page_association == $map) {
			                $values[]           = $map;
		                } elseif ( ! empty( $dms_global_parent_page_mapping ) && DMS_Helper::isPagePostType( $map ) && count( get_post_ancestors( $map ) ) == 0 ) {
			                $global_parent_match = true;
			                $values[]            = $map;
		                } else {
			                if ( ! empty( $archive_global_mapping ) && ! empty( $taxonomy_term ) && has_term( $taxonomy_term[1], $taxonomy_term[0], $map) ) {
				                // Do nothing
			                } elseif ( ! empty( $woo_shop_global_mapping ) && ! empty( $is_shop_mapping ) && function_exists( 'wc_get_product' ) && ! empty( wc_get_product( $map) ) ) {
				                // Do nothing
			                } elseif ( ! empty( $dms_global_parent_page_mapping ) && ! empty( $global_parent_match ) && count( get_post_ancestors( $map ) ) != 0 ) {
				                // Do nothing
			                } else {
				                $values[] = $map;
			                }
		                }
	                }

	                $values                  = array_unique( $values );
	                $count_mappings          = count( $values );
	                $mapping_values          = array_splice( $values, 0, $values_per_row );
	                $mapping->mapped_values  = $mapping_values;
	                $mapping->total_mappings = $count_mappings;
                }
            }
        }

		// Retrieve full data
		return [
			'result' => $result,
			'count'  => $count
		];
	}

	/**
	 * Check if we have specified "host" in our mappings
	 *
	 * @param  string  $host
	 */
	public function checkHostExistence( $host ) {
		$wpdb = $this->wpdb;

		return $wpdb->get_var( $wpdb->prepare( "SELECT `host` FROM `" . $wpdb->prefix . "dms_mappings` m WHERE m.host=%s", $host ) );
	}

	/**
	 * Compiles a clean list of DMS Options
	 *
	 * @return array
	 */
	public static function getDMSOptions( $search = '' ) {
		$posts = [];

		// Get custom post types
		$custom_post_types = get_post_types( [ '_builtin' => false ], 'objects' );

		// Include native post types (Posts and Pages)
		$native_post_types = [
			'post' => 'Posts',
			'page' => 'Pages'
		];

		// Merge custom and native post types
		$post_types = array_merge( $custom_post_types, $native_post_types );

		// Retrieve blog categories if enabled
		$useCats = get_option( 'dms_use_categories' );
		if ( $useCats === 'on' ) {
			$catArgs = [
				'hide_empty' => false,
				'number'     => ( $search ? - 1 : 5 )
			];
			if ( ! empty( $search ) ) {
				$catArgs['name__like'] = $search;
			}
			$cats = get_categories( $catArgs );
			if ( ! empty( $cats ) ) {
				$posts['Blog Categories'] = [];
				foreach ( $cats as $cat ) {
					$posts['Blog Categories'][] = [
						'title' => $cat->name,
						'id'    => 'category-' . $cat->slug
					];
				}
			}
		}

		// Loop through each post type to retrieve posts and taxonomies connected with the current post type
		foreach ( $post_types as $post_type => $label ) {
			$label    = is_string( $label ) ? $label : $label->label;
			$usePosts = get_option( 'dms_use_' . $post_type );
			if ( $usePosts === 'on' ) {
				$postArgs = [
					'numberposts' => ( $search ? - 1 : 5 ),
					'post_type'   => $post_type
				];
				if ( ! empty( $search ) ) {
					$postArgs['s'] = $search;
				}
				$blogPosts = get_posts( $postArgs );
				if ( ! empty( $blogPosts ) ) {
					$posts[ ucfirst( $label ) ] = [];
					foreach ( $blogPosts as $post ) {
						$posts[ ucfirst( $label ) ][] = [
							'id'    => $post->ID,
							'title' => $post->post_title,
							'link'  => get_permalink( $post->ID )
						];
					}
				}
			}
			// Retrieve custom taxonomies connected with this post
			$postTaxonomies = get_taxonomies( [ 'object_type' => [ $post_type ], '_builtin' => false ], 'objects' );
			foreach ( $postTaxonomies as $taxonomy ) {
				$useTax = get_option( 'dms_use_cat_' . $post_type . '_' . $taxonomy->name );
				if ( $useTax === 'on' ) {
					$taxonomyArgs = [
						'taxonomy'   => $taxonomy->name,
						'hide_empty' => false,
						'number'     => ( $search ? - 1 : 5 )
					];
					if ( ! empty( $search ) ) {
						$taxonomyArgs['name__like'] = $search;
					}
					$terms = get_terms( $taxonomyArgs );
					if ( ! empty( $terms ) ) {
						$posts[ ucfirst( $taxonomy->label ) ] = [];
						foreach ( $terms as $term ) {
							$posts[ ucfirst( $taxonomy->label ) ][] = [
								'title'     => $term->name,
								'id'        => 'term_' . $term->term_id,
								'permalink' => get_term_link( $term->term_id, $taxonomy->name )
							];
						}
					}
				}
			}
		}

		return $posts;
	}

	/**
	 * Set up filters to filter matched objects uris.
	 * In admin case we need to filter all the mapped objects uris
	 * and adjust with right host + [path].
	 * In public side in case "domain matching" exists
	 * we need to replace uris for all internal links (with help of native wp filters) if possible.
	 */
	public static function prepareUriFilters() {
		$DMS = self::getInstance();
		/**
		 * TODO
		 * Admin filter list with is_admin() check . Maybe also needed to keep some option of it in our side
		 *   attachment_link
		 *   get_comment_author_link
		 *   get_comment_author_uri_link
		 *   comment_reply_link
		 *   preview_post_link
		 */ /**
		 * Public side filtering
		 * List of possible hooks related with assets
		 *   script_loader_src
		 *   style_loader_src
		 *   the_content
		 *   get_header_image_tag
		 *   wp_get_attachment_image_src
		 *   wp_calculate_image_srcset
		 *   template_directory_uri
		 *   stylesheet_directory_uri
		 *   admin_url (ajax related)
		 *   plugins_url (done in initial file)
		 */
		// Jet plugin related filters
		if ( get_option( 'dms_rewrite_urls_on_mapped_page' ) && is_plugin_active( 'jet-engine/jet-engine.php' ) && is_plugin_active( 'jet-smart-filters/jet-smart-filters.php' ) ) {
			add_filter( 'jet-smart-filters/render/ajax/data', array( $DMS, 'rewriteJetAjaxContent' ), 99, 1 );
		}
		if ( ! is_admin() ) {
			add_filter( 'script_loader_src', array( $DMS, 'replaceScriptStyleSrc' ), 10, 2 );
			add_filter( 'style_loader_src', array( $DMS, 'replaceScriptStyleSrc' ), 10, 2 );
			add_filter( 'admin_url', array( $DMS, 'rewriteAdminUrl' ), 999, 4 );
			add_filter( 'wp_get_attachment_image_src', array( $DMS, 'rewriteAttachmentSrc' ), 10, 4 );
			add_filter( 'get_header_image_tag', array( $DMS, 'rewriteHeaderImageMarkup' ), 10, 3 );
			add_filter( 'wp_calculate_image_srcset', array( $DMS, 'rewriteImageSrcSet' ), 10, 5 );
			add_filter( 'template_directory_uri', array( $DMS, 'rewriteTemplateUri' ), 10, 3 );
			add_filter( 'stylesheet_directory_uri', array( $DMS, 'rewriteStylesheetUri' ), 10, 3 );
			add_filter( 'the_content', array( $DMS, 'rewriteTheContent' ), 10, 1 );
			// Uris
			add_filter( 'home_url', array( $DMS, 'rewriteHomeUrl' ), 99, 4 );
			add_filter( 'paginate_links', array( $DMS, 'rewritePaginationLinks' ), 99 );
			add_filter( 'nav_menu_link_attributes', array( $DMS, 'rewriteNavMenuLink' ), 99, 4 ); // Possible other workaround is "wp_nav_menu_objects" filter
			add_filter( 'page_link', array( $DMS, 'rewritePageLink' ), 99, 4 );
			add_filter( 'post_link', array( $DMS, 'rewritePostLink' ), 99, 4 );
			add_filter( 'post_type_link', array( $DMS, 'rewritePostTypeLink' ), 99, 4 );
			add_filter( 'term_link', array( $DMS, 'rewriteTermLink' ), 99, 3 );
		}
	}

	/**
	 * Rewrite home url
	 *
	 * @param  string  $url
	 * @param  string  $path
	 * @param  null  $orig_scheme
	 * @param  null  $blog_id
	 */
	public function rewriteHomeUrl( $url, $path, $orig_scheme = null, $blog_id = null ) {
		if ( $this->dms_fs->can_use_premium_code__premium_only()
		     && ( $this->domain_path_match || $this->is_main_mapping_with_path )
		     && ! empty( $this->url_rewrite )
		     && ( ! class_exists( 'DMS_Seo_Yoast' ) || ! DMS_Seo_Yoast::getInstance()->isSitemapRequested() ) ) {
			/**
			 * Two main scenarios
			 * 1. Global rewriting
			 * 2. Selective rewriting
			 */
			$home_link = get_option( 'home' );
			// This is for prevent home_url filter to run also from inside other uri related filter
			if ( rtrim( $home_link, '/' ) === rtrim( $url, '/' ) ) {
				$page_on_front = get_option( 'page_on_front' );
				if ( ! empty( $page_on_front ) ) {
					$new_link = $this->getRewrittenUrl( $page_on_front, $url );
					if ( ! empty( $new_link ) ) {
						return $new_link;
					}
				}
			}
		}

		return $url;
	}

	/**
	 * Rewrite term link
	 *
	 * @param  string  $termlink
	 * @param  WP_Term  $term
	 * @param  string  $taxonomy
	 */
	public function rewriteTermLink( $termlink, $term, $taxonomy ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path )
		     && $this->dms_fs->can_use_premium_code__premium_only()
		     && ! empty( $this->url_rewrite )
		     && ( ! class_exists( 'DMS_Seo_Yoast' ) || ! DMS_Seo_Yoast::getInstance()->isSitemapRequested() ) ) {
			if ( $taxonomy != 'category' ) {
				global $wp_taxonomies;
				$post_type = ! empty( $wp_taxonomies[ $taxonomy ] ) && ! empty( $wp_taxonomies[ $taxonomy ]->object_type[0] ) ? $wp_taxonomies[ $taxonomy ]->object_type[0] : null;
				$key       = implode( '#', [ $taxonomy, $term->slug, $post_type ] );
			} else {
				$key = 'category-' . $term->slug;
			}
			$new_link = $this->getRewrittenUrl( $key, $termlink );
			if ( ! empty( $new_link ) ) {
				return $new_link;
			}
		}

		return $termlink;
	}

	/**
	 * Rewrite post link
	 *
	 * @param  string  $permalink
	 * @param  WP_Post  $post
	 * @param  bool  $leavename
	 */
	public function rewritePostLink( $permalink, $post, $leavename ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path )
		     && $this->dms_fs->can_use_premium_code__premium_only()
		     && ! empty( $this->url_rewrite )
		     && ( ! class_exists( 'DMS_Seo_Yoast' ) || ! DMS_Seo_Yoast::getInstance()->isSitemapRequested() ) ) {
			$new_link = $this->getRewrittenUrl( $post->ID, $permalink );
			if ( ! empty( $new_link ) ) {
				return $new_link;
			}
		}

		return $permalink;
	}

	/**
	 * Rewrite post_type link
	 *
	 * @param  string  $permalink
	 * @param  WP_Post  $post
	 * @param  bool  $leavename
	 * @param  bool  $sample
	 */
	public function rewritePostTypeLink( $permalink, $post, $leavename, $sample ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path )
		     && $this->dms_fs->can_use_premium_code__premium_only()
		     && ! empty( $this->url_rewrite )
		     && ( ! class_exists( 'DMS_Seo_Yoast' ) || ! DMS_Seo_Yoast::getInstance()->isSitemapRequested() ) ) {
			$new_link = $this->getRewrittenUrl( $post->ID, $permalink );
			if ( ! empty( $new_link ) ) {
				return $new_link;
			}
		}

		return $permalink;
	}

	/**
	 * Rewrite page link
	 *
	 * @param  string  $link
	 * @param  int  $post_id
	 * @param  bool  $sample
	 */
	public function rewritePageLink( $link, $post_id, $sample ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path )
		     && $this->dms_fs->can_use_premium_code__premium_only()
		     && ! empty( $this->url_rewrite )
		     && ( ! class_exists( 'DMS_Seo_Yoast' ) || ! DMS_Seo_Yoast::getInstance()->isSitemapRequested() ) ) {
			$new_link = $this->getRewrittenUrl( $post_id, $link );
			if ( ! empty( $new_link ) ) {
				return $new_link;
			}
		}

		return $link;
	}

	/**
	 * Rewrite wp navigation menu links
	 * if current page is mapped
	 *
	 * @param $attributes
	 * @param $item
	 * @param $args
	 * @param $depth
	 *
	 * @return mixed
	 */
	public function rewriteNavMenuLink( $attributes, $item, $args, $depth = null ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path ) && $this->dms_fs->can_use_premium_code__premium_only() && ! empty( $this->url_rewrite ) ) {
			/**
			 * Get possible value and check if we have mapping
			 */
			if ( $item->type == 'post_type' && ( $item->object == 'page' || $item->object == 'post' ) ) {
				$key = $item->object_id;
			} elseif ( $item->type === 'taxonomy' ) {
				$slug = get_term( $item->object_id, $item->object )->slug;
				if ( $item->object != 'category' ) {
					global $wp_taxonomies;
					$post_type = ! empty( $wp_taxonomies[ $item->object ] ) && ! empty( $wp_taxonomies[ $item->object ]->object_type[0] ) ? $wp_taxonomies[ $item->object ]->object_type[0] : null;
					$key       = implode( '#', [ $item->object, $slug, $post_type ] );
				} else {
					$key = 'category-' . $slug;
				}
			} elseif ( $item->type === 'custom' ) {
				// In case of custom type. We should check if it contains our main url
				$href = $this->getRewrittenUrl( null, $attributes['href'] );
				if ( ! empty( $href ) ) {
					$attributes['href'] = $href;
				}
			} else {
				// Other item types
			}
			// Check $key existence
			if ( ! empty( $key ) ) {
				$href = $this->getRewrittenUrl( $key, $attributes['href'] );
				if ( ! empty( $href ) ) {
					$attributes['href'] = $href;
				}
			}
		}

		return $attributes;
	}

	/**
	 * @param  string  $key
	 * @param  string  $link
	 *
	 * @return array|string|string[]|null
	 */
	public function getRewrittenUrl( $key, $link ) {
		// TODO consider the fact of having host + path as site url . Dont know what will happen in that case
		$host = DMS_Helper::getBaseHost();
		if ( ! empty( $this->selective_url_rewrite ) ) {
			$mapping = DMS_Helper::getMatchingHostByValue( $this->wpdb, $key );
			if ( empty( $mapping ) && ! empty( get_option( 'dms_global_mapping' ) ) ) {
				// Proceed with global mapping 
				$mapping = $this->getMainMapping();
			}
			if ( ! empty( $mapping->host ) ) {
				$replace_with        = $mapping->host . ( ! empty( $mapping->path ) ? '/' . $mapping->path : '' );
				$link_without_scheme = preg_replace( "~^(https?://)~i", '', $link );
				if ( ! str_starts_with( $link_without_scheme, $replace_with ) ) {
					$mapped_link = str_ireplace( $host, $replace_with, $link );
				}
			}
			if ( ! empty( $mapped_link ) ) {
				return $mapped_link;
			}
		} elseif ( ! empty( $this->global_url_rewrite ) ) {
			//TODO bellow line ( including path ) is omitted cause in certain situations I am unable to get it
			// $current_mapping = $this->domain.(! empty($this->path) && !empty($this->map[0]) && ! is_null($this->map[0]['path']) ? '/'.$this->map[0]['path'] : '');
			$link_without_scheme = preg_replace( "~^(https?://)~i", '', $link );
			if ( ! str_starts_with( $link_without_scheme, $this->domain ) ) {
				$rewrite_link = str_ireplace( $host, $this->domain, $link );
			}
			if ( ! empty( $rewrite_link ) ) {
				return $rewrite_link;
			}
		}

		return null;
	}

	/**
	 * Rewrite any link
	 * Could be applied to any single param filter
	 *
	 * @param $link
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function rewritePaginationLinks( $link ) {
		if ( $this->domain_path_match || $this->is_main_mapping_with_path ) {
			/**
			 * We must
			 *  1) either avoid links to extend our custom path or
			 *  2) we need to replace in the URI with (replaceHostOccurrence), in case option is enabled in our side
			 */
			if ( $this->dms_fs->can_use_premium_code__premium_only() && ! empty( $this->url_rewrite ) ) {
				$link = self::replaceHostOccurrence( $link, $this );
			} else {
				if ( ! empty( $this->real_requested_object_link ) ) {
					//TODO Possible mini think to note . We are replacing all matches (rare thing but possible)
					$real_path = trim( wp_parse_url( $this->real_requested_object_link, PHP_URL_PATH ), '/' );
					if ( ! empty( $this->map[0]['path'] ) && ! empty( $this->real_requested_object_link ) ) {
						return str_ireplace( $this->map[0]['path'], $real_path, $link );
					} elseif ( ! empty( $this->real_requested_object_link ) ) {
						/*
						 * Also check if current $link contains only page/num path and no other path.
						 * Means our $this->path is empty. In that case simply build $link manually
						 */
						if ( empty( $this->path ) ) {
							$existing_link_path = trim( wp_parse_url( $link, PHP_URL_PATH ), '/' );
							$link               = str_ireplace( $existing_link_path, $real_path . '/' . $existing_link_path, $link );
						}
					}
				}
			}
		}

		return $link;
	}

	/**
	 * @param  string  $src  The source URL of the enqueued style.
	 * @param  string  $handle  The style's registered handle.
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function replaceScriptStyleSrc( $src, $handle ) {
		if ( $this->domain_path_match || $this->is_main_mapping_with_path ) {
			$src = self::replaceHostOccurrence( $src, $this );
			if ( DMS_Helper::checkIfBedrock() ) {
				$src = str_replace( $this->domain, $this->domain . '/wp', $src );
			}
		}

		return $src;
	}

	/**
	 * Rewrite plugin URL
	 * plugin_url() function could be called to define plugin directory url
	 *
	 * @param  string  $url
	 * @param  string  $path
	 * @param  string  $plugin
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public static function pluginsUrl( $url, $path, $plugin ) {
		if ( ! is_admin() ) {
			$DMS = self::getInstance();
			$DMS->setCurrentDomain();
			if ( ! empty( $DMS->checkHostExistence( $DMS->domain ) ) ) {
				$url = self::replaceHostOccurrence( $url, $DMS, true );
			}
		}

		return $url;
	}

	/**
	 * Rewrite admin url ( only in case if $path is starting with admin-ajax.php )
	 * admin_url function could be called in case plugin wants to define ajax-url
	 *
	 * @param  string  $url
	 * @param  string  $path
	 * @param  int  $blog_id
	 * @param  string  $scheme
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public static function rewriteAdminUrlStatic( $url, $path, $blog_id, $scheme = '' ) {
		if ( ! is_admin() ) {
			$DMS = self::getInstance();
			$DMS->setCurrentDomain();
			if ( ! empty( $DMS->checkHostExistence( $DMS->domain ) )
			     && strpos( trim( $path ), 'admin-ajax.php' ) === 0 ) {
				$url = self::replaceHostOccurrence( $url, $DMS );
			}
		}

		return $url;
	}

	/**
	 * Rewrite template stylesheets uri
	 * in case domain match
	 *
	 * @param  string  $stylesheet_dir_uri  Stylesheet directory URI.
	 * @param  string  $stylesheet  Name of the activated theme's directory.
	 * @param  string  $theme_root_uri  Themes root URI.
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function rewriteStylesheetUri( $stylesheet_dir_uri, $stylesheet, $theme_root_uri ) {
		if ( $this->domain_path_match || $this->is_main_mapping_with_path ) {
			$stylesheet_dir_uri = self::replaceHostOccurrence( $stylesheet_dir_uri, $this );
		}

		return $stylesheet_dir_uri;
	}

	/**
	 * Replace jet ajax filter content
	 *
	 * @param $args
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function rewriteJetAjaxContent( $content ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path ) && $this->dms_fs->can_use_premium_code__premium_only() && ! empty( $this->url_rewrite ) && ! empty( $content['content'] ) ) {
			return self::replaceHostOccurrence( $content, $this, false, - 1 );
		}

		return $content;
	}

	/**
	 * Replace with right url catching $content by the_content hook
	 * in case domain match
	 *
	 * @param $content
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function rewriteTheContent( $content ) {
		if ( $this->domain_path_match || $this->is_main_mapping_with_path ) {
			$content = self::replaceHostOccurrence( $content, $this, false, - 1 );
		}

		return $content;
	}

	/**
	 * Replace template uri with right one
	 * in case domain match
	 *
	 * @param  string  $template_dir_uri
	 * @param  string  $template
	 * @param  string  $theme_root_uri
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function rewriteTemplateUri( $template_dir_uri, $template, $theme_root_uri ) {
		if ( $this->domain_path_match || $this->is_main_mapping_with_path ) {
			$template_dir_uri = self::replaceHostOccurrence( $template_dir_uri, $this );
		}

		return $template_dir_uri;
	}

	/**
	 * Replace admin ajax url with mapped one
	 * in case domain match
	 *
	 * @param  string  $url
	 * @param  string  $path
	 * @param  int  $blog_id
	 * @param  string  $scheme
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function rewriteAdminUrl( $url, $path, $blog_id, $scheme = '' ) {
		if ( $path == 'admin-ajax.php' && ( $this->domain_path_match || $this->is_main_mapping_with_path ) ) {
			$url = self::replaceHostOccurrence( $url, $this );
		}

		return $url;
	}

	/**
	 * Replace attachment url with mapped one
	 * in case domain match
	 *
	 * @param  array|false  $image
	 * @param  int  $attachment_id
	 * @param  string|int[]  $size
	 * @param  bool  $icon
	 *
	 * @return mixed
	 */
	public function rewriteAttachmentSrc( $image, $attachment_id, $size, $icon ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path ) && ! empty( $image[0] ) ) {
			$image[0] = self::replaceHostOccurrence( $image[0], $this );
		}

		return $image;
	}

	/**
	 * Replace header image url with mapped one
	 * in case domain match
	 *
	 * @param  string  $html
	 * @param  object  $header
	 * @param  array  $attr
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function rewriteHeaderImageMarkup( $html, $header, $attr ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path ) && ! empty( $html ) ) {
			$html = self::replaceHostOccurrence( $html, $this, false, - 1 );
		}

		return $html;
	}

	/**
	 * Replace image src sources with mapped one
	 * in case domain match
	 *
	 * @param  array  $sources
	 * @param  array  $size_array
	 * @param  string  $image_src
	 * @param  array  $image_meta
	 * @param  int  $attachment_id
	 *
	 * @return array
	 */
	public function rewriteImageSrcSet( $sources, $size_array, $image_src, $image_meta, $attachment_id ) {
		if ( ( $this->domain_path_match || $this->is_main_mapping_with_path ) && ! empty( $sources ) ) {
			foreach ( $sources as $key => $val ) {
				$sources[ $key ]['url'] = self::replaceHostOccurrence( $val['url'], $this );
			}
		}

		return $sources;
	}

	public function replaceElementorPreviewUrl( $preview_url ) {
		return $preview_url;
	}

	/**
	 * Find matching pattern and replace the host
	 *
	 * @param  string  $data
	 * @param  DMS  $dms_obj
	 * @param  int  $limit
	 *
	 * @return array|string|string[]|null
	 */
	public static function replaceHostOccurrence( $data, $dms_obj, $plugin_url = false, $limit = 1 ) {
		$host = DMS_Helper::getBaseHost();
//		$dot  = $plugin_url ? '' : '(\.)';
		$dot = '';
		if ( DMS_Helper::isSubDirectoryInstall() ) {
			$path = DMS_Helper::getBasePath();
			$path = explode( '/', $path );
			$path = join( '\/', $path );

			return preg_replace_callback( '/(http[s]?:\/\/)(' . $host . ')((\/' . $path . '\/\w+)*\/)?([\w\-\.]+[^#?\s]+)' . $dot . '(#[\w\-]+)?/', array( $dms_obj, 'actualHostReplace' ), $data, - 1 );
		}

		return preg_replace_callback( '/(http[s]?:\/\/)(' . $host . ')((\/\w+)*\/)?([\w\-\.]+[^#?\s]+)' . $dot . '(#[\w\-]+)?/', array( $dms_obj, 'actualHostReplace' ), $data, - 1 );
	}

	/**
	 * The preg_replace_callback callback, for actual replacement of single occurrence
	 *
	 * @param $input
	 *
	 * @return array|string|string[]
	 */
	public function actualHostReplace( $input ) {
		if ( is_array( $input ) ) {
			$input = $input[0];
		}
		$host = DMS_Helper::getBaseHost();
		$path = DMS_Helper::getBasePath();
		//TODO case where input contains index.php is currently ignored
		if ( ! empty( $path ) ) {
			return str_ireplace( '://' . $host . '/' . $path, '://' . $this->domain, $input );
		}

		return str_ireplace( '://' . $host, '://' . $this->domain, $input );
	}

	/**
	 * Sets favicon
	 *
	 * @param  string  $url
	 * @param  int  $size
	 * @param  int  $blog_id
	 *
	 * @return string
	 */
	public static function doFavicon( $url, $size = 0, $blog_id = 0 ) {
		$DMS = self::getInstance();
		if ( ! empty( $DMS->dms_favicon_id ) && $DMS->dms_fs->can_use_premium_code__premium_only() ) {
			$favicon_src = wp_get_attachment_image_url( $DMS->dms_favicon_id );
			if ( ! empty( $favicon_src ) ) {
				return $favicon_src;
			}
		}

		return $url;
	}

	/**
	 * Print custom html
	 */
	public static function showCustomHtml() {
		$DMS = self::getInstance();
		if ( ! empty( $DMS->map_custom_html ) ) {
			printf( stripslashes( $DMS->map_custom_html ) );
		}
	}

	/**
	 * Post data reset for seo-by-rank-math. Otherwise the post data is being customized to homepage post by
	 * seo-by-rank-math when there is no path given in the url.
	 *
	 * Temporary solution for now. Or could be permanent. Depends on seo-by-rank-math and our further investigations
	 *
	 * @return void
	 */
	public static function postDataReset() {
		if ( is_plugin_active( 'seo-by-rank-math/rank-math.php' ) ) {
			$DMS = DMS::getInstance();
			if ( $DMS->domain_path_match && empty( $DMS->path ) ) {
				wp_reset_postdata();
			}
		}
	}

	/**
	 * Get main mapping
	 *
	 * @return array|object|stdClass|null
	 */
	public function getMainMapping() {
		if ( ! isset( $this->main_mapping ) ) {
			$this->main_mapping = DMS_Helper::getMainMappingDomain( $this->wpdb );
		}

		return $this->main_mapping;
	}

	/**
     * Change WP rest url if the current page is mapped to prevent js call errors (CORS errors)
     *
	 * @param $url
	 * @param $path
	 * @param $scheme
	 *
	 * @return int|mixed
	 */
	public static function changeWordpressApiUrl( $url, $path, $scheme ) {
		$DMS          = DMS::getInstance();
		$domain       = $DMS->domain;
		$mapping      = $DMS->checkHostExistence($domain);
		if ( $url == site_url() . '/wp-json/' && $path == '/' && ! empty( $mapping ) ) {
			$domain = is_ssl() ? 'https://' . $domain : 'http://' . $domain;

			return str_replace( site_url(), $domain, $url );
		}

		return $url;
	}

	/**
	 * Removes home link from navigation
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	public static function removeHomeLinkFromNavigation( $args ) {
		$DMS = DMS::getInstance();
		if ( $args['show_home'] && $DMS->url_rewrite && $DMS->active_mapping && $DMS->dms_fs->can_use_premium_code__premium_only() ) {
			//Set flag
			$DMS->home_link_args = [
				'show_home'   => $args['show_home'],
				'link_before' => $args['link_before'],
				'link_after'  => $args['link_after'],
			];
			$args['show_home'] = false;
		}

		return $args;
	}

	/**
	 * Update the sunrise.php file for multisites using WP_Filesystem
	 *
	 * @return void
	 */
	public static function updateSunriseFile() {
		if ( is_multisite() ) {
			$updated = get_option( 'dms_sunrise_updated', false );
			if ( ! $updated ) {
				// Load the filesystem API for handling file operations
				WP_Filesystem();
				global $wp_filesystem;
				if ( ! is_wp_error( $wp_filesystem ) ) {
					$sunrise_file = plugin_dir_path( __DIR__ ) . 'sunrise.php';
					$target_file  = WP_CONTENT_DIR . '/sunrise.php';
					$contents     = $wp_filesystem->get_contents( $sunrise_file );
					if ( $contents !== false ) {
						$write_result = $wp_filesystem->put_contents( $target_file, $contents, FS_CHMOD_FILE );
						if ( $write_result ) {
							update_option( 'dms_sunrise_updated', 1 );
						}
					}
				}
			}
		}
	}

	/**
	 * If the home link was removed add the rewritten version to navigation from first
	 *
	 * @param $output
	 * @param $parsed_args
	 * @param $pages
	 *
	 * @return mixed|string
	 */
	public static function addHomeUrlToNavigation( $output, $parsed_args, $pages ) {
		$DMS = DMS::getInstance();
		if ( $DMS->home_link_args && $DMS->url_rewrite && $DMS->active_mapping && $DMS->dms_fs->can_use_premium_code__premium_only() ) {
			$page_on_front = get_option( 'page_on_front' );
			$new_link      = $DMS->getRewrittenUrl( $page_on_front, home_url() );
			if ( $new_link ) {
				if ( true === $DMS->home_link_args['show_home'] || '1' === $DMS->home_link_args['show_home'] || 1 === $DMS->home_link_args['show_home'] ) {
					$text = __( 'Home' );
				} else {
					$text = $DMS->home_link_args['show_home'];
				}
				$class = '';
				if ( is_front_page() && ! is_paged() ) {
					$class = 'class="current_page_item"';
				}
				$output = '<li ' . $class . '><a href="' . esc_url( $new_link ) . '">' . $DMS->home_link_args['link_before'] . $text . $DMS->home_link_args['link_after'] . '</a></li>' . $output;
			}
		}

		return $output;
	}

	/**
     * Define ajax hooks
     *
	 * @return void
	 */
    public function defineAjaxHooks(){
        $DMS = DMS::getInstance();
        add_action('wp_ajax_dms_load_more_values', array($DMS, 'loadMoreSelectedValues'));
        add_action('wp_ajax_mapping_values_search', array($DMS, 'loadMoreMappingOptions'));
    }

	/**
     * Load more mapping options
     *
	 * @return void
	 */
	public static function loadMoreMappingOptions() {
		$search_term = ! empty( $_GET['search_term'] ) ? sanitize_text_field( $_GET['search_term'] ) : '';
		$options = DMS::getDMSOptions( $search_term );

		$results = [];
		foreach ( $options as $key_inner => $optgroup ) {
			$group = [ 'text' => $key_inner, 'children' => [] ];
			foreach ( $optgroup as $option ) {
				$group['children'][] = [ 'id' => $option['id'], 'text' => $option['title'] ];
			}
			$results[] = $group;
		}

		wp_send_json( $results );
	}

	/**
     * Load more selected values
     *
	 * @return void
	 */
	public static function loadMoreSelectedValues() {
		global $wpdb;
		$mappingId  = isset( $_GET['id'] ) ? sanitize_text_field( $_GET['id'] ) : '';
		$startCount = isset( $_GET['startCount'] ) ? absint( $_GET['startCount'] ) : 0;

		if ( ! $mappingId || ! $startCount ) {
			wp_send_json_error();

			return;
		}
		$archive_global_mapping         = get_option( 'dms_archive_global_mapping' );
		$woo_shop_global_mapping        = get_option( 'dms_woo_shop_global_mapping' );
		$dms_global_parent_page_mapping = get_option( 'dms_global_parent_page_mapping' );
		$shop_mapping_match             = false;
		$global_parent_match            = false;
		$shop_page_association          = ! empty( $woo_shop_global_mapping ) ? DMS_Helper::getShopPageAssociation() : false;
		$query                          = $wpdb->prepare(
			"SELECT DISTINCT `value`, `primary` 
                     FROM {$wpdb->prefix}dms_mapping_values 
                     WHERE `host_id` = %d 
                     ORDER BY `order` ASC",
			$mappingId
		);
		$count                          = 0;
		$values                         = $wpdb->get_results( $query, ARRAY_A );
		$options_html                   = '';
		$is_shop_mapping = array_filter($values, function ($item) use ($shop_page_association) {
			return $item['value'] == $shop_page_association;
		});

		if ( ! empty( $values ) ) {
			foreach ( $values as $key => $mapping ) {
				if ( $count == $startCount ) {
					break;
				}
				$map   = $mapping['value'];
				$value = null;
				// Collect cats or archives
				if ( DMS::isTaxonomyTerm( $map ) ) {
					// We consider that first we will get category, then related connection needs to be checked
					$taxonomy_term = DMS::getTaxonomyTermFromValue( $map );
					$value         = $mapping;
				} elseif ( $shop_page_association == $map ) {
					$value              = $mapping;
				} elseif ( ! empty( $dms_global_parent_page_mapping ) && DMS_Helper::isPagePostType( $map ) && count( get_post_ancestors( $map ) ) == 0 ) {
					$global_parent_match = true;
					$value               = $mapping;
				} else {
					if ( ! empty( $archive_global_mapping ) && ! empty( $taxonomy_term ) && has_term( $taxonomy_term[1], $taxonomy_term[0], $map ) ) {
						// Do nothing
					} elseif ( ! empty( $woo_shop_global_mapping ) && ! empty( $is_shop_mapping ) && function_exists( 'wc_get_product' ) && ! empty( wc_get_product( $map ) ) ) {
						// Do nothing
					} elseif ( ! empty( $dms_global_parent_page_mapping ) && ! empty( $global_parent_match ) && count( get_post_ancestors( $map ) ) != 0 ) {
						// Do nothing
					} else {
						$value = $mapping;
					}
				}
				if ( ! empty( $value ) ) {
					$primary      = (int) ( $value['primary'] == 1 );
					$option_text  = esc_html( DMS_Helper::getTitleOfValue( $value['value'] ) );
					$options_html .= sprintf(
						'<option selected data-primary="%d" class="level-0" value="%s">%s</option>',
						$primary,
						esc_attr( $value['value'] ),
						$option_text
					);
					$count ++;
				}
			}

			$response = [
				'html'  => $options_html,
				'count' => $count,
			];

			wp_send_json_success( $response );
		} else {
			wp_send_json_error();
		}
	}
}