<?php
namespace asadoo\handlers;
use \asadoo\core;

class GenericJSHandler extends AbstractFileHandler implements \asadoo\core\IHandler {
	public function __construct($path = null) {
		parent::__construct($path);
	}
	
	public function accept(core\Request $request) {
		if($request->segment(0) == JS_URI_SEGMENT) {
			return true;			
		}
		return false;
	}
	
	protected function getMimeType() {
		return 'text/javascript';
	}
}