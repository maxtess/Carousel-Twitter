<?php
/**
 * Classe Carousel qui cr�er un carousel de contenu avec le bootstrap Twitter.
 * @author Maxime Tessier <max77950@gmail.com>
 * @version 0.1.1
 */
class Carousel {
    
    /**
     * Tableau des configurations
     * @var type 
     */
    private $_aOptions = array();
    /**
     * Tableau des �l�ments.
     * @var array
     */
    private $_aItems   = array();
    /**
     * Nom par d�faut.
     * @var string
     */
    private $_sName    = '';
    /**
     * Type par d�faut.
     * @var string
     */
    private $_sType    = 'slide';
    
    /**
     * Ajoute les options de base pour la cr�ation du carousel
     * @param   array   $aOptions
     * 
     * Options :<br />
     * name         Nom du carousel d�fini dans l'id de la div global.<br />
     * type         Type de carousel<br />
     * arrows       Affichage des fl�ches<br />
     * indicators   Affichage des indicateurs<br />
     * <br /><br />
     * Exemple d'options des �l�ments :<br />
     * <code>
     * array(
     *     'name'       => 'carousel1',
     *     'type'       => 'slide',
     *     'arrows'     => true,
     *     'indicators' => true,
     * );
     * </code>
     */
    public function __construct( array $aOptions) {
        $this->_aOptions = $aOptions;
    }
    
    /**
     * Ajoute un �l�ment.
     * @param   array   $aItems
     * @return  Carousel
     * 
     * Options :<br />
     * Content      Contenu de l'�l�ment<br />
     * active       D�fini si l'�l�ment est le premier � afficher.( true | false )
     * <br /><br />
     * Exemple d'options des �l�ments :<br />
     * <code>
     * array(
     *     'content' => 'Item 1',
     *     'active'  => true,
     * );
     * </code>
     */
    public function setItem( array $aItems){
        $this->_aItems[] = $aItems;
        return $this;
    }
    
    /**
     * Cr�er les indicateurs.
     * @return  string
     * Les indicateurs sont les boutons ronds g�n�ralements en bas du carousel.
     * Ils indiques sur quel �l�ments on ce trouve et combien il y a d'�l�ments.
     */
    public function getIndicators() {
        
        $d = '<ol class="carousel-indicators">';
        for ($i = 0; $i < count($this->_aItems); $i++){
            $sActive = (array_key_exists('active', $this->_aItems[$i]) && true === $this->_aItems[$i]['active'])? 'class="active"':'';
            $d .= "<li data-target=\"#{$this->getName()}\" data-slide-to=\"{$i}\" {$sActive}></li>";
        }
        $d .= '</ol>';
        
        return $d;
    }
    
    /**
     * Cr�er la liste des �l�ments ( .item )
     * @return  string
     */
    public function getItems() {
        
        $d = '<div class="carousel-inner">';
        for ($i = 0; $i < count($this->_aItems); $i++){
            $sActive = (array_key_exists('active', $this->_aItems[$i]) && true === $this->_aItems[$i]['active'])? 'active':'';
            $d .= "<div class=\"{$sActive} item\" style=\"text-align: center;\">{$this->_aItems[$i]['content']}</div>";
        }
        $d .= '</div>';
        
        return $d;
    }
    
    /**
     * Affichage du carousel
     * @return  string
     */
    public function display() {
        ?>
        <div id="<?php echo $this->getName(); ?>" class="carousel <?php echo $this->getType(); ?>">
            <?php
            /* Carousel indicators */
            if ($this->_aOptions['indicators']){ echo $this->getIndicators(); } 
            
            /* Carousel items */
            echo $this->getItems();
            ?>
            <!-- Carousel nav -->
            <a class="carousel-control left" href="#<?php echo $this->getName(); ?>" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#<?php echo $this->getName(); ?>" data-slide="next">&rsaquo;</a>
        </div>
        <?php
    }
    
    /**
     * Retourne le nom du carousel.
     * @return  string
     * Si le nom n'est pas d�fini dans les options, le nom par d�faut est donn�.
     */
    private function getName(){
        return strtolower((array_key_exists('name', $this->_aOptions))? $this->_aOptions['name'] : $this->_sName);
    }
    
    /**
     * Retourne le type du carousel
     * @return  string
     * Si le type n'est pas d�fini dans les options, le type par d�faut est donn�.
     */
    private function getType(){
        return strtolower((array_key_exists('type', $this->_aOptions))? $this->_aOptions['type'] : $this->_sType);
    }
    
}

/* Configuration */
$aOptions = array(
    'name'          => 'home',      /* Nom du carousel d�fini dans l'id de la div global. */
    'type'          => 'slide',     /* Type de carousel */
    'arrows'        => true,        /* Affichage des fl�ches */
    'indicators'    => true,        /* Affichage des indicateurs */
);
/* Cr�ation du carousel */
$oCarousel = new Carousel($aOptions);
/* Ajout des �l�ments */
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
<?php /* Affichage */
echo $oCarousel->display();