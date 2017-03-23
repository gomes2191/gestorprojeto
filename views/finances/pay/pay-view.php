<?php
if (!defined('ABSPATH')) {
    exit();
}

if (filter_input(INPUT_GET, 're', FILTER_DEFAULT)) {
    $encode_id = filter_input(INPUT_GET, 're', FILTER_DEFAULT);
    $modelo->delRegister($encode_id);

    # Destroy variavel não mais utilizadas
    unset($encode_id);
}
    # Verifica se existe a requisição POST se existir executa o método se não faz nada
    (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;

    # Verifica se existe feedback e retorna o feedback se sim se não retorna false
    $form_msg = $modelo->form_msg;
?>

<script>
    //  Muda url da pagina
    //  window.history.pushState("fees", "", "fees");

    //  Faz um refresh de url apos fechar modal
    $(function () {
        $('#infor-view').on('hidden.bs.modal', function () {
            //document.location.reload();
            $(this).removeData('bs.modal');
        });
    });
</script>

<div class="row-fluid">
    <div class="col-md-12  col-sm-12 col-xs-12">
        <!--Implementação da nova tabela-->

        <section id="container" >

			<!--main content start-->
			<section id="main-content" style="margin-left: 0px;">
				<section class="wrapper">

					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
						<p>Type a name to begin searching</p>
								<form class="form-horizontal" name="search" role="form" method="POST" onkeypress="return event.keyCode != 13;">
									<div class="input-group col-sm-11">
										<input id="name" name="name" type="text" class="form-control" placeholder="Search by name..." autocomplete="off"/>
										<span class="input-group-btn">
											<button type="button" class="btn btn-default btnSearch">
												<span class="glyphicon glyphicon-search"> </span>
											</button> </span>
									</div>
								</form>
						</div>

					</div>

					<div class="row mt">
						<div class="col-lg-12">
							<div class="content-panel tablesearch">

								<section id="unseen">
									<table id="resultTable" class="table table-bordered table-hover table-condensed">
										<thead>
											<tr>
									
												<th class="small">Name</th>
												<th class="small">Company</th>
												<th class="small">Zip</th>
												<th class="small">City</th>
									
											</tr>
										</thead>
									
										<tbody></tbody>
									</table>
								</section>

							</div><!-- /content-panel -->
						</div><!-- /col-lg-4 -->
					</div><!-- /row -->
					

					<div class="row mt">
						<div class="col-lg-12">
							<h3>Top Searches</h3>
							<p>These results are ranked by popularity in the query_data table. Each time the complete name is entered in the search, a +1 is registered and incremented.</p>
							<div class="content-panel">

								<section id="unseen">
									<table id="resultTable-topsearch" class="table table-bordered table-hover table-condensed">
										<thead>
											<tr>
									
												<th class="small">Name</th>
												<th class="small">Company</th>
												<th class="small">Zip</th>
												<th class="small">City</th>
									
											</tr>
										</thead>
									
										<tbody><?= $modelo->getSelect_return("SELECT * FROM `bills_to_pay` c INNER JOIN `query_data` q ON c.pay_date_pay = q.name ORDER BY querycount DESC LIMIT 5"); # Display 10 most recent search items ?></tbody>
									</table>
								</section>

							</div><!-- /content-panel -->
						</div><!-- /col-lg-4 -->
					</div><!-- /row -->

					
			
					<p>
						Check out the full tutorial at <a href="http://lekkerlogic.com/blog/‎?p=16">LekkerLogic.com - PHP MySQL Ajax Live Data Table Tutorial</a>
					</p>

				</section>
				<! --/wrapper -->
			</section><!-- /MAIN CONTENT -->

			<!--main content end-->

		</section>
        
        
        <!--Implementação da nova tabela-->
        
        <!-- Start Modal deletar fornecedores -->
        <div class="modal in fade"  role="dialog" id="myModal">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title"><span style="colo" class=" info glyphicon glyphicon-floppy-remove">&nbsp;</span>ELIMINAR REGISTRO</h5>
                    </div>
                    <div class="modal-body">
                        <p class="text-justify">Tem certeza que deseja remover este registro? não sera possível reverter isso.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= HOME_URI; ?>/finances-pay" class="btn btn-primary">Desistir</a>
                        <a href="<?= HOME_URI; ?>/finances-pay?re=<?= $modelo->encode_decode($fetch_userdata['pay_id']); ?> " class="btn btn-danger" >Eliminar</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- Start Modal Informações de pagamentos -->
        <div id="infor-view" class="modal fade" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <!--Conteudo do modal-->
                </div>
            </div>
        </div>
        <!-- End modal -->
    </div>
</div>

