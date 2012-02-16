<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\ErrorModule\Forms;

use Venne;
use Venne\Forms\EntityForm;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ErrorForm extends EntityForm
{

	public function startup()
	{
		parent::startup();

		$this->addGroup();
		$this->addTextWithSelect("code", "Code")->setItems(array("403", "404", "405", "410", "500"), false)->addRule(self::FILLED, "Enter code");

		$this->addEditor("text", "Text");
	}

}
