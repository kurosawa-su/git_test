// 電力プラン診断ツールロジック

// --- 1. 会社マスター定義 ---
// キーを日本語の会社名にし、内容はショートコード名のみに簡略化
// ★変更: 'has_campaign' => '有り' を追加。不要な場合は '無し' に変更してください。
global $diagnostic_company_master;
$diagnostic_company_master = [
    'オクトパスエナジー' => [ 'shortcode_name' => 'オクトパスエナジー', 'has_campaign' => '有り' ],
    'Looopでんき' => [ 'shortcode_name' => 'Looopでんき', 'has_campaign' => '無し' ],
    'シン・エナジー' => [ 'shortcode_name' => 'シンエナジー', 'has_campaign' => '無し' ],
    'エネワンでんき' => [ 'shortcode_name' => 'エネワンでんき', 'has_campaign' => '有り' ],
    'TERASELでんき' => [ 'shortcode_name' => 'TERASELでんき', 'has_campaign' => '無し' ],
    'CDエナジーダイレクト' => [ 'shortcode_name' => 'ＣＤエナジーダイレクト', 'has_campaign' => '無し' ],
    'リボンエナジー' => [ 'shortcode_name' => 'リボンエナジー', 'has_campaign' => '有り' ],
    'ミツウロコでんき' => [ 'shortcode_name' => 'ミツウロコでんき', 'has_campaign' => '無し' ],
    'ENEOSでんき' => [ 'shortcode_name' => 'ENEOSでんき', 'has_campaign' => '無し' ]
];

// --- 2. データ定義 ---
// plan_keys に会社名を直接指定するように変更
global $diagnostic_plan_data;
$diagnostic_plan_data = [
    'hokkaido' => [
        'area_name' => '北海道', 'comparison_target' => '北海道電力', 'shortcode_prefix' => '電力_プラン_北海道',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
        ]
    ],
    'tohoku' => [
        'area_name' => '東北', 'comparison_target' => '東北電力', 'shortcode_prefix' => '電力_プラン_東北',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['オクトパスエナジー', 'TERASELでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['オクトパスエナジー', 'TERASELでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
        ]
    ],
    'hokuriku' => [
        'area_name' => '北陸', 'comparison_target' => '北陸電力', 'shortcode_prefix' => '電力_プラン_北陸',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['オクトパスエナジー', 'ENEOSでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
        ]
    ],
    'kanto' => [
        'area_name' => '関東', 'comparison_target' => '東京電力', 'shortcode_prefix' => '電力_プラン_関東',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['オクトパスエナジー', 'TERASELでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
        ]
    ],
    'chubu' => [
        'area_name' => '中部', 'comparison_target' => '中部電力', 'shortcode_prefix' => '電力_プラン_中部',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['オクトパスエナジー', 'ENEOSでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['オクトパスエナジー', 'ENEOSでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
        ]
    ],
    'kansai' => [
        'area_name' => '関西', 'comparison_target' => '関西電力', 'shortcode_prefix' => '電力_プラン_関西',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['オクトパスエナジー', 'ENEOSでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['オクトパスエナジー', 'ENEOSでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
        ]
    ],
    'chugoku' => [
        'area_name' => '中国', 'comparison_target' => '中国電力', 'shortcode_prefix' => '電力_プラン_中国',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['TERASELでんき', 'エネワンでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['TERASELでんき', 'エネワンでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['TERASELでんき', 'エネワンでんき'] ],
        ]
    ],
    'shikoku' => [
        'area_name' => '四国', 'comparison_target' => '四国電力', 'shortcode_prefix' => '電力_プラン_四国',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['Looopでんき', 'TERASELでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
        ]
    ],
    'kyushu' => [
        'area_name' => '九州', 'comparison_target' => '九州電力', 'shortcode_prefix' => '電力_プラン_九州',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['オクトパスエナジー', 'TERASELでんき'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['オクトパスエナジー', 'TERASELでんき'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['オクトパスエナジー', 'TERASELでんき'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['オクトパスエナジー', 'Looopでんき'] ],
        ]
    ],
    'okinawa' => [
        'area_name' => '沖縄', 'comparison_target' => '沖縄電力', 'shortcode_prefix' => '電力_プラン_沖縄',
        'households' => [
            '1' => [ 'household_type_suffix' => '一人暮らし', 'plan_keys' => ['シン・エナジー'] ],
            '2' => [ 'household_type_suffix' => '2人暮らし', 'plan_keys' => ['シン・エナジー'] ],
            '3' => [ 'household_type_suffix' => '3人暮らし', 'plan_keys' => ['シン・エナジー'] ],
            '4' => [ 'household_type_suffix' => '4人暮らし', 'plan_keys' => ['シン・エナジー'] ],
        ]
    ],
];

