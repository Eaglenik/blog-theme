<? get_header()?>
	<!-- Intro Section================================================== -->
	<section id="intro">
		<!-- Flexslider Start-->
		<div id="intro-slider" class="flexslider">
			<ul class="slides">
				<? $slider = new WP_Query(['post_type'=>'slider', 'posts_per_page'=>-1])?>
				<? if($slider->have_posts()):while($slider->have_posts()):$slider->the_post()?>
				<!-- Slide -->
				<li>
					<div class="row">
						<div class="twelve columns">
							<div class="slider-text">
								<h1><? the_title()?></h1>
								<? the_content()?>
							</div>
							<div class="slider-image">
								<? the_post_thumbnail()?>
							</div>
						</div>
					</div>
				</li>
				<? endwhile; endif;?>
			</ul>
		</div> <!-- Flexslider End-->
	</section> <!-- Intro Section End-->

	<!-- Info Section================================================== -->
	<section id="info">

		<div class="row">

			<div class="bgrid-quarters s-bgrid-halves">

				<div class="columns">
					<h2>Clean & Modern.</h2>

					<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
						Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					</p>
				</div>

				<div class="columns">
					<h2>Responsive.</h2>

					<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
						Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					</p>
				</div>

				<div class="columns s-first">
					<h2>HTML5 + CSS3.</h2>

					<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
						Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					</p>
				</div>

				<div class="columns">
					<h2>Free of Charge.</h2>

					<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
						Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					</p>
				</div>

			</div>

		</div>

	</section> <!-- Info Section End-->

	<!-- Works Section================================================== -->
	<section id="works">
		<div class="row">
			<div class="twelve columns align-center">
				<h1>Some of our recent works.</h1>
			</div>
			<div id="portfolio-wrapper" class="bgrid-quarters s-bgrid-halves">
				<? $portfolio = new WP_Query(['post_type'=>'portfolio', 'posts_per_page'=>4])?>
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
		</div>
	</section> <!-- Works Section End-->

	<!-- Journal Section================================================== -->
	<section id="journal">
		<div class="row">
			<div class="twelve columns align-center">
				<h1>Our latest posts and rants.</h1>
			</div>
		</div>
		<div class="blog-entries">
			<? if(have_posts()):while(have_posts()):the_post();?>
				<!-- Entry -->
				<article class="row entry">
					<div class="entry-header">
						<div class="permalink">
							<a href="<? the_permalink()?>"><i class="fa fa-link"></i></a>
						</div>
						<div class="ten columns entry-title pull-right">
							<h3><a href="<? the_permalink()?>"><? the_title()?></a></h3>
						</div>
						<div class="two columns post-meta end">
							<p>
								<time datetime="<? the_time('Y-m-d')?>" class="post-date" pubdate=""><? the_time('M d, Y')?></time>
								<span class="dauthor">By <? the_author()?></span>
							</p>
						</div>
					</div>
					<div class="ten columns offset-2 post-content">
						<? the_excerpt()?>
					</div>
				</article> <!-- Entry End -->
			<? endwhile; endif;?>
		</div> <!-- Entries End -->

	</section> <!-- Journal Section End-->
<? get_footer()?>