<?php

/**
 * Venne:CMS (version 2.0-dev released on $WCDATE$)
 *
 * Copyright (c) 2011 Josef Kříž pepakriz@gmail.com
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\ErrorModule\AdminModule;

use Nette\Forms\Form;
use Nette\Web\Html;

/**
 * @author Josef Kříž
 * 
 * @secured
 */
class DefaultPresenter extends \Venne\Application\UI\AdminPresenter {


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
		$repository = $this->context->errorRepository;
		$entity = $repository->createNew();

		$form = $this->context->createErrorFormControl($entity);
		$form->setSuccessLink("default");
		$form->setFlashMessage("Error has been created");
		$form->setSubmitLabel("Create");
		$form->onSave[] = function($form) use ($repository) {
					$repository->save($form->entity);
				};
		return $form;
	}



	public function createComponentFormEdit($name)
	{
		$repository = $this->context->errorRepository;
		$entity = $repository->find($this->getParam("id"));

		$form = $this->context->createErrorFormControl($entity);
		$form->setSuccessLink("this");
		$form->setFlashMessage("Error has been updated");
		$form->setSubmitLabel("Update");
		$form->onSave[] = function($form) use ($repository) {
					$repository->update($form->entity);
				};
		return $form;
	}



	public function beforeRender()
	{
		parent::beforeRender();
		$this->setTitle("Venne:CMS | Pages administration");
		$this->setKeywords("pages administration");
		$this->setDescription("pages administration");
		$this->setRobots(self::ROBOTS_NOINDEX | self::ROBOTS_NOFOLLOW);
	}



	public function handleDelete($id)
	{
		$this->context->errorRepository->delete($this->context->errorRepository->find($this->getParam("id")));
		$this->flashMessage("Error page has been deleted", "success");
		$this->redirect("this", array("id" => NULL));
	}



	public function renderDefault()
	{
		$this->template->table = $this->context->errorRepository->findAll();
	}

}