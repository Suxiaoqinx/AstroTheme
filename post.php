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

    <!-- Tags -->
    <?php if ($this->tags): ?>
    <div class="flex flex-wrap gap-2">
      <?php $this->tags(' ', true, '暂无标签'); ?>
    </div>
    <?php endif; ?>

    <!-- Copyright Notice -->
    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800 p-5 flex items-start gap-3">
      <svg class="w-5 h-5 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
      <div class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
        <p><strong class="text-blue-700 dark:text-blue-400">版权声明：</strong></p>
        <p>本文作者：<span class="text-blue-600 dark:text-blue-400 font-medium"><?php $this->author(); ?></span></p>
        <p>本文链接：<a href="<?php $this->permalink(); ?>" class="text-blue-600 dark:text-blue-400 hover:underline break-all"><?php $this->permalink(); ?></a></p>
        <p>转载需注明文章出处，若本站内容侵犯了原著者的合法权益，请联系站长删除。</p>
      </div>
    </div>

    <!-- Previous/Next Navigation -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <?php $this->thePrev('<a href="%s" class="group flex flex-col gap-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 hover:border-blue-300 dark:hover:border-blue-600 hover:shadow-md transition-all"><span class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>上一篇</span><span class="font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">%s</span></a>', ''); ?>
      <?php $this->theNext('<a href="%s" class="group flex flex-col gap-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 hover:border-blue-300 dark:hover:border-blue-600 hover:shadow-md transition-all"><span class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 md:flex-row-reverse">下一篇<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></span><span class="font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2 md:text-right">%s</span></a>', ''); ?>
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

    // 先清空旧内容
    tocContainer.innerHTML = '';
    
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
        const targetId = heading.id; // 闭包保存 ID
        a.href = '#' + targetId;
        a.textContent = heading.innerText;
        a.className = 'block hover:text-blue-600 dark:hover:text-blue-400 transition-colors line-clamp-1';
        a.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.getElementById(targetId);
            if (!target) return;
            const headerHeight = 72; // 导航栏高度 + 额外间距
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
            window.scrollTo({ top: targetPosition, behavior: 'smooth' });
            // 同时更新 URL hash
            history.pushState(null, null, '#' + targetId);
        });
        
        li.appendChild(a);
        ul.appendChild(li);
    });
    
    tocContainer.innerHTML = '';
    tocContainer.appendChild(ul);
    
    // Smooth scroll and highlight active
    if (window._tocObserver) {
        window._tocObserver.disconnect();
        window._tocObserver = null;
    }
    if (window._tocScrollHandler) {
        window.removeEventListener('scroll', window._tocScrollHandler, { passive: true });
    }
    
    const tocLinks = document.querySelectorAll('#toc-container a');
    const headerOffset = 100;
    
    function updateTocHighlight() {
        let currentId = null;
        for (let i = headings.length - 1; i >= 0; i--) {
            if (headings[i].getBoundingClientRect().top <= headerOffset) {
                currentId = headings[i].id;
                break;
            }
        }
        tocLinks.forEach(link => {
            link.classList.remove('text-blue-600', 'dark:text-blue-400', 'font-bold');
        });
        if (currentId) {
            const activeLink = document.querySelector('#toc-container a[href="#' + currentId + '"]');
            if (activeLink) {
                activeLink.classList.add('text-blue-600', 'dark:text-blue-400', 'font-bold');
            }
        }
    }
    
    window._tocScrollHandler = updateTocHighlight;
    window.addEventListener('scroll', updateTocHighlight, { passive: true });
    updateTocHighlight();
}

document.addEventListener('DOMContentLoaded', initToc);
document.addEventListener('pjax:complete', initToc);
</script>

<script src="<?php $this->options->themeUrl('joe.short.js'); ?>"></script>
<?php $this->need('footer.php'); ?>
