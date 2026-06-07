<?php
/**
 * 友链模板
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
      <div class="prose prose-lg dark:prose-invert max-w-none mb-8" id="links-content">
        <?php $this->content(); ?>
      </div>
      
      <div id="links-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $linksStr = $this->options->links;
        if ($linksStr):
            $linksArray = explode("\n", $linksStr);
            foreach ($linksArray as $linkItem):
                $linkItem = trim($linkItem);
                if (empty($linkItem)) continue;
                
                $linkData = explode("||", $linkItem);
                $name = isset($linkData[0]) ? trim($linkData[0]) : '';
                $url = isset($linkData[1]) ? trim($linkData[1]) : '#';
                $avatar = isset($linkData[2]) ? trim($linkData[2]) : '';
                $desc = isset($linkData[3]) ? trim($linkData[3]) : '这是一个友链';
        ?>
        <a href="<?php echo htmlspecialchars($url); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 hover:shadow-lg transition-all group bg-white dark:bg-gray-800">
            <img src="<?php echo htmlspecialchars($avatar); ?>" alt="<?php echo htmlspecialchars($name); ?> Avatar" class="w-12 h-12 rounded-full group-hover:scale-110 transition-transform bg-gray-100 dark:bg-gray-800 object-cover">
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-gray-900 dark:text-white truncate"><?php echo htmlspecialchars($name); ?></h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 truncate" title="<?php echo htmlspecialchars($desc); ?>"><?php echo htmlspecialchars($desc); ?></p>
            </div>
        </a>
        <?php 
            endforeach;
        else:
        ?>
        <div class="col-span-full text-center text-gray-500 py-8">
            暂无友链，请在主题外观设置中添加。<br>格式：<code>博客名称 || 博客地址 || 博客头像 || 博客简介</code>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Comments -->
    <?php $this->need('comments.php'); ?>
  </div>

  <!-- Sidebar -->
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>