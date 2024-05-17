<?php

namespace Damon35868\Traits\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Trait InterfaceResponse
 * @package App\Traits\Response
 * Date: 19/03/2018
 * @author George
 */
trait InterfaceResponse
{
	/**
	 * 定义默认响应状态码
	 *
	 * @var int
	 * Date: 19/03/2018
	 * @author George
	 */
	protected $statusCode = JsonResponse::HTTP_OK;

	/**
	 * 设置响应状态吗
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param $statusCode
	 * @return $this
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/**
	 * 创建资源成功响应
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param $data
	 * @param $message
	 * @return JsonResponse
	 */
	public function stored($data, $message = '创建成功')
	{
		return $this->setStatusCode(JsonResponse::HTTP_CREATED)->respond($data, $message);
	}

	/**
	 * 更新资源成功的响应
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param $data
	 * @param $message
	 * @return JsonResponse
	 */
	public function updated($data, $message = '更新成功')
	{
		return $this->setStatusCode(JsonResponse::HTTP_OK)->respond($data, $message);
	}

	/**
	 * 删除资源成功响应
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param $message
	 * @return JsonResponse
	 */
	public function deleted($message = '删除成功')
	{
		return $this->setStatusCode(JsonResponse::HTTP_NO_CONTENT)->respond([], $message);
	}

	/**
	 * 异步任务响应
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param $message
	 * @return JsonResponse
	 */
	public function accepted($message = '请求已接受，等待处理')
	{
		return $this->setStatusCode(JsonResponse::HTTP_ACCEPTED)->message($message);
	}

	/**
	 * 资源不存在
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param string $message
	 * @return JsonResponse
	 */
	public function notFound($message = '您访问的资源不存在')
	{
		return $this->failed($message, JsonResponse::HTTP_NOT_FOUND);
	}

	/**
	 * 服务器未知错误
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param string $message
	 * @return JsonResponse
	 */
	public function internalError($message = '未知错误导致请求失败')
	{
		return $this->failed($message, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
	}

	/**
	 * 未知错误响应
	 *
	 * Date: 22/03/2018
	 * @author George
	 * @param $message
	 * @param int $code
	 * @return JsonResponse
	 */
	public function failed($message, $code = JsonResponse::HTTP_BAD_REQUEST)
	{
		return $this->message($message, $code);
	}

	/**
	 * 响应资源
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param $data
	 * @return JsonResponse
	 */
	public function success($data)
	{
		return $this->respond($data);
	}

	/**
	 * 响应消息
	 *
	 * Date: 22/03/2018
	 * @author George
	 * @param $message
	 * @param int $code
	 * @return JsonResponse
	 */
	public function message($message, $code = JsonResponse::HTTP_OK)
	{
		return $this->setStatusCode($code)->respond([], $message);
	}

	/**
	 * 生成响应
	 *
	 * Date: 19/03/2018
	 * @author George
	 * @param array $data
	 * @param string $message
	 * @param array $header
	 * @return JsonResponse
	 */
	public function respond($data = [], $message = '请求成功', array $header = [])
	{
		if ($data instanceof LengthAwarePaginator) {
			return response()->json([
				'code' => $this->statusCode,
				'message' => $message,
				'data' => $data->items(),
				'current_page' => $data->currentPage(),
				'from' => $data->firstItem(),
				'per_page' => $data->perPage(),
				'to' => $data->lastItem(),
				'total' => $data->total(),
			], $this->statusCode, $header, JSON_UNESCAPED_UNICODE);
		}
		return response()->json([
			'code' => $this->statusCode,
			'message' => $message,
			'data' => $data ? $data : []
		], $this->statusCode, $header, JSON_UNESCAPED_UNICODE);
	}
}
