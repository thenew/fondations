<!doctype html>
<html lang="fr-FR" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>2014</title>
    <style>
        body {
            margin: 0;
            position: relative;
            background-color: #8b1b28;
        }

        .hero {
            width: 500px;
            margin: 0 auto;
            text-align: center;
        }

        .el {
            position: absolute;
            top: 0;
            right: 50%;
            margin-left: -25px;
            min-height: 350px;
            width: 1px;
            border-right: 1px solid #efefef;
        }

        .el + .el {
            left: 60%;
        }
        .el + .el + .el {
            margin-left: 105px;
        }

        .l {
            position: absolute;
            bottom: 0;
            left: -25px;
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #efefef;
            background-color: #d04c4f;
            -webkit-transition: all 2.2s cubic-bezier(.05,.65,.67,.99);
            transition: all 2.2s cubic-bezier(.05,.65,.67,.99);
        }
        .l:hover {
            transform: rotateY(500deg);
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="el"><div class="l">T</div></div>
        <div class="el"><div class="l">E</div></div>
        <div class="el"><div class="l">S</div></div>
        <div class="el"><div class="l">T</div></div>
    </div>
    <script type="text/javascript">
        var letters = document.querySelectorAll('.l');
        Array.prototype.forEach.call( letters, function(letter) {
            console.log(letter);
        });

    </script>
</body>
</html>