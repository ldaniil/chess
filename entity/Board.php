<?php

namespace entity;

use entity\Figure;
use entity\figure\Builder as FigureBuilder;

/**
 * Class Board
 *
 * @package entity
 */
class Board
{
	/**
	 * Фигуры
	 *
	 * @var array
	 */
	protected $figures = [];

	/**
	 * @var FigureBuilder
	 */
	protected $figureBuilder;

	/**
	 * Обработчики событий
	 *
	 * @var array
	 */
	protected $eventCallbacks = [];

	/**
	 * Добавлет фигуру
	 *
	 * @param $name
	 * @param $coordinate
	 *
	 * @return bool
	 */
	public function addFigure($name, $coordinate)
	{
		$figure = $this->createFigure($name);

		$this->figures[$coordinate] = $figure;

		$this->event('addFigure', $figure);
		$this->event('addFigure' . ucfirst($figure->getName()), $figure);

		return true;
	}

	/**
	 * Удаляет фигуру
	 *
	 * @param $coordinate
	 *
	 * @return bool
	 */
	public function deleteFigure($coordinate)
	{
		if (empty($this->figures[$coordinate])) {
			unset($this->figures[$coordinate]);
			return true;
		}

		return false;
	}

	/**
	 * Двигает фигуру
	 *
	 * @param $coordinate
	 * @param $newCoordinate
	 *
	 * @return mixed|void
	 */
	public function moveFigure($coordinate, $newCoordinate)
	{
		if (!empty($this->figures[$coordinate])) {
			$figure = $this->figures[$coordinate];

			if ($figure->move($newCoordinate)) {
				$this->figures[$newCoordinate] = $figure;
				unset($this->figures[$coordinate]);
			}
		} else {
			return false;
		}
	}

	/**
	 * Устанавливает создателя фигур
	 *
	 * @param FigureBuilder $builder
	 */
	public function setFigureBuilder(FigureBuilder $builder)
	{
		$this->figureBuilder = $builder;
	}

	/**
	 * Устанавливает обработчик события
	 *
	 * @param $type
	 * @param $callback
	 */
	public function setEventCallback($type, $callback)
	{
		$this->eventCallbacks[$type] = $callback;
	}

	/**
	 * Экспортирует данные
	 */
	public function export()
	{

	}

	/**
	 * Импортирует данные
	 */
	public function import($data)
	{

	}

	/**
	 * Создает фигуру
	 *
	 * @param $name
	 *
	 * @return figure\King|figure\Pawn|figure\Queen
	 * @throws figure\Exception
	 */
	protected function createFigure($name)
	{
		return $this->figureBuilder->createFigure($name);
	}

	/**
	 * Вызывает обработчик события
	 *
	 * @param $type
	 * @param $figure
	 */
	protected function event($type, $figure)
	{
		if (!empty($this->eventCallbacks[$type])) {
			$this->eventCallbacks[$type]($figure);
		}
	}
}