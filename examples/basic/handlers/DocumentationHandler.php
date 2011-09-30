<?php
class DocumentationHandler implements asadoo\core\IHandler {
	public function accept(asadoo\core\Request $request) {
        return $request->segment(1) == 'docs';
	}

	public function handle(asadoo\core\Request $request, asadoo\core\Response $response) {
		$response->setView(PROJECT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'body.php');

		$response->value('title', 'Asadoo :: Documentacion [' . strtoupper($request->segment(0)) . ']');
		$response->value('elapsed', $request->elapsed());
		$response->value('name', $request->get('name', 'world'));

		$response->display();

        return false;
	}
}