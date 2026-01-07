<?php
// 電力プラン診断ツール用ロジック

add_action('rest_api_init', 'register_diagnostic_rest_route');

/**
 * 診断ツール用のカスタムREST APIエンドポイントを登録します。
 * ( /wp-json/erisgood-tool/v1/get_result )
 */
function register_diagnostic_rest_route() {
    register_rest_route('erisgood-tool/v1', '/get_result', [
        'methods'             => 'GET',
        'callback'            => 'handle_diagnostic_rest_request',
        'permission_callback' => '__return_true', // 公開エンドポイント
        'args'                => [
            'region' => [
                'required'          => true,
                'validate_callback' => function($param) {
                    return is_string($param);
                },
                'sanitize_callback' => 'sanitize_text_field',
            ],
            'household' => [
                'required'          => true,
                'validate_callback' => function($param) {
                    return is_string($param);
                },
                'sanitize_callback' => 'sanitize_text_field',
            ],
        ],
    ]);
}

/**
 * REST APIリクエストを処理します。
 *
 * @param WP_REST_Request $request RESTリクエストオブジェクト
 */
function handle_diagnostic_rest_request(WP_REST_Request $request) {
    // パラメータをリクエストから取得 (register_rest_route でサニタイズ済み)
    $region = $request->get_param('region');
    $household = $request->get_param('household');

    // グローバル変数に $region と $household を格納します
    // (Post Snippet側で参照するため)
    global $erisgood_diagnostic_vars;
    $erisgood_diagnostic_vars = [
        'region'    => $region,
        'household' => $household,
    ];

    // 実行するショートコードを組み立てる
    // ★ここを変更します
    // Post Snippetの名前（ショートコード名）に合わせて変更してください
    $shortcode_string = '[電力_診断ツール]';

    // ショートコードを実行 (1回目: Post Snippet本体)
    $result_html = do_shortcode($shortcode_string);

    // ショートコードを実行 (2回目: ネストされた [電力_プラン_...] を展開)
    // ※Post Snippet内でdo_shortcodeがネストされたショートコードを展開しない場合があるため
    $result_html = do_shortcode($result_html);

    // HTMLとして結果を返す
    header('Content-Type: text/html; charset=utf-8');
    echo $result_html;
    exit;
}