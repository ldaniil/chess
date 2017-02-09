<?php

namespace entity\repository;

/**
 * Interface RepositoryInterface
 *
 * @package entity\repository
 */
interface RepositoryInterface
{
	/**
	 * Возвращает данные
	 *
	 * @param $id
	 */
	public function get($id);

	/**
	 * Устанавливает данные
	 *
	 * @param $id
	 * @param $data
	 */
	public function set($id, $data);
}