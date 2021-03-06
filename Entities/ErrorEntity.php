<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\ErrorModule\Entities;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\Venne\Doctrine\ORM\BaseRepository")
 * @Table(name="error")
 *
 * @property $text
 * @property $code
 */
class ErrorEntity extends \Venne\Doctrine\ORM\BaseEntity
{


	/**
	 * @Column(type="integer")
	 */
	protected $code;

	/**
	 * @Column(type="text")
	 */
	protected $text;



	public function getCode()
	{
		return $this->code;
	}



	public function setCode($code)
	{
		$this->code = $code;
	}



	public function getText()
	{
		return $this->text;
	}



	public function setText($text)
	{
		$this->text = $text;
	}

}
