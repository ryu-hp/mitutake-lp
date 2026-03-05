<?php
/**
 * Theme Name: 光武商事法人用LP
 * Description: 光武商事株式会社の法人用ページテーマ
 * Version: 1.0.0
 * Author: 光武商事株式会社
 */

// テーマのセットアップ
function mitutake_theme_setup() {
    // タイトルタグのサポート
    add_theme_support('title-tag');
    
    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');
    
    // HTML5サポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // カスタムロゴのサポート
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // ナビゲーションメニューの登録
    register_nav_menus(array(
        'primary' => 'メインメニュー',
        'footer'  => 'フッターメニュー',
    ));
}
add_action('after_setup_theme', 'mitutake_theme_setup');

// スタイルシートとスクリプトのエンキュー
function mitutake_enqueue_assets() {
    $version = '20270126-0735'; // キャッシュバスティング用
    
    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Poppins:wght@700;800&display=swap',
        array(),
        null
    );
    
    // メインスタイルシート
    wp_enqueue_style(
        'mitutake-style',
        get_template_directory_uri() . '/css/style.css',
        array(),
        $version
    );
    
    // カスタムスクリプト
    wp_enqueue_script(
        'mitutake-script',
        get_template_directory_uri() . '/js/script.js',
        array(),
        $version,
        true
    );
}
add_action('wp_enqueue_scripts', 'mitutake_enqueue_assets');

// ウィジェットエリアの登録
function mitutake_widgets_init() {
    // サイドバーウィジェット
    register_sidebar(array(
        'name'          => 'サイドバー',
        'id'            => 'sidebar-1',
        'description'   => 'サイドバーに表示されるウィジェット',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // フッターウィジェット
    register_sidebar(array(
        'name'          => 'フッター',
        'id'            => 'footer-1',
        'description'   => 'フッターに表示されるウィジェット',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'mitutake_widgets_init');


// 抜粋文字数のカスタマイズ
function mitutake_excerpt_length($length) {
    return 80;
}
add_filter('excerpt_length', 'mitutake_excerpt_length');

// 抜粋の省略記号をカスタマイズ
function mitutake_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'mitutake_excerpt_more');

// セキュリティ: WordPressバージョンを非表示
remove_action('wp_head', 'wp_generator');

// 管理画面でのメディアファイルのSVGサポート
function mitutake_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'mitutake_mime_types');

// SVGファイルのプレビュー表示修正
function mitutake_fix_svg_thumb_display() {
    echo '<style>
        td.media-icon img[src$=".svg"] { 
            width: 100% !important; 
            height: auto !important; 
        }
    </style>';
}
add_action('admin_head', 'mitutake_fix_svg_thumb_display');

// カスタムフィールドの設定（事例投稿用）
function mitutake_add_case_meta_boxes() {
    add_meta_box(
        'case_details',
        '事例詳細',
        'mitutake_case_details_callback',
        'case',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'mitutake_add_case_meta_boxes');

// 事例詳細のメタボックスコールバック
function mitutake_case_details_callback($post) {
    wp_nonce_field('mitutake_save_case_details', 'mitutake_case_details_nonce');
    
    $concern = get_post_meta($post->ID, '_case_concern', true);
    $result = get_post_meta($post->ID, '_case_result', true);
    ?>
    <p>
        <label for="case_concern"><strong>疑念・課題:</strong></label><br>
        <textarea id="case_concern" name="case_concern" rows="4" style="width:100%;"><?php echo esc_textarea($concern); ?></textarea>
    </p>
    <p>
        <label for="case_result"><strong>調査結果:</strong></label><br>
        <textarea id="case_result" name="case_result" rows="4" style="width:100%;"><?php echo esc_textarea($result); ?></textarea>
    </p>
    <?php
}

// 事例詳細の保存
function mitutake_save_case_details($post_id) {
    // nonceの検証
    if (!isset($_POST['mitutake_case_details_nonce']) || 
        !wp_verify_nonce($_POST['mitutake_case_details_nonce'], 'mitutake_save_case_details')) {
        return;
    }
    
    // 自動保存の場合は処理しない
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // 権限チェック
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // データの保存
    if (isset($_POST['case_concern'])) {
        update_post_meta($post_id, '_case_concern', sanitize_textarea_field($_POST['case_concern']));
    }
    
    if (isset($_POST['case_result'])) {
        update_post_meta($post_id, '_case_result', sanitize_textarea_field($_POST['case_result']));
    }
}
add_action('save_post_case', 'mitutake_save_case_details');

// Contact Form 7用のショートコード（必要に応じて）
// お問い合わせフォームの設定は、Contact Form 7プラグインをインストール後に使用

// ページネーション
function mitutake_pagination() {
    global $wp_query;
    
    $big = 999999999;
    
    echo paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '&laquo; 前へ',
        'next_text' => '次へ &raquo;',
    ));
}

// 管理画面のカスタマイズ
function mitutake_admin_custom_styles() {
    echo '<style>
        /* 管理画面のカスタムスタイル */
        #adminmenu .dashicons-portfolio:before {
            color: #0073aa;
        }
    </style>';
}
add_action('admin_head', 'mitutake_admin_custom_styles');

// カスタマイザーの設定
function mitutake_customize_register($wp_customize) {
    // 会社情報セクション
    $wp_customize->add_section('mitutake_company_info', array(
        'title'    => '会社情報',
        'priority' => 30,
    ));
    
    // 電話番号
    $wp_customize->add_setting('company_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('company_phone', array(
        'label'   => '電話番号',
        'section' => 'mitutake_company_info',
        'type'    => 'text',
    ));
    
    // メールアドレス
    $wp_customize->add_setting('company_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('company_email', array(
        'label'   => 'メールアドレス',
        'section' => 'mitutake_company_info',
        'type'    => 'email',
    ));
    
    // 住所
    $wp_customize->add_setting('company_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('company_address', array(
        'label'   => '住所',
        'section' => 'mitutake_company_info',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'mitutake_customize_register');

// 会社情報を取得する関数
function mitutake_get_company_info($key) {
    return get_theme_mod('company_' . $key, '');
}

// ショートコード: 会社情報表示
function mitutake_company_info_shortcode($atts) {
    $atts = shortcode_atts(array(
        'type' => 'phone', // phone, email, address
    ), $atts);
    
    return mitutake_get_company_info($atts['type']);
}
add_shortcode('company_info', 'mitutake_company_info_shortcode');
