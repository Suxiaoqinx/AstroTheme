<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 注册插件：通过插件接口自动处理短代码
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('AstroTheme_Plugin', 'contentEx');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('AstroTheme_Plugin', 'excerptEx');

class AstroTheme_Plugin {
    public static function contentEx($content, $widget, $lastResult) {
        $content = empty($lastResult) ? $content : $lastResult;
        if ($widget instanceof Widget_Archive) {
            $content = parseContentShortcode($content, $widget);
        }
        return $content;
    }
    public static function excerptEx($content, $widget, $lastResult) {
        $content = empty($lastResult) ? $content : $lastResult;
        if ($widget instanceof Widget_Archive) {
            $content = parseContentShortcode($content, $widget);
        }
        return $content;
    }
}

function themeConfig($form) {
    // === 导航设置 ===
    $navLimit = new \Typecho\Widget\Helper\Form\Element\Text('navLimit', null, '4', _t('【导航设置】导航栏显示数量'), _t('设置导航栏最多显示的分类/页面数量，超出的将放入下拉菜单中，默认 4'));
    $form->addInput($navLimit);
    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text('logoUrl', null, null, _t('【导航设置】导航栏 Logo'), _t('导航栏左上角的 Logo 图片地址'));
    $form->addInput($logoUrl);

    // === 首页设置 ===
    $heroTitle = new \Typecho\Widget\Helper\Form\Element\Text('heroTitle', null, null, _t('【首页设置】大标题 (Hero Title)'), _t('首页头部显示的大标题，如果不填则默认显示网站标题'));
    $form->addInput($heroTitle);
    $heroDesc = new \Typecho\Widget\Helper\Form\Element\Text('heroDesc', null, null, _t('【首页设置】描述 (Hero Description)'), _t('首页头部显示的描述文字，如果不填则默认显示网站描述'));
    $form->addInput($heroDesc);
    $heroImages = new \Typecho\Widget\Helper\Form\Element\Textarea('heroImages', null, null, _t('【首页设置】跑马灯图片'), _t('首页头部背景跑马灯显示的图片地址，一行一个，建议尺寸相似。如果不填则不显示背景。'));
    $form->addInput($heroImages);
    $stickyCids = new \Typecho\Widget\Helper\Form\Element\Text('stickyCids', null, null, _t('【首页设置】置顶文章 (CID)'), _t('请填入需要置顶的文章 CID，以英文逗号分隔，如：1,2,3'));
    $form->addInput($stickyCids);
    $defaultThumb = new \Typecho\Widget\Helper\Form\Element\Text('defaultThumb', null, null, _t('【首页设置】默认缩略图'), _t('文章没有缩略图且没有图片时，默认显示的图片地址。如果这里也留空，则不显示图片。'));
    $form->addInput($defaultThumb);
    $customPageSize = new \Typecho\Widget\Helper\Form\Element\Text('customPageSize', null, '10', _t('【首页设置】每页文章数目'), _t('设置首页和分类归档页每页显示的文章数量，默认 10。'));
    $form->addInput($customPageSize);

    // === 侧边栏设置 ===
    $sidebarNickname = new \Typecho\Widget\Helper\Form\Element\Text('sidebarNickname', null, null, _t('【侧边栏设置】昵称'), _t('侧边栏个人信息卡片显示的昵称，如果不填则默认显示网站标题'));
    $form->addInput($sidebarNickname);
    $sidebarDesc = new \Typecho\Widget\Helper\Form\Element\Text('sidebarDesc', null, null, _t('【侧边栏设置】介绍'), _t('侧边栏个人信息卡片显示的介绍，如果不填则默认显示网站描述'));
    $form->addInput($sidebarDesc);
    $avatarUrl = new \Typecho\Widget\Helper\Form\Element\Text('avatarUrl', null, null, _t('【侧边栏设置】头像图片地址'), _t('侧边栏显示的头像URL，默认使用主题目录下的 avatar.png'));
    $form->addInput($avatarUrl);
    $customAvatarSource = new \Typecho\Widget\Helper\Form\Element\Text('JCustomAvatarSource', null, 'https://gravatar.ihuan.me/avatar/', _t('【头像设置】自定义头像源'), _t('自定义头像服务地址（末尾可选 /），例如 https://gravatar.ihuan.me/avatar/'));
    $form->addInput($customAvatarSource);
    $githubUrl = new \Typecho\Widget\Helper\Form\Element\Text('githubUrl', null, null, _t('【侧边栏设置】GitHub 链接'), _t('侧边栏显示的 GitHub 链接'));
    $form->addInput($githubUrl);
    $emailUrl = new \Typecho\Widget\Helper\Form\Element\Text('emailUrl', null, null, _t('【侧边栏设置】Email 链接'), _t('侧边栏显示的 Email 链接，例如 mailto:you@example.com'));
    $form->addInput($emailUrl);
    $sidebarRecentNum = new \Typecho\Widget\Helper\Form\Element\Text('sidebarRecentNum', null, '5', _t('【侧边栏设置】最新文章显示数量'), _t('侧边栏最新文章模块最多显示的文章数量，默认为 5'));
    $form->addInput($sidebarRecentNum);
    $siteNotice = new \Typecho\Widget\Helper\Form\Element\Textarea('siteNotice', null, null, _t('【侧边栏设置】系统公告'), _t('侧边栏顶部显示的系统公告，支持 HTML，留空则不显示。'));
    $form->addInput($siteNotice);

    // === 友链设置 ===
    $links = new \Typecho\Widget\Helper\Form\Element\Textarea('links', null, null, _t('【友链设置】友情链接'), _t('用于填写友情链接<br>注意：您需要先增加友链链接页面（新增独立页面-右侧模板选择友链），该项才会生效<br>格式：博客名称 || 博客地址 || 博客头像 || 博客简介<br>其他：一行一个，一行代表一个友链'));
    $form->addInput($links);

    // === 评论设置 ===
    $allowComment = new \Typecho\Widget\Helper\Form\Element\Radio('allowComment', array(
        '1' => _t('开启'),
        '0' => _t('关闭')
    ), '1', _t('【评论设置】是否开启文章评论'), _t('开启后，文章详情页底部将显示评论区，默认开启'));
    $form->addInput($allowComment);

    // === 底部自定义 ===
    $customFooter = new \Typecho\Widget\Helper\Form\Element\Textarea('customFooter', null, null, _t('【底部设置】自定义底部 HTML'), _t('填写自定义底部内容（HTML），留空则显示默认版权信息。'));
    $form->addInput($customFooter);
}

