<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="flex flex-col lg:flex-row gap-8">
  
  <!-- Left Sidebar (TOC) -->
  <aside class="hidden xl:block w-64 shrink-0 sticky top-24 h-[calc(100vh-8rem)] overflow-y-auto pr-4 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
      <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
        文章目录
      </h3>
      <div id="toc-container" class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
        <!-- TOC will be generated here by JS -->
      </div>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 min-w-0 space-y-12">
    <!-- Title Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-4 sm:p-6 md:p-10 text-center">
      <h1 class="text-2xl sm:text-3xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-3 sm:mb-4 leading-snug"><?php $this->title() ?></h1>
      <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mt-3 sm:mt-4">
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
          <time datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time>
        </div>
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
          <?php $this->category(','); ?>
        </div>
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
          <?php getPostView($this); ?>
        </div>
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
          <a href="#comments" class="hover:text-blue-600 transition-colors"><?php $this->commentsNum('0', '1', '%d'); ?></a>
        </div>
      </div>
    </div>

    <!-- Content Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-4 sm:p-6 md:p-10">
      <article id="post-content" class="prose prose-lg dark:prose-invert max-w-none">
        <?php $this->content(); ?>
      </article>
    </div>

    <!-- Comments -->
    <?php if ($this->allow('comment')): ?>
        <?php $this->need('comments.php'); ?>
    <?php endif; ?>
  </div>

  <!-- Sidebar -->
  <?php $this->need('sidebar.php'); ?>
</div>

<script>
// TOC 目录生成函数（全局可访问，供 PJAX 回调调用）
function initToc() {
    const content = document.getElementById('post-content');
    const tocContainer = document.getElementById('toc-container');
    if (!content || !tocContainer) return;

    const headings = content.querySelectorAll('h1, h2, h3, h4, h5, h6');
    if (headings.length === 0) {
        tocContainer.innerHTML = '<p class="text-gray-400">暂无目录</p>';
        return;
    }

    const ul = document.createElement('ul');
    ul.className = 'space-y-2';
    
    let minLevel = 6;
    headings.forEach(h => {
        const level = parseInt(h.tagName.substring(1));
        if (level < minLevel) minLevel = level;
    });

    headings.forEach((heading, index) => {
        if (!heading.id) {
            heading.id = 'heading-' + index;
        }
        
        const level = parseInt(heading.tagName.substring(1));
        const indent = (level - minLevel) * 1;
        
        const li = document.createElement('li');
        li.style.paddingLeft = indent + 'rem';
        
        const a = document.createElement('a');
        a.href = '#' + heading.id;
        a.textContent = heading.innerText;
        a.className = 'block hover:text-blue-600 dark:hover:text-blue-400 transition-colors line-clamp-1';
        
        li.appendChild(a);
        ul.appendChild(li);
    });
    
    tocContainer.innerHTML = '';
    tocContainer.appendChild(ul);
    
    // Smooth scroll and highlight active
    if (window._tocObserver) {
        window._tocObserver.disconnect();
    }
    
    const observerOptions = {
        rootMargin: '-80px 0px -40% 0px',
        threshold: 1.0
    };
    
    window._tocObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.id;
                document.querySelectorAll('#toc-container a').forEach(link => {
                    link.classList.remove('text-blue-600', 'dark:text-blue-400', 'font-bold');
                    if (link.getAttribute('href') === '#' + id) {
                        link.classList.add('text-blue-600', 'dark:text-blue-400', 'font-bold');
                    }
                });
            }
        });
    }, observerOptions);
    
    headings.forEach(h => window._tocObserver.observe(h));
}

document.addEventListener('DOMContentLoaded', initToc);
document.addEventListener('pjax:complete', initToc);
</script>

<script src="<?php $this->options->themeUrl('joe.short.js'); ?>"></script>
<?php $this->need('footer.php'); ?>
