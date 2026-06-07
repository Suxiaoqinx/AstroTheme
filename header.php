<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title><?php $this->archiveTitle([
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            animation: {
              marquee: 'marquee 40s linear infinite',
            },
            keyframes: {
              marquee: {
                '0%': { transform: 'translateX(0%)' },
                '100%': { transform: 'translateX(-100%)' },
              }
            }
          }
        }
      }
    </script>
    
    <!-- 引入 Fancybox CSS -->
    <link rel="stylesheet" href="https://lib.baomitu.com/fancyapps-ui/6.0.33/fancybox/fancybox.min.css" />
    
    <script>
      const theme = (() => {
        if (typeof localStorage !== 'undefined' && localStorage.getItem('theme')) {
          return localStorage.getItem('theme');
        }
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
          return 'dark';
        }
        return 'light';
      })();
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    </script>
    <?php $this->header(); ?>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-900 antialiased transition-colors duration-300 dark:bg-gray-950 dark:text-gray-100">
<header id="site-header" class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50">
  <nav class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <a href="<?php $this->options->siteUrl(); ?>" class="flex items-center gap-2 text-xl font-bold hover:opacity-80 transition-opacity">
        <?php if ($this->options->logoUrl): ?>
          <img src="<?php $this->options->logoUrl(); ?>" alt="Logo" class="h-8 w-auto object-contain" />
        <?php else: ?>
          <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"><?php $this->options->title(); ?></span>
        <?php endif; ?>
      </a>
    </div>

    <!-- Desktop Menu -->
    <div class="hidden md:flex items-center gap-6">
      <?php
        $navLimit = intval($this->options->navLimit) > 0 ? intval($this->options->navLimit) : 4;
        $navItems = [];
        // 首页
        $navItems[] = [
            'title' => '首页',
            'url' => $this->options->siteUrl,
            'isActive' => $this->is('index')
        ];
        
        \Widget\Contents\Page\Rows::alloc()->to($pages);
        while ($pages->next()) {
            $navItems[] = [
                'title' => $pages->title,
                'url' => $pages->permalink,
                'isActive' => $this->is('page', $pages->slug)
            ];
        }

        $visibleItems = array_slice($navItems, 0, $navLimit);
        $hiddenItems = array_slice($navItems, $navLimit);
      ?>

      <?php foreach ($visibleItems as $item): ?>
      <a href="<?php echo $item['url']; ?>" class="font-medium transition-colors <?php if($item['isActive']): ?>text-blue-600 dark:text-blue-400<?php else: ?>text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400<?php endif; ?>">
        <?php echo $item['title']; ?>
      </a>
      <?php endforeach; ?>

      <?php if (!empty($hiddenItems)): ?>
      <div class="relative group">
        <button class="font-medium transition-colors text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 flex items-center gap-1">
          更多
          <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>
        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 py-2 min-w-[120px] flex flex-col">
            <?php foreach ($hiddenItems as $item): ?>
            <a href="<?php echo $item['url']; ?>" class="px-4 py-2 font-medium transition-colors whitespace-nowrap <?php if($item['isActive']): ?>text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/20<?php else: ?>text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-blue-600 dark:hover:text-blue-400<?php endif; ?>">
              <?php echo $item['title']; ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <!-- Mobile Controls -->
    <div class="flex items-center gap-4 md:hidden">
      <button id="mobile-menu-btn" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none p-2" aria-label="Menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
      </button>
    </div>
  </nav>

  <!-- Mobile Drawer -->
  <div id="mobile-drawer" class="fixed inset-y-0 right-0 z-50 w-64 bg-white dark:bg-gray-900 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out md:hidden">
    <div class="p-6">
      <div class="flex items-center justify-between mb-8">
        <span class="text-lg font-bold text-gray-900 dark:text-white">菜单</span>
        <button id="close-menu-btn" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none p-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
      </div>
      <div class="flex flex-col gap-6">
        <a href="<?php $this->options->siteUrl(); ?>" class="text-lg font-medium transition-colors block text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">首页</a>
        <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
        <?php while ($pages->next()): ?>
        <a href="<?php $pages->permalink(); ?>" class="text-lg font-medium transition-colors block text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
            <?php $pages->title(); ?>
        </a>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

  <!-- Overlay -->
  <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-40 hidden opacity-0 transition-opacity duration-300 md:hidden backdrop-blur-sm"></div>
</header>
<div id="mobile-drawer-portal"></div>
<script>
  function setupMobileMenu() {
    const btn = document.getElementById('mobile-menu-btn');
    const drawerOriginal = document.getElementById('mobile-drawer');
    const overlayOriginal = document.getElementById('mobile-menu-overlay');
    const portal = document.getElementById('mobile-drawer-portal');

    if (!btn || !drawerOriginal || !overlayOriginal || !portal) return;

    if (!portal.hasChildNodes()) {
       portal.appendChild(overlayOriginal);
       portal.appendChild(drawerOriginal);
    }
    
    const drawer = document.getElementById('mobile-drawer');
    const overlay = document.getElementById('mobile-menu-overlay');
    const closeBtn = document.getElementById('close-menu-btn');

    if (!drawer || !overlay || !closeBtn) return;
    if (btn.dataset.initialized) return;

    function openMenu() {
      drawer.classList.remove('translate-x-full');
      overlay.classList.remove('hidden');
      requestAnimationFrame(() => {
        overlay.classList.remove('opacity-0');
      });
      document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
      drawer.classList.add('translate-x-full');
      overlay.classList.add('opacity-0');
      setTimeout(() => {
        overlay.classList.add('hidden');
      }, 300);
      document.body.style.overflow = '';
    }

    btn.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);
    
    const links = drawer.querySelectorAll('a');
    links.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    btn.dataset.initialized = 'true';
  }
</script>

<main class="flex-grow max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
