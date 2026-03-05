<?php
/**
 * Template Name: Default Page
 * Description: 固定ページのデフォルトテンプレート
 */

get_header(); ?>

<main class="main">
  <?php while (have_posts()): the_post(); ?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
      
      <?php if (has_post_thumbnail()): ?>
      <section class="section section--page-header">
        <div class="page-header__container">
          <div class="page-header__image">
            <?php the_post_thumbnail('full'); ?>
          </div>
          <div class="page-header__title-wrapper">
            <h1 class="page-header__title"><?php the_title(); ?></h1>
          </div>
        </div>
      </section>
      <?php else: ?>
      <section class="section section--page-header-simple">
        <div class="container">
          <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
      </section>
      <?php endif; ?>
      
      <div class="page-content">
        <div class="page-content__container container">
          <div class="page-content__body">
            <?php the_content(); ?>
            
            <?php
            wp_link_pages(array(
              'before' => '<div class="page-links">' . __('Pages:', 'mitutake'),
              'after'  => '</div>',
            ));
            ?>
          </div>
          
          <?php if (is_active_sidebar('sidebar-1')): ?>
          <aside class="page-content__sidebar">
            <?php dynamic_sidebar('sidebar-1'); ?>
          </aside>
          <?php endif; ?>
        </div>
      </div>
      
    </article>
    
    <?php
    // コメント表示（必要に応じて）
    if (comments_open() || get_comments_number()):
      comments_template();
    endif;
    ?>
    
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
