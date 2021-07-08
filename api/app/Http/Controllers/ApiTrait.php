<?php

namespace App\Http\Controllers;

trait ApiTrait
{
    /**
     * Api Controller return success response
     *
     * @param string $message
     * @param array  $data
     * @param array  $field
     * @return mixed
     */
    public function returnSuccess($message = '', $data = [], $field = [])
    {
        $field['data'] = $data;
        return response()->json(array_merge([
            'success' => true,
            'message' => $message,
        ], $field), 200);
    }

    /**
     * return bad request status response
     *
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnError($message = '', $data = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data
        ], 400);
    }

    /**
     * return not found response
     *
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnNotFoundError($message = 'Not found', $data = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data
        ], 404);
    }

    /**
     * return 500 error response
     *
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnServerError($message = 'Something Wrong', $data = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data
        ], 500);
    }

    /**
     * UnAuth return
     *
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnUnAuthError($message = 'You have no permission', $data = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data
        ], 401);
    }
}
