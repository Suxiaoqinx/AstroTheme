<?php
/**
 * 基于 Astro-blog 修改的 Typecho 主题
 * 
 * @package AstroTheme
 * @author 苏晓晴
 * @version 1.0
 * @link http://www.toubiec.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="flex flex-col lg:flex-row gap-8">
    <!-- Main Content -->
    <div class="flex-1 min-w-0 space-y-12">
      
      <!-- Hero Section -->
      <div class="relative w-full overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 mb-12 group min-h-[400px] flex items-center justify-center">
        <?php if($this->options->heroImages): ?>
          <?php 
          $heroImages = array_filter(explode("\n", str_replace("\r", "", $this->options->heroImages)));
          if(!empty($heroImages)):
          ?>
          <div class="absolute inset-0 z-0 overflow-hidden flex gap-4 opacity-40 dark:opacity-20" style="mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);">
            <!-- 第一组图片 -->
            <div class="flex animate-marquee whitespace-nowrap gap-4 min-w-full shrink-0 items-center">
              <?php foreach($heroImages as $img): ?>
                <div class="h-48 w-72 md:h-64 md:w-96 shrink-0 rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700 p-2 bg-gray-50 dark:bg-gray-900">
                  <img src="<?php echo trim($img); ?>" class="w-full h-full object-cover rounded-xl" alt="Hero Image">
                </div>
              <?php endforeach; ?>
            </div>
            <!-- 复制一组用于无缝滚动 -->
            <div class="flex animate-marquee whitespace-nowrap gap-4 min-w-full shrink-0 items-center" aria-hidden="true">
              <?php foreach($heroImages as $img): ?>
                <div class="h-48 w-72 md:h-64 md:w-96 shrink-0 rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700 p-2 bg-gray-50 dark:bg-gray-900">
                  <img src="<?php echo trim($img); ?>" class="w-full h-full object-cover rounded-xl" alt="Hero Image">
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        <?php endif; ?>

        <!-- 渐变遮罩 -->
        <div class="absolute inset-0 z-10 bg-gradient-to-r from-white/95 via-white/70 to-white/95 dark:from-gray-800/95 dark:via-gray-800/70 dark:to-gray-800/95 pointer-events-none"></div>
        
        <!-- 内容区域 -->
        <div class="relative z-20 flex flex-col items-center justify-center py-20 px-4 text-center">
          <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl mb-6 drop-shadow-sm">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600"><?php if($this->options->heroTitle) $this->options->heroTitle(); else $this->options->title(); ?></span>
          </h1>
          <p class="max-w-2xl mx-auto text-xl text-gray-700 dark:text-gray-200 mb-8 font-medium drop-shadow-sm">
            <?php if($this->options->heroDesc) $this->options->heroDesc(); else $this->options->description(); ?>
          </p>
          <div class="flex flex-wrap justify-center gap-4">
            <a href="#posts" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-lg text-white bg-blue-600 hover:bg-blue-700 hover:scale-105 transition-all duration-300">
              阅读博客
            </a>
            <a href="<?php $this->options->siteUrl(); ?>about.html" class="inline-flex items-center px-8 py-3 border border-gray-200 dark:border-gray-600 text-base font-medium rounded-full shadow-sm text-gray-700 dark:text-gray-200 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700 hover:scale-105 transition-all duration-300">
              关于我
            </a>
          </div>
        </div>
      </div>

      <section id="posts">
        <div class="flex items-center justify-between mb-8">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white">所有文章</h2>
          <!-- 布局切换按钮（仅电脑端显示） -->
          <div class="hidden md:flex items-center gap-1 bg-gray-100 dark:bg-gray-700 rounded-lg p-1" id="layout-toggle">
            <button type="button" data-layout="list" class="layout-btn p-2 rounded-md transition-colors" aria-label="列表视图" title="列表视图">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <button type="button" data-layout="grid" class="layout-btn p-2 rounded-md transition-colors" aria-label="网格视图" title="网格视图">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </button>
          </div>
        </div>
        <div class="flex flex-col gap-8 grid-layout grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 hidden" id="post-list">
          <?php
          global $stickyArray;
          $stickyCids = $this->options->stickyCids;
          $stickyArray = $stickyCids ? explode(',', str_replace(' ', '', $stickyCids)) : [];
          
          if ($stickyArray && $this->is('index') && $this->_currentPage == 1) {
              foreach ($stickyArray as $cid) {
                  $this->widget('Widget_Archive@sticky_' . $cid, 'pageSize=1&type=post', 'cid=' . $cid)->to($sticky);
                  if ($sticky->have()) {
                      while ($sticky->next()) {
                          $sticky->isStickyItem = true;
                          $sticky->need('post-item.php');
                      }
                  }
              }
          }
          ?>
          <?php while ($this->next()): ?>
              <?php if(in_array($this->cid, $stickyArray)) continue; ?>
              <?php 
              $this->isStickyItem = false;
              $this->need('post-item.php'); 
              ?>
          <?php endwhile; ?>
        </div>
        
        <div class="mt-8 text-center flex justify-center gap-4">
            <?php $this->pageNav('&laquo; 上一页', '下一页 &raquo;', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
        </div>
      </section>
    </div>

    <!-- Sidebar -->
    <?php $this->need('sidebar.php'); ?>
</div>

<script>
// 文章列表布局切换（全局可访问，供 PJAX 回调调用）
function initLayoutToggle() {
    var defaultLayout = '<?php echo isset($this->options->postLayout) ? $this->options->postLayout : "list"; ?>';
    var savedLayout = localStorage.getItem('post-layout');
    var isMobile = window.innerWidth < 768;

    // 手机端强制网格，电脑端跟随设置/本地存储
    var currentLayout;
    if (isMobile) {
        currentLayout = 'grid';
    } else {
        currentLayout = savedLayout || defaultLayout;
    }

    var toggleEl = document.getElementById('layout-toggle');
    if (!toggleEl) return;

    var listContainer = document.getElementById('post-list');
    var buttons = toggleEl.querySelectorAll('.layout-btn');

    function applyLayout(layout) {
        if (!listContainer) return;
        if (layout === 'grid') {
            listContainer.classList.remove('hidden');
            listContainer.classList.add('grid-layout', 'grid', 'grid-cols-1', 'sm:grid-cols-2', 'lg:grid-cols-3', 'gap-6');
            listContainer.classList.remove('flex', 'flex-col', 'gap-8');
        } else {
            listContainer.classList.remove('hidden', 'grid-layout', 'grid', 'grid-cols-1', 'sm:grid-cols-2', 'lg:grid-cols-3', 'gap-6');
            listContainer.classList.add('flex', 'flex-col', 'gap-8');
        }
        buttons.forEach(function(btn) {
            var btnLayout = btn.getAttribute('data-layout');
            if (btnLayout === layout) {
                btn.classList.add('bg-white', 'dark:bg-gray-600', 'shadow-sm', 'text-blue-600', 'dark:text-blue-400');
                btn.classList.remove('text-gray-500', 'dark:text-gray-400');
            } else {
                btn.classList.remove('bg-white', 'dark:bg-gray-600', 'shadow-sm', 'text-blue-600', 'dark:text-blue-400');
                btn.classList.add('text-gray-500', 'dark:text-gray-400');
            }
        });
        // 更新文章卡片样式
        document.querySelectorAll('.post-item').forEach(function(card) {
            if (layout === 'grid') {
                card.classList.add('post-item-grid');
                card.classList.remove('post-item-list');
            } else {
                card.classList.remove('post-item-grid');
                card.classList.add('post-item-list');
            }
        });
    }

    buttons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var layout = btn.getAttribute('data-layout');
            localStorage.setItem('post-layout', layout);
            applyLayout(layout);
        });
    });

    applyLayout(currentLayout);
}

document.addEventListener('DOMContentLoaded', initLayoutToggle);
document.addEventListener('pjax:complete', initLayoutToggle);
</script>

<?php $this->need('footer.php'); ?>
