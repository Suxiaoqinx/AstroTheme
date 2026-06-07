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

    <!-- Comments -->
    <?php $this->need('comments.php'); ?>
  </div>

  <!-- Sidebar -->
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>