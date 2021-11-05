<!-- navigation START -->
<nav class="relative z-10">
	<div class="flex justify-between items-center">
		<a class="" href="#">
			<img class="h-36 pt-0 lg:pt-3" src="<?php echo $config->urls->templates ?>pictures/logo/siamo-alpi-bianco.svg" alt="Siamo Alpi" width="">
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
	<div class="navbar-backdrop fixed inset-0 bg-blu-sa-100 opacity-20"></div>
	<nav class="relative flex flex-col py-8 w-full h-full bg-blu-sa-500 opacity-80 border-r overflow-y-auto">
		<div>
			<ul class="mt-20 text-white font-serif uppercase text-3xl lg:text-4xl">
				<li class="mb-4 lg:mb-4 w-auto"><a class="ml-4 lg:ml-8 py-0 pb-0 lg:pb-2 border-b-2 border-blu-sa-500 hover:border-white " href="#">Home</a></li>
				<li class="mb-4 lg:mb-4 w-auto"><a class="ml-4 lg:ml-8 py-0 pb-0 lg:pb-2 border-b-2 border-blu-sa-500 hover:border-white " href="#">Il Progetto</a></li>
				<li class="mb-4 lg:mb-4 w-auto"><a class="ml-4 lg:ml-8 py-0 pb-0 lg:pb-2 border-b-2 border-blu-sa-500 hover:border-white " href="#">Le fasi</a></li>
				<?php if($page->editable()){} ?>
			</ul>
		</div>

	</nav>
</div>

<!-- navigation END -->