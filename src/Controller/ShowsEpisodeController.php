<?php

namespace App\Controller;

use App\Database;
use App\Controller\BaseController;

class ShowsEpisodeController extends BaseController {

	public function __construct() {
		parent::__construct('showsepisode.twig');
	}

	public function handleRequest($vars) {
		$db = Database::getInstance();
		$shows = $db->getShows();
		$this->render(array('pageTitle' => 'DJFDDF', 'shows' => $shows));
	}
}