// 添加文章自定义字段
function themeFields($layout) {
    $thumb = new \Typecho\Widget\Helper\Form\Element\Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('输入缩略图的图片地址。留空则尝试获取文章第一张图片，如果没有则不显示。'));
    $layout->addItem($thumb);

    $thumbPosition = new \Typecho\Widget\Helper\Form\Element\Select('thumbPosition', array(
        'left' => _t('左侧显示'),
        'right' => _t('右侧显示')
    ), 'left', _t('缩略图位置'), _t('选择缩略图在列表中的显示位置（默认左侧）'));
    $layout->addItem($thumbPosition);
}

// 获取文章缩略图
function getPostImg($archive) {
    // 1. 如果填写了自定义字段，优先使用
    if ($archive->fields->thumb) {
        return $archive->fields->thumb;
    }
    // 2. 尝试获取文章内的第一张图片
    preg_match_all("/<img.*?src=\"(.*?)\"[^>]*>/i", $archive->content, $matches);
    if (isset($matches[1][0])) {
        return $matches[1][0];
    }
    // 3. 使用后台设置的默认全局缩略图
    if (\Widget\Options::alloc()->defaultThumb) {
        return \Widget\Options::alloc()->defaultThumb;
    }
    // 4. 都没有则返回 false
    return false;
}

// 拦截查询，设置每页文章数目
function themeInit($archive) {
    if ($archive->is('index') || $archive->is('archive')) {
        $pageSize = \Widget\Options::alloc()->customPageSize;
        if ($pageSize) {
            $archive->parameter->pageSize = intval($pageSize);
        }
    }
}

