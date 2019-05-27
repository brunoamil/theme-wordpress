<!-- chamando o header -->
<?php 
$existeBusca = array_key_exists('taxonomy', $_GET);
if($existeBusca && $_GET['taxonomy'] === ''){
    wp_redirect(home_url());
}

$css_especifico = 'index';
require_once('header.php'); ?>

<main class="home-main">
    <div class="container">

    <?php $taxonomias = get_terms('localizacao'); ?>
        <form class="busca-localizacao" action="<?= bloginfo('url'); ?>">
            <select name="taxonomy">
                <option value="">Todos</option>
                <?php foreach($taxonomias as $taxonomia) { ?>
                <option value="<?= $taxonomia->slug; ?>"><?= $taxonomia->name ?></option>
                <?php } ?>
            </select>
            <button type="submit">Filtrar </button>
        </form>
        <!-- chamando meus post-imoveis -->
        <?php 

            if($existeBusca) {
                $tax_query = array(
                    array(
                        'taxonomy' => 'localizacao',
                        'field' => 'slug',
                        'terms' => $_GET['taxonomy']
                    )
                );
            }
           

            $args = array(
                'post_type' => 'imovel',
                'tax_query' => $tax_query
            );

            $loop = new WP_Query($args);
        ?>

        <ul class="imoveis-listagem">
            <!-- chamando os post -->
            <?php 
                if($loop ->have_posts()){
                    while($loop ->have_posts()){
                        $loop->the_post();
            ?>
            <li class="imoveis-listagem-item">
            <a href="<?php the_permalink(); ?>">
                <!-- imagem em destaque -->
                <?php the_post_thumbnail(); ?>
                    <!-- Titulo do post-->
                    <h2><?php the_title(); ?></h2>
                    <!-- conteudo do post-->
                    <p><?php the_content(); ?></p>
                </a>
            </li>
            <?php
                    }
                }
            ?>
        </ul>
    </div>
</main>

<!-- chamando o footer -->
<?php get_footer(); ?>