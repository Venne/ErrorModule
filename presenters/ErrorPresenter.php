<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\ErrorModule;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 *
 * @secured
 */
class ErrorPresenter extends \Venne\Application\UI\FrontPresenter
{


	/**
	 * @param  Exception
	 * @return void
	 */
	public function renderDefault($exception)
	{
		if ($this->isAjax()) { // AJAX request? Just note this error in payload.
			$this->payload->error = TRUE;
			$this->terminate();

		} elseif ($exception instanceof \Nette\Application\BadRequestException) {
			$code = $exception->getCode();

		} else {
			$code = 500;
			Debugger::log($exception, Debugger::ERROR); // and log exception
		}

		$this->template->error = $this->context->errorRepository->findOneBy(array("code" => $code));
		$this->template->code = $code;
		if ($this->template->error) {
			$this->setView("error");
		}


	}

}