// --- 3. ビュー関数 (診断結果HTML生成) ---

if (!function_exists('render_diagnostic_result_html')) {
    function render_diagnostic_result_html($region_key, $region_data, $household, $company_master) {
        $household_map = [ '1' => '1人', '2' => '2人', '3' => '3人', '4' => '4人' ];
        $household_text = $household_map[$household] ?? $household . '人';
        $comparison_target = esc_html($region_data['comparison_target']);
        $area_name = esc_html($region_data['area_name']);
        $household_data = $region_data['households'][$household];
        $shortcode_prefix = $region_data['shortcode_prefix'];
        $household_suffix = $household_data['household_type_suffix'];

        // plan_keys の1番目(index 0)を1位のおすすめとする
        $plan_keys = $household_data['plan_keys'];
        // 配列の値がそのまま会社名(キー)になっている
        $recommend_name = isset($plan_keys[0]) ? $plan_keys[0] : null;
        $recommend_company = ($recommend_name && isset($company_master[$recommend_name])) ? $company_master[$recommend_name] : null;
        
        // 2番目(index 1)を次のおすすめとする
        $second_name = isset($plan_keys[1]) ? $plan_keys[1] : null;
        $second_company = ($second_name && isset($company_master[$second_name])) ? $company_master[$second_name] : null;

        if (!$recommend_company) { echo '<p>おすすめプランが見つかりませんでした。</p>'; return; }

        $usage_type_name = ($region_key === 'hokkaido') ? '北海道' : '共通';

        // ショートコード生成ヘルパー
        $gen_sc = function($comp_sc_name, $suffix_type) use ($shortcode_prefix, $household_suffix) {
            return sprintf('[%s type="%s_%s%s"]', $shortcode_prefix, $comp_sc_name, $household_suffix, $suffix_type);
        };
        $gen_data_sc = function($comp_sc_name, $type_suffix) {
            return do_shortcode(sprintf('[電力_データ type="%s_%s"]', $comp_sc_name, $type_suffix));
        };
        $gen_link_url = function($comp_sc_name) {
            return do_shortcode(sprintf('[電力_データ type="%s_リンク"]', $comp_sc_name));
        };
        $gen_site_text = function($comp_sc_name) {
            return do_shortcode(sprintf('[電力_データ type="%s_公式サイト"]', $comp_sc_name));
        };

        $rec_sc_name = $recommend_company['shortcode_name'];
        $rec_name = $recommend_name; // 会社名そのまま
        $rec_link = $gen_link_url($rec_sc_name);
        $rec_site_text = $gen_site_text($rec_sc_name);

        // 2位がある場合のみ設定
        if ($second_company) {
            $sec_sc_name = $second_company['shortcode_name'];
            $sec_name = $second_name; // 会社名そのまま
            $sec_link = $gen_link_url($sec_sc_name);
            $sec_site_text = $gen_site_text($sec_sc_name);
        }

        ?>
        <!-- ★修正: 外側の #diagnostic-tool ラッパーを削除し、中身だけを出力する -->
            
            <!-- ★追加: 結果画面用のヘッダーボックス -->
            <!-- ★修正: クラス化 (インラインスタイル削除) -->
            <div class="diag-main-header-box">
                <div class="diag-header-box-title">シミュレーション結果</div>
            </div>

            <!-- ヘッダー -->
            <div class="diag-center diag-mb-s">
                <p><?php echo esc_html($household_text); ?>で暮らしているあなたが<br><?php echo $comparison_target; ?>から切り替えるなら…</p>
            </div>

            <!-- 1位の会社メイン -->
            <div class="diag-center diag-mb-l">
                <!-- ★変更: クラス統一 (diag-catch-copy-wrap) -->
                <div class="diag-catch-copy-wrap"><span class="swl-format-1"><?php echo $gen_data_sc($rec_sc_name, 'キャッチコピー'); ?></span></div>
                <div class="diag-center diag-mb-s diag-logo-wrap"><?php echo $gen_data_sc($rec_sc_name, 'ロゴ'); ?></div>
                <!-- ★修正: クラス化 -->
                <div class="diag-recommend-msg"><span class="swl-format-1"><?php echo $gen_data_sc($rec_sc_name, 'おすすめプラン'); ?>が一番おすすめ！</span></div>
            </div>

            <!-- 1位: 2カラム (縦積み) -->
            <!-- ★変更: クラス名を diag-grid-2col から diag-layout-vertical に変更 -->
            <div class="diag-layout-vertical diag-mb-l">

                <!-- ★修正: 1位の金額表示をテーブルからdivカード形式に変更 -->
                <!-- ★修正: テーブルと注釈をラッパー(div)で囲み、gapの影響を回避 -->
                <div>
                    <div class="diag-price-section"> <!-- ラッパー追加 -->
                        
                        <!-- ★修正: 枠付きテーブル風レイアウト -->
                        <div class="diag-price-summary-box">
                            <!-- ★追加: テーブル内にタイトル行を追加 -->
                            <div class="diag-price-box-title">
                                <?php echo esc_html($household_text); ?>暮らしの電気料金シミュレーション
                                <!-- ★変更: ここにあった注釈を削除 -->
                            </div>

                            <!-- ヘッダー行 -->
                            <div class="diag-price-header">
                                <div class="diag-price-header-col">[電力_その他 type="更新_最新月"]の電気代</div>
                                <div class="diag-price-header-col">1年間の電気代</div>
                            </div>
                            
                            <!-- データボディ行 -->
                            <div class="diag-price-body">
                                <!-- 左カラム：月額 -->
                                <div class="diag-price-col">
                                    <div class="diag-price-row-main">
                                        <span class="diag-price-val swl-format-1"><?php echo do_shortcode($gen_sc($rec_sc_name, '更新月')); ?></span>
                                    </div>
                                    <div class="diag-price-row-sub">
                                        <?php echo $comparison_target; ?>より<br>
                                        <span class="diag-price-label-black">月</span> <span class="diag-price-diff-val"><?php echo do_shortcode($gen_sc($rec_sc_name, '差額更新月')); ?></span>
                                    </div>
                                </div>

                                <!-- 右カラム：年額 -->
                                <div class="diag-price-col">
                                    <div class="diag-price-row-main">
                                        <span class="diag-price-val swl-format-1"><?php echo do_shortcode($gen_sc($rec_sc_name, '年間')); ?></span>
                                    </div>
                                    <div class="diag-price-row-sub">
                                        <?php echo $comparison_target; ?>より<br>
                                        <span class="diag-price-label-black">年</span> <span class="diag-price-diff-val"><?php echo do_shortcode($gen_sc($rec_sc_name, '年間差額')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ★追加: 注釈を白背景エリア(.diag-price-section)の外に移動 -->
                    <div class="diag-price-note-bottom">
                        <small>※シミュレーション条件は<a href="#price-simulation-conditions">こちら</a></small>
                    </div>
                </div>

                <!-- 左：特徴リスト -->
                <div class="diag-features-box">
                    <div class="diag-features-header"><?php echo esc_html($rec_name); ?>の特徴</div>
                    <!-- ★修正: div箱を削除し、ulだけのシンプルな構造に戻す -->
                    <ul class="diag-features-list">
                        <li><?php echo $gen_data_sc($rec_sc_name, '特徴1'); ?></li>
                        <li><?php echo $gen_data_sc($rec_sc_name, '特徴2'); ?></li>
                        <li><?php echo $gen_data_sc($rec_sc_name, '特徴3'); ?></li>
                    </ul>
                </div>

                <!-- 右：キャンペーン & 申し込みボタン -->
                <div class="diag-right-column">
                    <!-- 上段：キャンペーン -->
                    <?php 
                    // ★追加: キャンペーンが「有り」の場合のみ表示する条件分岐
                    if (isset($recommend_company['has_campaign']) && $recommend_company['has_campaign'] === '有り') : 
                    ?>
                        <div class="diag-campaign-box">
                            <div class="diag-campaign-title">[電力_その他 type="更新_日付"]現在のキャンペーン</div>
                            <div class="diag-mb-s">
                                <span class="swl-format-1">[電力_CP type="<?php echo esc_attr($rec_sc_name); ?>_新規"]</span>
                            </div>
                            <div class="diag-mb-m">
                                <!-- ★修正: 「まで」を削除 -->
                                <small class="mininote">（[電力_CP type="<?php echo esc_attr($rec_sc_name); ?>_新規_日付"]）</small>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 下段：申し込みボタン (元エネピの場所) -->
                    <div class="diag-application-btn-area">
                        <!-- キャッチコピー -->
                        <!-- ★変更: クラス統一 (diag-catch-copy-wrap) -->
                        <div class="diag-catch-copy-wrap">
                            <span class="swl-format-1"><?php echo $gen_data_sc($rec_sc_name, 'キャッチコピー'); ?></span>
                        </div>
                        <!-- ボタン -->
                        <div class="swell-block-button blue_ is-style-btn_solid u-mb-ctrl u-mb-10" data-id="157f0b48">
                            <a href="<?php echo esc_url($rec_link); ?>" target="_blank" rel="noopener noreferrer nofollow" class="swell-block-button__link" data-has-icon="1">
                                <!-- ★修正: ボタン文言変更 -->
                                <span><?php echo esc_html($rec_name); ?>の詳細をみる</span>
                                <svg class="__icon -right" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 48 48"><path d="m33 25.1-13.1 13c-.8.8-2 .8-2.8 0-.8-.8-.8-2 0-2.8L28.4 24 17.1 12.7c-.8-.8-.8-2 0-2.8.8-.8 2-.8 2.8 0l13.1 13c.6.6.6 1.6 0 2.2z"></path></svg>
                            </a>
                        </div>
                        <div class="diag-official-link-wrap">
                            <small class="mininote">公式サイト : <a href="<?php echo esc_url($rec_link); ?>" target="_blank"><?php echo $rec_site_text; ?></a></small>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
            // ★追加: 2位が存在する場合のみ表示するブロック
            if ($second_company) : 
            ?>
                <!-- ★修正: 2位全体を囲むラッパー (枠なし・背景あり) -->
                <div class="diag-second-rank-area">
                    
                    <!-- 2位へのつなぎ文言 (吹き出しスタイル) -->
                    <!-- ★修正: 2位エリアの中に移動 -->
                    <div class="diag-speech-wrap">
                        <div class="diag-speech-bubble">
                            次におすすめなのは<span class="swl-format-3"><?php echo esc_html($sec_name); ?></span>です。<br>
                            こちらも<?php echo esc_html($rec_name); ?>と同じくお得なので、気に入った方で大丈夫です。<br>
                            どちらも年間 <span class="swl-format-2"><?php echo do_shortcode($gen_sc($rec_sc_name, '年間差額')); ?>～<?php echo do_shortcode($gen_sc($sec_sc_name, '年間差額')); ?></span> 安くなります。
                        </div>
                        <div class="diag-speech-person">
                            <div class="diag-speech-icon">
                                <img src="https://starcraft-n.co.jp/erisgood/wp-content/uploads/2025/06/img_enepi-interview_icon2-1.webp" alt="エリスグッド エネルギー担当 編集部かわばたの顔">
                            </div>
                            <div class="diag-speech-name">編集部<br>かわばた</div> <!-- ★修正: 改行を追加 -->
                        </div>
                    </div>
                    
                    <!-- 2位ロゴエリア -->
                    <div class="diag-sec-logo">
                        <!-- ★変更: クラス統一 (diag-catch-copy-wrap) -->
                        <div class="diag-catch-copy-wrap"><span class="swl-format-1"><?php echo $gen_data_sc($sec_sc_name, 'キャッチコピー'); ?></span></div>
                        <div class="diag-center diag-mb-s diag-logo-wrap"><?php echo $gen_data_sc($sec_sc_name, 'ロゴ'); ?></div>
                        <div><span class="swl-format-1"><?php echo $gen_data_sc($sec_sc_name, 'おすすめプラン'); ?>もおすすめ！</span></div>
                    </div>

                    <!-- ★変更: 2位は diag-grid-2col を使用するが、HTML構造をフラットに変更 -->
                    <div class="diag-grid-2col">
                        <!-- 左：金額シミュレーション (カスタムレイアウト) -->
                        <!-- ★修正: Wrapper divを追加してGridアイテムをまとめる -->
                        <div>
                            <div class="diag-price-section"> <!-- ラッパー追加 -->
                                
                                <div class="diag-price-summary-box">
                                    <!-- ★追加: テーブル内にタイトル行を追加 -->
                                    <div class="diag-price-box-title">
                                        <?php echo esc_html($household_text); ?>暮らしの電気料金シミュレーション
                                        <!-- ★変更: ここにあった注釈を削除 -->
                                    </div>

                                    <!-- ヘッダー行 -->
                                    <div class="diag-price-header">
                                        <div class="diag-price-header-col">[電力_その他 type="更新_最新月"]の電気代</div>
                                        <div class="diag-price-header-col">1年間の電気代</div>
                                    </div>
                                    
                                    <!-- データボディ行 -->
                                    <div class="diag-price-body">
                                        <!-- 左カラム：月額 -->
                                        <div class="diag-price-col">
                                            <div class="diag-price-row-main">
                                                <span class="diag-price-val swl-format-1"><?php echo do_shortcode($gen_sc($sec_sc_name, '更新月')); ?></span>
                                            </div>
                                            <div class="diag-price-row-sub">
                                                <?php echo $comparison_target; ?>より<br>
                                                <span class="diag-price-label-black">月</span> <span class="diag-price-diff-val"><?php echo do_shortcode($gen_sc($sec_sc_name, '差額更新月')); ?></span>
                                            </div>
                                        </div>

                                        <!-- 右カラム：年額 -->
                                        <div class="diag-price-col">
                                            <div class="diag-price-row-main">
                                                <span class="diag-price-val swl-format-1"><?php echo do_shortcode($gen_sc($sec_sc_name, '年間')); ?></span>
                                            </div>
                                            <div class="diag-price-row-sub">
                                                <?php echo $comparison_target; ?>より<br>
                                                <span class="diag-price-label-black">年</span> <span class="diag-price-diff-val"><?php echo do_shortcode($gen_sc($sec_sc_name, '年間差額')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ★追加: 注釈を白背景エリア(.diag-price-section)の外に移動 -->
                            <div class="diag-price-note-bottom">
                                <small>※シミュレーション条件は<a href="#price-simulation-conditions">こちら</a></small>
                            </div>
                        </div>

                        <!-- ★変更: 特徴リストとボタンを diag-right-column から出して並列配置 -->
                        <!-- 特徴リスト -->
                        <div class="diag-sec-features">
                            <div class="diag-sec-features-title"><?php echo esc_html($sec_name); ?>の特徴</div>
                            <ul class="diag-sec-features-list">
                                <li><?php echo $gen_data_sc($sec_sc_name, '特徴1'); ?></li>
                                <li><?php echo $gen_data_sc($sec_sc_name, '特徴2'); ?></li>
                                <li><?php echo $gen_data_sc($sec_sc_name, '特徴3'); ?></li>
                            </ul>
                        </div>
                        
                        <!-- 申し込みボタン -->
                        <div class="diag-application-btn-area">
                            <!-- キャッチコピー -->
                            <!-- ★変更: クラス統一 (diag-catch-copy-wrap) -->
                            <div class="diag-catch-copy-wrap">
                                <span class="swl-format-1"><?php echo $gen_data_sc($sec_sc_name, 'キャッチコピー'); ?></span>
                            </div>
                            <!-- ボタン -->
                            <div class="swell-block-button blue_ is-style-btn_solid u-mb-ctrl u-mb-10" data-id="157f0b48">
                                <a href="<?php echo esc_url($sec_link); ?>" target="_blank" rel="noopener noreferrer nofollow" class="swell-block-button__link" data-has-icon="1">
                                    <!-- ★修正: ボタン文言変更 -->
                                    <span><?php echo esc_html($sec_name); ?>の詳細をみる</span>
                                    <svg class="__icon -right" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 48 48"><path d="m33 25.1-13.1 13c-.8.8-2 .8-2.8 0-.8-.8-.8-2 0-2.8L28.4 24 17.1 12.7c-.8-.8-.8-2 0-2.8.8-.8 2-.8 2.8 0l13.1 13c.6.6.6 1.6 0 2.2z"></path></svg>
                                </a>
                            </div>
                            <div class="diag-official-link-wrap">
                                <small class="mininote">公式サイト : <a href="<?php echo esc_url($sec_link); ?>" target="_blank"><?php echo $sec_site_text; ?></a></small>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; // 2位表示終了 ?>

            <!-- 詳細条件アコーディオン -->
            <details class="diag-accordion" id="price-simulation-conditions">
                <!-- ★修正: smallタグを削除（CSSでサイズ制御） -->
                <summary>
                    ※ <?php echo $comparison_target; ?>エリアで各社同条件で電気料金シミュレーションを行った場合。<br>くわしい比較条件はこちらをクリック。
                </summary>
                <div class="diag-accordion-content">
                    <ul>
                        <li>契約アンペアは1～3人暮らしが「30A」、4人暮らしが「40A」で試算しています。</li>
                        <li>各社、[最新の年][電力_その他 type="更新_最新月"]時点で<?php echo $comparison_target; ?>エリアの料金プランで試算しています。</li>
                        <li>各社、[電力_その他 type="更新_最新月"]のシミュレーション料金は更新日時点で公表されている最新の燃料費調整等単価（独自燃調）や<a href="https://www.jepx.jp/electricpower/market-data/spot/ave_month.html" target="_blank" rel="noreferrer noopener">エリアプライス価格</a>で試算しています。</li>
                        <li>各社、年間のシミュレーション料金は[電力_その他 type="更新_シミュ期間"]の燃料費調整等単価（独自燃調）や固定単価＋<a href="https://www.jepx.jp/electricpower/market-data/spot/ave_month.html" target="_blank" rel="noreferrer noopener">[電力_その他 type="更新_シミュ期間"]の月平均のエリアプライス価格（<?php echo $area_name; ?>）</a>で試算しています。</li>
                        <li>消費税を含みます。</li>
                        <li><strong>政府が実施する割引、再生可能エネルギー発電促進賦課金（再エネ賦課金）は含みません</strong>。</li>
                        <li>世帯別料金シミュレーションで用いた[電力_その他 type="更新_最新月"]の電気使用量の詳細は、以下の表の通りです。</li>
                    </ul>
                    
                    <!-- ★修正: インラインスタイルを削除しCSSクラス適用 -->
                    <figure class="diag-center diag-accordion-figure">
                        <table class="diag-accordion-table">
                            <thead>
                                <tr><th>世帯人数</th><th>シミュレーションに用いた<br class="br-sp">[電力_その他 type="更新_最新月"]電気使用量<small class="mininote">※</small></th></tr>
                            </thead>
                            <tbody>
                                <!-- ★修正: br-spクラスを使ってスマホのみ改行 -->
                                <tr><th>1人暮らし<br class="br-sp">（集合住宅）</th><td>[電力_その他 type="更新_<?php echo $usage_type_name; ?>一人暮らし更新月"]</td></tr>
                                <tr><th>2人暮らし<br class="br-sp">（集合住宅）</th><td>[電力_その他 type="更新_<?php echo $usage_type_name; ?>2人暮らし更新月"]</td></tr>
                                <tr><th>3人暮らし<br class="br-sp">（戸建）</th><td>[電力_その他 type="更新_<?php echo $usage_type_name; ?>3人暮らし更新月"]</td></tr>
                                <tr><th>4人暮らし<br class="br-sp">（戸建）</th><td>[電力_その他 type="更新_<?php echo $usage_type_name; ?>4人暮らし更新月"]</td></tr>
                            </tbody>
                        </table>
                        <!-- ★修正: インラインスタイルを削除しCSSクラス適用 -->
                        <figcaption class="diag-accordion-caption">
                            <small class="mininote">※参考：<a href="https://www.kankyo.metro.tokyo.lg.jp/documents/d/kankyo/home-energy-files-syouhidoukouzittaityousa26honpen_3" target="_blank" rel="noreferrer noopener">東京都家庭のエネルギー消費動向実態調査</a>　p.12<br>
                            ※上記の資料から「年間電気使用量（平均）」を引用し、<a href="https://www.tepco.co.jp/corporateinfo/illustrated/power-demand/peak-demand-monthly-j.html" target="_blank" rel="noreferrer noopener">東京電力が提供する月別最大電力</a>の比率を用いて12か月分に振り分けて試算しています。</small>
                        </figcaption>
                    </figure>

                    <ul>
                        <li>世帯別料金シミュレーションで用いた年間電気使用量の詳細は、以下の表の通りです。</li>
                    </ul>

                    <!-- ★修正: インラインスタイルを削除しCSSクラス適用 -->
                    <figure class="diag-center diag-accordion-figure">
                        <table class="diag-accordion-table">
                            <thead>
                                <tr><th>世帯人数</th><th>シミュレーションに用いた<br class="br-sp">年間電気使用量<small class="mininote">※</small></th></tr>
                            </thead>
                            <tbody>
                                <!-- ★修正: br-spクラスを使ってスマホのみ改行 -->
                                <tr><th>1人暮らし<br class="br-sp">（集合住宅）</th><td>2,232kWh</td></tr>
                                <tr><th>2人暮らし<br class="br-sp">（集合住宅）</th><td>3,264kWh</td></tr>
                                <tr><th>3人暮らし<br class="br-sp">（戸建）</th><td>4,632kWh</td></tr>
                                <tr><th>4人暮らし<br class="br-sp">（戸建）</th><td>5,232kWh</td></tr>
                            </tbody>
                        </table>
                        <!-- ★修正: インラインスタイルを削除しCSSクラス適用 -->
                        <figcaption class="diag-accordion-caption">
                            <small class="mininote">※参考：<a href="https://www.kankyo.metro.tokyo.lg.jp/documents/d/kankyo/home-energy-files-syouhidoukouzittaityousa26honpen_3" target="_blank" rel="noreferrer noopener">東京都家庭のエネルギー消費動向実態調査</a>　p.12<br>
                            ※上記の資料から「年間電気使用量（平均）」を引用し、<a href="https://www.tepco.co.jp/corporateinfo/illustrated/power-demand/peak-demand-monthly-j.html" target="_blank" rel="noreferrer noopener">東京電力が提供する月別最大電力</a>の比率を用いて12か月分に振り分けて試算しています。</small>
                        </figcaption>
                    </figure>
                </div>
            </details>
        <?php
    }
}

// --- 4. メイン分岐 (Post Snippet実行時) ---
global $erisgood_diagnostic_vars, $diagnostic_company_master, $diagnostic_plan_data;

// API経由などで変数($erisgood_diagnostic_vars)がセットされていれば「結果表示モード」
$is_result_mode = false;
if (isset($erisgood_diagnostic_vars) && is_array($erisgood_diagnostic_vars)) {
    $region = $erisgood_diagnostic_vars['region'] ?? 'default';
    $household = $erisgood_diagnostic_vars['household'] ?? '0';
    
    // データが存在するか確認
    if (isset($diagnostic_plan_data[$region]) && isset($diagnostic_plan_data[$region]['households'][$household])) {
        $is_result_mode = true;
    }
}

if ($is_result_mode) {
    // --- 【A】結果表示モード ---
    render_diagnostic_result_html($region, $diagnostic_plan_data[$region], $household, $diagnostic_company_master);

} else {
    // --- 【B】フォーム表示モード (デフォルト) ---
    // 記事に [電力_診断ツール] と書かれた場合はこちらが実行され、フォームが表示されます。
    // ※ Post Snippet自体がショートコード機能を持つため、add_shortcodeは不要です。
    ?>
    <!-- 電力プラン診断ツール本体 -->
    <div id="diagnostic-tool">
    
        <!-- ========== 【パターンA：1画面スクロール形式 (有効)】 ========== -->
        <div id="screen-scroll-questions" class="diagnostic-screen active"> <!-- Q1,Q2をまとめるコンテナ -->
            <!-- ★追加: ヘッダーボックス -->
            <div class="diag-main-header-box">
                <div class="diag-header-catch">個人情報入力不要！<br>2問答えるだけですぐわかる</div>
                <div class="diag-header-main">電気料金シミュレーション</div>
            </div>
            
            <!-- Q1: 地域選択 -->
            <div class="diag-question-group" id="group-region">
                <p class="diag-question">Q1. お住まいの地域はどこですか？</p>
                <div class="diag-grid-regions">
                    <button class="choice-button region-choice" data-value="hokkaido">北海道</button>
                    <button class="choice-button region-choice" data-value="tohoku">東北</button>
                    <button class="choice-button region-choice" data-value="hokuriku">北陸</button>
                    <button class="choice-button region-choice" data-value="kanto">関東</button>
                    <button class="choice-button region-choice" data-value="chubu">中部</button>
                    <button class="choice-button region-choice" data-value="kansai">関西</button>
                    <button class="choice-button region-choice" data-value="chugoku">中国</button>
                    <button class="choice-button region-choice" data-value="shikoku">四国</button>
                    <button class="choice-button region-choice" data-value="kyushu">九州</button>
                    <button class="choice-button region-choice" data-value="okinawa">沖縄</button>
                </div>
            </div>

            <!-- Q2: 人数選択 -->
            <div class="diag-question-group" id="group-household">
                <p class="diag-question">Q2.一緒に住んでる人は何人ですか？</p>
                <div class="diag-grid-households">
                    <button class="choice-button household-choice btn-household" data-value="1">1人</button>
                    <button class="choice-button household-choice btn-household" data-value="2">2人</button>
                    <button class="choice-button household-choice btn-household" data-value="3">3人</button>
                    <button class="choice-button household-choice btn-household" data-value="4">4人以上</button>
                </div>
            </div>
        </div>
        
        <!-- ========== 【パターンB：2画面遷移形式 (コメントアウト中)】 ========== -->
        <!--
        <div id="screen-region" class="diagnostic-screen active">
            <div class="diag-main-header-box">
                <div class="diag-header-catch">個人情報入力不要！<br>2問答えるだけですぐわかる</div>
                <div class="diag-header-main">電気料金シミュレーション</div>
            </div>
            
            <p class="diag-question">Q1. お住まいの地域はどこですか？</p>

            <div class="diag-grid-regions">
                <button class="choice-button region-choice" data-value="hokkaido">北海道</button>
                <button class="choice-button region-choice" data-value="tohoku">東北</button>
                <button class="choice-button region-choice" data-value="hokuriku">北陸</button>
                <button class="choice-button region-choice" data-value="kanto">関東</button>
                <button class="choice-button region-choice" data-value="chubu">中部</button>
                <button class="choice-button region-choice" data-value="kansai">関西</button>
                <button class="choice-button region-choice" data-value="chugoku">中国</button>
                <button class="choice-button region-choice" data-value="shikoku">四国</button>
                <button class="choice-button region-choice" data-value="kyushu">九州</button>
                <button class="choice-button region-choice" data-value="okinawa">沖縄</button>
            </div>
        </div>

        <div id="screen-household" class="diagnostic-screen">
            <div class="diag-main-header-box">
                <div class="diag-header-catch">個人情報入力不要！<br>2問答えるだけですぐわかる</div>
                <div class="diag-header-main">電気料金シミュレーション</div>
            </div>

            <p class="diag-question">Q2.一緒に住んでる人は何人ですか？</p>

            <div class="diag-grid-households">
                <button class="choice-button household-choice btn-household" data-value="1">1人</button>
                <button class="choice-button household-choice btn-household" data-value="2">2人</button>
                <button class="choice-button household-choice btn-household" data-value="3">3人</button>
                <button class="choice-button household-choice btn-household" data-value="4">4人以上</button>
            </div>
            
            <button id="prev-btn-1" class="diag-btn-prev">←前の質問にもどる</button>
        </div>
        -->

        <!-- ステップ 3: 結果画面 -->
        <div id="screen-result" class="diagnostic-screen">
            <div class="diag-text-center">
                <!-- PHPで生成されたHTMLがここに入ります -->
                <div id="result-content">
                    <div id="result-loader" class="loading-area">
                        <div class="diagnostic-spinner"></div>
                    </div>
                </div>
                <button id="restart-btn" class="diag-btn-restart">もう一度診断する</button>
            </div>
        </div>
    </div>
    <?php
}
?>