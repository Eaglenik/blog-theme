<? get_header()?>
  <!-- Page Title================================================== -->
  <div id="page-title">
    <div class="row">
      <div class="ten columns centered text-center">
        <h1><? single_cat_title()?></h1>
        <?=category_description()?>
      </div>
    </div>
  </div> <!-- Page Title End-->
  <!-- Content================================================== -->
  <div class="content-outer">
    <div id="page-content" class="row">
      <div id="primary" class="eight columns">
        <? if(have_posts()):while(have_posts()):the_post();?>
          <article class="post">
            <div class="entry-header cf">
              <h1><a href="<? the_permalink()?>" title=""><? the_title()?></a></h1>
              <p class="post-meta">
                <time class="date" datetime="<? the_time('Y-m-d')?>"><? the_time('M d, Y')?></time>/
                <span class="categories">
                  <? the_category('/')?>
                </span>
              </p>
            </div>
            <div class="post-thumb">
              <a href="<? the_permalink()?>" title="">
                <? if(has_post_thumbnail()):the_post_thumbnail(); else:?>
                  <img src="<? bloginfo('template_url')?>/assets/images/header-bg.jpg">
                <? endif;?>
              </a>
            </div>
            <div class="post-content more-none">
              <? the_excerpt()?>
            </div>
          </article> <!-- post end -->
        <? endwhile; endif;?>
        <!-- Pagination -->
        <?
        the_posts_pagination([
          'show_all'     => false, // показаны все страницы участвующие в пагинации
          'end_size'     => 1,     // количество страниц на концах
          'mid_size'     => 1,     // количество страниц вокруг текущей
          'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
          'prev_text'    => __('«'),
          'next_text'    => __('»'),
          'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
          'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
          'screen_reader_text' => __( 'Posts navigation' ),
          'class'        => 'pagination', // CSS класс, добавлено в 5.5.0.
        ])
        ?>
      </div> <!-- Primary End-->
      <div id="secondary" class="four columns end">
        <? get_sidebar()?>
      </div> <!-- Secondary End-->
    </div>
  </div> <!-- Content End-->
<? get_footer()?>