<?php

namespace Binaerpiloten\LigaBundle\Twig;

class StandingExtension extends \Twig_Extension {

    public function __construct() {
    }
    
    public function getFunctions() {
        return array(new \Twig_SimpleFunction('globalStandingBar', array($this, 'globalStandingBar')));
    }

    public function globalStandingBar($name,$wintotal,$losstotal) {
    	$ret = ".standing-".$name." {";
    	$ret .= "	width: 240px;";
    	$ret .= "	height: 30px;";
    	$ret .= "	background: #8fc800; /* Old browsers */";
    	$ret .= "	background: -moz-linear-gradient(left,  #8fc800 0%, #c6c000 ".$wintotal."%, #c6c000 ".$losstotal."%, #c60000 100%); /* FF3.6+ */";
    	$ret .= "	background: -webkit-gradient(linear, left top, right top, color-stop(0%,#8fc800), color-stop(".$wintotal."%,#c6c000), color-stop(".$losstotal."%,#c6c000), color-stop(100%,#c60000)); /* Chrome,Safari4+ */";
    	$ret .= "	background: -webkit-linear-gradient(left,  #8fc800 0%,#c6c000 ".$wintotal."%,#c6c000 ".$losstotal."%,#c60000 100%); /* Chrome10+,Safari5.1+ */";
    	$ret .= "	background: -o-linear-gradient(left,  #8fc800 0%,#c6c000 ".$wintotal."%,#c6c000 ".$losstotal."%,#c60000 100%); /* Opera 11.10+ */";
    	$ret .= "	background: -ms-linear-gradient(left,  #8fc800 0%,#c6c000 ".$wintotal."%,#c6c000 ".$losstotal."%,#c60000 100%); /* IE10+ */";
    	$ret .= "	background: linear-gradient(to right,  #8fc800 0%,#c6c000 ".$wintotal."%,#c6c000 ".$losstotal."%,#c60000 100%); /* W3C */";
    	$ret .= "	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8fc800', endColorstr='#c60000',GradientType=1 ); /* IE6-9 */";
    	$ret .= "}";
    	
      return $ret;
    }

    public function getName()
    {
        return 'standing_extension';
    }
}