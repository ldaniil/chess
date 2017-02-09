<?php

namespace entity\figure;

/**
 * Class Builder
 *
 * @package entity\figure
 */
class Builder
{
	/**
	 * Создает фигуру  по имени
	 *
	 * @param $name
	 *
	 * @return King|Pawn|Queen
	 * @throws Exception
	 */
	public function createFigure($name)
	{
		switch ($name) {
			case 'pawn':

				return new Pawn();

				break;

			case 'queen':

				return new Queen();

				break;

			case 'king':

				return new King();

				break;

			default:

				throw new Exception('Нет фигуры: ' . $name);
		}
	}
}