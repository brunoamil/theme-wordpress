<!-- chamando o header -->
<?php 
$css_especifico = 'index';
require_once('header.php'); ?>

<main class="home-main">
    <div class="container">
    <h1> Bem vindo! :) </h1>

        <!-- chamando meus post-imoveis -->
        <?php 
            $args = array('post_type' => 'imovel');
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