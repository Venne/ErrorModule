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

use App\CoreModule\NavigationEntity;
use Nette\DI\ContainerBuilder;

/**
 * @author Josef Kříž
 */
class Module extends \Venne\Module\AutoModule {



	public function getName()
	{
		return "error";
	}



	public function getDescription()
	{
		return "Make basic error pages.";
	}



	public function getVersion()
	{
		return "2.0";
	}


	
	public function loadConfiguration(ContainerBuilder $container, array $config)
	{
		parent::loadConfiguration($container, $config);
		
		$container->addDefinition("errorRepository")
				->setClass("Venne\Doctrine\ORM\BaseRepository")
				->setFactory("@entityManager::getRepository", array("\\App\\ErrorModule\\ErrorEntity"))
				->addTag("repository")
				->setAutowired(false);
		
		$container->addDefinition("errorFormControl")
				->setParameters(array("entity"))
				->setClass("App\ErrorModule\ErrorForm", array("@entityFormMapper", "@entityManager", "%entity%"))
				->addTag("control")
				->setAutowired(false)
				->setShared(false);
	}

	public function configure(\Nette\DI\Container $container, \App\CoreModule\CmsManager $manager)
	{
		parent::configure($container, $manager);

		$manager->addEventListener(array(\App\CoreModule\Events::onAdminMenu), $this);
	}



	public function onAdminMenu($menu)
	{
		$nav = new NavigationEntity("Error module");
		$nav->setLink(":Error:Admin:Default:");
		$nav->setMask(":Error:Admin:*:*");
		$menu->addNavigation($nav);
	}

}
