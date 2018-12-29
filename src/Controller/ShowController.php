<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Database;

class ShowController extends BaseController {

	public function __construct() {
		parent::__construct('show.twig');
	}

	public function handleRequest($vars) {
		$db = Database::getInstance();
		$data = $db->getShow($vars['name']);
		$characters = $db->getCharacters(explode(',', $data['characters']));
		$this->render(array('pageTitle' => $data['title'], 'title' => $data['title'], 'name' => $data['name'], 'description' => $data['description'], 'characters' => $characters));
	}
}