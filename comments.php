<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments" class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6 md:p-10 mt-8">
    <?php $this->comments()->to($comments); ?>
    
    <?php if ($this->allow('comment')): ?>
    <!-- 回复弹窗 -->
    <div id="<?php $this->respondId(); ?>" class="respond hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="hideReplyForm()"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 p-6 max-w-lg w-full">
            <div class="flex items-center justify-between mb-4">
                <h3 id="response" class="text-lg font-bold text-gray-900 dark:text-white">回复评论</h3>
                <button onclick="hideReplyForm()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <!-- 正在回复提示 -->
            <div id="reply-to-info" class="mb-4 hidden">
                <div class="flex items-center gap-2 text-sm text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                    <span id="reply-to-name"></span>
                </div>
            </div>
            
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <input type="hidden" name="parent" id="comment-parent" value="0" />
                
                <?php if($this->user->hasLogin()): ?>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                    登录身份: <a href="<?php $this->options->profileUrl(); ?>" class="text-blue-600 hover:underline"><?php $this->user->screenName(); ?></a>. 
                    <a href="<?php $this->options->logoutUrl(); ?>" class="text-red-500 hover:underline" title="Logout">退出 &raquo;</a>
                </p>
                <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">称呼 *</label>
                        <input type="text" name="author" id="author" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white outline-none transition-all" value="<?php $this->remember('author'); ?>" required />
                    </div>
                    <div>
                        <label for="mail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email *</label>
                        <input type="email" name="mail" id="mail" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white outline-none transition-all" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </div>
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">网站</label>
                        <input type="url" name="url" id="url" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white outline-none transition-all" placeholder="http://" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="mb-4">
                    <label for="textarea" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">内容 *</label>
                    <textarea rows="5" name="text" id="textarea" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white outline-none transition-all resize-y" required><?php $this->remember('text'); ?></textarea>
                </div>
                
                <div class="flex items-center justify-between pt-2">
                    <button type="button" onclick="hideReplyForm()" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                        取消
                    </button>
                    <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        提交评论
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php else: ?>
    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">评论已关闭</h3>
    <?php endif; ?>

    <?php if ($comments->have()): ?>
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white"><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
            <button onclick="showReplyForm('0', '')" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-full shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                添加评论
            </button>
        </div>
        
        <?php $comments->listComments(['before' => '<ul class="space-y-0 p-0 m-0">', 'after' => '</ul>']); ?>
        
        <div class="mt-10 flex justify-center">
            <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
        </div>
    <?php else: ?>
        <?php if ($this->allow('comment')): ?>
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white"><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
            <button onclick="showReplyForm('0', '')" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-full shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                添加评论
            </button>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
