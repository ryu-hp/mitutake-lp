document.addEventListener('DOMContentLoaded', () => {
  // ビデオの再生コントロール
  const videoWrappers = document.querySelectorAll('.video-wrapper');
  
  videoWrappers.forEach((wrapper) => {
    const video = wrapper.querySelector('.promo-video');
    const playBtn = wrapper.querySelector('.video-play-btn');
    
    // 再生/一時停止
    const togglePlay = () => {
      if (video.paused) {
        video.play();
        playBtn.style.opacity = '0';
        playBtn.style.pointerEvents = 'none';
      } else {
        video.pause();
        playBtn.style.opacity = '1';
        playBtn.style.pointerEvents = 'auto';
      }
    };
    
    video.addEventListener('click', togglePlay);
    playBtn.addEventListener('click', togglePlay);
    
    // 再生終了時に再生ボタンを表示
    video.addEventListener('ended', () => {
      playBtn.style.opacity = '1';
      playBtn.style.pointerEvents = 'auto';
    });
  });

  // FAQアコーディオン
  const faqItems = document.querySelectorAll('.faq-item');
  
  faqItems.forEach((item) => {
    const question = item.querySelector('.faq-item__question');
    const answer = item.querySelector('.faq-item__answer');
    
    // 初期状態で閉じる
    answer.style.maxHeight = '0';
    answer.style.opacity = '0';
    answer.style.marginTop = '0';
    
    item.addEventListener('click', () => {
      const isOpen = item.classList.contains('is-open');
      
      if (isOpen) {
        // 閉じる
        answer.style.maxHeight = '0';
        answer.style.opacity = '0';
        answer.style.marginTop = '0';
        item.classList.remove('is-open');
      } else {
        // 開く
        answer.style.maxHeight = answer.scrollHeight + 'px';
        answer.style.opacity = '1';
        answer.style.marginTop = '40px';
        item.classList.add('is-open');
      }
    });
  });

  // スムーズスクロール
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#' || targetId === '') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        e.preventDefault();
        const header = document.querySelector('.header');
        const headerHeight = header ? header.offsetHeight : 0;
        const targetPosition = targetElement.offsetTop - headerHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });

        // メニューが開いていたら閉じる
        if (headerToggle && mobileMenu && body.classList.contains('menu-open')) {
          headerToggle.classList.remove('is-active');
          mobileMenu.classList.remove('is-open');
          body.classList.remove('menu-open');
        }
      }
    });
  });

});