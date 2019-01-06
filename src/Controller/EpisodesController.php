<?php

namespace App\Controller;

use App\Database;
use App\Controller\BaseController;

class EpisodesController extends BaseController {

	public function __construct() {
		parent::__construct('showepisodes.twig');
	}

	public function handleRequest($vars) {
		$db = Database::getInstance();
		$episodes = $db->getEpisodesFromShow($vars['name']);
		$this->render(array('pageTitle' => $vars['name'], 'episodes' => $episodes));
	}
}