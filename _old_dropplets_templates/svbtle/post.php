<header>
	<h2 class="category <?php echo(substr($post_category_link, strrpos($post_category_link, '/') + 1)); ?>">#<?php echo($post_category); ?></h2>
	<h3><?php echo($published_date); ?></h3>
</header>

<article class="category <?php echo(substr($post_category_link, strrpos($post_category_link, '/') + 1)); ?>">
	<h1><?php echo($post_title); ?></h1>
	<?php /* <p class="italic"><?php echo $entry->teaser; ?></p> */ ?>
	<?php echo($post_content); ?>
</article>

<a href="<?php echo($post_category_link); ?>" class="button_accent <?php echo(substr($post_category_link, strrpos($post_category_link, '/') + 1)); ?>" title="alle Artikel zum Thema «<?php echo($post_category); ?>»">&larr;&nbsp;&nbsp;&nbsp;#<?php echo($post_category); ?></a>
<a href="<?php echo($blog_url); ?>" class="button_accent" title="alle Artikel">&larr;&nbsp;&nbsp;&nbsp;Startseite</a>

<?php /*
<ul class="actions">
	<li><a class="button" href="https://twitter.com/intent/tweet?screen_name=<?php echo($post_author_twitter); ?>&text=Re:%20<?php echo($post_link); ?>%20" data-dnt="true">Comment on Twitter</a></li>
	<li><a class="button" href="https://twitter.com/intent/tweet?text=&quot;<?php echo($post_title); ?>&quot;%20<?php echo($post_link); ?>%20via%20&#64;<?php echo($post_author_twitter); ?>" data-dnt="true">Share on Twitter</a></li>
	<li><a class="button" href="<?php echo($blog_url); ?>">More Articles</a></li>
</ul>
*/ ?>