// 短代码处理 - 登录可见、评论可见等
function parseContentShortcode($content, $archive = null) {
    // === [login] 登录可见 [/login] ===
    $content = preg_replace_callback(
        '/\[login\]([\s\S]*?)\[\/login\]/i',
        function($matches) {
            $user = Typecho_Widget::widget('Widget_User');
            if ($user->hasLogin()) {
                return '<div class="my-4 p-4 rounded-xl border border-blue-200 bg-blue-50/50 dark:bg-blue-900/20 dark:border-blue-800/50"><div class="flex items-center gap-2 mb-2"><svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg><span class="text-sm font-medium text-blue-600 dark:text-blue-400">登录可见内容</span></div><div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">' . $matches[1] . '</div></div>';
            }
            return '<div class="my-4 p-4 rounded-xl border border-yellow-200 bg-yellow-50/50 dark:bg-yellow-900/20 dark:border-yellow-800/50 text-center"><svg class="w-8 h-8 text-yellow-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg><p class="text-sm text-yellow-700 dark:text-yellow-300">🔒 此部分内容需要 <a href="' . Typecho_Widget::widget('Widget_Options')->loginUrl() . '" class="font-medium underline hover:text-yellow-900 dark:hover:text-yellow-100">登录</a> 后才能查看</p></div>';
        },
        $content
    );

    // === [reply] 评论可见 [/reply] ===
    $content = preg_replace_callback(
        '/\[reply\]([\s\S]*?)\[\/reply\]/i',
        function($matches) use ($archive) {
            if ($archive && $archive->is('single') && $archive->cid) {
                $user = Typecho_Widget::widget('Widget_User');
                // 管理员和作者直接可见
                if ($user->hasLogin() && ($user->group === 'administrator' || $user->uid === $archive->authorId)) {
                    return '<div class="my-4 p-4 rounded-xl border border-green-200 bg-green-50/50 dark:bg-green-900/20 dark:border-green-800/50"><div class="flex items-center gap-2 mb-2"><svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg><span class="text-sm font-medium text-green-600 dark:text-green-400">评论可见内容</span></div><div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">' . $matches[1] . '</div></div>';
                }
                // 检查用户是否在此文章下留过言
                $db = Typecho_Db::get();
                $prefix = $db->getPrefix();
                $hasComment = false;
                if ($user->hasLogin()) {
                    $result = $db->fetchRow($db->select()->from('table.comments')
                        ->where('cid = ?', $archive->cid)
                        ->where('authorId = ?', $user->uid)
                        ->where('status = ?', 'approved')
                        ->limit(1));
                    $hasComment = !empty($result);
                } else {
                    // 游客通过邮箱判断
                    $cookieEmail = Typecho_Cookie::get('__typecho_remember_mail');
                    if ($cookieEmail) {
                        $result = $db->fetchRow($db->select()->from('table.comments')
                            ->where('cid = ?', $archive->cid)
                            ->where('mail = ?', $cookieEmail)
                            ->where('status = ?', 'approved')
                            ->limit(1));
                        $hasComment = !empty($result);
                    }
                }
                if ($hasComment) {
                    return '<div class="my-4 p-4 rounded-xl border border-green-200 bg-green-50/50 dark:bg-green-900/20 dark:border-green-800/50"><div class="flex items-center gap-2 mb-2"><svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg><span class="text-sm font-medium text-green-600 dark:text-green-400">评论可见内容</span></div><div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">' . $matches[1] . '</div></div>';
                }
                return '<div class="my-4 p-4 rounded-xl border border-yellow-200 bg-yellow-50/50 dark:bg-yellow-900/20 dark:border-yellow-800/50 text-center"><svg class="w-8 h-8 text-yellow-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg><p class="text-sm text-yellow-700 dark:text-yellow-300">💬 此部分内容需要 <a href="#comments" class="font-medium underline hover:text-yellow-900 dark:hover:text-yellow-100">发表评论</a> 后才能查看</p></div>';
            }
            return '<div class="my-4 p-4 rounded-xl border border-yellow-200 bg-yellow-50/50 dark:bg-yellow-900/20 dark:border-yellow-800/50 text-center"><p class="text-sm text-yellow-700 dark:text-yellow-300"> 此内容仅在当前文章页面有效</p></div>';
        },
        $content
    );

    // === [todo] 待办列表 [/todo] ===
    $content = preg_replace_callback(
        '/\[todo\]([\s\S]*?)\[\/todo\]/i',
        function($matches) {
            $items = preg_split('/\n/', trim($matches[1]));
            $html = '<div class="my-4 p-4 rounded-xl border border-purple-200 bg-purple-50/50 dark:bg-purple-900/20 dark:border-purple-800/50"><div class="flex items-center gap-2 mb-3"><svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg><span class="text-sm font-bold text-purple-600 dark:text-purple-400">待办清单</span></div><ul class="space-y-2 todo-list">';
            foreach ($items as $item) {
                $item = trim($item);
                if (empty($item)) continue;
                // 支持 [x] 和 [ ] 语法
                if (preg_match('/^\[x\]\s*(.*)/i', $item, $m)) {
                    $html .= '<li class="flex items-start gap-2 text-sm"><input type="checkbox" checked disabled class="mt-1 w-4 h-4 rounded border-purple-300 text-purple-600 focus:ring-purple-500"><span class="text-gray-500 dark:text-gray-400 line-through flex-1">' . htmlspecialchars($m[1]) . '</span></li>';
                } elseif (preg_match('/^\[\s*\]\s*(.*)/', $item, $m)) {
                    $html .= '<li class="flex items-start gap-2 text-sm"><input type="checkbox" disabled class="mt-1 w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"><span class="text-gray-700 dark:text-gray-300 flex-1">' . htmlspecialchars($m[1]) . '</span></li>';
                } else {
                    $html .= '<li class="flex items-start gap-2 text-sm"><input type="checkbox" disabled class="mt-1 w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"><span class="text-gray-700 dark:text-gray-300 flex-1">' . htmlspecialchars($item) . '</span></li>';
                }
            }
            $html .= '</ul></div>';
            return $html;
        },
        $content
    );

    // === [timeline] 时间线 [/timeline] ===
    $content = preg_replace_callback(
        '/\[timeline\]([\s\S]*?)\[\/timeline\]/i',
        function($matches) {
            $items = preg_split('/\n/', trim($matches[1]));
            $html = '<div class="my-6 timeline"><div class="border-l-2 border-blue-200 dark:border-blue-800/50 ml-4 space-y-6">';
            foreach ($items as $item) {
                $item = trim($item);
                if (empty($item)) continue;
                // 支持 title="标题" content="内容" 或 纯文本
                if (preg_match('/\[item\s+title=(?:"|\'|&quot;)(.*?)(?:"|\'|&quot;)\]([\s\S]*?)\[\/item\]/i', $item, $m)) {
                    $html .= '<div class="relative pl-6"><div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-blue-500 border-2 border-white dark:border-gray-800 shadow-sm"></div><h4 class="text-base font-bold text-gray-900 dark:text-white mb-1">' . htmlspecialchars($m[1]) . '</h4><div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">' . $m[2] . '</div></div>';
                } elseif (preg_match('/\[item date=(?:"|\'|&quot;)(.*?)(?:"|\'|&quot;)\]([\s\S]*?)\[\/item\]/i', $item, $m)) {
                    $html .= '<div class="relative pl-6"><div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-blue-500 border-2 border-white dark:border-gray-800 shadow-sm"></div><div class="text-xs text-blue-500 dark:text-blue-400 font-medium mb-1">' . htmlspecialchars($m[1]) . '</div><div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">' . $m[2] . '</div></div>';
                } else {
                    $html .= '<div class="relative pl-6"><div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-blue-500 border-2 border-white dark:border-gray-800 shadow-sm"></div><div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">' . htmlspecialchars($item) . '</div></div>';
                }
            }
            $html .= '</div></div>';
            return $html;
        },
        $content
    );

    return $content;
}

