<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

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
    $postLayout = new \Typecho\Widget\Helper\Form\Element\Radio('postLayout', array(
        'list' => _t('列表'),
        'grid' => _t('网格')
    ), 'list', _t('【首页设置】文章列表默认样式'), _t('设置文章列表的默认显示样式，默认列表模式。访客可通过页面右上角按钮切换，选择会保存到本地。'));
    $form->addInput($postLayout);

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