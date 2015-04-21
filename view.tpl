<html lang="fr">
<head>
    <link rel="stylesheet" href="web/css/bootstrap.min.css">
</head>
<body>

<div class = "container">

    <form class="form-signin" action="" method="get">

        <h2>Welcome !</h2>

        <div class="form-group">
            <label for="long_url">Enter the Long Url here please</label>
            <input type="url" class="form-control" id="long_url" name="long_url" required placeholder="Enter an url" value={if isset($long_url)} {$long_url} {else} http:// {/if}"">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>

    {if isset($short_url)}
      <p>The short url is : {$short_url}</p>
    {/if}

</div>

</body>
</html>
