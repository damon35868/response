<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

if (!function_exists('stored')) {
	/**
	 * 创建资源成功后响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param $data
	 * @param string $message
	 * @return JsonResponse
	 */
	function stored($data, $message = '创建成功')
	{
		return respond($data, $message);
	}
}

if (!function_exists('updated')) {
	/**
	 * 更新资源成功后响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param $data
	 * @param string $message
	 * @return JsonResponse
	 */
	function updated($data, $message = '更新成功')
	{
		return respond($data, $message);
	}
}

if (!function_exists('deleted')) {
	/**
	 * 删除资源成功后响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param string $message
	 * @return JsonResponse
	 */
	function deleted($message = '删除成功')
	{
		return message($message, JsonResponse::HTTP_OK);
	}
}

if (!function_exists('accepted')) {
	/**
	 * 请求已被放入任务队列响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param string $message
	 * @return JsonResponse
	 */
	function accepted($message = '请求已接受，等待处理')
	{
		return message($message, JsonResponse::HTTP_ACCEPTED);
	}
}

if (!function_exists('notFound')) {
	/**
	 * 未找到资源响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param string $message
	 * @return JsonResponse
	 */
	function notFound($message = '您访问的资源不存在')
	{
		return message($message, JsonResponse::HTTP_NOT_FOUND);
	}
}

if (!function_exists('internalError')) {
	/**
	 * 服务器端位置错误响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param $message
	 * @param int $code
	 * @return JsonResponse
	 */
	function internalError($message = '未知错误导致请求失败', $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR)
	{
		return message($message, $code);
	}
}

if (!function_exists('failed')) {
	/**
	 * 错误的请求响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param $message
	 * @param int $code
	 * @return JsonResponse
	 */
	function failed($message, $code = JsonResponse::HTTP_BAD_REQUEST)
	{
		return message($message, $code);
	}
}

if (!function_exists('success')) {
	/**
	 * 成功响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param $date
	 * @return JsonResponse
	 */
	function success($date)
	{
		return respond($date);
	}
}

if (!function_exists('message')) {
	/**
	 * 消息响应
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param $message
	 * @param int $code
	 * @return JsonResponse
	 */
	function message($message, $code = JsonResponse::HTTP_OK)
	{
		return respond([], $message, $code);
	}
}

if (!function_exists('respond')) {
	/**
	 * 生成响应体
	 *
	 * Date: 21/03/2018
	 * @author George
	 * @param array $data
	 * @param string $message
	 * @param int $code
	 * @param array $header
	 * @return JsonResponse
	 */
	function respond($data = [], $message = '请求成功', $code = JsonResponse::HTTP_OK, array $header = [])
	{
		if ($data instanceof LengthAwarePaginator) {
			return response()->json([
				'code' => $code,
				'message' => $message,
				'data' => $data->items(),
				'current_page' => $data->currentPage(),
				'from' => $data->firstItem(),
				'per_page' => $data->perPage(),
				'to' => $data->lastItem(),
				'last_page' => $data->lastPage(),
				'total' => $data->total(),
			], $code, $header, JSON_UNESCAPED_UNICODE);
		} else {
			return response()->json([
				'code' => $code,
				'message' => $message,
				'data' => $data ? $data : []
			], $code, $header, JSON_UNESCAPED_UNICODE);
		}
	}
}
