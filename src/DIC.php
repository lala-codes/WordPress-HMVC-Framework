<?php
namespace WordPressHMVC;

use Pimple\Container;

/**
 * Class DIC
 * @package WordPressHMVC
 */
class DIC {
	const SITE_MANAGER = 'site_manager';
	const THEME = 'theme';

	/** @var DIC */
	private static $_instance;
	/** @var Container */
	private $_container;

	private function __construct() {
		$this->_container                       = new Container();
		$this->_container[ self::SITE_MANAGER ] = function ( $c ) {
			return new SiteManager();
		};
		$this->_container[ self::THEME ]        = function ( $c ) {
			return new Theme();
		};
	}

	/**
	 * @return DIC
	 */
	public static function instance() {
		if ( ! static::$_instance instanceof DIC ) {
			static::$_instance = new static();
		}

		return static::$_instance;
	}

	public function getSiteManager() {
		return $this->_container[ self::SITE_MANAGER ];
	}

	public function getTheme() {
		return $this->_container[ self::THEME ];
	}
} 