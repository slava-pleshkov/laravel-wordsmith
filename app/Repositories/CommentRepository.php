<?php

namespace App\Repositories;

use App\Models\Comment as Model;

class CommentRepository implements RepositoryInterface
{
	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BlogCommentRepository constructor.
	 */
	public function __construct()
	{
		$this->model = new Model();
	}

	/**
	 * @return Model[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getAll()
	{
		return $this->model->all();
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function getById($id)
	{
		return $this->model->find($id);
	}

	/**
	 * @param $attributes
	 * @return mixed
	 */
	public function create($attributes)
	{
		return $this->model->create($attributes);
	}

	/**
	 * @param $id
	 * @param $attributes
	 * @return mixed
	 */
	public function update($id, $attributes)
	{
		return $this->model->find($id)->update($attributes);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this->model->find($id)->delete();
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function getCommentsAll($id)
	{
		$result = $this->model
			->where('status', 1)
			->where('article_id', $id)
			->orderBy('id', 'desc')
			->get();

		return $result;
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function getCountCommentsAll($id)
	{
		$columns = [
			'id',
			'article_id',
			'status'
		];

		$result = $this->model
			->select($columns)
			->where('status', 1)
			->where('article_id', $id)
			->count();

		return $result;
	}
}