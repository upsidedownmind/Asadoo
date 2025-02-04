<?php
/*
 * Asadoo
 *
 * Copyright (c) 2011 Valentin Starck
 *
 * May be freely distributed under the MIT license. See the MIT-LICENSE file.
 */

// Load config.ini
if(!file_exists('config.ini')) {
	echo 'Invalid config file';
	die();
}

$config = parse_ini_file('config.ini');

if(!isset($config['asadoo_path'])) {
	echo 'Invalid config file';
	die();	
}

define('PROJECT_PATH', dirname(__FILE__));

//require_once($config['asadoo_path'] . DIRECTORY_SEPARATOR . 'init.php');
require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR . 'index.php');

//---------------------------------------------------------------------------------------------------------------------

// TODO move handlers to an external pipeline
\asadoo\core\asadoo::getInstance()->setConfig($config)->addHandler(
    // Lambdas
    function(\asadoo\core\Request $request, \asadoo\core\Response $response, Closure $container) {
        if(!$request->any('test')) {
            return;
        }

        // Using dependences
        $container('file_cache')->set('file', '123');

        // Stop handling after this
        $request->end();

        // Send foo
        return 'foo';
    },
	// Use a generic handler to serve js files
	new \asadoo\handlers\GenericJSHandler(PROJECT_PATH . DIRECTORY_SEPARATOR . 'js'),
	// Use a generic handler to serve css files
	new \asadoo\handlers\GenericCSSHandler(PROJECT_PATH . DIRECTORY_SEPARATOR . 'css'),
	new DocumentationHandler,
	new CatchAllHandler
)->start();


