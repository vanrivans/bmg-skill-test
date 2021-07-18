	<script>
		$(document).ready( function () {

			$('#modal-signout').modal('show');

			$("body").on("shown.bs.modal", "#modal-signout", function () {

				$('#btn-confirm-signout').focus();

				$('#btn-confirm-signout').on('click', function () {

					location.href = "<?=site_url('dashboard/destroy_sessions');?>";
				});
			});
		});
    </script>

	<div id="modal-signout" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

		<div class="modal-dialog modal-dialog-centered">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title">Konfirmasi</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

				</div>

				<div class="modal-body">
					<p>Logout aplikasi?</p>
				</div>

				<div class="modal-footer">

					<div class="btn-group">
						<button type="button" id="btn-confirm-signout" class="btn btn-primary"><i class="bi-power"></i> Logout</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					</div>

				</div>

			</div>
			<!-- /div.modal-content -->

		</div>
		<!-- /div.modal-dialog -->

	</div>
	<!-- /div.modal -->

