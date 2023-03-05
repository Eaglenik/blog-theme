<? get_header()?>

  <!-- Page Title================================================== -->
  <div id="page-title">
    <div class="row">
      <? dynamic_sidebar( 'slogan' )?>
    </div>
  </div> <!-- Page Title End-->

  <!-- Content ================================================== -->
  <div class="content-outer">
    <? if(have_posts()):the_post();?>
    <div id="page-content" class="row portfolio">
      <section class="entry cf">
        <div id="secondary"  class="four columns entry-details">
          <h1><? the_title()?></h1>
          <div class="entry-description">
            <? the_excerpt()?>
          </div>
          <ul class="portfolio-meta-list">
				    <li><span>Date: </span><? the_time('F Y')?></li>
				    <li><span>Client </span>Styleshout</li>
				    <li><span>Skills: </span>Photoshop, Photography, Branding</li>
				  </ul>
          <a class="button" href="tel:+998912223344">Позвонить</a>
        </div> <!-- secondary End-->
        <div id="primary" class="eight columns">
          <div class="entry-media">
            <? the_post_thumbnail()?>
          </div>
          <div class="entry-excerpt">
				    <? the_content()?>
					</div>
        </div> <!-- primary end-->
      </section> <!-- end section -->

      <ul class="post-nav cf">
			  <li class="prev"><? previous_post_link('%link', '<strong>Previous Entry</strong>%title')?></li>
				<li class="next"><? next_post_link('%link', '<strong>Next Entry</strong>%title')?></li>
			</ul>
    </div>
    <? endif;?>
  </div> <!-- content End-->

<? get_footer()?>