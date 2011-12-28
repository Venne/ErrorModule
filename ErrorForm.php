<?php

/**
 * Venne:CMS (version 2.0-dev released on $WCDATE$)
 *
 * Copyright (c) 2011 Josef Kříž pepakriz@gmail.com
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\ErrorModule;

use Venne\ORM\Column;
use Nette\Utils\Html;
use Venne\Forms\Form;

/**
 * @author Josef Kříž
 */
class ErrorForm extends \Venne\Forms\EntityForm {

	public function startup()
	{
		parent::startup();

		$this->addGroup();
		$this->addTextWithSelect("code", "Code")
				->setItems(array("403", "404", "405", "410", "500"))
				->addRule(self::FILLED, "Enter code");

		$this->addEditor("text", "Text");
	}

}
