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
 
        'about'  => [
            'text'  => 'Om',   
            'url'   => 'about',  
            'title' => 'Om'
        ],       

        // This is a menu item
        'texts'  => [
            'text'  => 'Redovisning',   
            'url'   => 'redovisning/kmom1',   
            'title' => 'Redovisning',

            'submenu' => [
                'items' => [

                    'item 1'  => [
                        'text'  => 'Kmom1',   
                        'url'   => 'redovisning/kmom1',  
                        'title' => 'Kursmoment 1'
                    ],

                    'item 2'  => [
                        'text'  => 'Kmom2',   
                        'url'   => 'redovisning/kmom2',  
                        'title' => 'Kursmoment 2'
                    ],

                    'item 3'  => [
                        'text'  => 'Kmom3',   
                        'url'   => 'redovisning/kmom3',  
                        'title' => 'Kursmoment 3'
                    ],
                    'item 4'  => [
                        'text'  => 'Kmom4',   
                        'url'   => 'redovisning/kmom4',  
                        'title' => 'Kursmoment 4'
                    ],
                ],
            ],
        ],

        'theme' => [
            'text'  =>'Temat', 
            'url'   =>'theme-show.php',  
            'title' => 'Temat',
        ],

        'users' => [
            'text'  => 'Användare',
            'url'   => 'users/list',
            'title' =>  'Användare',
            'submenu' => [
                'items' => [
                    'item 1'  => [
                        'text'  => 'Alla',   
                        'url'   => 'users/list',  
                        'title' => 'Alla användare'
                    ],

                    'item 2'  => [
                        'text'  => 'Aktiva',   
                        'url'   => 'users/active',  
                        'title' => 'Aktiva användare'
                    ],

                    'item 3'  => [
                        'text'  => 'Inaktiva',   
                        'url'   => 'users/inactive', 
                        'title' => 'Inaktiva användare'
                    ],

                    'item 4'  => [
                        'text'  => 'Papperskorg',   
                        'url'   => 'users/waste', 
                        'title' => 'Papperskorg'
                    ],

                    'item 5'  => [
                        'text'  => 'Skapa användare',   
                        'url'   => 'users/add', 
                        'title' => 'Skapa användare'
                    ],

                    'item 6'  => [
                        'text'  => 'Återställ DB',   
                        'url'   => 'users/setup', 
                        'title' => 'Återställ databas'
                    ]
                ]
            ]
        ],
 
        'source' => [
            'text'  =>'Källkod', 
            'url'   =>'source',  
            'title' => 'Källkod'
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
