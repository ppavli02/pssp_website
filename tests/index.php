<html>
<head>
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="//raw.github.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<div id="content">Dynamic Content goes here</div>
<div id="page-selection">Pagination goes here</div>
<script>
    // init bootpag
    $('#page-selection').bootpag({
        total: 10
    }).on("page", function (event, /* page number here */ num) {
        $("#content").html("Insert content"); // some ajax content loading...
    });
</script>
</body>
</html>