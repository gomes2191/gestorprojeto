<?php
class AgendaBoxController extends MainController
{
	// URL: dominio.com/exemplo/
	public function index() {
	
		// Carrega o modelo
		//$modelo = $this->load_model('exemplo/exemplo-model');
                $modelo = $this->load_model('agenda/agenda-model');
		
		// Carrega o view
		require_once ABSPATH . '/views/agenda/agenda-box-view.php';
	}
	
	// URL: dominio.com/exemplo/outra-acao
	public function OutraAcao() {
		// Inclua seus models e views aqui
	}
}