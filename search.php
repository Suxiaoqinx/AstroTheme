<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="flex flex-col lg:flex-row gap-8">
  <div class="flex-1 min-w-0 space-y-12">
    <section>
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">搜索结果</h2>
      <?php $keyword = isset($_GET['s']) ? htmlspecialchars($_GET['s'], ENT_QUOTES) : ''; ?>
      <?php if ($keyword): ?>
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">关键词：<span class="font-medium text-gray-800 dark:text-gray-100"><?php echo $keyword; ?></span></p>
      <?php endif; ?>

      <div id="post-list" class="flex flex-col gap-8">
        <?php if ($this->have()): ?>
          <?php while ($this->next()): ?>
            <?php $this->need('post-item.php'); ?>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
            <p class="text-gray-600 dark:text-gray-300">未找到匹配的内容，试试其他关键词或检查拼写。</p>
          </div>
        <?php endif; ?>
      </div>

      <div class="mt-8 text-center flex justify-center gap-4">
        <?php $this->pageNav('&laquo; 上一页', '下一页 &raquo;', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
      </div>
    </section>
  </div>

  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>
