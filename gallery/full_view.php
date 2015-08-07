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
                
                <div class="full">
                    <?php
                    echo "<img src='{$fullimage['url']}' alt='{$fullimage['alt']}'>";
                    ?>                   
                </div>
                <div id="options">
                <?php if ($_SESSION['admin'] == TRUE) { ?>
                    <a href="/lynn?action=deleteImg&amp;edimg=<?php echo $fullimage['imageID']; ?>">Delete</a>
                    <a href="/lynn?action=updateimgform&amp;imageID=<?php echo $fullimage['imageID']; ?>">Update</a>
                <?php } ?>
                </div>
            </main>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>

</html>