// 添加浏览量统计
function getPostView($archive) {
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    
    $row = $db->fetchRow($db->select()->from('table.contents')->limit(1));
    if ($row && !array_key_exists('views', $row)) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
    }
    
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    $views = $row ? $row['views'] : 0;
    
    if ($archive->is('single')) {
        $cookie = Typecho_Cookie::get('extend_contents_views');
        $cookieViews = empty($cookie) ? array() : explode(',', $cookie);
        if (!in_array($cid, $cookieViews)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int) $views + 1))->where('cid = ?', $cid));
            array_push($cookieViews, $cid);
            $cookieViews = implode(',', $cookieViews);
            Typecho_Cookie::set('extend_contents_views', $cookieViews);
            $views++;
        }
    }
    echo $views;
}

// 自定义评论列表 HTML
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' mt-5' : '';

    // 获取被回复者的昵称
    $replyToHtml = '';
    if ($comments->parent > 0) {
        $db = Typecho_Db::get();
        $parent = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ?', $comments->parent));
        if ($parent) {
            $replyToHtml = '<a href="#comment-' . $comments->parent . '" class="text-blue-600 dark:text-blue-400 font-medium no-underline hover:text-blue-700 dark:hover:text-blue-300">@' . htmlspecialchars($parent['author']) . '</a> ';
        }
    }
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
    echo $commentLevelClass;
    if ($comments->levels > 0) {
        echo ' comment-child';
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;
    ?> list-none">
        <?php if ($comments->levels == 0): ?>
        <div class="p-4 md:p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm mb-8">
        <?php endif; ?>
        <div id="<?php $comments->theId(); ?>" class="flex gap-3 md:gap-4">
            <!-- 头像 -->
            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                <img src="<?php echo _getAvatarByMail($comments->mail, 640); ?>" alt="<?php $comments->author(); ?>" class="w-full h-full object-cover" />
            </div>
            <div class="flex-1 min-w-0">
                <!-- 昵称行 -->
                 <div class="flex items-center flex-wrap gap-2 mb-1">
                     <span class="font-bold text-gray-900 dark:text-white"><?php $comments->author(); ?></span>
                     <?php
                     $isBlogger = false;
                     if ($comments->authorId > 0) {
                         if ($comments->authorId == $comments->ownerId) {
                             $isBlogger = true;
                         } else {
                             static $adminCache = [];
                             if (!isset($adminCache[$comments->authorId])) {
                                 $db = Typecho_Db::get();
                                 $user = $db->fetchRow($db->select('group')->from('table.users')->where('uid = ?', $comments->authorId));
                                 $adminCache[$comments->authorId] = ($user && $user['group'] == 'administrator');
                             }
                             $isBlogger = $adminCache[$comments->authorId];
                         }
                     }
                     ?>
                     <?php if ($isBlogger): ?>
                         <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded bg-blue-500 text-white">博主</span>
                     <?php elseif ($comments->authorId > 0): ?>
                         <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded bg-blue-500 text-white">UID: <?php echo $comments->authorId; ?></span>
                     <?php elseif ($comments->authorId == $comments->ownerId): ?>
                         <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded bg-blue-500 text-white">游客</span>
                     <?php endif; ?>
                 </div>
                <!-- 内容区 -->
                <div class="p-2.5 rounded-lg bg-gray-50 dark:bg-gray-900/50 mb-2 overflow-x-auto break-words">
                    <div class="prose prose-sm dark:prose-invert max-w-none prose-a:no-underline break-words">
                        <?php echo $replyToHtml; ?><?php $comments->content(); ?>
                    </div>
                </div>
                <!-- 底部信息 -->
                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                    <div>
                        <time datetime="<?php $comments->date('c'); ?>"><?php $comments->date('Y年m月d日 H:i'); ?></time>
                    </div>
                    <div class="cursor-pointer hover:text-blue-500 transition-colors">
                        <a href="javascript:void(0)" onclick="showReplyForm('<?php $comments->theId(); ?>', '<?php echo addslashes($comments->author); ?>')">回复 ↗</a>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($comments->children) { ?>
            <div class="comment-children mt-4">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php } ?>
        <?php if ($comments->levels == 0): ?>
        </div>
        <?php endif; ?>
    </li>
    <?php
}

