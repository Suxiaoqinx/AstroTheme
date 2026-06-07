<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</main>
<footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-auto">
  <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 text-center text-gray-500 dark:text-gray-400 text-sm">
    <?php if ($this->options->customFooter && trim($this->options->customFooter) !== ''): ?>
      <div class="prose prose-sm dark:prose-invert prose-a:no-underline max-w-none mx-auto text-center text-sm">
        <?php echo $this->options->customFooter; ?>
      </div>
    <?php else: ?>
      <p>
        &copy; <?php echo date('Y'); ?> <?php $this->options->title(); ?> | Powered by <a href="http://typecho.org" target="_blank" class="hover:text-gray-900 dark:hover:text-white transition-colors no-underline">Typecho</a>
      </p>
    <?php endif; ?>
  </div>
</footer>

<div class="fixed bottom-8 right-8 z-40 flex flex-col gap-4 items-center print:hidden">
  <!-- Back to Top Button -->
  <button
    id="back-to-top"
    class="group relative flex items-center justify-center w-12 h-12 rounded-full bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition-all duration-300 opacity-0 translate-y-4 invisible"
    aria-label="Back to Top"
  >
    <svg class="absolute inset-0 w-full h-full -rotate-90 pointer-events-none p-1" viewBox="0 0 44 44">
      <circle cx="22" cy="22" r="20" fill="none" stroke="currentColor" stroke-width="3" class="text-gray-100 dark:text-gray-700"></circle>
      <circle id="progress-circle" cx="22" cy="22" r="20" fill="none" stroke="currentColor" stroke-width="3" stroke-dasharray="126" stroke-dashoffset="126" stroke-linecap="round" class="text-blue-600 dark:text-blue-400 transition-all duration-100"></circle>
    </svg>
    <svg class="w-5 h-5 transition-transform group-hover:-translate-y-0.5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
  </button>

  <!-- Theme Toggle -->
  <div class="relative">
    <button
      id="theme-menu-button"
      type="button"
      class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none rounded-full text-sm p-2.5 inline-flex items-center justify-center transition-colors shadow-sm bg-white dark:bg-gray-800 w-12 h-12"
      aria-label="Theme Menu"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
    </button>
    <div id="theme-dropdown" class="hidden absolute right-full top-1/2 -translate-y-1/2 mr-4 bg-white dark:bg-gray-800 rounded-full shadow-xl focus:outline-none p-1.5 flex items-center gap-1 whitespace-nowrap">
      <button type="button" class="theme-option w-8 h-8 flex items-center justify-center rounded-full transition-all" data-theme="light">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z"></path></svg>
      </button>
      <button type="button" class="theme-option w-8 h-8 flex items-center justify-center rounded-full transition-all" data-theme="dark">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
      </button>
      <button type="button" class="theme-option w-8 h-8 flex items-center justify-center rounded-full transition-all" data-theme="system">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
      </button>
    </div>
  </div>
</div>

