<!-- chamando o header -->
<?php get_header(); ?>

<main class="home-main">
    <div class="container">
    <h1> Bem vindo! :) </h1>
        <ul class="imoveis-listagem">
            <!-- chamando os post -->
            <?php 
                if(have_posts()){
                    while(have_posts()){
                        the_post();
            ?>
            <li class="imoveis-listagem-item">
                <!-- imagem em destaque -->
                <?php the_post_thumbnail(); ?>
                <!-- Titulo do post-->
                <h2><?php the_title(); ?></h2>
                <!-- conteudo do post-->
                <p><?php the_content(); ?></p>
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