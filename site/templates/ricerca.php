<?php require "inc/landing_head.php" ?>
<!-- algolia -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.5.1/dist/algoliasearch-lite.umd.js" integrity="sha256-EXPXz4W6pQgfYY3yTpnDa3OH8/EPn16ciVsPQ/ypsjk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.8.3/dist/instantsearch.production.min.js" integrity="sha256-LAGhRRdtVoD6RLo2qDQsU2mp+XVSciKRC8XPOBWmofM=" crossorigin="anonymous"></script>



<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/reset-min.css" integrity="sha256-t2ATOGCtAIZNnzER679jwcFcKYfLlw01gli6F6oszk8=" crossorigin="anonymous"> -->

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.4.5/themes/satellite-min.css" integrity="sha256-TehzF/2QvNKhGQrrNpoOb2Ck4iGZ1J/DI4pkd2oUsBc=" crossorigin="anonymous"> -->

<!-- pre connect -->
<link crossorigin href="https://NK1J7ES7IV-dsn.algolia.net" rel="preconnect" />


</head>
<body class='bg-verde-sa antialiased'>

	<section class="container w-3/4 mx-auto">
		<div class="bg-white ">
			<h1 class="text-3xl p-10">Prova ricerca contenuti</h1>
			<div id="searchbox" class="p-5">
				
			</div>
			<div id="stats" class="p-5 text-sm">
				
			</div>
			<div id="hits" class="p-5">
				
			</div>
		</div>
		
	</section>



<!-- algolia search -->
	<script>
		const searchClient = algoliasearch('NK1J7ES7IV', '6581401b5f047688ea20ca3f5e6074fd');

		const search = instantsearch({
		  indexName: 'siamoAlpi',
		  searchClient,
		});










		// Create the render function
		const renderInfiniteHits = (renderOptions, isFirstRender) => {
		  const {
		    hits,
		    widgetParams,
		    showPrevious,
		    isFirstPage,
		    showMore,
		    isLastPage,
		  } = renderOptions;

		  if (isFirstRender) {
		    const ul = document.createElement('div');
		    ul.classList.add('tabella', 'grid', 'grid-cols-4', 'gap-4');
		    //const previousButton = document.createElement('button');
		    //previousButton.className = 'previous-button';
		    //previousButton.textContent = 'Show previous';

			    // previousButton.addEventListener('click', () => {
			    //   showPrevious();
			    // });

		    const nextButton = document.createElement('button');
		    nextButton.classList.add('next-button', 'bg-verde-sa', 'text-white', 'p-3');
		    nextButton.textContent = 'Mostra altro';
		    nextButton.addEventListener('click', () => {
		      showMore();
		    });

		    // show/hide content
			    const hideButton = document.createElement('button');
			    const showButton = document.createElement('button');
			    const hideme = document.getElementsByClassName('titoloFoto');
			    var i;
			    hideButton.classList.add('bg-verde-sa', 'text-white', 'p-1');
			    showButton.classList.add('bg-verde-sa', 'text-white', 'p-1', 'hidden');
			    hideButton.textContent = 'nascondi titolo';
			    showButton.textContent = 'mostra titolo';
			    hideButton.addEventListener('click', () => {
			      for (i = 0; i < hideme.length; i++) {
				      hideme[i].classList.add('hidden');
			      };
			      hideButton.classList.add('hidden');
			      showButton.classList.remove('hidden');
			    });
			    showButton.addEventListener('click', () => {
			      for (i = 0; i < hideme.length; i++) {
				      hideme[i].classList.remove('hidden');
			      };
			      hideButton.classList.remove('hidden');
			      showButton.classList.add('hidden');
			    });


		    //widgetParams.container.appendChild(previousButton);
		    widgetParams.container.appendChild(hideButton);
		    widgetParams.container.appendChild(showButton);
		    widgetParams.container.appendChild(ul);
		    widgetParams.container.appendChild(nextButton);

		    return;
		  }

		  //widgetParams.container.querySelector('.previous-button').disabled = isFirstPage;
		  widgetParams.container.querySelector('.next-button').disabled = isLastPage;

		  widgetParams.container.querySelector('div').innerHTML = `
		    ${hits
		      .map(
		        item =>
		          `<div class='algCard '>
		            <div>
		          		<img src='${item.immagine}'>
			        </div>
			        <div class='max-h-36 overflow-hidden'>
		            
			          	<h2 class='font-bold titoloFoto'>
			            ${instantsearch.highlight({ attribute: 'titolo', hit: item })}
			            </h2>

			        </div>
		          </div>`
		      )
		      .join('')}
		  `;
		};

		// Create the custom widget
		const customInfiniteHits = instantsearch.connectors.connectInfiniteHits(
		  renderInfiniteHits
		);

		// Instantiate the custom widget
		search.addWidgets([
		  customInfiniteHits({
		    container: document.querySelector('#hits'),
		    showPrevious: true,
		    templates: {
		        item: `
		        <div>
		          <h2>
		            {{ titolo }}
		          </h2>
		          <div>
		          	<img src='{{ immagine }}'>
		          </div>
		          <p>{{ descrizione }}</p>
		        </div>
		        `,
		      },
		  }),

		  instantsearch.widgets.searchBox({
		    container: '#searchbox',
		  }),

		  instantsearch.widgets.stats({
		    container: '#stats',
		    templates: {
		       text: `
		         
		           {{#hasNoResults}}Nessun risultato trovato{{/hasNoResults}}
		           {{#hasOneResult}}1 risultato trovato{{/hasOneResult}}
		           {{#hasManyResults}}{{#helpers.formatNumber}}{{nbHits}}{{/helpers.formatNumber}} risultati trovati{{/hasManyResults}}

		         
		       `,
		     },
		  }),



		]);








/*

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
		        list: ['grid'],
		        root: ['cardX-prova', 'cardY-test'],
		      },
		    templates: {
		        item: `
		        <div>
		          <h2>
		            {{ titolo }}
		          </h2>
		          <div>
		          	<img src='{{ immagine }}'>
		          </div>
		          <p>{{ descrizione }}</p>
		        </div>
		        `,
		      },

		  })
		]);
*/
		search.start();

	</script>



	<?php require "inc/scripts.php" ?>

<!-- masonry -->
<!-- 	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
 -->
	<script>
		
		// var elem = document.querySelector('.tabella');
		// var msnry = new Masonry( elem, {
		//   // options
		//   itemSelector: '.algCard',
		//   columnWidth: '400'
		// });
		

		// element argument can be a selector string
		//   for an individual element
		/*var msnry = new Masonry( '.grid', {
		  itemSelector: '.ais-InfiniteHits-item',
		  columnWidth: '200px'
		  // options
		});*/
	</script>



</body>
</html>
