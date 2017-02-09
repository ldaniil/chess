<?php

namespace entity;

use entity\figure\Builder as FigureBuilder;
use entity\repository\RepositoryInterface;

/**
 * Class Game
 *
 * @package entity
 */
class Game
{
	/**
	 * Идентификатор
	 *
	 * @var string
	 */
	protected $identity;

	/**
	 * @var Board
	 */
	protected $board;

	/**
	 * @var RepositoryInterface
	 */
	protected $repository;

	/**
	 * @var FigureBuilder
	 */
	protected $figureBuilder;

	/**
	 * Game constructor.
	 *
	 * @param array $config
	 */
	public function __construct(array $config)
	{
		$this->identity = md5(time() . rand(111111111, 999999999));

		if (!empty($config['repository'])) {
			$this->repository = $config['repository'];
		}

		$this->figureBuilder = $config['figureBuilder'];

		$this->initBoard($config);
	}

	/**
	 * Возвращает доску
	 *
	 * @return Board
	 */
	public function getBoard()
	{
		return $this->board;
	}

	/**
	 * Сохраняет состояние доски
	 *
	 * @return bool
	 */
	public function save()
	{
		if ($this->repository) {
			return $this->repository->set($this->identity, $this->getBoard()->export());
		} else {
			return false;
		}
	}

	/**
	 * Загружает сохраненое состояние доски
	 *
	 * @return bool|void
	 */
	public function load()
	{
		if ($this->repository) {
			$data = $this->repository->get($this->identity);
			return $this->getBoard()->import($data);
		} else {
			return false;
		}
	}

	/**
	 * Создает доску
	 *
	 * @param $config
	 */
	protected function initBoard($config)
	{
		$this->board = new Board();
		$this->board->setFigureBuilder($this->figureBuilder);

		if (!empty($config['callbackEvents'])) {
			foreach ($config['callbackEvents'] as $type => $callback) {
				$this->board->setEventCallback($type, $callback);
			}
		}

		if (!empty($config['figures'])) {
			foreach ($config['figures'] as $coordinate => $name) {
				$this->board->addFigure($name, $coordinate);
			}
		}
	}
}