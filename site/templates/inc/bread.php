
	<ul class="uk-breadcrumb" >
		<?php 
		foreach($page->parents()->append($page) as $parent) {
			$active = ($parent->id == $page->id) ? "is-active" : "";
			echo "<li class='$active'><a href='{$parent->url}'>";
			echo $parent->title;
			echo "</a></li> ";
		}
		?>
	</ul>
