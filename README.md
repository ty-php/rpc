远程过程调用（Remote Process Call）项目
===============

1、composer 引入包

2、创建RPC实例对象
静态方法调用微服务user：
RPC::User()->get();
RPC::User()->request();

创建搜索服务对象：
(new RPC('XinMo\Search'))->request($uri, 'GET', $bo);

3、RPC现有目录介绍
BO：请求微服务方法时，需要传递的参数对象；
Exception：统一异常处理；
Protocol：请求协议：本地调用、http、rest、tcp等；

