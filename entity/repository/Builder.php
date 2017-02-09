<?php

namespace entity\repository;

/**
 * Class Builder
 *
 * @package entity\repository
 */
class Builder
{
	/**
	 * Конфиг
	 *
	 * @var array
	 */
	protected $config;

	/**
	 * Builder constructor.
	 *
	 * @param $config
	 */
	public function __construct($config)
	{
		$this->config = $config;
	}

	/**
	 * Создает хранилище
	 *
	 * @param $type
	 *
	 * @return File|Redis
	 */
	public function createRepository($type)
	{
		switch ($type) {
			case 'file':
				return new File($this->config['file']);
			case 'redis':
				return new Redis($this->config['redis']);
		}
	}
}