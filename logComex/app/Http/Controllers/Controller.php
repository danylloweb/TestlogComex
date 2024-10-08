<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $service;
    protected $validator;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json($this->service->all($request->query->get('limit', 15)));
        } catch (Exception $exception) {
            return $this->sendBadResponse($exception);
        }
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->find($id));
        } catch (Exception $exception) {
            return $this->sendBadResponse($exception);
        }
    }

    /**
     * @param ProductCreateRequest $request
     * @return JsonResponse
     */
    public function store(ProductCreateRequest $request): JsonResponse
    {
        try {
            if ($this->validator) {
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            }
            return response()->json($this->service->create($request->all()));
        } catch (Exception $exception) {
            return $this->sendBadResponse($exception);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidatorException
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            if ($this->validator) {
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            }
            return response()->json($this->service->update($request->all(), $id));
        } catch (Exception $exception) {
            return $this->sendBadResponse($exception);
        }
    }

    /**
     * Restore the specified resource from storage.
     * @param $id
     * @return JsonResponse
     */
    public function restore($id): JsonResponse
    {
        try {
            return response()->json($this->service->restore($id));
        } catch (Exception $exception) {
            return $this->sendBadResponse($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->delete($id));
        } catch (Exception $exception) {
            return $this->sendBadResponse($exception);
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findWhere(array $data)
    {
        try {
            return $this->service->findWhere($data);
        } catch (Exception $exception) {
            return $this->sendBadResponse($exception);
        }
    }


    /**
     * @param Exception $exception
     * @return JsonResponse
     */
    protected function sendBadResponse(Exception $exception): JsonResponse
    {
        Log::error($exception->getMessage());

        $error = [
            'error' => 'true',
            'message' => $exception->getMessage()
        ];

        try {
            return response()->json($error,422);
        } catch (Exception $exception) {
            return response()->json($error, 406);
        }
    }
}
