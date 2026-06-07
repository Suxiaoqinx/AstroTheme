<?php
/**
 * 留言模板 (读者墙)
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div class="flex flex-col lg:flex-row gap-8">
  <!-- Main Content -->
  <div class="flex-1 min-w-0 space-y-12">
    <!-- Title Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6 md:p-10 text-center">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-4"><?php $this->title() ?></h1>
    </div>

    <!-- Content Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6 md:p-10">
      
      <!-- 读者墙展示区域 -->
      <div class="mb-10">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700 pb-2">
              <svg class="w-6 h-6 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
              活跃读者
          </h2>
          <?php
          $db = Typecho_Db::get();
          // 获取留言数最多的前 40 位用户（去重），排除博主自己（通常 authorId 为 1）
          $sql = $db->select('COUNT(author) AS cnt', 'author', 'url', 'mail')
                    ->from('table.comments')
                    ->where('status = ?', 'approved')
                    ->where('type = ?', 'comment')
                    ->where('authorId <> ? OR authorId IS NULL', $this->authorId)
                    ->group('mail')
                    ->order('cnt', Typecho_Db::SORT_DESC)
                    ->limit(40);
          $comments = $db->fetchAll($sql);
          ?>
          
          <?php if (count($comments) > 0): ?>
          <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-3 sm:gap-4">
              <?php foreach ($comments as $comment): ?>
              <?php
                  $avatar = 'https://cravatar.cn/avatar/' . md5(strtolower(trim($comment['mail']))) . '?s=80&d=identicon';
              ?>
              <a href="<?php echo empty($comment['url']) ? 'javascript:void(0)' : htmlspecialchars($comment['url']); ?>" <?php echo empty($comment['url']) ? '' : 'target="_blank" rel="noopener noreferrer"'; ?> class="group relative block aspect-square rounded-full overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 ring-2 ring-transparent hover:ring-blue-400" title="<?php echo htmlspecialchars($comment['author']); ?> (<?php echo $comment['cnt']; ?>条留言)">
                  <img src="<?php echo $avatar; ?>" alt="<?php echo htmlspecialchars($comment['author']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                  <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white text-xs">
                      <span class="font-bold truncate w-full text-center px-1"><?php echo htmlspecialchars($comment['author']); ?></span>
                      <span class="scale-75 opacity-90"><?php echo $comment['cnt']; ?></span>
                  </div>
              </a>
              <?php endforeach; ?>
          </div>
          <?php else: ?>
          <div class="text-center text-gray-500 dark:text-gray-400 py-8">
              还没有读者留下足迹，快来抢沙发吧！
          </div>
          <?php endif; ?>
      </div>

      <div class="prose prose-lg dark:prose-invert max-w-none">
        <?php $this->content(); ?>
      </div>
    </div>

    <!-- Comments -->
    <?php $this->need('comments.php'); ?>
  </div>

  <!-- Sidebar -->
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>