<?php

namespace App\ErrorModule;

use Nette\Environment;

class ErrorPresenter extends \Venne\Application\UI\FrontPresenter {


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