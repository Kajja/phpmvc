<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu structure
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Hem',   
            'url'   => '',  
            'title' => 'Hem'
        ],
        'regions' => [
            'text'  =>'Regioner', 
            'url'   =>'theme-show.php/theme/regions',  
            'title' => 'Regioner',
        ],
        'grid' => [
            'text'  =>'Rutnät', 
            'url'   =>'theme-show.php/theme/grid',  
            'title' => 'Rutnät',
        ],
        'typo' => [
            'text'  =>'Typografi', 
            'url'   =>'theme-show.php/theme/typo',  
            'title' => 'Typografi',
        ],
        'font' => [
            'text'  =>'Font Awesome', 
            'url'   =>'theme-show.php/theme/font',  
            'title' => 'Font Awesome',
        ]
    ],
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if ($url == $this->di->get('request')->getRoute()) {
            return true;
        }
    },

    // Callback to create the urls
    'create_url' => function($url) {
        return $this->di->get('url')->create($url);
    },
];
