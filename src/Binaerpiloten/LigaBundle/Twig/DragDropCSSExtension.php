<?php

namespace Binaerpiloten\LigaBundle\Twig;

class DragDropCSSExtension extends \Twig_Extension {

    public function __construct() {
    }
    
    public function getFunctions() {
        return array(new \Twig_SimpleFunction('globalDragDropCSS', array($this,
        		 	'globalDragDropCSS',
        			array('is_safe' => array('html'))
        )));
    }

    public function globalDragDropCSS($element) {
    	$ret = ".dragged {\n";
    	$ret .= "	position: absolute;\n";
    	$ret .= "	opacity: 0.5;\n";
    	$ret .= "	z-index: 2000;\n";
    	$ret .= "}\n";

    	$ret .= "ol.".$element." li.placeholder,\n";
    	$ret .= "	position: relative;\n";
    	$ret .= "	/** More li styles **/\n";
    	$ret .= "}\n";
    	
    	$ret .= "ol.source-test li.placeholder:before,\n";
    	$ret .= "	position: absolute;\n";
    	$ret .= "	/** Define arrowhead **/\n";
    	$ret .= "}";
    	
      return $ret;
    }

    public function getName()
    {
        return 'dragdropcss_extension';
    }
}