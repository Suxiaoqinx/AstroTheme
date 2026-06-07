<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
$imgUrl = getPostImg($this);
$thumbPos = $this->fields->thumbPosition ? $this->fields->thumbPosition : 'left';
$flexDir = $thumbPos === 'right' ? 'md:flex-row-reverse' : 'md:flex-row';

global $stickyArray;
if (!isset($stickyArray)) $stickyArray = [];
$isSticky = isset($this->isStickyItem) && $this->isStickyItem;
?>
<article class="flex flex-col <?php echo $flexDir; ?> gap-4 sm:gap-6 bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-shadow border border-gray-200 dark:border-gray-700 p-4 sm:p-6 post-item">
  <?php if($imgUrl): ?>
  <div class="w-full md:w-[260px] lg:w-[320px] aspect-[16/9] md:aspect-auto md:h-48 overflow-hidden rounded-lg flex-shrink-0">
    <a href="<?php $this->permalink() ?>" class="block w-full h-full">
      <img src="<?php echo $imgUrl; ?>" alt="<?php $this->title() ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
    </a>
  </div>
  <?php endif; ?>
  
  <div class="flex-1 flex flex-col justify-between min-w-0">
    <div>
      <a href="<?php $this->permalink() ?>" class="block group">
        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors mb-2 sm:mb-3 flex items-center gap-2 flex-wrap leading-snug">
          <?php if($isSticky): ?>
          <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">置顶</span>
          <?php endif; ?>
          <?php $this->title() ?>
        </h3>
        <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400 mb-3 sm:mb-4 line-clamp-2 sm:line-clamp-3 leading-relaxed">
          <?php $this->excerpt(200, '...'); ?>
        </p>
      </a>
    </div>
    <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mt-auto">
      <div class="flex items-center gap-1.5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <time datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time>
      </div>
      <div class="flex items-center gap-1.5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        <?php getPostView($this); ?>
      </div>
      <div class="flex items-center gap-1.5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <?php $this->commentsNum('0', '1', '%d'); ?>
      </div>
    </div>
  </div>
</article>