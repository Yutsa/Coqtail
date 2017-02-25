<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

        <?php $foo = "prout"; ?>
        <script type="text/javascript">
            var foo = '<?php echo $foo ?>';
            console.log(foo);
        </script>
    </body>
</html>
