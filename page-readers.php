<?php
/**
 * 读者墙
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
      <div class="prose prose-lg dark:prose-invert max-w-none mb-8">
        <?php $this->content(); ?>
      </div>
      
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6 mt-8">
        <?php
        $db = Typecho_Db::get();
        
        // 尝试获取博主的邮箱，以便在读者墙中排除博主自己
        $authorEmail = $this->author->mail;
        if (!$authorEmail) {
            $author = $db->fetchRow($db->select('mail')->from('table.users')->where('uid = ?', 1));
            $authorEmail = $author ? $author['mail'] : '';
        }

        $sql = $db->select('COUNT(author) AS cnt', 'author', 'mail', 'url')
                  ->from('table.comments')
                  ->where('status = ?', 'approved')
                  ->where('type = ?', 'comment')
                  ->where('authorId = ?', '0') // 排除已登录用户(通常是博主)
                  ->where('mail != ?', $authorEmail) // 进一步通过邮箱排除
                  ->group('mail')
                  ->order('cnt', Typecho_Db::SORT_DESC)
                  ->limit(30); // 默认显示前30名
                  
        $readers = $db->fetchAll($sql);
        
        if ($readers) {
            foreach ($readers as $reader) {
                // 生成 Gravatar 头像
                $avatar = Typecho_Common::gravatarUrl($reader['mail'], 100, 'mp', $this->options->commentsAvatarRating, true);
                $url = $reader['url'] ? htmlspecialchars($reader['url']) : '#';
                $name = htmlspecialchars($reader['author']);
                $cnt = $reader['cnt'];
                
                // 为了让无链接的用户不显示鼠标指针
                $cursorClass = $reader['url'] ? 'cursor-pointer hover:-translate-y-1' : 'cursor-default';
                $target = $reader['url'] ? 'target="_blank" rel="noopener noreferrer"' : '';
                
                echo '<a href="' . $url . '" ' . $target . ' class="group flex flex-col items-center p-5 bg-gray-50 dark:bg-gray-800/50 rounded-2xl hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-800/50 ' . $cursorClass . '">';
                echo '  <div class="relative mb-4">';
                echo '      <img src="' . $avatar . '" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full shadow-md object-cover ring-2 ring-white dark:ring-gray-700 group-hover:ring-blue-200 dark:group-hover:ring-blue-700 transition-all" alt="' . $name . '">';
                // 右下角小气泡显示评论数
                echo '      <div class="absolute -bottom-2 -right-2 bg-blue-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm border-2 border-white dark:border-gray-800">' . $cnt . '</div>';
                echo '  </div>';
                echo '  <span class="text-gray-900 dark:text-gray-100 font-bold truncate w-full text-center text-sm sm:text-base">' . $name . '</span>';
                echo '</a>';
            }
        } else {
            echo '<div class="col-span-full text-center text-gray-500 py-12 bg-gray-50 dark:bg-gray-800/30 rounded-2xl border border-dashed border-gray-200 dark:border-gray-700">暂无读者评论数据。</div>';
        }
        ?>
      </div>
    </div>

    <!-- Comments -->
    <?php $this->need('comments.php'); ?>
  </div>

  <!-- Sidebar -->
  <?php $this->need('sidebar.php'); ?>
</div>

<script src="<?php $this->options->themeUrl('joe.short.js'); ?>"></script>
<?php $this->need('footer.php'); ?>