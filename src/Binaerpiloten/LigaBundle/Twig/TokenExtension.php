<?php

namespace Binaerpiloten\LigaBundle\Twig;

class TokenExtension extends \Twig_Extension {

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }
    
    public function getFunctions() {
        return array(new \Twig_SimpleFunction('globalGetToken', array($this, 'globalGetToken')));
    }

    public function globalGetToken() {
        $csrfToken = $this->container->has('form.csrf_provider')
        ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
        : null;
        
        return $csrfToken;
    }

    public function getName()
    {
        return 'token_extension';
    }
}