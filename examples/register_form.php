<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'tail - S'inscrire</title>
        <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="static/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include_once '../core/favicon.inc.php'; ?>
    </head>
    <body>

        <form action="register.php" method="post">
            <input type="text" name="email" placeholder="Enter your email.">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="submit" name="submit" value="Valider">
        </form>

        <script type="text/javascript" src="static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="static/js/materialize.min.js"></script>
        <script src="static/js/custom.js" charset="utf-8"></script>
        <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    </body>
</html>
