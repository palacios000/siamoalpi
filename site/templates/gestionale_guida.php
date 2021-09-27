<?php require "inc/guida/head.php" ?>
<body class=''>

	<?php require "inc/guida/menu.php" ?>

		<section class="uk-container ">
			<?php require "inc/guida/bread.php" ?>
		</section>

		<section class="uk-container">

			<!-- usiamo lo stesso template per guida e calendario -->
			<?php if ($page->name == "calendario"){ ?>
				<!-- calendario -->
				<iframe src="https://calendar.google.com/calendar/embed?src=sm2k4pndb28bptgj150874pfe8%40group.calendar.google.com&ctz=Europe%2FRome&bgcolor=%23ffffff" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
				<p>
					Se desideri accedere a questo calendario col tuo account gmail, scrivi a admin@siamoalpi.it.
				</p>
				
			<?php }else{ ?>
				<!-- guida -->
			
				<div class="uk-grid uk-padding-top-small" uk-grid>
					<div class="uk-width-2-3">
						<h1><?php echo $page->title ?></h1>
						<?php echo $page->body ?>
						<hr class="uk-margin-medium">
						<?php
						if (count($page->children)){
							// echo "<ul class='uk-list'>";
							// foreach ($page->children as $child) {
							// 	echo "<li><a>$child->title</a><li>";
							// }
							// echo "</ul>"; uk-list-striped

							//opzione 2
							echo '<dl class="uk-description-list">';
							foreach ($page->children as $child) {
							    echo "<dt><a href='$child->url'>$child->title</a></dt>";
							    echo "<dd>".$sanitizer->text($child->body, ['type' => 'sentence', 'maxLength' => 250, 'more' => '...'] )."</dd>";
							}
							echo '</dl>';


						}else{
							echo $page->comments->renderAll(); 
						}
						?>
					</div>
					<div class="uk-width-1-3">
						<div class="uk-margin-large-left">
							
							<h3>MENU</h3>

							<?php 
							$guidaGestionale = $pages->get(1050);
							$guidaEtnografica = $pages->get(1051) ?>

							<H4><?php echo $guidaGestionale->title ?></H4>
								<ul class="uk-list  uk-list-striped">
									<?php foreach ($guidaGestionale->children as $guida) {
										echo "<li><a href='$guida->url'>$guida->title</a></li>";
									} ?>
								</ul>

							<H4><?php echo $guidaEtnografica->title ?></H4>
								<ul class="uk-list  uk-list-striped">
									<?php foreach ($guidaEtnografica->children as $guida) {
										echo "<li><a href='$guida->url'>$guida->title</a></li>";
									} ?>
								</ul>

						</div>
					</div>
				</div>
			<?php } ?>
		</section>

	
	<?php require "inc/guida/footer.php" ?>

</body>
</html>
