<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\ErrorModule\AdminModule;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 *
 * @secured
 */
class DefaultPresenter extends \Venne\Application\UI\AdminPresenter
{


	/** @persistent */
	public $id;



	public function startup()
	{
		parent::startup();
		$this->addPath("Error", $this->link(":Error:Admin:Default:"));
	}



	public function actionCreate()
	{
		$this->addPath("new item", $this->link(":Error:Admin:Default:create"));
	}



	public function actionEdit()
	{
		$this->addPath("edit ({$this->id})", $this->link(":Error:Admin:Default:edit"));
	}



	public function createComponentForm($name)
	{
		$repository = $this->context->error->errorRepository;
		$entity = $repository->createNew();

		$form = $this->context->error->createErrorForm();
		$form->setEntity($entity);
		$form->addSubmit("_submit", "Save");
		$form->onSuccess[] = function($form) use ($repository)
		{
			$repository->save($form->entity);
			$form->presenter->flashMessage("Error has been created");
			$form->presenter->redirect("default");
		};
		return $form;
	}



	public function createComponentFormEdit($name)
	{
		$repository = $this->context->error->errorRepository;
		$entity = $repository->find($this->getParameter("id"));

		$form = $this->context->error->createErrorForm();
		$form->setEntity($entity);
		$form->addSubmit("_submit", "Save");
		$form->onSuccess[] = function($form) use ($repository)
		{
			$repository->save($form->entity);
			$form->presenter->flashMessage("Error has been updated");
			$form->presenter->redirect("this");
		};
		return $form;
	}



	public function handleDelete($id)
	{
		$this->context->error->errorRepository->delete($this->context->error->errorRepository->find($this->getParam("id")));
		$this->flashMessage("Error page has been deleted", "success");
		$this->redirect("this", array("id" => NULL));
	}



	public function renderDefault()
	{
		$this->template->table = $this->context->error->errorRepository->findAll();
	}

}