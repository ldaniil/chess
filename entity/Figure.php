<?php

namespace entity;

use entity\figure\FigureInterface;

/**
 * Class Figure
 *
 * @package entity
 */
abstract class Figure implements FigureInterface
{
	/**
	 * Имя
	 *
	 * @var
	 */
	protected $name;

	/**
	 * Координата
	 *
	 * @var
	 */
	protected $coordinate;

	public function getName()
	{
		return $this->name;
	}
}