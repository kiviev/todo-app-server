<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use NexTyres\Task\Application\TaskUseCase;
use NexTyres\Task\Domain\TaskEntity;
use NexTyres\Task\Infraestructure\TaskRepository;

class TodoController extends Controller
{
    /**
     * @var TaskUseCase
     */
    private $useCase;

    public function __construct()
    {
        $this->useCase = new TaskUseCase(new TaskRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->useCase->listAction();

        $responseData = [];
        $status = false;
        if ($list) {
            $status = true;
            $responseData = $list;
        }

        return $this->getResponse($status, $responseData);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateRequestData($request);

        $entity = $this->buildTaskEntity($validatedData);

        $result = $this->useCase->save($entity);

        $responseData = [];
        $status = false;
        if ($result) {
            $status = true;
        }

        return $this->getResponse($status, $responseData);;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->useCase->find($id);
        $responseData = [];
        $status = false;
        if ($task instanceof TaskEntity) {
            $status = true;
            $responseData = [$task];
        }

        return $this->getResponse($status, $responseData);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateRequestData($request);

        $entity = $this->buildTaskEntity($validatedData);

        $task = $this->useCase->save($entity);

        $responseData = [];
        $status = false;
        if ($task instanceof TaskEntity) {
            $status = true;
            $responseData = [$task];
        }

        return $this->getResponse($status, $responseData);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->useCase->destroy($id);

        return $this->getResponse($destroy, [
            'id' => $id
        ]);;
    }

    private function getResponse(bool $status, array $data)
    {
        return [
            'status' => $status === true ? 'OK' : 'KO',
            'data' => $data
        ];
    }

    /**
     * @param array $validatedData
     * @return TaskEntity
     */
    private function buildTaskEntity(array $validatedData): TaskEntity
    {
        $entity = new TaskEntity(
            $validatedData['id'],
            $validatedData['title'],
            $validatedData['description'],
            $validatedData['priority']);
        return $entity;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateRequestData(Request $request): array
    {
        $validatedData = $request->validate([
            'id' => 'numeric|nullable',
            'title' => 'required:max:255',
            'description' => 'max:500',
            'priority' => 'required|integer|between:0,5'
        ]);
        return $validatedData;
    }
}
