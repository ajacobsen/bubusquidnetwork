<?php

namespace App\Controller;

use App\Controller\BaseController;

class IndexController extends BaseController {

	public function __construct() {
		parent::__construct('index.twig');
	}

	public function handleRequest($vars) {
		$this->render(array('pageTitle' => 'HOME'));
	}
}