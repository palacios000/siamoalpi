<?php require "inc/head.php" ?>
</head>
<body class='landing-home bg-verde-sa antialiased'>


	<section class="relative">

		<!-- navigation START -->
		<nav class="relative z-10">
		  <div class="flex justify-between items-center">
		    <a class="" href="#">
		      <img class="h-36" src="<?php echo $config->urls->templates ?>pictures/logo/siamo-alpi-bianco.svg" alt="Siamo Alpi" width="">
		    </a>
		    <div class="">
		      <button class="navbar-burger flex items-center p-3 rounded">
		        <svg class="text-white block h-4 w-4" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
		          <title>Mobile burger</title>
		          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
		        </svg>
		      </button>
		    </div>
		  </div>
		</nav>

		<div class="hidden navbar-menu fixed top-0 left-0 bottom-0 w-5/6 max-w-sm z-50">
		  <div class="navbar-backdrop fixed inset-0 bg-blue-800 opacity-90"></div>
		  <nav class="relative flex flex-col py-8 w-full h-full bg-white border-r overflow-y-auto">
		    <div class="flex items-center mb-16 pr-6">
		      <a class="ml-16 mr-auto text-xl text-blue-800 font-semibold leading-none" href="#">
		        <img class="h-7" src="bendis-assets/logos/bendis-blue.svg" alt="" width="auto">
		      </a>
		    </div>
		    <div>
		      <ul>
		        <li class="mb-1"><a class="block pl-16 py-5 font-semibold text-blue-800 hover:bg-blue-50 rounded" href="#">About</a></li>
		        <li class="mb-1"><a class="block pl-16 py-5 font-semibold text-blue-800 hover:bg-blue-50 rounded" href="#">Company</a></li>
		        <li class="mb-1"><a class="block pl-16 py-5 font-semibold text-blue-800 hover:bg-blue-50 rounded" href="#">Services</a></li>
		        <li class="mb-1"><a class="block pl-16 py-5 font-semibold text-blue-800 hover:bg-blue-50 rounded" href="#">Testimonials</a></li>
		      </ul>
		    </div>
		    
		  </nav>
		</div>

		<!-- navigation END -->

		<div class="absolute top-0 w-full flex ">
			<?php
			$bgFolder = $config->urls->templates . "pictures/bg-landing/bg/" ; ?>

			<!-- colonna A -->
			<div class=" w-1/5 ">
				<div id="a1" class="h-97 relative flex-auto">
					<img class="absolute bottom-0 left-0 pb-5 pr-8" src="<?php echo $bgFolder ?>2siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
				<div id="a2" class="relative flex-auto h-full">
					<img class="absolute top-48 left-0 pl-12 w-2/3 " src="<?php echo $bgFolder ?>3-9siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute bottom-80 left-0  pr-28"  src="<?php echo $bgFolder ?>1-5siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
			</div>

			<!-- colonna B - content -->
			<div class=" w-3/5 ">
				<div id="b1" class="h-97 relative justify-center">
					<img class="absolute bottom-0 left-0 pb-32 pl-16 w-1/3" src="<?php echo $bgFolder ?>3siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute top-0 left-1/3 h-1/4 pl-3" src="<?php echo $bgFolder ?>1siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute bottom-0 right-0 pb-10 pr-9 w-2/5" src="<?php echo $bgFolder ?>4siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
				<div class="flex justify-center">
					<div id="b2" class="w-99  text-white">
						<div class="landing-body">
							<p class="text-8xl uppercase mb-30 font-serif">Apriamo i cassetti</p>
							<h1>titolo h1</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo neque aliquid obcaecati, eius et eveniet, sed animi? Quas harum aspernatur, commodi ab fugit mollitia hic aliquam quos, impedit, dicta, consequatur.</p>
							<p>prova Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><h1>titolo h1</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo neque aliquid obcaecati, eius et eveniet, sed animi? Quas harum aspernatur, commodi ab fugit mollitia hic aliquam quos, impedit, dicta, consequatur.</p>
							<p>prova Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						</div>

					</div>
				</div>
			</div>

			<!-- colonna C -->
			<div class=" w-1/5 ">
				<div id="c1" class="h-97 relative flex-auto">
					<img class="absolute top-0 right-0 pt-44 pl-14" src="<?php echo $bgFolder ?>5siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
				<div id="c2" class="relative flex-auto h-full">
					<img class="absolute top-0 right-0 pt-14 pl-28 " src="<?php echo $bgFolder ?>3-6siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute top-96 right-0 pl-16 pr-14" src="<?php echo $bgFolder ?>1-9siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute bottom-64 right-0 pl-30 " src="<?php echo $bgFolder ?>1-7siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
			</div>
		</div>
		



	</section>



	<?php require "inc/footer.php" ?>

</body>
</html>
