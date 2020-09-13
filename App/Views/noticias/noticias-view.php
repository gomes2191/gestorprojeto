<?php
// Evita acesso direto a este arquivo
if (!defined('Config::HOME_URI')) exit;
?>

<div class="wrap">

	<?php
	// Número de posts por página
	$modelo->posts_por_pagina = 10;

	// Lista notícias
	$lista = $modelo->listar_noticias();
	?>

	<?php foreach ($lista as $noticia) : ?>

		<!-- Título -->
		<h1>
			<a href="<?php echo HOME_URI ?>/noticias/index/<?php echo $noticia['noticia_id'] ?>">
				<?php echo $noticia['noticia_titulo'] ?>
			</a>
		</h1>

		<?php
		// Verifica se estamos visualizando uma única notícia
		if (is_numeric(chkArray($modelo->_parameters, 0))) : // single
		?>

			<p>
				<?php echo $modelo->inverte_data($noticia['noticia_data']); ?> |
				<?php echo $noticia['noticia_autor']; ?>
			</p>

			<p>
				<img src="<?php
							echo HOME_URI . '/views/_uploads/' . $noticia['noticia_imagem']; ?>">
			</p>

			<?php echo $noticia['noticia_texto']; ?>

		<?php endif;  // single
		?>

	<?php endforeach; ?>

	<?php $modelo->paginacao(); ?>

</div> <!-- .wrap -->