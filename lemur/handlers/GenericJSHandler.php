<?php
namespace lemur\handlers;
use \lemur\core;

/**
 * TODO pasar la logica de servicio de archivos estaticos a una clase abstracta
 *
 */
class GenericJSHandler extends AbstractFileHandler implements \lemur\core\IHandler {
	public function __construct($path = null) {
		parent::__construct($path);
	}
	
	public function accept(core\Request $request) {
		if($request->segment(0) == JS_URI_SEGMENT) {
			return true;			
		}
		return false;
	}
}