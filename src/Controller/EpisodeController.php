<?php

namespace App\Controller;

use App\Database;
use App\Controller\BaseController;

class EpisodeController extends BaseController {

	public function __construct() {
		parent::__construct('fullepisode.twig');
	}

	public function handleRequest($vars) {
		$db = Database::getInstance();
		$episode = $db->getEpisode($vars['episode'], $vars['name']);
		$this->render(array('pageTitle' => 'HOME', 'episode' => $episode));
	}
}