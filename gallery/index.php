<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gallery | LynnPagelPhotography.com</title>
        <link href="/css/screen.css" type="text/css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div id="container">
            <header>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/login.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
            </header>
            <main>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php'; ?>
                
                <div id="switcher-wrapper">
                    <a id="one" href="/lynn/index.php?action=grid&amp;category=1"><span>Landscapes</span></a>
                    <a id="two" href="/lynn/index.php?action=grid&amp;category=2"><span>Still Life</span></a>
                    <a id="three" href="/lynn/index.php?action=grid&amp;category=3"><span>Portrait</span></a>           
                </div>
            </main>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>
</html>
