<?php

namespace mife\Theme;

class ThemeController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    
    public function regionsAction() {

        $this->theme->setTitle('Regioner');
		$this->theme->setVariable('bodyClasses', 'page-container region-test');

    	// For verifying regions in theme
    	 $this->views->addString('header', 'header')
                    ->addString('flash', 'flash')
                    ->addString('alert', 'alert')
                    ->addString('main', 'main')
                    ->addString('panel-col-1', 'panel-col-1')
                    ->addString('panel-col-2', 'panel-col-2')
                    ->addString('panel-col-3', 'panel-col-3')
                    ->addString('panel-col-4', 'panel-col-4')
                    ->addString('footer-col-1', 'footer-col-1')
                    ->addString('footer-col-2', 'footer-col-2')
                    ->addString('footer-col-3', 'footer-col-3');
    }

    public function gridAction() {

        $this->theme->setTitle('Rutnät');
        $this->theme->setVariable('bodyClasses', 'page-container region-test grid');

        // For verifying regions in theme
         $this->views->addString('header', 'header')
                    ->addString('flash', 'flash')
                    ->addString('alert', 'alert')
                    ->addString('main', 'main')
                    ->addString('panel-col-1', 'panel-col-1')
                    ->addString('panel-col-2', 'panel-col-2')
                    ->addString('panel-col-3', 'panel-col-3')
                    ->addString('panel-col-4', 'panel-col-4')
                    ->addString('footer-col-1', 'footer-col-1')
                    ->addString('footer-col-2', 'footer-col-2')
                    ->addString('footer-col-3', 'footer-col-3'); 
    }

    public function typoAction() {

        $this->theme->setTitle('Typografi');
		$this->theme->setVariable('bodyClasses', 'page-container grid');

    	$content = $this->fileContent->get('typography.html');
    	$this->views->addString($content, 'main')
    				->addstring($content, 'panel-col-1')
    				->addstring($content, 'panel-col-2')
    				->addstring($content, 'panel-col-3')
    				->addstring($content, 'panel-col-4')
                    ->addstring('header', 'header');
    }

    public function fontAction() {

        $this->theme->setTitle('Font Awesome');
		$this->theme->setVariable('bodyClasses', 'page-container');

    	$this->views->addString('<i class="fa fa-car fa-5x"></i>', 'main')
    				->addstring('<i class="fa fa-bicycle"></i>', 'panel-col-1')
    				->addstring('<i class="fa fa-bicycle fa-2x"></i>', 'panel-col-2')
    				->addstring('<i class="fa fa-bicycle fa-3x"></i>', 'panel-col-3')
    				->addstring('<i class="fa fa-bicycle fa-4x"></i>', 'panel-col-4')
    				->addstring('<i class="fa fa-cog fa-spin fa-4x"></i>', 'footer-col-1')
                    ->addstring('header', 'header');
    }
}