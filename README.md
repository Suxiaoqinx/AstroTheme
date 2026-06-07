# AstroTheme - Typecho 主题

一个简洁、响应式的 Typecho 主题，适合个人博客与技术文章展示，基于 Tailwind CSS 风格的实用样式和轻量化组件。

## ✨ 主要特性

- 响应式布局，完美适配桌面与移动端
- 深色/浅色主题切换，支持跟随系统
- 文章目录（TOC）自动生成
- 内置评论功能，支持嵌套回复与弹窗表单
- 归档、标签云、分类展示、友链、留言板、相册、说说等独立页面
- 侧边栏个人信息卡片、最新文章、最新评论、标签云等组件
- 图片灯箱（Fancybox）支持
- 文章浏览量统计
- 文章置顶功能
- 缩略图自定义，支持左侧/右侧布局
- 首页跑马灯背景图
- 滚动进度条与返回顶部按钮
- 文章列表视图切换（列表/网格），手机端默认网格，电脑端默认列表
- PJAX 全局无刷新页面切换，带加载进度条和全屏 Loading 提示
- 轻量化样式，易于定制

## 📁 目录结构

```
├── archive.php          # 归档页模板
├── comments.php         # 评论模板
├── footer.php           # 页脚模板
├── functions.php        # 主题配置与功能函数
├── header.php           # 页头模板
├── index.php            # 首页模板
├── page-archive.php     # 归档独立页面
├── page-gallery.php     # 相册独立页面
├── page-guestbook.php   # 留言板独立页面
├── page-links.php       # 友链独立页面
├── page-moments.php     # 说说独立页面
├── page.php             # 普通页面模板
├── post-item.php        # 文章列表项
├── post.php             # 文章详情页
├── screenshot.png       # 主题截图
├── search.php           # 搜索页模板
├── sidebar.php          # 侧边栏
├── style.css            # 自定义样式
├── joe.short.js         # 短代码/工具脚本
└── README.md            # 说明文档
```

## 📦 安装

1. 将本主题文件夹完整上传至 Typecho 的主题目录（通常为 `/usr/themes/` 或 `YOUR_TYPECHO_ROOT/usr/themes/`）
2. 登录 Typecho 后台 → 外观 → 主题，启用 **AstroTheme**

## ️ 主题设置

启用主题后，可在 Typecho 后台 → 外观 → 设置主题 中配置以下选项：

### 导航设置
- 导航栏显示数量
- 导航栏 Logo 图片

### 首页设置
- 大标题 (Hero Title)
- 描述 (Hero Description)
- 跑马灯背景图片（一行一个 URL）
- 置顶文章 CID（多个用英文逗号分隔）
- 默认缩略图地址
- 每页文章数目
- 文章列表默认样式（列表/网格）

### 侧边栏设置
- 昵称 / 介绍
- 头像图片地址 / 自定义头像源（Gravatar 镜像）
- GitHub / Email 链接
- 最新文章显示数量
- 系统公告（支持 HTML）

### 友链设置
- 友情链接（格式：`博客名称 || 博客地址 || 博客头像 || 博客简介`，一行一个）

### 底部自定义
- 自定义底部 HTML 内容（留空则显示默认版权信息）

## ️ 使用与定制

- 样式调整请编辑 `style.css`
- 头部/底部共用模板位于 `header.php` 与 `footer.php`
- 侧边栏组件位于 `sidebar.php`，方便按需添加小部件
- 如需修改归档或文章列表的展示，可编辑 `page-archive.php` 与 `post.php`
- 评论模板位于 `comments.php`，列表渲染函数在 `functions.php` 的 `threadedComments()` 中定义
- 文章列表视图切换按钮仅在电脑端显示，手机端默认网格布局

##  调试与开发

- 本地测试：将主题复制到本地 Typecho 环境，启用后访问站点查看样式
- 若出现样式问题，优先检查 `style.css` 是否被缓存，清理浏览器缓存或 CDN 后再刷新
- 确保 Typecho 后台 **设置 → 评论** 中已勾选"允许其他人在我的文章上评论"
- 确保每篇文章编辑时右侧的"允许评论"已勾选
- PJAX 局部刷新：导航栏、主内容区、页脚、悬浮按钮等区域会自动更新

## 🤝 贡献

欢迎提交 issues 或 pull requests，或直接在本地修改后与我同步改动。

##  许可证

MIT License