// ==========================================

/**
 * 根据邮箱生成头像地址（返回 URL）
 * 优先识别 QQ 邮箱并使用 QQ 头像，否则使用自定义头像服务或 Gravatar
 *
 * @param string $email 邮箱
 * @param int $size 头像大小（像素）
 * @return string 头像 URL
 */
function _getAvatarByMail($email, $size = 640) {
    $email = trim((string)$email);
    // 当没有邮件时，使用后台侧边栏设置或主题自带头像
    if (empty($email)) {
        $opts = Helper::options();
        if ($opts->avatarUrl) return $opts->avatarUrl;
        return $opts->themeUrl('avatar.png');
    }

    $opts = Helper::options();
    $gravatarsUrl = isset($opts->JCustomAvatarSource) && $opts->JCustomAvatarSource ? rtrim($opts->JCustomAvatarSource, '/') . '/' : 'https://gravatar.ihuan.me/avatar/';

    $mailLower = strtolower($email);
    $md5MailLower = md5($mailLower);
    $qqMail = str_replace('@qq.com', '', $mailLower);

    if (stristr($email, '@qq.com') && is_numeric($qqMail) && strlen($qqMail) < 11 && strlen($qqMail) > 4) {
        return 'https://q.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=' . intval($size);
    }

    return $gravatarsUrl . $md5MailLower . '?d=mm&s=' . intval($size);
}