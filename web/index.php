<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        #myTable {
            border-collapse: collapse;
            text-align: center;
            border: solid #000000 2px;
            color: #386092;
            font-size: 20px;
            margin: 30px;
        }

        #myTable tr td {
            border: solid #000000 1px;
            padding: 6px;
        }

        .bgColor {
            background-color: #95B3D7;
            color: #000000;
            font-weight: bold;
        }

        body {
            padding: 30px;
        }

        select {
            margin: 30px;
        }
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('select').change(function () {
                var d = {
                    year: $('#select option:selected').text()
                };
                $.ajax({
                    type: 'POST',
                    url: 'post.php',
                    data: d,
                    success: function (code) {
                        $('#result').html(code);
                    }
                });
            });

            var d = {
                select: $('#select option:selected').text()
            };
            $.ajax({
                type: 'POST',
                url: 'post.php',
                data: d,
                success: function (code) {
                    $('#result').html(code);
                }
            });
        });

    </script>
    <title>Title</title>
</head>
<body>
<?php
$db = new db();
$link = $db->dbConnect();
$array = $db->yearList($link);
?>
<select id="select">
    <?php
    foreach ($array as $key => $val) {
        echo '<option>' . $val['year'] . '</option>';
    }
    ?>
</select>

<div id="result">

</div>
</body>
</html>




