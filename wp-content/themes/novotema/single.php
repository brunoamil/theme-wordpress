<?php 
$css_especifico = 'single';
require_once('header.php'); ?>

<main>
    <article>
<?php 
    if(have_posts()){
        while(have_posts()){
            the_post();
        ?>
        <div class="single-imovel-thumbnail">
             <?php the_post_thumbnail(); ?>
        </div>
        <div class="container">
            <section class="chamada-principal">
                <?php the_title(); ?>
            </section>
            <section class="single-imovel-geral">
                <div class="single-imovel-descricao">
                    <?php the_content(); ?>
                </div>

                <!-- pegando os dados a mais da base -->
                <?php 
                $imoveis_meta_data = get_post_meta( $post->ID ); ?>
                <dl class="single-imovel-informacoes">
                    <dt>Preço:</dt>
                    <dd><?= $imoveis_meta_data['preco_id'][0]; ?></dd>
                </dl>

                <dl class="single-imovel-informacoes">
                    <dt>Vagas:</dt>
                    <dd><?= $imoveis_meta_data['vagas_id'][0]; ?></dd>
                </dl>

                <dl class="single-imovel-informacoes">
                    <dt>Banheiro:</dt>
                    <dd><?= $imoveis_meta_data['banheiros_id'][0]; ?></dd>
                </dl>

                <dl class="single-imovel-informacoes">
                    <dt>Quartos:</dt>
                    <dd><?= $imoveis_meta_data['quartos_id'][0]; ?></dd>
                </dl>
            </section>
            <span class="single-imovel-data">
            <?php the_date(); ?>
            </span>
        </div>
    <?php
        }
    }
?>

    </article>
</main>
<?php get_footer(); ?>  