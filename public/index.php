<?php
/**
 * Front Controller for the application
 * @package Garson
 */
 
/*
 * Paths for the application
 *
 * Copied directly from zf-tool's generated Front Controller.
 */
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) .
    '/../application'));

// Ensure library/ is on include_path
set_include_path( implode( PATH_SEPARATOR, array(
    realpath( APPLICATION_PATH . '/../library' ),
    get_include_path(),
)));

/*
 * Autoloader
 *
 * This will ensure that we don't need to include stuff; it will do it for us.
 */
function __autoload($class_name)
{
    $class_name = ucwords($class_name);
    
    /* Application Specific Classes are inside this directories */
    $named_directories = array
    (
      'Controller' => 'controllers/',
      'View' => 'views/',
      'Model' => 'models/',
    );
    $is_core = true;
    foreach ( $named_directories AS $name => $directory ) {
      if ( stristr($class_name, $name) && $class_name!=$name ){
          $path = $directory . $class_name;
          $is_core = false;
          break;
      }
    }
    /* All other classes are inside the core */
    if ($is_core) {
        $path = 'core/' . $class_name;
    }
   
    /* add the application path and the php extension */
    require_once APPLICATION_PATH . '/' . $path . '.php';
}

/**
 * URL = TianguisCabal/test/test/?param1=value1&param2=value2
 * url_rewrite= TianguisCabal/index.php?controller=test&action=index&param1=value1&param2=value2
 * test => TestController
 * index => indexAction
 */

if( !isset( $_GET['controller'] ) OR !isset( $_GET['action'] ) ) {
    $controller = "IndexController";
    $action     = "indexAction";
} else {
    $controller = ucwords( $_GET['controller'] ) . "Controller";
    $action     = strtolower( $_GET['action'] ) . "Action";
}

$Controller = new $controller();
$Controller->$action();
