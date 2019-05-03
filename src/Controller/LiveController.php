<?php

namespace App\Controller;

use App\Controller\BaseController;

class LiveController extends BaseController {

	public function __construct() {
		parent::__construct('live.twig');
	}

	public function handleRequest($vars) {
		$this->render(array('pageTitle' => 'LIVE'));
	}
}