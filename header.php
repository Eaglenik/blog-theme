<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<!--- Basic Page Needs================================================== -->
	<meta charset="utf-8">
	<!-- Mobile Specific Metas================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<? wp_head()?>
</head>
<body>

	<!-- Header
   ================================================== -->
	<header>
		<div class="row">
			<div class="twelve columns">
				<div class="logo">
					<? the_custom_logo()?>
				</div>
				<nav id="nav-wrap">
					<a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
					<a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>
					<?
					wp_nav_menu([
						'theme-location' => 'header-menu',
						'container' => false,
						'menu_class' => 'nav',
						'menu_id' => 'nav',
					])
					?>
				</nav> <!-- end #nav-wrap -->
			</div>
		</div>
	</header> <!-- Header End -->