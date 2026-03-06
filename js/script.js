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
  const faqItems = document.querySelectorAll('.faq__item');
  
  faqItems.forEach((item) => {
    const question = item.querySelector('.faq__contents--head');
    const answer = item.querySelector('.faq__contents--answer');
    
    if (!question || !answer) return;
    
    // クリック可能なカーソルを設定
    question.style.cursor = 'pointer';
    
    // 初期状態の設定（アクティブでない場合は閉じる）
    if (!item.classList.contains('faq__item--active')) {
      answer.style.maxHeight = '0';
      answer.style.overflow = 'hidden';
    } else {
      // 一時的にmax-heightを解除してから正しい高さを取得
      answer.style.maxHeight = 'none';
      const height = answer.scrollHeight;
      answer.style.maxHeight = '0';
      // 次のフレームで高さを設定（アニメーションのため）
      requestAnimationFrame(() => {
        answer.style.maxHeight = height + 'px';
      });
    }
    
    question.addEventListener('click', () => {
      const isOpen = item.classList.contains('faq__item--active');
      
      if (isOpen) {
        // 閉じる
        answer.style.maxHeight = '0';
        item.classList.remove('faq__item--active');
      } else {
        // 開く：一時的にmax-heightを解除してから正しい高さを取得
        answer.style.maxHeight = 'none';
        const height = answer.scrollHeight;
        answer.style.maxHeight = '0';
        // 次のフレームで高さを設定（アニメーションのため）
        requestAnimationFrame(() => {
          answer.style.maxHeight = height + 'px';
          item.classList.add('faq__item--active');
        });
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