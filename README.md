# mini_MVC_base_tp
参考thinkphp制作的小型mvc-php框架
##原作者
http://www.kancloud.cn/huangfohai/tp_easy_mvc/143321

##核心目录文件
2. 初始化框架Application.class.php
3. 自动加载类Autoload.class.php
4. 视图类View.class.php
5. 控制器核心类Controller.class.php
6. 配置文件Config.php
7. 数据库类Db.class.php
8. 模型类Model.class.php

##框架使用事项
1. 框架内的所有类名中，不能够有重复的，包括Admin模块和Home模块
2. Admin、Home、Common里面的View文件夹控制器里面的每个方法对应一个模板文件
3. 访问Admin和Home里面的模板时，display("模块名/控制器名/方法名"); 路径要写全部，不然会出错。比如display("Home/Index/index")
4. 访问公共模板时，文件位于Common文件夹中，display("Common/模板名"); 比如display("Common/redirect")
5. 调用assign()时，应该注意模板中的标签变量的名字应该和assign()的第一个参数一样，并且第一个参数是用单引号引起来
6. 比如模板中是{$msg}，那么调用如下：$this->assign('{$msg}',$msg);
7. protected function redirect($url,$msg,$time = 2)，其中$url中，除了带参数m,c,a之外，不能带其他参数。pathinfo模式），那么就是index.php/模块名/控制器名/方法名
8. 如果传递的参数个数不对，或者不是m/c/a，就不接受，pathinfo模式，错误时是控制器和方法不存在
9. 还有一种就是模块，控制器，方法都缺省的方式。http://localhost/ecshop/index.php，默认是Index控制器，index方法，因为和模块无关，所以无需默认什么模块

##个人修改
1. Controller核心类添加assign和display调用View核心类里的对应方法
