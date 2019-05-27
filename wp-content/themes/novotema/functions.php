<?php $nome = $_POST['form-nome'];
$email = $_POST['form-email'];
$mensagem = $_POST['form-mensagem'];

$formularioEnviado = isset($nome) && isset($email) && isset($mensagem);

if($formularioEnviado) {
    $enviou = enviar_e_checar_email($nome, $email, $mensagem);

    if($enviou) { ?>
        <span class="email-sucesso">Seu e-mail foi enviado com sucesso!</span>
    <?php } else { ?>
        <span class="email-fracasso">Desculpe, ocorreu um erro, seu e-mail não foi enviado!</span>
    <?php } 
}


// adicionando a imagem destacada no post que não tinha
add_theme_support('post-thumbnails');



//############################################
//registrar conteudo novo - customizado, onde passa várias configuracoes com $args(array)
//public  - para aparecer no menu 
//labels - é o nome do titulo e outros do menu novo imoveis
//add_new_item - titulo para adicionar novo imovel
//edit_item - titulo para editar imovel
//visitar o site https://codex.wordpress.org/Function_Reference/register_post_type e verificar os outros titulos
//visitar icone wordpress https://developer.wordpress.org/resource/dashicons/#heart

function cadastrando_post_type_imoveis() {
        $nomeSingular = 'Imóvel';
        $nomePlural = 'Imóveis';
        $description = 'Imóveis da Mobiliaria Malura';

        $labels = array(
            'name' => $nomePlural,
            'name_singular' => $nomeSingular,
            'add_new_item' => 'Adicionar novo ' . $nomeSingular,
            'edit_item' => 'Editar ' . $nomeSingular
        );

        $supports = array(
            'title',
            'editor',
            'thumbnail'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'description' => $description,
            'menu_icon' => 'dashicons-admin-home',
            'supports' => $supports
        );

        register_post_type('imovel', $args);

}

//chamando as funcoes que o wordpress deve chamar
add_action('init', 'cadastrando_post_type_imoveis');

//############################################
//registrando o menu
function registrar_menu_navegacao(){
    register_nav_menu('header-menu','main-menu');
}

add_action('init', 'registrar_menu_navegacao');

// ############################
function geraTitle(){
    bloginfo('name');
    if(!is_home()) echo ' | ';
    the_title();
}

// #####################
//taxonomia de localização - onde voce informa pra que é, e depois passa o seu post modificado ou nao.
function registra_taxonomia_localizacao(){
        $nomeSingular= 'Localização';
        $nomePlural = 'Localizações';

        $labels = array(
            'name' => $nomePlural,
            'singular_name' => $nomeSingular,
            'edit_item' => 'Editar '. $nomeSingular,
            'add_new_item' => 'Adicionar ' . $nomeSingular
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => true
        );

        register_taxonomy('localizacao', 'imovel', $args);

}

add_action('init', 'registra_taxonomia_localizacao');

// ######################
// criando metaboxes para os post
/* Criando a taxonomia de localização */

function criando_taxonomia_localizacao() {
	$singular = 'Localização';
	$plural = 'Localizações';

	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'view_item' => 'Ver ' . $singular,
		'edit_item' => 'Editar ' . $singular,
		'new_item' => 'Novo ' . $singular,
		'add_new_item' => 'Adicionar novo ' . $singular
		);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'hierarchical' => true
		);

	register_taxonomy('localizacao', 'imovel', $args);
}

add_action( 'init' , 'criando_taxonomia_localizacao' );

function is_selected_taxonomy($taxonomy, $search) {
	if($taxonomy->slug === $search) {
		echo 'selected';
	}
}

function adicionar_meta_info_imovel() {
	add_meta_box(
		'informacoes_imovel',
		'Informações',
		'informacoes_imovel_view',
		'imovel',
		'normal',
		'high'
	);
}

add_action('add_meta_boxes', 'adicionar_meta_info_imovel');

function informacoes_imovel_view( $post ) { 
	$imoveis_meta_data = get_post_meta( $post->ID ); ?>

	<style>
		.maluras-metabox {
			display: flex;
			justify-content: space-between;
		}

		.maluras-metabox-item {
			flex-basis: 30%;

		}

		.maluras-metabox-item label {
			font-weight: 700;
			display: block;
			margin: .5rem 0;

		}

		.input-addon-wrapper {
			height: 30px;
			display: flex;
			align-items: center;
		}

		.input-addon {
			display: block;
			border: 1px solid #CCC;
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			height: 100%;
			width: 30px;
			text-align: center;
			line-height: 30px;
			box-sizing: border-box;
			background-color: #888;
			color: #FFF;
		}

		.maluras-metabox-input {
			height: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}

	</style>
	<div class="maluras-metabox">
		<div class="maluras-metabox-item">
			<label for="maluras-preco-input">Preço:</label>
			<div class="input-addon-wrapper">
				<span class="input-addon">R$</span>
				<input id="maluras-preco-input" class="maluras-metabox-input" type="text" name="preco_id"
				value="<?= number_format($imoveis_meta_data['preco_id'][0], 2, ',', '.'); ?>">
			</div>
		</div>

		<div class="maluras-metabox-item">
			<label for="maluras-vagas-input">Vagas:</label>
			<input id="maluras-vagas-input" class="maluras-metabox-input" type="number" name="vagas_id"
			value="<?= $imoveis_meta_data['vagas_id'][0]; ?>">
		</div>

		<div class="maluras-metabox-item">
			<label for="maluras-banheiros-input">Banheiros:</label>
			<input id="maluras-banheiros-input" class="maluras-metabox-input" type="number" name="banheiros_id"
			value="<?= $imoveis_meta_data['banheiros_id'][0]; ?>">
		</div>

		<div class="maluras-metabox-item">
			<label for="maluras-quartos-input">Quartos:</label>
			<input id="maluras-quartos-input" class="maluras-metabox-input" type="number" name="quartos_id"
			value="<?= $imoveis_meta_data['quartos_id'][0]; ?>">
		</div>

	</div>
<?php

}

function salvar_meta_info_imoveis( $post_id ) {
	if( isset($_POST['preco_id']) ) {
		update_post_meta( $post_id, 'preco_id', sanitize_text_field( $_POST['preco_id'] ) );
	}
	if( isset($_POST['vagas_id']) ) {
		update_post_meta( $post_id, 'vagas_id', sanitize_text_field( $_POST['vagas_id'] ) );
	}
	if( isset($_POST['banheiros_id']) ) {
		update_post_meta( $post_id, 'banheiros_id', sanitize_text_field( $_POST['banheiros_id'] ) );
	}
	if( isset($_POST['quartos_id']) ) {
		update_post_meta( $post_id, 'quartos_id', sanitize_text_field( $_POST['quartos_id'] ) );
	}
}

add_action('save_post', 'salvar_meta_info_imoveis');

//################# trabalho com email

function enviar_e_checar_email($nome, $email, $mensagem) {
    return wp_mail( 'fbrunoamil@gmail.com', 'Bruno lindo', 'Nome: ' . $nome . "\n" . $mensagem  );
}



