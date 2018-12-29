<?php

namespace App\Controller;

use App\Controller\BaseController;

class GameController extends BaseController {

	public function __construct() {
		parent::__construct('game.twig');
	}

	public function handleRequest($vars) {
		$this->render(array('pageTitle' => $vars['name']));
	}
}