<script>
  function setupFloatingControls() {
    const backToTopBtn = document.getElementById('back-to-top');
    const progressCircle = document.getElementById('progress-circle');
    
    if (backToTopBtn && progressCircle) {
      const circumference = 126;
      function updateProgress() {
        const scrollTotal = document.documentElement.scrollHeight - window.innerHeight;
        const scrollY = window.scrollY;
        if (scrollY > 300) {
          backToTopBtn.classList.remove('opacity-0', 'translate-y-4', 'invisible');
        } else {
          backToTopBtn.classList.add('opacity-0', 'translate-y-4', 'invisible');
        }
        if (scrollTotal > 0) {
          const progress = Math.min(scrollY / scrollTotal, 1);
          const offset = circumference - (progress * circumference);
          progressCircle.style.strokeDashoffset = offset.toString();
        }
      }
      updateProgress();
      window.addEventListener('scroll', updateProgress, { passive: true });
      backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }

    const themeMenuBtn = document.getElementById('theme-menu-button');
    const themeDropdown = document.getElementById('theme-dropdown');
    const themeOptions = document.querySelectorAll('.theme-option');

    if (themeMenuBtn && themeDropdown) {
      themeMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        themeDropdown.classList.toggle('hidden');
      });
      document.addEventListener('click', (e) => {
        if (!themeMenuBtn.contains(e.target) && !themeDropdown.contains(e.target)) {
          themeDropdown.classList.add('hidden');
        }
      });
      themeOptions.forEach(btn => {
        btn.addEventListener('click', () => {
          const theme = btn.getAttribute('data-theme');
          if (theme === 'system') {
            localStorage.removeItem('theme');
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
              document.documentElement.classList.add('dark');
            } else {
              document.documentElement.classList.remove('dark');
            }
          } else {
            localStorage.setItem('theme', theme);
            if (theme === 'dark') {
              document.documentElement.classList.add('dark');
            } else {
              document.documentElement.classList.remove('dark');
            }
          }
          updateUI(theme);
        });
      });

      function updateUI(theme) {
        if (!theme) {
          theme = localStorage.getItem('theme') || 'system';
        }
        themeOptions.forEach(btn => {
          const btnTheme = btn.getAttribute('data-theme');
          if (btnTheme === theme) {
            btn.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-blue-600', 'dark:text-blue-400');
            btn.classList.remove('text-gray-500', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
          } else {
            btn.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-blue-600', 'dark:text-blue-400');
            btn.classList.add('text-gray-500', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
          }
        });
      }
      updateUI();
    }
  }

  // 回复弹窗相关逻辑
  function showReplyForm(coid, authorName) {
    var respond = document.querySelector('.respond');
    if (!respond) return;
    respond.classList.remove('hidden');
    var numericCoid = coid.toString().replace('comment-', '');
    document.getElementById('comment-parent').value = numericCoid;
    var replyInfo = document.getElementById('reply-to-info');
    var replyName = document.getElementById('reply-to-name');
    if (authorName) {
      replyName.textContent = '正在回复 @' + authorName;
      replyInfo.classList.remove('hidden');
    } else {
      replyInfo.classList.add('hidden');
    }
    document.getElementById('textarea').focus();
  }
  function hideReplyForm() {
    var respond = document.querySelector('.respond');
    if (!respond) return;
    respond.classList.add('hidden');
    document.getElementById('comment-parent').value = '0';
    document.getElementById('reply-to-info').classList.add('hidden');
  }

  // 目录高亮初始化函数
  function initTocHighlight() {
    const tocLinks = document.querySelectorAll('#toc a');
    if (!tocLinks.length) return;

    const headings = [];
    tocLinks.forEach(link => {
      const id = link.getAttribute('href').replace('#', '');
      const heading = document.getElementById(id);
      if (heading) headings.push({ el: heading, link: link });
    });

    if (!headings.length) return;

    function updateActive() {
      let current = null;
      for (let i = headings.length - 1; i >= 0; i--) {
        if (headings[i].el.getBoundingClientRect().top <= 100) {
          current = headings[i];
          break;
        }
      }
      tocLinks.forEach(link => link.classList.remove('text-blue-600', 'dark:text-blue-400', 'font-semibold'));
      if (current) {
        current.link.classList.add('text-blue-600', 'dark:text-blue-400', 'font-semibold');
      }
    }

    window.addEventListener('scroll', updateActive, { passive: true });
    updateActive();
  }

  // Fancybox 初始化/重新初始化函数（全局可访问）
  window.initFancybox = function() {
    // 清理已有的 Fancybox 实例
    document.querySelectorAll('a[data-fancybox]').forEach(a => {
      if (a._fancyboxInstance) {
        try { a._fancyboxInstance.destroy(); } catch(e) {}
      }
      a.removeAttribute('data-fancybox');
      a.removeAttribute('data-caption');
      // 如果是我们包裹的 a 标签且里面只有一个 img，解开包装
      const img = a.querySelector('img');
      if (img && a.children.length === 1 && img.tagName === 'IMG') {
        a.parentNode.insertBefore(img, a);
        a.parentNode.removeChild(a);
      }
    });

    const images = document.querySelectorAll('.prose img');
    images.forEach(img => {
      const parent = img.parentElement;
      if (parent.tagName === 'A' && parent.getAttribute('data-fancybox')) {
        return;
      }
      if (parent.tagName === 'A') {
        parent.setAttribute('data-fancybox', 'gallery');
      } else {
        const wrapper = document.createElement('a');
        wrapper.href = img.src;
        wrapper.setAttribute('data-fancybox', 'gallery');
        wrapper.setAttribute('data-caption', img.alt || '');
        img.parentNode.insertBefore(wrapper, img);
        wrapper.appendChild(img);
      }
    });

    if (typeof Fancybox !== "undefined") {
      Fancybox.bind('[data-fancybox]', {
        Hash: false,
        Thumbs: { autoStart: false },
        Toolbar: {
          display: {
            left: ["infobar"],
            middle: ["zoomIn", "zoomOut", "toggle1to1", "rotateCCW", "rotateCW", "flipX", "flipY"],
            right: ["slideshow", "thumbs", "close"]
          }
        }
      });
    }
  };

  // 页面加载完成后初始化所有组件
  document.addEventListener('DOMContentLoaded', function() {
    setupMobileMenu();
    setupFloatingControls();
    initFancybox();
    initTocHighlight();
  });
