<?php
/**
 * 相册模板
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
      <div class="prose prose-lg dark:prose-invert max-w-none mb-8" id="gallery-content">
        <?php $this->content(); ?>
      </div>
      
            <div id="gallery-container">
                    <div id="gallery-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- 图片将通过 JS 从上面的内容中提取并生成在这里 -->
                    </div>
            </div>
      
      <script>
      document.addEventListener('DOMContentLoaded', function() {
          const content = document.getElementById('gallery-content');
          const container = document.getElementById('gallery-container');
          const grid = document.getElementById('gallery-grid');
          if (!content || !grid || !container) return;
          
          const headings = content.querySelectorAll('h2, h3, h4');
          
          if (headings.length > 0) {
              // 存在分类标题，执行相册分类逻辑
              let albums = [];
              let currentAlbum = null;
              
              Array.from(content.children).forEach(node => {
                  if (/^H[2-4]$/.test(node.tagName)) {
                      if (currentAlbum) albums.push(currentAlbum);
                      currentAlbum = {
                          title: node.textContent,
                          images: []
                      };
                  } else if (currentAlbum) {
                      const imgs = node.tagName === 'IMG' ? [node] : node.querySelectorAll('img');
                      imgs.forEach(img => {
                          currentAlbum.images.push({
                              src: img.src,
                              alt: img.alt || 'Gallery Image'
                          });
                      });
                  }
              });
              if (currentAlbum) albums.push(currentAlbum);
              
              albums = albums.filter(a => a.images.length > 0);
              
              if (albums.length > 0) {
                  // 渲染相册封面网格（默认移动端两列，卡片更紧凑）
                  grid.className = 'grid grid-cols-2 sm:grid-cols-3 gap-4';
                  grid.innerHTML = '';
                  
                  albums.forEach((album, index) => {
                      const coverImg = album.images[0];
                      const wrapper = document.createElement('div');
                      wrapper.className = 'relative group rounded-xl overflow-hidden shadow-sm cursor-pointer aspect-[3/2]';
                      
                      wrapper.innerHTML = `
                          <img src="${coverImg.src}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="${album.title}">
                          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                          <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-end">
                              <h3 class="text-white text-lg font-bold drop-shadow-md truncate pr-4">${album.title}</h3>
                              <span class="bg-white/30 backdrop-blur-sm text-white text-xs px-2 py-0.5 rounded-full font-medium whitespace-nowrap">${album.images.length} 张</span>
                          </div>
                      `;
                      
                      wrapper.addEventListener('click', () => renderAlbumImages(album));
                      grid.appendChild(wrapper);
                  });
                  
                  content.style.display = 'none';
              } else {
                  renderSimpleGrid();
              }
          } else {
              renderSimpleGrid();
          }
          
          function renderSimpleGrid() {
              const images = content.querySelectorAll('img');
              if (images.length > 0) {
                  grid.innerHTML = '';
                  images.forEach(img => {
                      const src = img.src;
                      const alt = img.alt || 'Gallery Image';
                      
                      const wrapper = document.createElement('a');
                      wrapper.href = src;
                      wrapper.setAttribute('data-fancybox', 'gallery-page');
                      wrapper.setAttribute('data-caption', alt);
                      wrapper.className = 'break-inside-avoid relative group rounded-xl overflow-hidden shadow-sm cursor-pointer block';
                      
                      wrapper.innerHTML = `
                          <img src="${src}" class="w-full object-cover transition-transform duration-500 group-hover:scale-110" alt="${alt}">
                          ${alt !== 'Gallery Image' ? `
                          <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                              <span class="text-white font-medium px-4 text-center">${alt}</span>
                          </div>` : ''}
                      `;
                      
                      grid.appendChild(wrapper);
                  });
                  
                  content.querySelectorAll('img').forEach(img => {
                      const p = img.closest('p');
                      if (p && p.childNodes.length === 1) p.style.display = 'none';
                      else img.style.display = 'none';
                  });
              } else {
                  grid.innerHTML = '<div class="col-span-full text-center text-gray-500 py-8">请在文章内容中插入图片（可选使用 H2/H3 标题进行相册分类）。</div>';
              }
          }
          
          function renderAlbumImages(album) {
              container.innerHTML = '';
              
              const backBtn = document.createElement('button');
              backBtn.className = 'mb-6 inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium transition-colors bg-blue-50 dark:bg-blue-900/30 px-4 py-2 rounded-lg';
              backBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> 返回相册列表';
              backBtn.onclick = () => location.reload();
              
              const title = document.createElement('h2');
              title.className = 'text-3xl font-bold text-gray-900 dark:text-white mb-8 pb-4 border-b border-gray-100 dark:border-gray-700';
              title.textContent = album.title;
              
              const header = document.createElement('div');
              header.appendChild(backBtn);
              header.appendChild(title);
              
              const imagesGrid = document.createElement('div');
              imagesGrid.className = 'grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4';
              
              album.images.forEach(imgData => {
                  const wrapper = document.createElement('a');
                  wrapper.href = imgData.src;
                  wrapper.setAttribute('data-fancybox', 'gallery-album');
                  wrapper.setAttribute('data-caption', imgData.alt);
                  wrapper.className = 'break-inside-avoid relative group rounded-xl overflow-hidden shadow-sm cursor-pointer block';
                  wrapper.innerHTML = `
                      <img src="${imgData.src}" class="w-full object-cover transition-transform duration-500 group-hover:scale-110" alt="${imgData.alt}">
                      ${imgData.alt !== 'Gallery Image' ? `
                      <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                          <span class="text-white font-medium px-4 text-center">${imgData.alt}</span>
                      </div>` : ''}
                  `;
                  imagesGrid.appendChild(wrapper);
              });
              
              container.appendChild(header);
              container.appendChild(imagesGrid);
          }
      });
      </script>
    </div>

    <!-- Comments -->
    <?php $this->need('comments.php'); ?>
  </div>

  <!-- Sidebar -->
  <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>