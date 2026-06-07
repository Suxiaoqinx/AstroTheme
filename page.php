<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="flex flex-col lg:flex-row gap-8">
  <!-- Main Content -->
  <div class="flex-1 min-w-0 space-y-12">
    <!-- Title Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6 md:p-10 text-center">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-4"><?php $this->title() ?></h1>
      <div class="flex flex-wrap items-center justify-center gap-4 text-gray-500 dark:text-gray-400 font-medium mt-4">
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
          <a href="#comments" class="hover:text-blue-600 transition-colors"><?php $this->commentsNum('0', '1', '%d'); ?></a>
        </div>
      </div>
    </div>

    <!-- Content Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6 md:p-10">
      <article class="prose prose-lg dark:prose-invert max-w-none">
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

<script src="<?php $this->options->themeUrl('joe.short.js'); ?>"></script>
<?php $this->need('footer.php'); ?>
