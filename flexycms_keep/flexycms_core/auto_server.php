<<<<<<< HEAD
<?php
/**
 * Advanced usage of HTML_AJAX_Server
 * Allows for a single server to manage exporting a large number of classes without high overhead per call
 * Also gives a single place to handle setup tasks especially useful if session setup is required
 *
 * The server responds to ajax calls and also serves the js client libraries, so they can be used directly from the PEAR data dir
 * 304 not modified headers are used when server client libraries so they will be cached on the browser reducing overhead
 *
 * @category   HTML
 * @package    AJAX
 * @author     Joshua Eichorn <josh@bluga.net>
 * @copyright  2005 Joshua Eichorn
 * @license    http://www.opensource.org/licenses/lgpl-license.php  LGPL
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/HTML_AJAX
 */


define("THROUGH_CONTROLLER","0");
define("THROUGH_AJAX","1");
define("flexycms_ROOT", $_SERVER['DOCUMENT_ROOT'].'/ccu2new/flexycms/');
include_once('common.php');
ini_set('include_path',ini_get('include_path').APP_ROOT.'libsext/Pearajax');
ini_set('include_path',ini_get('include_path').APP_ROOT.'flexycms/classes/ajax/');
ini_set('include_path',ini_get('include_path').APP_ROOT.'flexycms/classes/');

 // include the server class
 
include_once(APP_ROOT.'libsext/Pearajax/HTML/AJAX/Server.php');
include_files("classes/ajax");
define("AJAX",1);




// extend HTML_AJAX_Server creating our own custom one with init{ClassName} methods for each class it supports calls on
class TestServer extends HTML_AJAX_Server {
	// this flag must be set to on init methods
	public $initMethods = true;
	
	// init method for the test class, includes needed files an registers it for ajax

	// anon 
	function initsample_ajax() {
		$this->registerClass(new sample_ajax());
	}

}

// create an instance of our test server
$server = new TestServer();

// handle requests as needed
$server->handleRequest();
=======
<?php
/**
 * Advanced usage of HTML_AJAX_Server
 * Allows for a single server to manage exporting a large number of classes without high overhead per call
 * Also gives a single place to handle setup tasks especially useful if session setup is required
 *
 * The server responds to ajax calls and also serves the js client libraries, so they can be used directly from the PEAR data dir
 * 304 not modified headers are used when server client libraries so they will be cached on the browser reducing overhead
 *
 * @category   HTML
 * @package    AJAX
 * @author     Joshua Eichorn <josh@bluga.net>
 * @copyright  2005 Joshua Eichorn
 * @license    http://www.opensource.org/licenses/lgpl-license.php  LGPL
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/HTML_AJAX
 */


define("THROUGH_CONTROLLER","0");
define("THROUGH_AJAX","1");
define("flexycms_ROOT", $_SERVER['DOCUMENT_ROOT'].'/ccu2new/flexycms/');
include_once('common.php');
ini_set('include_path',ini_get('include_path').APP_ROOT.'libsext/Pearajax');
ini_set('include_path',ini_get('include_path').APP_ROOT.'flexycms/classes/ajax/');
ini_set('include_path',ini_get('include_path').APP_ROOT.'flexycms/classes/');

 // include the server class
 
include_once(APP_ROOT.'libsext/Pearajax/HTML/AJAX/Server.php');
include_files("classes/ajax");
define("AJAX",1);




// extend HTML_AJAX_Server creating our own custom one with init{ClassName} methods for each class it supports calls on
class TestServer extends HTML_AJAX_Server {
	// this flag must be set to on init methods
	public $initMethods = true;
	
	// init method for the test class, includes needed files an registers it for ajax

	// anon 
	function initsample_ajax() {
		$this->registerClass(new sample_ajax());
	}

}

// create an instance of our test server
$server = new TestServer();

// handle requests as needed
$server->handleRequest();
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
