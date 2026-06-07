<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<aside class="w-full lg:w-72 shrink-0 space-y-8 lg:sticky lg:top-24 h-fit">
  <!-- 个人信息卡片 -->
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
    <div class="flex flex-col items-center text-center">
      <div class="relative w-24 h-24 mb-4">
        <img 
          src="<?php if ($this->options->avatarUrl): $this->options->avatarUrl(); else: $this->options->themeUrl('avatar.png'); endif; ?>" 
          alt="Avatar" 
          class="w-full h-full object-cover rounded-full border-4 border-white dark:border-gray-700 shadow-sm"
        />
        <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-4 border-white dark:border-gray-800 rounded-full"></div>
      </div>
      <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-1"><?php if($this->options->sidebarNickname) $this->options->sidebarNickname(); else $this->options->title(); ?></h2>
      <p class="text-gray-600 dark:text-gray-300 text-sm mb-6">
        <?php if($this->options->sidebarDesc) $this->options->sidebarDesc(); else $this->options->description(); ?>
      </p>
      
      <div class="flex flex-wrap gap-3 justify-center w-full">
        <?php if ($this->options->githubUrl): ?>
        <a href="<?php $this->options->githubUrl(); ?>" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-xl transition-colors text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.158-1.11-1.158-.908-.618.069-.606.069-.606 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
          </svg>
        </a>
        <?php endif; ?>
        <?php if ($this->options->emailUrl): ?>
        <a href="<?php $this->options->emailUrl(); ?>" class="flex items-center justify-center w-10 h-10 rounded-xl transition-colors text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
          </svg>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php if ($this->options->siteNotice): ?>
  <div class="bg-yellow-50 dark:bg-yellow-900/30 rounded-xl shadow-md p-4 border border-yellow-200 dark:border-yellow-800">
    <h3 class="text-sm font-semibold text-yellow-800 dark:text-yellow-200 mb-2">系统公告</h3>
    <div class="text-sm text-yellow-700 dark:text-yellow-100">
      <?php $this->options->siteNotice(); ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- 搜索框 -->
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 border border-gray-200 dark:border-gray-700">
    <form role="search" method="get" action="<?php $this->options->siteUrl(); ?>" class="flex items-center gap-2">
      <label for="sidebar-search" class="sr-only">搜索文章</label>
      <input id="sidebar-search" name="s" type="search" placeholder="搜索文章、标签或作者..." class="flex-1 px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      <button type="submit" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1016.65 16.65z"></path></svg>
      </button>
    </form>
  </div>

  <!-- 数据统计 -->
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
      <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
      数据统计
    </h3>
    <div class="space-y-4">
      <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
      <div class="flex items-center justify-between text-gray-600 dark:text-gray-300">
        <span>文章总数</span>
        <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-sm font-medium"><?php $stat->publishedPostsNum() ?></span>
      </div>
      <div class="flex items-center justify-between text-gray-600 dark:text-gray-300">
        <span>分类数量</span>
        <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-sm font-medium"><?php $stat->categoriesNum() ?></span>
      </div>
      <div class="flex items-center justify-between text-gray-600 dark:text-gray-300">
        <span>标签数量</span>
        <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-sm font-medium"><?php echo \Widget\Metas\Tag\Cloud::alloc()->length(); ?></span>
      </div>
    </div>
  </div>

  <!-- 最新文章 -->
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
      <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
      最新文章
    </h3>
    <div class="space-y-4">
      <ul class="space-y-3">
      <?php 
      $recentNum = $this->options->sidebarRecentNum ? intval($this->options->sidebarRecentNum) : 5;
      Typecho_Widget::widget('Widget_Contents_Post_Recent@sidebar', 'pageSize=' . $recentNum)->to($recent); 
      ?>
      <?php $i = 1; while($recent->next()): ?>
        <li class="flex items-start gap-3">
          <span class="flex-shrink-0 w-6 h-6 rounded bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-bold flex items-center justify-center mt-0.5">
            <?php echo $i++; ?>
          </span>
          <a href="<?php $recent->permalink(); ?>" class="text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors line-clamp-2 mt-0.5">
            <?php $recent->title(); ?>
          </a>
        </li>
      <?php endwhile; ?>
      </ul>
    </div>
  </div>

  <!-- 最新评论 -->
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
      <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
      最新评论
    </h3>
    <div class="space-y-4">
      <?php 
      \Widget\Comments\Recent::alloc('pageSize=20')->to($latestComments); 
      $showCount = 0;
      ?>
      <?php while($latestComments->next()): ?>
      <?php
        // 判断是否为博主
        $isBlogger = false;
        if ($latestComments->authorId > 0) {
            if ($latestComments->authorId == $latestComments->ownerId) {
                $isBlogger = true;
            } else {
                static $sidebarAdminCache = [];
                if (!isset($sidebarAdminCache[$latestComments->authorId])) {
                    $db = Typecho_Db::get();
                    $user = $db->fetchRow($db->select('group')->from('table.users')->where('uid = ?', $latestComments->authorId));
                    $sidebarAdminCache[$latestComments->authorId] = ($user && $user['group'] == 'administrator');
                }
                $isBlogger = $sidebarAdminCache[$latestComments->authorId];
            }
        }
        // 如果是博主则跳过
        if ($isBlogger) continue;
        
        $showCount++;
        if ($showCount > 5) break;
      ?>
      <a href="<?php $latestComments->permalink(); ?>#<?php $latestComments->theId(); ?>" class="block p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
        <div class="flex gap-3">
          <!-- 头像 -->
          <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden border border-gray-200 dark:border-gray-600">
            <img src="<?php echo _getAvatarByMail($latestComments->mail, 40); ?>" alt="<?php $latestComments->author(false); ?>" class="w-full h-full object-cover" />
          </div>
          <div class="flex-1 min-w-0">
            <!-- 昵称 -->
            <div class="font-bold text-sm text-gray-900 dark:text-white"><?php $latestComments->author(false); ?></div>
            <!-- 时间 -->
            <div class="text-xs text-gray-400 dark:text-gray-500 mt-0.5"><?php $latestComments->date('n月j日 H:i'); ?></div>
            <!-- 评论文章标题 -->
            <div class="text-xs text-gray-600 dark:text-gray-300 mt-0.5"><?php $latestComments->title(); ?></div>
          </div>
        </div>
        <!-- 评论内容气泡 -->
        <div class="mt-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-900/50 relative overflow-hidden break-words">
          <div class="absolute -top-1.5 left-5 w-3 h-3 bg-gray-50 dark:bg-gray-900/50 transform rotate-45"></div>
          <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-2 relative z-10"><?php $latestComments->excerpt(30, '...'); ?></p>
        </div>
      </a>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- 标签云 -->
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
      <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
      标签云
    </h3>
    <div class="flex flex-wrap gap-2">
      <?php \Widget\Metas\Tag\Cloud::alloc('sort=count&desc=1&limit=20')->to($tags); ?>
      <?php if($tags->have()): ?>
      <?php while ($tags->next()): ?>
        <a href="<?php $tags->permalink(); ?>" class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm hover:bg-blue-100 dark:hover:bg-blue-900 hover:text-blue-600 dark:hover:text-blue-300 transition-colors">
          #<?php $tags->name(); ?>
        </a>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</aside>
