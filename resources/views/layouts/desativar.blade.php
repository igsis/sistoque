<div class="modal fade" id="desativar" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<p>Confirma?</p>
			</div>
			<div class="modal-footer">
				<form method="POST">
					{{csrf_field()}}
					<input type="hidden" name="_method" value="DELETE">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<input type="submit" class="btn btn-danger" value="Desativar">
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="ativar" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<p>Confirma?</p>
			</div>
			<div class="modal-footer">
				<form method="POST">
					{{csrf_field()}}
					<input type="hidden" name="_method" value="PUT">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<input type="submit" class="btn btn-success" value="Ativar">
				</form>
			</div>
		</div>
	</div>
</div>




{{-- <button type="button" class="btn btn-default" data-dismiss="modal"></button>
        <button type="button" class="btn btn-danger" id="confirm"></button> --}}