# Laravel Response

[![Latest Stable Version](https://poser.pugx.org/Damon35868/response/v/stable)](https://packagist.org/packages/Damon35868/response)
[![Total Downloads](https://poser.pugx.org/Damon35868/response/downloads)](https://packagist.org/packages/Damon35868/response)
[![License](https://poser.pugx.org/Damon35868/response/license)](https://packagist.org/packages/Damon35868/response)

### 1.Use Trait class in your base controller

`use Damon35868\Traits\Response\InterfaceResponse;`

> e.g.

```
   <?php

   namespace App\Http\Controllers;

   use Illuminate\Foundation\Bus\DispatchesJobs;
   use Damon35868\Traits\Response\InterfaceResponse;
   use Illuminate\Routing\Controller as BaseController;
   use Illuminate\Foundation\Validation\ValidatesRequests;
   use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

   class Controller extends BaseController
   {
       use AuthorizesRequests, DispatchesJobs, ValidatesRequests, InterfaceResponse;
   }

```

### 2.Use helper function in your project

- stored

```
return stored($data, $message = '创建成功');

```

- updated

```
return updated($data, $message = '更新成功');

```

- deleted

```
return deleted($message = '删除成功');

```

- accepted

```
return accepted($message = '请求已接受，等待处理');

```

- notFound

```
return notFound($message = '您访问的资源不存在');

```

- internalError

```
return internalError($message = '未知错误导致请求失败');

```

- failed

```
return failed($message, $code = Response::HTTP_BAD_REQUEST);

```

- success

```
return success($data);

```

- message

```
return message($message, $code = Response::HTTP_OK);

```

- respond

```
return respond($data = [], $message = '请求成功', array $header = []);

```
