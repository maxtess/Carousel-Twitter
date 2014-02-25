Carousel-Twitter
================

Gestion simple d'un carrousel en relation avec le bootstrap Twitter.

```php
/* Configuration */
$aOptions = array(
    'name'          => 'home',      /* Nom du carousel défini dans l'id de la div global. */
    'type'          => 'slide',     /* Type de carousel */
    'arrows'        => true,        /* Affichage des flèches */
    'indicators'    => true,        /* Affichage des indicateurs */
);

/* Création du carousel */
$oCarousel = new Carousel($aOptions);

/* Ajout des éléments */
$oCarousel  ->setItem(array('content' => 'Item 1', 'active' => true))
            ->setItem(array('content' => 'Item 2'))
            ->setItem(array('content' => 'Item 3'));

/* Jquery */
?>
<script type="text/javascript">
$('.carousel').carousel({
    interval: 5000
});
</script>
<?php

/* Affichage */
echo $oCarousel->display();
```
