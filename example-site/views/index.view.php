<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Variables</title>
</head>
<body>
    <h1><?= $title ?></h1>

    <p>Welcome to php  view</p>

    <p>Email</p>

    <form action="index.php" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" />
        </div>
        <button type="submit">Submit</button>
    </form>

    <pre>
        <?php
        var_dump($_SERVER);
        ?>
    </pre>

</body>
</html>