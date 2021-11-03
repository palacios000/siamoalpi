<footer class="mt-30 mb-8  flex justify-center ">
	<div class="w-99 border-t border-blu-sa flex flex-col md:flex-row justify-end">
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

		<div class="md:hidden flex-grow border-t border-blu-sa mt-8"></div>
		
		<div class="grid grid-cols-2">
			
			<div class="mt-6 w-1/2 md:w-auto h-20">
				<div class="border-0 md:border-l border-blu-sa text-blu-sa-700 uppercase text-xs pl-0 md:pl-3">
					<p class="tracking-wide">Un'inziativa di</p>
					<img class="pt-6 h-20 " src="<?php echo $config->urls->templates . "pictures/bg-landing/loghi-provincia-sev.png" ?>" alt="Provincia di Sondrio, SEV">
				</div>
			</div>
			<div class="mt-6 w-1/2 md:w-auto h-20 ">
				<div class="border-0 md:border-l border-blu-sa text-blu-sa-700 uppercase text-xs pl-0 md:pl-3 ">
					<p class="tracking-wide">Finanziata da</p>
					<img class="pt-6 h-20 mb-3" src="<?php echo $config->urls->templates . "pictures/bg-landing/loghi-fondazione-cariplo.png" ?>" alt="Fondazione Cariplo">
				</div>
			</div>
		</div>
	</div>
</footer>