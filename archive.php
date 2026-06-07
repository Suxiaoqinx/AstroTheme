<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="flex flex-col lg:flex-row gap-8">
    <!-- Main Content -->
    <div class="flex-1 min-w-0 space-y-12">
      <section id="posts">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
            <?php $this->archiveTitle([
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ], '', ''); ?>
        </h2>
        
        <?php if ($this->have()): ?>
        <div class="flex flex-col gap-8" id="post-list">
          <?php while ($this->next()): ?>
              <?php $this->need('post-item.php'); ?>
          <?php endwhile; ?>
        </div>
        
        <div class="mt-8 text-center flex justify-center gap-4">
            <?php $this->pageNav('&laquo; 上一页', '下一页 &raquo;', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
        </div>
        <?php else: ?>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700 text-center text-gray-500 dark:text-gray-400">
                <p><?php _e('没有找到内容'); ?></p>
            </div>
        <?php endif; ?>
      </section>
    </div>

    <!-- Sidebar -->
    <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>
