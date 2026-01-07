/* 電力プラン診断ツールカスタムJS */
document.addEventListener('DOMContentLoaded', () => {
  // 診断ツール全体（HTML）がページに存在するか確認
  const diagnosticTool = document.getElementById('diagnostic-tool');
  if (!diagnosticTool) {
    // 診断ツールがこのページになければ、何もしない
    return;
  }

  // ========== 【パターンA：1画面スクロール形式ロジック (有効)】 ==========
  
  // 各要素の取得
  const regionChoices = document.querySelectorAll('.region-choice');
  const householdChoices = document.querySelectorAll('.household-choice');
  const groupHousehold = document.getElementById('group-household'); // Q2のコンテナ
  
  // 結果表示エリア
  const resultScreen = document.getElementById('screen-result');
  const questionsScreen = document.getElementById('screen-scroll-questions'); // 1画面版の質問スクリーンID
  const resultContent = document.getElementById('result-content');
  const resultLoader = document.getElementById('result-loader');
  const restartBtn = document.getElementById('restart-btn');

  // 回答を保存する変数
  let answers = {
    region: null,
    household: null,
  };

  // WordPressのサイトURL取得など
  const siteUrl = (typeof swellVars !== 'undefined' && swellVars.siteUrl)
    ? swellVars.siteUrl
    : (location.origin + '/erisgood/');
  const restApiUrl = siteUrl + 'wp-json/erisgood-tool/v1/get_result';

  // --- Q1: 地方選択の処理 ---
  regionChoices.forEach(button => {
    button.addEventListener('click', () => {
      // 選択状態の更新
      answers.region = button.dataset.value;
      regionChoices.forEach(btn => btn.classList.remove('selected'));
      button.classList.add('selected');

      // Q2へスムーズスクロール
      if (groupHousehold) {
        // 少し遅延させてスクロール（クリックの感触を残すため）
        setTimeout(() => {
          groupHousehold.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 200);
      }
    });
  });

  // --- Q2: 人数選択の処理（これがトリガーで診断実行） ---
  householdChoices.forEach(button => {
    button.addEventListener('click', () => {
      // Q1が未選択の場合のガード
      if (!answers.region) {
        alert('先に「お住まいの地域」を選択してください。');
        // Q1へスクロール戻し
        const groupRegion = document.getElementById('group-region');
        if(groupRegion) groupRegion.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
      }

      // 選択状態の更新
      answers.household = button.dataset.value;
      householdChoices.forEach(btn => btn.classList.remove('selected'));
      button.classList.add('selected');

      // 結果取得処理へ
      setTimeout(() => {
        // 質問画面を隠して結果画面を表示（遷移）
        questionsScreen.classList.remove('active');
        resultScreen.classList.add('active');
        
        // 診断実行
        fetchDiagnosticResult();
        
        // 念のためトップへスクロール
        diagnosticTool.scrollIntoView({ behavior: 'smooth' });
      }, 300);
    });
  });

  // 結果を取得して表示する関数
  async function fetchDiagnosticResult() {
    if (!resultContent || !resultLoader) {
      console.error('結果表示エリアまたはローダーが見つかりません。');
      return;
    }

    // 1. 結果エリアを空にし、ローディングスピナーを表示
    resultContent.innerHTML = ''; 
    resultLoader.classList.add('loading'); 
    resultContent.appendChild(resultLoader); 

    // 2. クエリパラメータ作成
    const params = new URLSearchParams();
    params.append('region', answers.region);
    params.append('household', answers.household);
    const requestUrl = restApiUrl + '?' + params.toString();

    try {
      // 3. API通信
      const response = await fetch(requestUrl, { method: 'GET' });

      if (!response.ok) {
        const errorText = await response.text();
        console.error('サーバー応答エラー詳細:', errorText);
        throw new Error('サーバー応答エラー: ' + response.statusText);
      }

      // 4. 結果HTML表示
      const resultHtml = await response.text();
      resultLoader.classList.remove('loading');
      resultContent.innerHTML = resultHtml; 

    } catch (error) {
      console.error('診断結果の取得に失敗しました:', error);
      resultLoader.classList.remove('loading');
      resultContent.innerHTML = '<p class="text-red-500">エラー: 結果の取得に失敗しました。時間をおいて再度お試しください。</p>';
    }
  }

  // --- リスタートボタンの処理 ---
  if (restartBtn) {
    restartBtn.addEventListener('click', () => {
      // 回答リセット
      answers = { region: null, household: null };
      
      // ボタンの選択状態解除
      document.querySelectorAll('.choice-button').forEach(btn => {
        btn.classList.remove('selected');
      });

      // 結果画面を隠し、質問画面を表示
      resultScreen.classList.remove('active');
      questionsScreen.classList.add('active'); // 1画面版ID

      // 結果エリアの中身リセット
      resultContent.innerHTML = '';
      resultContent.appendChild(resultLoader);
      resultLoader.classList.remove('loading');

      // ツールトップへスクロール
      diagnosticTool.scrollIntoView({ behavior: 'smooth' });
    });
  }

  // --- 詳細条件リンクの制御（変更なし） ---
  diagnosticTool.addEventListener('click', (e) => {
    const targetLink = e.target.closest('a[href="#price-simulation-conditions"]');
    if (targetLink) {
      e.preventDefault(); 
      const targetId = targetLink.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);
      if (targetElement) {
        if (targetElement.tagName.toLowerCase() === 'details') {
          targetElement.open = true;
        }
        targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }
  });

  
  /* ========== 【パターンB：2画面遷移形式ロジック (コメントアウト中)】 ==========
  // 以前のロジックを使用する場合はこちらを有効化し、上のパターンAを無効化してください
  
  const screens = {
    region: document.getElementById('screen-region'),
    household: document.getElementById('screen-household'),
    result: document.getElementById('screen-result'),
  };
  const prevBtn1 = document.getElementById('prev-btn-1');

  function showScreen(screenId) {
    Object.values(screens).forEach(screen => {
      if (screen) screen.classList.remove('active');
    });
    if (screens[screenId]) {
      screens[screenId].classList.add('active');
    }
  }

  // Q1
  regionChoices.forEach(button => {
    button.addEventListener('click', () => {
      answers.region = button.dataset.value;
      regionChoices.forEach(btn => btn.classList.remove('selected'));
      button.classList.add('selected');
      setTimeout(() => {
        showScreen('household');
      }, 300);
    });
  });

  // 戻るボタン
  if (prevBtn1) {
    prevBtn1.addEventListener('click', () => {
      showScreen('region');
    });
  }

  // Q2
  householdChoices.forEach(button => {
    button.addEventListener('click', () => {
      answers.household = button.dataset.value;
      householdChoices.forEach(btn => btn.classList.remove('selected'));
      button.classList.add('selected');
      setTimeout(() => {
        showScreen('result');
        fetchDiagnosticResult();
        diagnosticTool.scrollIntoView({ behavior: 'smooth' });
      }, 300);
    });
  });

  // リスタート (パターンB用)
  if (restartBtn) {
    restartBtn.addEventListener('click', () => {
      answers = { region: null, household: null };
      document.querySelectorAll('.choice-button').forEach(btn => {
        btn.classList.remove('selected');
      });
      resultContent.innerHTML = '';
      resultContent.appendChild(resultLoader);
      resultLoader.classList.remove('loading');
      showScreen('region');
      diagnosticTool.scrollIntoView({ behavior: 'smooth' });
    });
  }
  
  // 初期表示 (パターンB用)
  // showScreen('region');
  ======================================================================== */

});