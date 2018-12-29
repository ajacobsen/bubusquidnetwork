<?php

namespace App\Controller;

use Twig_Loader_Filesystem;
use Twig_Environment;

class BaseController {
	protected $template;
	private $loader;
	private $twig;

	public function __construct($template_file) {
		$this->$loader = new Twig_Loader_Filesystem('../src/templates');
		$this->$twig = new Twig_Environment($this->$loader);
		$this->$template = $this->$twig->load($template_file);
	}

	public function render($vars) {
		echo $this->$template->render($vars);
	}
}