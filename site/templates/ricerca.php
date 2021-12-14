<?php require "inc/landing_head.php" ?>
<!-- algolia -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.5.1/dist/algoliasearch-lite.umd.js" integrity="sha256-EXPXz4W6pQgfYY3yTpnDa3OH8/EPn16ciVsPQ/ypsjk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.8.3/dist/instantsearch.production.min.js" integrity="sha256-LAGhRRdtVoD6RLo2qDQsU2mp+XVSciKRC8XPOBWmofM=" crossorigin="anonymous"></script>



<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/reset-min.css" integrity="sha256-t2ATOGCtAIZNnzER679jwcFcKYfLlw01gli6F6oszk8=" crossorigin="anonymous"> -->

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.4.5/themes/satellite-min.css" integrity="sha256-TehzF/2QvNKhGQrrNpoOb2Ck4iGZ1J/DI4pkd2oUsBc=" crossorigin="anonymous"> -->



</head>
<body class='bg-verde-sa antialiased'>

	<section class="container w-3/4 mx-auto">
		<div class="bg-white ">
			<h1>test</h1>
			<div id="searchbox">
				
			</div>
			<div id="hits">
				
			</div>
		</div>
		
	</section>



<script>
	const searchClient = algoliasearch('NK1J7ES7IV', '6581401b5f047688ea20ca3f5e6074fd');

	const search = instantsearch({
	  indexName: 'siamoAlpi',
	  searchClient,
	});

	search.addWidgets([
	  instantsearch.widgets.searchBox({
	    container: '#searchbox',
	  }),

	  instantsearch.widgets.configure({
	    hitsPerPage: 6,
	  }),


	  instantsearch.widgets.infiniteHits({
	    container: '#hits',
	    escapeHTML: true,
	    cssClasses: {
	        list: ['grid', 'grid-cols-3', 'gap-4'],
	        root: ['cardX-prova', 'cardY-test'],
	      },
	    templates: {
	        item: `
	        <div>
	          <h2>
	            {{ titolo }}
	          </h2>
	          <p>{{ descrizione }}</p>
	          <div>
	          	<img src='{{ immagine }}'>
	          </div>
	        </div>
	        `,
	      },

	  })
	]);

	search.start();

</script>
	<?php require "inc/scripts.php" ?>

</body>
</html>
