document.addEventListener('DOMContentLoaded', function() {
    const contentElements = document.querySelectorAll('.prose'); // 获取所有文章/页面内容区域

    contentElements.forEach(contentEl => {
        let html = contentEl.innerHTML;

        // 预处理：移除可能被 Markdown 自动包裹的 <p> 标签，防止 HTML 嵌套不合法导致错位
        html = html.replace(/<p>\s*(\[(?:info|success|warning|error|collapse|cloud|tabs|tab)[^\]]*\])\s*<\/p>/gi, '$1');
        html = html.replace(/<p>\s*(\[\/(?:info|success|warning|error|collapse|cloud|tabs|tab)\])\s*<\/p>/gi, '$1');
        html = html.replace(/<p>\s*(\[(?:info|success|warning|error|collapse|cloud|tabs|tab)[^\]]*\])/gi, '$1');
        html = html.replace(/(\[\/(?:info|success|warning|error|collapse|cloud|tabs|tab)\])\s*<\/p>/gi, '$1');

        // 1. 信息面板 [info]内容[/info]
        html = html.replace(/\[info\]([\s\S]*?)\[\/info\]/gi, '<div class="px-4 py-3 mb-4 rounded-xl bg-blue-50 text-blue-800 border border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800/50"><div class="flex items-start"><svg class="w-5 h-5 mr-3 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg><div class="flex-1 leading-relaxed">$1</div></div></div>');
        
        // 2. 成功面板 [success]内容[/success]
        html = html.replace(/\[success\]([\s\S]*?)\[\/success\]/gi, '<div class="px-4 py-3 mb-4 rounded-xl bg-green-50 text-green-800 border border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800/50"><div class="flex items-start"><svg class="w-5 h-5 mr-3 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg><div class="flex-1 leading-relaxed">$1</div></div></div>');

        // 3. 警告面板 [warning]内容[/warning]
        html = html.replace(/\[warning\]([\s\S]*?)\[\/warning\]/gi, '<div class="px-4 py-3 mb-4 rounded-xl bg-yellow-50 text-yellow-800 border border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800/50"><div class="flex items-start"><svg class="w-5 h-5 mr-3 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg><div class="flex-1 leading-relaxed">$1</div></div></div>');

        // 4. 错误面板 [error]内容[/error]
        html = html.replace(/\[error\]([\s\S]*?)\[\/error\]/gi, '<div class="px-4 py-3 mb-4 rounded-xl bg-red-50 text-red-800 border border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800/50"><div class="flex items-start"><svg class="w-5 h-5 mr-3 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg><div class="flex-1 leading-relaxed">$1</div></div></div>');

        // 5. 折叠面板 [collapse title="标题"]内容[/collapse]
        html = html.replace(/\[collapse title="([^"]+)"\]([\s\S]*?)\[\/collapse\]/gi, '<details class="mb-4 bg-gray-50/50 dark:bg-gray-800/30 border border-gray-100 dark:border-gray-700/50 rounded-lg overflow-hidden group shadow-sm"><summary class="px-4 py-3 text-[15px] text-gray-600 dark:text-gray-300 cursor-pointer hover:bg-gray-100/80 dark:hover:bg-gray-700/80 transition-colors list-none flex justify-between items-center outline-none [&::-webkit-details-marker]:hidden border-b border-transparent group-open:border-gray-100 dark:group-open:border-gray-700/50"><span>$1</span><svg class="w-4 h-4 text-gray-400 transition-transform duration-300 group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></summary><div class="p-4 text-sm text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800/80">$2</div></details>');

        // 6. 按钮 [btn href="链接"]文字[/btn]
        html = html.replace(/\[btn href="([^"]+)"\]([\s\S]*?)\[\/btn\]/gi, '<a href="$1" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 hover:scale-105 focus:outline-none transition-all duration-300 no-underline my-2">$2</a>');

        // 7. 徽章 [tag]文字[/tag]
        html = html.replace(/\[tag\]([\s\S]*?)\[\/tag\]/gi, '<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 mx-1">$1</span>');

        // 8. 云盘下载面板
        html = html.replace(/\[cloud title=(?:"|'|&quot;)(.*?)(?:"|'|&quot;) url=(?:"|'|&quot;)(.*?)(?:"|'|&quot;)\s*(?:password=(?:"|'|&quot;)(.*?)(?:"|'|&quot;))?\s*(?:icon=(?:"|'|&quot;)(.*?)(?:"|'|&quot;))?\]([\s\S]*?)\[\/cloud\]/gi, function(match, title, url, password, icon, desc) {
            let bgClass = 'bg-blue-50/50 dark:bg-blue-900/20';
            let iconHtml = '<svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>';
            
            if (title.indexOf('百度') !== -1) {
                iconHtml = '<svg class="w-8 h-8 text-blue-500" viewBox="0 0 1024 1024" fill="currentColor"><path d="M720.613 361.353c-145.474-55.807-227.18 51.498-227.18 51.498s-74.67-106.07-219.06-53.715c-151.71 55.009-115.96 238.163-115.96 238.163s-52.023 203.047 114.787 231.62c144.385 24.73 220.232-126.79 220.232-126.79s87.75 147.28 227.18 126.79c162.593-23.86 114.787-231.62 114.787-231.62s36.88-176.475-114.786-235.946zM286.91 768.04c-113.626 0-205.74-92.115-205.74-205.74 0-113.626 92.114-205.74 205.74-205.74 113.625 0 205.74 92.114 205.74 205.74 0 113.625-92.115 205.74-205.74 205.74zm448.965 0c-113.625 0-205.74-92.115-205.74-205.74 0-113.626 92.115-205.74 205.74-205.74 113.626 0 205.74 92.114 205.74 205.74 0 113.625-92.114 205.74-205.74 205.74zM286.91 432.802c-71.49 0-129.497 57.942-129.497 129.498s58.007 129.497 129.498 129.497c71.49 0 129.497-57.942 129.497-129.497s-58.007-129.498-129.498-129.498zm448.965 0c-71.49 0-129.498 57.942-129.498 129.498s58.008 129.497 129.498 129.497 129.497-57.942 129.497-129.497-58.007-129.498-129.497-129.498z"></path></svg>';
            } else if (title.indexOf('蓝奏') !== -1) {
                iconHtml = '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>';
            } else if (title.toLowerCase().indexOf('github') !== -1) {
                iconHtml = '<svg class="w-8 h-8 text-gray-800 dark:text-white" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.465-1.11-1.465-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.416 22 12c0-5.523-4.477-10-10-10z"></path></svg>';
            } else if (title.indexOf('阿里') !== -1) {
                iconHtml = '<svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>';
            }
            
            let passwordHtml = password ? ' <span class="mx-1 text-gray-300">|</span> 提取码：<span class="font-mono">' + password + '</span>' : '';
            
            return '<div class="flex items-center justify-between p-4 mb-4 ' + bgClass + ' rounded-xl border border-blue-100 dark:border-blue-800/30 hover:shadow-md transition-shadow">' +
                        '<div class="flex items-center gap-4 min-w-0">' +
                            '<div class="flex-shrink-0 bg-white dark:bg-gray-800 p-2 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">' +
                                iconHtml +
                            '</div>' +
                            '<div class="min-w-0">' +
                                '<h4 class="text-base font-bold text-blue-600 dark:text-blue-400 m-0 truncate">' + title + '</h4>' +
                                '<div class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate">' +
                                    '来源：' + desc + passwordHtml +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<a href="' + url + '" target="_blank" rel="noopener noreferrer" class="flex-shrink-0 ml-4 bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full shadow-sm transition-colors" title="点击下载">' +
                            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>' +
                        '</a>' +
                    '</div>';
        });

        // 9. Tabs
        html = html.replace(/\[tabs\]([\s\S]*?)\[\/tabs\]/gi, function(match, tabsContent) {
            let tabsId = 'tabs-' + Math.random().toString(36).substr(2, 9);
            let navHtml = '<div class="flex flex-wrap border-b border-gray-200 dark:border-gray-700 mb-0 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl" role="tablist">';
            let contentHtml = '<div class="p-4 bg-white dark:bg-gray-800 border border-t-0 border-gray-200 dark:border-gray-700 rounded-b-xl">';
            
            let index = 0;
            tabsContent = tabsContent.replace(/\[tab title=(?:"|'|&quot;)(.*?)(?:"|'|&quot;)\]([\s\S]*?)\[\/tab\]/gi, function(tabMatch, title, content) {
                let isActive = index === 0;
                let activeNavClass = isActive ? 'text-blue-600 bg-white dark:bg-gray-800 border-t-2 border-blue-500 font-bold' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-medium border-t-2 border-transparent';
                let activeContentClass = isActive ? 'block' : 'hidden';
                let tabId = tabsId + '-tab-' + index;
                
                navHtml += '<button type="button" class="px-6 py-3 text-sm focus:outline-none transition-colors ' + activeNavClass + '" role="tab" aria-selected="' + (isActive ? 'true' : 'false') + '" onclick="joeSwitchTab(this, \'' + tabId + '\', \'' + tabsId + '\')">' + title + '</button>';
                contentHtml += '<div id="' + tabId + '" class="' + tabsId + '-content ' + activeContentClass + ' prose prose-sm dark:prose-invert max-w-none" role="tabpanel">' + content + '</div>';
                
                index++;
                return '';
            });
            
            navHtml += '</div>';
            contentHtml += '</div>';
            
            return '<div class="mb-6 shadow-sm rounded-xl overflow-hidden">' + navHtml + contentHtml + '</div>';
        });

        contentEl.innerHTML = html;
    });
});

// 暴露全局切换函数给 Tabs 使用
window.joeSwitchTab = function(btn, targetId, groupId) {
    const tabsGroup = btn.closest('[role="tablist"]');
    const buttons = tabsGroup.querySelectorAll('button');
    buttons.forEach(b => {
        b.setAttribute('aria-selected', 'false');
        b.className = b.className.replace('text-blue-600 bg-white dark:bg-gray-800 border-blue-500 font-bold', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-medium border-transparent');
    });
    btn.setAttribute('aria-selected', 'true');
    btn.className = btn.className.replace('text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-medium border-transparent', 'text-blue-600 bg-white dark:bg-gray-800 border-blue-500 font-bold');
    
    const contents = document.querySelectorAll('.' + groupId + '-content');
    contents.forEach(c => {
        c.classList.add('hidden');
        c.classList.remove('block');
    });
    document.getElementById(targetId).classList.add('block');
    document.getElementById(targetId).classList.remove('hidden');
};