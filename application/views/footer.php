		<footer class="text-right">
			<hr />
	
	    </footer>

		<?php if(IS_DEMO == 1): ?>
			<script>
				function FinContacto()
				{
					$("#mContact .modal-body").html('Muchas Gracias, pronto estaremos en contacto con usted.');
					$("#mContact .modal-footer .btn-default").text('Cerrar');
					$("#mContact .modal-footer .submit-ajax-button").fadeOut();
				}
			</script>

		<?php endif; ?>

    </div>

  </body>
</html>