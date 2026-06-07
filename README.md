# AstroTheme - Typecho 主题

一个简洁、响应式的 Typecho 主题，适合个人博客与技术文章展示，基于 Tailwind 风格的实用样式和轻量化组件。

**主要特性**
- 响应式布局，适配桌面与移动端
- 自带归档、标签云、分类展示、评论和侧边栏组件
- 轻量化样式、易于定制

**目录结构（部分）**
- archive.php
- comments.php
- footer.php
- functions.php
- header.php
- index.php
- page-archive.php
- page.php
- post.php
- sidebar.php
- style.css

**安装**
1. 将本主题文件夹完整上传至 Typecho 的主题目录（通常为 `/usr/themes/` 或 `YOUR_TYPECHO_ROOT/usr/themes/`）。
2. 登录 Typecho 后台 → 外观 → 主题，启用本主题。

**使用与定制**
- 样式调整请编辑 `style.css`。
- 头部/底部共用模板位于 `header.php` 与 `footer.php`。
- 侧边栏组件位于 `sidebar.php`，方便按需添加小部件。
- 如需修改归档或文章列表的展示，可编辑 `page-archive.php` 与 `post.php`。

**调试与开发**
- 本地测试：将主题复制到本地 Typecho 环境，启用后访问站点查看样式。
- 若出现样式问题，优先检查 `style.css` 是否被缓存，清理浏览器缓存或 CDN 后再刷新。

**贡献**
欢迎提交 issues 或 pull requests，或直接在本地修改后与我同步改动。

---