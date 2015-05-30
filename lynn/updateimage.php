<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update | LynnPagelPhotography.com</title>
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

                <h1>Update</h1>
                <?php
                if (isset($message)) {
                    echo '<p class="notice">' . $message . '</p>';
                }
                ?>
                
                    <form action="." method="post" id="updateimgform" enctype="multipart/form-data">
                        <fieldset id="updateimgfield">
                            <!--              <label for="fileToUpload">Select Image To Upload:</label>
                                          <input type="file" name="fileToUpload" id="fileToUpload"><br>-->
                            <label for="alt">Alt For Image:</label>
                            <input type="text" name="alt" id="alt" value="<?php echo $image['alt']; ?>"> <br>
                            <input type="hidden" name="imageID" value="<?php echo $image['imageID']; ?>">
                            <label>&nbsp;</label>
                            <select name="catID">
                                <?php
                                foreach ($categories as $category) {
                                    echo "<option value = '{$category['catID']}'";
                                    if ($image['catID'] == $category['catID']) {
                                        echo 'selected';
                                    }
                                    echo ">{$category['catName']}</option>";
                                }
                                ?>
                            </select>
                            <input type="submit" value="Upload Image" class="button" name="submit">
                            <input type="hidden" name="action" value="updateimg">
                        </fieldset>
                    </form>
                
            </main>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>

</html>