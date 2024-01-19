<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1><?= $article->title ?></h1>
    <p><?= $article->formatPublishDate("m-d-y") ?></p>
    <p><?= $article->description ?></p>

    <?php // TODO: links to next and previous ?>
    <a href="index.php?page=articles-show&id=<?= $article->id?>&action=previous">Previous article</a>
    <a href="index.php?page=articles-show&id=<?= $article->id?>&action=next">Next article</a>
</section>

<?php require 'View/includes/footer.php'?>