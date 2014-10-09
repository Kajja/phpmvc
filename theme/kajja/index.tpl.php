<!DOCTYPE html>
<html lang='<?=$lang;?>' class='<?=$htmlClasses;?>'>
    <head>
        <meta charset='utf-8'/>
        <title><?=$title;?></title>
        <link rel='shortcut icon' href='<?=$favicon;?>'>
    </head>
    <body class='<?=$bodyClasses;?>'>
        <?php if ($this->views->hasContent('header')) : ?>
        <header><?php $this->views->render('header'); ?></header>
        <?php endif; ?>

        <?php if ($this->views->hasContent('nav')) : ?>
        <nav><?php $this->views->render('nav'); ?></nav>
        <?php endif; ?>    
        
        <div id='alert'></div>
        <div id='flash'></div>
        
        <?php if ($this->views->hasContent('main')) : ?>
        <main>
            <?php $this->views->render('main'); ?>
        </main>
        <?php endif; ?>

        <div id='content'></div>
        <footer>
            <div>
                <div id='footer-col-1'></div>
                <div id='footer-col-2'></div>
                <div id='footer-col-3'></div>
            </div>
            <div id='footer'></div>
        </footer>
    </body>
</html>