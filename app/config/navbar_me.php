<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Hem',   
            'url'   => '',  
            'title' => 'Hem'
        ],
 
        // This is a menu item
        'texts'  => [
            'text'  => 'Redovisning',   
            'url'   => 'redovisning',   
            'title' => 'Redovisning',
/*
            'submenu' => [
                'items' => [

                    // This is a menu item of the submenu
                    'item 1'  => [
                        'text'  => 'Kmom1',   
                        'url'   => 'redovisning/kmom1',  
                        'title' => 'Kursmoment 1'
                    ],

                    // This is a menu item of the submenu
                    'item 2'  => [
                        'text'  => 'Kmom2',   
                        'url'   => 'redovisning/kmom2',  
                        'title' => 'Kursmoment 2'
                    ],
                ],
            ],
            */
        ],
 
        // This is a menu item
        'source' => [
            'text'  =>'Källkod', 
            'url'   =>'source',  
            'title' => 'Källkod'
        ],
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
