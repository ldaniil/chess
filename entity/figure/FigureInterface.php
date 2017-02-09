<?php

namespace entity\figure;

/**
 * Interface FigureInterface
 *
 * @package entity\figure
 */
interface FigureInterface
{
	/**
	 * Двигает фигуру
	 *
	 * @param $coordinate
	 *
	 * @return mixed
	 */
	public function move($coordinate);

	/**
	 * Возврашает имя фигуры
	 *
	 * @return mixed
	 */
	public function getName();
}