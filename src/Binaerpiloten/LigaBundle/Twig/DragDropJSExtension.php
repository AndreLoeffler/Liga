<?php

namespace Binaerpiloten\LigaBundle\Twig;

class DragDropJSExtension extends \Twig_Extension {

    public function __construct() {
    }
    
    public function getFunctions() {
        return array(new \Twig_SimpleFunction('globalDragDropJS', array($this,
        		 	'globalDragDropJS',
        			array('is_safe' => array('html'))
        )));
    }

    public function globalDragDropJS($element, $group) {
    	
    	$ret = "$(function  () {\n";
    	$ret .= "	$('".$element."').sortable({\n";
    	$ret .= "		group: '".$group."',\n";
    	$ret .= "		pullPlaceholder: false,\n";
    	$ret .= "		drop: false,\n";
    	$ret .= "		onDragStart: function (\$item, container, _super) {\n";
    	$ret .= "			var offset = \$item.offset(),\n";
    	$ret .= "			pointer = container.rootGroup.pointer\n";
    	$ret .= "			_super(\$item, container)\n";
    	$ret .= "		}\n";
    	$ret .= "	})\n";
    	$ret .= "})";
    	
      return $ret;
    }

    public function getName()
    {
        return 'dragdropjs_extension';
    }
}