<!-- Modal -->
<div class="modal fade" id="downloadarq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Area de download</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Dados.jason
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="fechar">Close</button>
        <a type="application/json" class="btn btn-primary" id="buttondw" href="../dados/dados.json" download="dados.json">Donwload</a>
      </div>
    </div>
  </div>
</div>
<div style="display: none;" id="pphp"></div>

<script>
    $('.modal-footer #fechar').click(function(){
        $('footer #downloadarq').modal('hide');
    });
</script>