</script>

<!-- PJAX Loading 遮罩 -->
<div id="pjax-loading" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-white/80 dark:bg-gray-950/80 backdrop-blur-sm">
  <div class="flex flex-col items-center gap-4">
    <div class="w-12 h-12 border-4 border-blue-200 dark:border-blue-800 border-t-blue-600 dark:border-t-blue-400 rounded-full animate-spin"></div>
    <span class="text-sm font-medium text-gray-600 dark:text-gray-300">加载中...</span>
  </div>
</div>

<!-- 引入 PJAX 和 NProgress -->
<script src="https://cdn.jsdelivr.net/npm/pjax@0.2.8/pjax.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.js"></script>

<script>
// PJAX 初始化
(function() {
    var loadingEl = document.getElementById('pjax-loading');

    function showLoading() {
        if (loadingEl) {
            loadingEl.classList.remove('hidden');
            loadingEl.classList.add('flex');
        }
    }

    function hideLoading() {
        if (loadingEl) {
            loadingEl.classList.add('hidden');
            loadingEl.classList.remove('flex');
        }
    }

    var pjax = new Pjax({
        selectors: [
            'head title',
            'meta[name="description"]',
            'header',
            '#mobile-drawer-portal',
            'main',
            'footer',
            '.fixed.bottom-8'
        ],
        cacheBust: false,
        debug: false
    });

    // NProgress 配置
    NProgress.configure({ showSpinner: false, trickleSpeed: 200 });

    document.addEventListener('pjax:send', function() {
        NProgress.start();
        showLoading();
    });

    document.addEventListener('pjax:complete', function() {
        NProgress.done();
        hideLoading();
        // 先滚动到顶部
        window.scrollTo(0, 0);
        // 再重新初始化页面组件
        if (typeof setupMobileMenu === 'function') setupMobileMenu();
        if (typeof setupFloatingControls === 'function') setupFloatingControls();
        if (typeof initFancybox === 'function') initFancybox();
        if (typeof initTocHighlight === 'function') initTocHighlight();
    });
})();
</script>

<!-- 引入 Fancybox JS -->
<script src="https://lib.baomitu.com/fancyapps-ui/6.0.33/fancybox/fancybox.umd.js"></script>

<?php $this->footer(); ?>
</body>
</html>
