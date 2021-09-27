<?php $form = $forms->render('questionario-valfurva'); ?>
<?php require "inc/head.php" ?>
<?php echo $form->styles; ?>
<?php echo $form->scripts; ?>
<style>
.uk-button-success,
.uk-button-success:focus, 
.uk-button-success:hover{
	background-color: #0e9b7e !important;
}
.InputfieldHeader.uk-form-label{
	text-align: right;
}
</style>
</head>
<body class='questionario'>

	<?php //require "inc/menu.php" ?>
		

		<section class="uk-container">
			<img src="<?php echo $urls->templates ?>pictures/logo/siamo-alpi-nero-verde.svg" width="300" alt="Siamo Alpi">
			<div class="uk-margin-large-top">

				<?php if($page->editable()){
					echo "<a class='uk-padding' href='$page->editURL'>Modifica Pagina</a>";
				}?>
				
				<div class="uk-padding-large">
					<?php echo $page->body; ?>
				</div>

				<div class="uk-padding-large uk-padding-top-remove uk-margin-large-bottom">
					<?php echo $form; ?>
				</div>
			</div>
		</section>


	
	<?php require "inc/footer.php" ?>

</body>
</html>
