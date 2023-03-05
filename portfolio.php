<?
/*
Template Name: Шаблон для портфолио
Template Post Type: page
*/
?>
<? get_header()?>

  <!-- Page Title================================================== -->
  <div id="page-title">
    <div class="row">
      <? dynamic_sidebar( 'slogan' )?>
    </div>
  </div> <!-- Page Title End-->

  <!-- Content================================================== -->
  <div class="content-outer">
    <div id="page-content" class="row portfolio">
      <section class="entry cf">
        <? if(have_posts()):the_post()?>
        <div id="secondary"  class="four columns entry-details">
          <h1><? the_title()?></h1>
          <? the_content()?>
        </div> <!-- Secondary End-->
        <? endif;?>
        <div id="primary" class="eight columns portfolio-list">
          <div id="portfolio-wrapper" class="bgrid-halves cf">
          		   
            <? $portfolio = new WP_Query(['post_type'=>'portfolio', 'posts_per_page'=>-1])?>
				    <? if($portfolio->have_posts()):while($portfolio->have_posts()):$portfolio->the_post()?>
            <div class="columns portfolio-item">
              <div class="item-wrap">
                <a href="<? the_permalink()?>">
                  <? if(has_post_thumbnail()):the_post_thumbnail(); else:?>
                    <img alt="" src="<?bloginfo('template_url')?>/assets/images/header-bg.jpg">
                  <? endif?>
                  <div class="overlay"></div>
                  <div class="link-icon"><i class="fa fa-link"></i></div>
                </a>
                <div class="portfolio-item-meta">
                  <h5><a href="<? the_permalink()?>"><? the_title()?></a></h5>
                  <?$category = get_the_terms($post->ID, 'portfolio-category');
                  if(is_array($category)):
                    foreach($category as $item):
                      echo "<p>". $item->name ."</p>";
                    endforeach;
                  else:
                    echo "<p>Нет категории</p>";
                  endif;?>
                </div>
              </div>
            </div>
            <? endwhile; endif;?>
          
          </div>
        </div> <!-- primary end-->
      </section> <!-- end section -->
    </div> <!-- #page-content end-->
  </div> <!-- content End-->

<? get_footer()?>