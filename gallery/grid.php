<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home | LynnPagelPhotography.com</title>
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
                
                <?php echo "<h1>$catName</h1>" ?>
                <div id='grid_view' class='thumbs'>
                    <?php
                    foreach ($images as $image) {
                        echo
                        "<a href='/lynn/index.php?action=fullview&amp;imageID={$image['imageID']}' title='Click to view'><img src='{$image['url']}' alt='{$image['alt']}'></a>";
                    }
                    ?></div>
            </main>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>

</html>
