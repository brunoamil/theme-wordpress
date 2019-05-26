<?php
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