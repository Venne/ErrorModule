<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011 Josef Kříž (pepakriz
 * @gmail.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\ErrorModule;

use App\CoreModule\NavigationEntity;
use Nette\DI\ContainerBuilder;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class Module extends \Venne\Module\BaseModule {


	/** @var string */
	protected $version = "2.0";

	/** @var string */
	protected $description = "Make basic error pages.";


}
