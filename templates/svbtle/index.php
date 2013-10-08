<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<title><?php echo($page_title); ?></title>
	<?php echo($page_meta); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Thomas Puppe">
	<link rel="author" href="https://plus.google.com/109992889758306031081/posts"/>
	<link rel="stylesheet" href="<?php echo($template_dir_url); ?>style.css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:800,400,300|Inconsolata" rel="stylesheet" type="text/css">
	<?php /* get_header(); */ ?>
</head>

	<?php if($filename===NULL) { ?>
		<body class="list">
	<?php } else { ?>
		<body class="article">
	<?php } ?>
	
		<section id="sidebar">
			<figure id="user_logo">
				<a href="http://blog.thomaspuppe.de"><div class="logo">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="140px" height="120px" xml:space="preserve">
							<circle cx="70" cy="60" r="50" stroke="black" fill="white" stroke-width="3"></circle>
							<polygon points="87.334,95.568 69.667,84.717 52,95.568 52,24 87.334,24"></polygon>
						</svg>
				</div></a>
			</figure>
			<div class="user_meta">
				<h1 id="user"><a href="http://blog.thomaspuppe.de" class="">Thomas Puppe</a></h1>
				<h2></h2>
				<ul>
					<li><a href="http://twitter.com/thomaspuppe">@thomaspuppe</a></li>
					<li><a href="http://github.com/thomaspuppe">github</a></li>
					<li><a href="http://www.thomaspuppe.de">website</a></li>
					<?php /* <li><a href="http://blog.williamting.com/feeds/all.atom.xml">feed</a></li> */ ?>
				</ul>
			</div>
		</section>
        
		<section id="posts">
			<?php echo($content); ?>
		</section>
        
        <?php /* get_footer(); */ ?>
		
		<footer>
			<address>
				&copy; 2012&ndash;2013 <a href="http://www.thomaspuppe.de">Thomas Puppe</a>. Theme by <a href="https://github.com/wting/pelican-svbtle">wting</a>.
			</address>
		</footer>

	</body>
</html>
