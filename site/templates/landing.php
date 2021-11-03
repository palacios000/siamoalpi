<?php require "inc/landing_head.php" ?>
</head>
<body class='landing-home bg-verde-sa antialiased'>

	<section class="relative ">

		<?php include 'inc/landing_menu.php' ?>

		<?php $bgFolder = $config->urls->templates . "pictures/bg-landing/bg/" ; ?>

		<!-- colonna B - content MOBILE INTRO start -->
		<div id="b1m" class="md:hidden w-full h96 pb-3 ">
			<img class="" src="<?php echo $bgFolder ?>bg-mobile-top_c.jpg" alt="archivio Garlaschelli">
		</div>
		<!-- colonna B - content MOBILE INTRO end -->

		<div class="relative md:absolute top-0 w-full flex">

			<!-- colonna A -->
			<div class="invisible md:visible w-1/12 md:w-1/5 ">
				<div id="a1" class="h-97 relative flex-auto">
					<img class="absolute bottom-0 left-0 pb-5 pr-8" src="<?php echo $bgFolder ?>2siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
				<div id="a2" class="relative flex-auto h-3/5 ">
					<img class="absolute top-48 left-0 pl-12 w-2/3 " src="<?php echo $bgFolder ?>3-9siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute bottom-8 left-0 pr-28 max-h-72"  src="<?php echo $bgFolder ?>1-5siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
			</div>


			<div class="w-full px-2 md:px-0 md:w-3/5 ">
				<!-- blocco medium -->
				<div id="b1" class="invisible md:visible mb-14 md:mb-0 h-0 md:h-97 relative justify-center">
					<img class="absolute bottom-0 left-0 pb-32 pl-16 w-1/3" src="<?php echo $bgFolder ?>3siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute top-0 left-1/3 h-1/4 pl-3" src="<?php echo $bgFolder ?>1siamo-alpi.jpg" alt="archivio Garlaschelli">
					<img class="absolute bottom-0 right-0 pb-10 pr-9 w-2/5" src="<?php echo $bgFolder ?>4siamo-alpi.jpg" alt="archivio Garlaschelli">
				</div>
				<div class="flex justify-center">
					<div id="b2" class="w-full md:w-99  text-white">
						<div class="landing-body text-base">
							<p class="text-5xl md:text-8xl uppercase pb-16 font-serif tracking-tight">Apriamo i cassetti</p>
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

				<div class="h-0 md:h-auto overflow-hidden w-full">
					<?php include 'inc/landing_footer.php' ?>
				</div>
			</div>

			<!-- colonna C -->
			<div class="invisible md:visible w-1/12 md:w-1/5 ">
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

	<!-- MOBILE FOOTER start -->
	<section>
		<div id="b4" class="md:hidden pt-12 pb-8">
			<img class="w-full" src="<?php echo $bgFolder ?>bg-mobile-bottom_c.jpg" alt="archivio Garlaschelli">
		</div>

		<!-- aggiungi ancora il footer -->
		<div class="h-auto md:h-0 overflow-hidden">
			<?php include 'inc/landing_footer-mobile.php' ?>
		</div>
	</section>
	<!-- MOBILE FOOTER end -->


				
				
	<div id="credits" class="relative overflow-visible visible md:invisible ">
		<!-- absolute setting in .css file -->
		<p class="credits absolute  right-0 pl-3 pb-0 mb-0 text-blu-sa-700 text-xxs transform rotate-270 w-80">FOTO: archivio Garlaschelli | design: simoneronzio.com</p>
	</div>


	<?php require "inc/scripts.php" ?>

</body>
</html>
