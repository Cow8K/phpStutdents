# 学生后台管理系统

基于 ThinkPHP + Layui 的学生管理系统，支持管理员权限、学生/课程/成绩管理等功能。

## 主要功能

- 管理员登录/退出/密码修改（Session + 中间件校验）
- 学生管理：增删改查 + 搜索 + 导入 + 班级关联
- 班级/课程/成绩：完整 CRUD
- 管理员列表管理 + 头像上传
- 操作日志记录（事件机制）
- 首页仪表盘

## 技术栈

- 后端：ThinkPHP 6
- 前端：Layui + think-view
- 其他：路由分组、中间件、验证器、事件系统

## 预览

### 1. 登录页面
<img width="2285" height="1268" alt="image" src="https://github.com/user-attachments/assets/1d5bfb1f-67d7-4ddb-950f-1661e839d5c1" />

### 2. 首页
<img width="2490" height="862" alt="image" src="https://github.com/user-attachments/assets/ec32de73-d8de-46af-9a46-a91923497f7d" />

### 3. 学生管理
<img width="2489" height="1352" alt="image" src="https://github.com/user-attachments/assets/37d68956-4b27-4697-8877-143c9d51643b" />



## 快速启动

```bash
git clone https://github.com/Cow8K/phpStutdents.git
cd 项目目录
composer install
cp .env.example .env          # 修改数据库配置
# 导入数据库（database/sql）
php think run
