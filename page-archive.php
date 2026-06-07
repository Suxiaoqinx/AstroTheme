<?php
/**
 * 归档模板
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
      
      <!-- 统计区域 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
          <!-- 分类统计（改为标签样式） -->
          <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-700">
              <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 border-b border-gray-200 dark:border-gray-700 pb-3">
                  <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                  分类统计
              </h3>
              <div class="flex flex-wrap gap-2 pb-2">
                  <?php Typecho_Widget::widget('Widget_Metas_Category_List')->to($categories); ?>
                  <?php if($categories->have()): ?>
                  <?php while ($categories->next()): ?>
                      <a href="<?php $categories->permalink(); ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 text-gray-700 dark:text-gray-300 rounded-full text-sm transition-colors group">
                          <span class="group-hover:text-blue-600 dark:group-hover:text-blue-400 font-medium"><?php $categories->name(); ?></span>
                          <span class="text-gray-400 dark:text-gray-500 text-xs bg-gray-100 dark:bg-gray-700 px-1.5 py-0.5 rounded-full"><?php $categories->count(); ?></span>
                      </a>
                  <?php endwhile; ?>
                  <?php else: ?>
                      <span class="text-gray-500 p-2">暂无分类</span>
                  <?php endif; ?>
              </div>
          </div>

          <!-- 标签统计 -->
          <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-700">
              <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 border-b border-gray-200 dark:border-gray-700 pb-3">
                  <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                  标签统计
              </h3>
              <div class="flex flex-wrap gap-2 pb-2">
                  <?php Typecho_Widget::widget('Widget_Metas_Tag_Cloud', 'sort=count&desc=1&limit=100')->to($tags); ?>
                  <?php if($tags->have()): ?>
                  <?php while ($tags->next()): ?>
                      <a href="<?php $tags->permalink(); ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 text-gray-700 dark:text-gray-300 rounded-full text-sm transition-colors group">
                          <span class="group-hover:text-blue-600 dark:group-hover:text-blue-400 font-medium"><?php $tags->name(); ?></span>
                          <span class="text-gray-400 dark:text-gray-500 text-xs bg-gray-100 dark:bg-gray-700 px-1.5 py-0.5 rounded-full"><?php $tags->count(); ?></span>
                      </a>
                  <?php endwhile; ?>
                  <?php else: ?>
                      <span class="text-gray-500 p-2">暂无标签</span>
                  <?php endif; ?>
              </div>
          </div>
      </div>

      <div class="prose prose-lg dark:prose-invert max-w-none">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            文章归档
        </h2>
        <?php
        // 使用 @archive_page 别名来实例化 Widget_Contents_Post_Recent，彻底与侧边栏隔离单例
        $this->widget('Widget_Contents_Post_Recent@archive_page', 'pageSize=10000')->to($archives);
        
        // 第一步：先将所有文章按年份进行分组统计
        $archives_by_year = [];
        while($archives->next()) {
            $year = date('Y', $archives->created);
            if (!isset($archives_by_year[$year])) {
                $archives_by_year[$year] = [];
            }
            $archives_by_year[$year][] = [
                'title' => $archives->title,
                'permalink' => $archives->permalink,
                'date' => date('m-d', $archives->created)
            ];
        }
        
        // 第二步：渲染按年份分组的归档（截图极简风格）
        $output = '';
        $isFirst = true;
        
        foreach ($archives_by_year as $year => $posts) {
            $count = count($posts);
            $isOpen = $isFirst ? 'open' : '';
            $isFirst = false;
            
            $output .= '<details class="mb-2 group border-b border-gray-100 dark:border-gray-800 pb-2 transition-all duration-300" ' . $isOpen . '>';
            
            // 年份标题栏
            $output .= '<summary class="py-4 cursor-pointer list-none [&::-webkit-details-marker]:hidden flex items-center justify-between select-none hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors rounded-lg px-2">';
            $output .= '<div class="flex items-baseline gap-3">';
            $output .= '<span class="text-2xl font-bold text-gray-900 dark:text-white">' . $year . '</span>';
            $output .= '<span class="text-xs text-gray-500 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full font-medium">' . $count . ' 篇</span>';
            $output .= '</div>';
            $output .= '<svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
            $output .= '</summary>';
            
            // 文章列表
            $output .= '<ul class="mt-2 space-y-1 pb-4 list-none pl-2">';
            foreach ($posts as $post) {
                $output .= '<li class="flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-800/50 p-3 rounded-lg transition-colors group/item">';
                $output .= '<a href="' . $post['permalink'] . '" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium truncate no-underline transition-colors">' . $post['title'] . '</a>';
                $output .= '<time class="text-gray-400 dark:text-gray-500 font-mono text-sm shrink-0 ml-4 group-hover/item:text-blue-500 transition-colors">' . $post['date'] . '</time>';
                $output .= '</li>';
            }
            $output .= '</ul>';
            
            $output .= '</details>';
        }
        
        echo $output;
        ?>
      </div>
    </div>
  </div>

  <!-- Sidebar -->
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>