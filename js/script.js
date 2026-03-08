document.addEventListener('DOMContentLoaded', () => {
  // ドロワーメニューの開閉
  const drowerBtn = document.querySelector('.lpHeader__drower-btn');
  const drower = document.querySelector('#drower');
  const body = document.body;
  const drowerLinks = document.querySelectorAll('.lpHeader__drower-menu-item a, .lpHeader__drower-btn-contents a');

  // ドロワーメニューを閉じる関数
  const closeDrower = () => {
    if (drower) drower.classList.remove('is-open');
    if (drowerBtn) drowerBtn.classList.remove('is-active');
    body.classList.remove('drower-open');
  };

  // ドロワーメニューを開く関数
  const openDrower = () => {
    if (drower) drower.classList.add('is-open');
    if (drowerBtn) drowerBtn.classList.add('is-active');
    body.classList.add('drower-open');
  };

  if (drowerBtn && drower) {
    // ハンバーガーボタンのクリック
    drowerBtn.addEventListener('click', (e) => {
      e.stopPropagation(); // イベントのバブリングを防ぐ
      const isOpen = drower.classList.contains('is-open');
      
      if (isOpen) {
        closeDrower();
      } else {
        openDrower();
      }
    });

    // ドロワー内のリンクをクリックしたら閉じる
    drowerLinks.forEach(link => {
      link.addEventListener('click', () => {
        closeDrower();
      });
    });

    // ドロワー自体のクリックでイベントバブリングを停止
    drower.addEventListener('click', (e) => {
      e.stopPropagation();
    });

    // オーバーレイクリックで閉じる
    document.addEventListener('click', (e) => {
      if (body.classList.contains('drower-open') && 
          !drower.contains(e.target) && 
          !drowerBtn.contains(e.target)) {
        closeDrower();
      }
    });
  }

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
        const lpHeader = document.querySelector('.lpHeader');
        const headerHeight = lpHeader ? lpHeader.offsetHeight : 0;
        const targetPosition = targetElement.offsetTop - headerHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });

        // ドロワーメニューが開いていたら閉じる
        if (body.classList.contains('drower-open')) {
          closeDrower();
        }
      }
    });
  });

  // お問い合わせ種別の自動選択
  const contactButtons = document.querySelectorAll('a[href="#contact"][data-inquiry-type]');
  contactButtons.forEach(button => {
    button.addEventListener('click', function() {
      const inquiryType = this.getAttribute('data-inquiry-type');
      
      // フォームのselectが存在する場合、少し遅延させて値を設定
      setTimeout(() => {
        const selectElement = document.getElementById('your-select');
        if (selectElement && inquiryType) {
          selectElement.value = inquiryType;
          // selectの変更イベントをトリガー（Contact Form 7など用）
          const event = new Event('change', { bubbles: true });
          selectElement.dispatchEvent(event);
        }
      }, 100);
    });
  });

});