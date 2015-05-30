<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home | LynnPagelPhotography.com</title>
        <!--        <link href="/css/screen.css" type="text/css" rel="stylesheet" media="screen">-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="banner">
            <div class="container">
                <div class="head-nav">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <ul>
                        <li>Home</li>
                        <li>Gallery</li>
                        <li>Contact</li>
                        <li>About Me</li>
                    </ul>
                    </button>
                </div>
                <script>
					$( "span.menu" ).click(function() {
					$( ".head-nav ul" ).slideToggle(300, function() {
					});
					});
		</script>	 
                <div class="logo">
                    <h1>Lynn Pagel Photography</h1>
                </div>
            </div>
        </div>
        
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js" type="text/javascript"></script>

    </body>

</html>