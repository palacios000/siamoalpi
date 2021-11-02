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
		      <button class="navbar-burger flex items-center px-6 ">
		        <svg class="text-white block h-6 w-6" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
		          <title>Mobile burger</title>
		          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
		        </svg>
		      </button>
		    </div>
		  </div>
		</nav>

		<div class="hidden navbar-menu fixed top-0 right-0 bottom-0 w-5/6 max-w-sm z-50">
		  <div class="navbar-backdrop fixed inset-0 bg-white opacity-10"></div>
		  <nav class="relative flex flex-col py-8 w-full h-full bg-blu-sa-500 opacity-80 border-r overflow-y-auto">
			<div>
		      <ul class="mt-20 text-white font-serif uppercase text-4xl">
		        <li class="mb-1"><a class="block pl-16 py-0 hover:bg-blue-50 hover:text-blu-sa " href="#">Home</a></li>
		        <li class="mb-1"><a class="block pl-16 py-0 hover:bg-blue-50 hover:text-blu-sa " href="#">Il Progetto</a></li>
		        <li class="mb-1"><a class="block pl-16 py-0 hover:bg-blue-50 hover:text-blu-sa " href="#">Le fasi</a></li>
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
				<div id="a2" class="relative flex-auto h-3/5 ">
					<img class="absolute top-48 left-0 pl-12 w-2/3 " src="<?php echo $bgFolder ?>3-9siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute bottom-8 left-0 pr-28 max-h-72"  src="<?php echo $bgFolder ?>1-5siamo-alpi.jpg" alt="archivio Garlaschelli">
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
						<div class="landing-body text-base">
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

				<footer class="mt-30  flex justify-center ">
					<div class="w-99 border-t border-blu-sa flex flex-row justify-end">
						<div class="flex-grow">
							<p class="text-white mt-6 text-base">
								Segui lo sviluppo del progetto <br>
								sui nostri canali social
							</p>
							<p class="mt-4">
								<a href=""><img class="w-8 inline" src='<?php echo $config->urls->templates . "pictures/bg-landing/facebook.svg" ?>' alt='facebook icon'></a>
								<a href=""><img class="w-8 inline" src='<?php echo $config->urls->templates . "pictures/bg-landing/instagram.svg" ?>' alt='instagram icon'></a>

							</p>
						</div>
						<div class="mt-6 w-auto h-20">
							<div class="border-l border-blu-sa text-blu-sa-700 uppercase text-xs pl-3">
								<p class="tracking-wide">Un'inziativa di</p>
								<img class="pt-6 h-20 " src="<?php echo $config->urls->templates . "pictures/bg-landing/loghi-provincia-sev.png" ?>" alt="Provincia di Sondrio, SEV">
							</div>
						</div>
						<div class="mt-6 w-auto h-20">
							<div class="border-l border-blu-sa text-blu-sa-700 uppercase text-xs pl-3">
								<p class="tracking-wide">Finanziata da</p>
								<img class="pt-6 h-20 mb-3" src="<?php echo $config->urls->templates . "pictures/bg-landing/loghi-fondazione-cariplo.png" ?>" alt="Fondazione Cariplo">
							</div>
						</div>
					</div>
				</footer>
			</div>

			<!-- colonna C -->
			<div class=" w-1/5 ">
				<div id="c1" class="h-97 relative flex-auto">
					<img class="absolute top-0 right-0 pt-44 pl-14" src="<?php echo $bgFolder ?>5siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
				<div id="c2" class="relative flex-auto h-3/5">
					<img class="absolute top-0 right-0 pt-14 pl-28 " src="<?php echo $bgFolder ?>3-6siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute top-96 right-0 pl-16 pr-14" src="<?php echo $bgFolder ?>1-9siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute bottom-0 right-0 pl-30 max-h-44" src="<?php echo $bgFolder ?>1-7siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
			</div>
		</div>
		



	</section>



	<?php require "inc/footer.php" ?>

</body>
</html>
