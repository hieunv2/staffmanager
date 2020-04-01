<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class ApiResourceController extends BaseController
{
	/** @var $model Model */
	protected $model;
	
	/** @var Builder $query */
	protected $query;
	
	/** @var Request $request */
	protected $request;
	
	public function __construct()
	{
		$this->request = request();
		$this->setModel();
		$this->setQuery();
	}
	
	abstract protected function setModel();
	
	protected function setQuery()
	{
		$this->query = $this->model->query();
	}
	
	protected function resultResponse($data)
	{
		return $data ? $this->successResponse() : $this->errorResponse();
	}
	
	protected function successResponse($responseData = ['message' => 'OK'])
	{
		return response()->json($responseData);
	}
	
	protected function errorResponse($errorData = ['errors' => 'System error'])
	{
		return response()->json($errorData, 500);
	}
	
	protected function addDefaultFilter()
	{
		$data = $this->request->all();
		foreach ($data as $key => $value) {
			try {
				if (preg_match('/(.*)_like$/', $key, $matches)) {
					$this->query->where($matches[1], 'like', '%' . $value . '%');
				}
				if (preg_match('/(.*)_equal$/', $key, $matches)) {
					$this->query->where($matches[1], $value);
				}
				if (preg_match('/^has_(.*)/', $key, $matches) && $value) {
					$this->query->whereHas($matches[1]);
				}
				if ($key == 'only_trashed' && $value) {
					$this->query->onlyTrashed();
				}
				if ($key == 'with_trashed' && $value) {
					$this->query->withTrashed();
				}
				
				if ($key == 'sort' && $value) {
					$sortParams = explode('|', $value);
					$this->query->getQuery()->orders = null;
					if (strpos($sortParams[0], '.') !== false) {
						$this->query->orderByJoin($sortParams[0], isset($sortParams[1]) ? $sortParams[1] : 'asc');
					}
					$this->query->orderBy($sortParams[0], isset($sortParams[1]) ? $sortParams[1] : 'asc');
				}
			} catch (\Exception $e) {
			
			}
		}
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if (method_exists($this, 'addFilter')) {
			$this->addFilter();
		}
		$this->addDefaultFilter();
		$data = $this->query->paginate($request->per_page ?? 20);
		return response()->json($data);
	}
	
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return mixed
	 */
	public function _store(Request $request)
	{
		$data = $request->only($this->model->getFillable());
		if (method_exists($this->model, 'adminCreate')) {
			$this->model->fill($data);
			$result = $this->model->adminCreate();
		} else
			$result = $this->query->create($data);
		return $this->resultResponse($result);
	}
	
	
	/**
	 * Display the specified resource.
	 * @param $id
	 * @return Builder|mixed
	 */
	public function show($id)
	{
		if (method_exists($this, 'addAppend')) {
			$this->addAppend();
		}
		$data = $this->query->find($id);
		return $data ?? response()->json([
				'message' => 'Not found',
			], 404);
	}
	
	
	/**
	 *      * Update the specified resource in storage.
	 * @param Request $request
	 * @param $id
	 * @return mixed
	 */
	public function _update(Request $request, $id)
	{
		$data = $request->toArray();
		if (isset($data['id'])) unset($data['id']);
		$item = $this->query->where('id', $id)->first();
		if (!$item) return response()->json(['error' => 'Not found'], 404);
		$item->fill($data);
		if (method_exists($item, 'adminUpdate')) {
			$result = $item->adminUpdate();
		} else
			$result = $item->update();
		return $this->resultResponse($result);
	}
	
	
	/**
	 * Remove the specified resource from storage.
	 * @param $id
	 * @return bool|\Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function destroy($id)
	{
		$data = $this->query->find($id);
		if (!$data) return $this->errorResponse();
		$result = $data->delete();
		return $this->resultResponse($result);
	}
	
}
