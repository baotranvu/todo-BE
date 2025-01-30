<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
trait ApiResponse
{
    /**
     * Build API response structure
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @param bool $status
     * @return array
     */
    protected function buildResponse($data = null, ?string $message = null, int $status = Response::HTTP_OK, bool $success = true): array
    {
        return [
            'success' => $success,
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'errors' => null,
        ];
    }

    /**
     * Return a success response
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse($data = null, ?string $message = null, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json(
            $this->buildResponse($data, $message, $status, true),
        );
    }

    /**
     * Return an error response
     *
     * @param string|null $message
     * @param mixed $errors
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse(?string $message = null, $errors = null, int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json(
            $this->buildResponse($errors, $message, $status, false),
        );
    }

    /**
     * Return a validation error response
     *
     * @param mixed $errors
     * @param string|null $message
     * @return JsonResponse
     */
    public function validationError($errors, ?string $message = 'Validation failed'): JsonResponse
    {
        return $this->errorResponse($message, $errors, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Return a not found error response
     *
     * @param string $message
     * @param mixed $data
     * @return JsonResponse
     */
    public function notFound(string $message = 'Resource not found', $data = null): JsonResponse
    {
        return $this->errorResponse($message, $data, Response::HTTP_NOT_FOUND);
    }

    /**
     * Return an unauthorized error response
     *
     * @param string $message
     * @param mixed $data
     * @return JsonResponse
     */
    public function unauthorized(string $message = 'Unauthorized', $data = null): JsonResponse
    {
        return $this->errorResponse($message, $data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Return a forbidden error response
     *
     * @param string $message
     * @param mixed $data
     * @return JsonResponse
     */
    public function forbidden(string $message = 'Forbidden', $data = null): JsonResponse
    {
        return $this->errorResponse($message, $data, Response::HTTP_FORBIDDEN);
    }

    /**
     * Return a server error response
     *
     * @param string $message
     * @param mixed $data
     * @return JsonResponse
     */
    public function serverError(string $message = 'Server Error', $data = null): JsonResponse
    {
        return $this->errorResponse($message, $data, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Return a created response
     *
     * @param mixed $data
     * @param string|null $message
     * @return JsonResponse
     */
    public function created($data = null, ?string $message = 'Resource created successfully'): JsonResponse
    {
        return $this->successResponse($data, $message, Response::HTTP_CREATED);
    }

    /**
     * Return a no content response
     *
     * @return JsonResponse
     */
    public function noContent(): JsonResponse
    {
        return $this->successResponse(null, null, Response::HTTP_NO_CONTENT);
    }
}
