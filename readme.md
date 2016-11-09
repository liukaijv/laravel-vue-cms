# laravel-vue-cms

> 这个项目一直没有更新，把前端部分作了些修改放这个项目里了[https://github.com/liukaijv/vue-admin-template](https://github.com/liukaijv/vue-admin-template)。

学习laravel和vue，用laravel5.2, vue.js 1.0+ and INSPINIA Admin Theme写的

## 线上演示

[demo](http://115.28.223.2:8765/admin/ "demo")

账号: demo 或者 demo@qq.com

密码: demo

## 本地运行

### 克隆代码，安装依赖

```
clone https://github.com/liukaijv/laravel-vue-cms.git someDir

cd someDir

composer install

npm install

```

### 数据库设置

mysql：修改.env文件的数据库配置

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-vue-cms
DB_USERNAME=root
DB_PASSWORD=

```

sqlite：修改config/database.php，使用sqlite

```
'default' => env('DB_CONNECTION', 'sqlite')

// 创建database.sqlite文件
touch database/database.sqlite

```


### 运行

```
// 创建数据库，填充数据
php artisan migrate
php artisan db:seed

// 后台服务
npm run web

// 前台测试
npm run dev

// 代码生成到publick/admin目录
npm run build

```
