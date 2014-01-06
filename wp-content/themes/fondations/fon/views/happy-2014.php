<!doctype html>
<html lang="fr-FR" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>2014</title>
    <style>

        body,
        html {
            height: 100%;
        }

        body {
            min-height: 100%;
            font: 62.5%/1 sans-serif;
            margin: 0;
            position: relative;
            background-color: #8b1b28;
            background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+CjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0iIzhiMWIyOCI+PC9yZWN0Pgo8Y2lyY2xlIGN4PSIxMCIgY3k9IjEwIiByPSIzIiBmaWxsPSIjOTYxRDJDIj48L2NpcmNsZT4KPC9zdmc+");
        }

        .hero {
            position: relative;
            width: 400px;
            height: 100%;
            margin: 0 auto;
            text-align: center;
            -webkit-perspective: 700;
            -moz-perspective: 700;
            perspective: 700;
        }

        .el {
            position: absolute;
            top: 0;
            left: 0;
            margin-left: -25px;
            min-height: 240px;
            width: 6px;
            /*background-color: #efefef;*/
            /*background-color: #ffffff;background-image:url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPSc0MDAnIGhlaWdodD0nNDAwJyB2aWV3Qm94PScwIDAgNDAwIDQwMCc+CjxkZWZzPgoJPHBhdHRlcm4gaWQ9J2JsdWVzdHJpcGUnIHBhdHRlcm5Vbml0cz0ndXNlclNwYWNlT25Vc2UnIHg9JzAnIHk9JzAnIHdpZHRoPScxMCcgaGVpZ2h0PScyMCcgdmlld0JveD0nMCAwIDUgMTAnID4KCQk8cmVjdCB4PSctNScgeT0nLTUnIHdpZHRoPScxNScgaGVpZ2h0PScyMCcgZmlsbD0nI2ZmZmZmZicvPgoJCTxsaW5lIHgxPSctMicgeTE9JzEnIHgyPSc3JyB5Mj0nMTAnIHN0cm9rZT0nI2ZhZmFmYScgc3Ryb2tlLXdpZHRoPScyJy8+CgkJPGxpbmUgeDE9Jy0yJyB5MT0nNicgeDI9JzcnIHkyPScxNScgc3Ryb2tlPScjZmFmYWZhJyBzdHJva2Utd2lkdGg9JzInLz4KCQk8bGluZSB4MT0nLTInIHkxPSctNCcgeDI9JzcnIHkyPSc1JyBzdHJva2U9JyNmYWZhZmEnIHN0cm9rZS13aWR0aD0nMicvPgoJCTxsaW5lIHgxPSc3JyB5MT0nMScgeDI9Jy0yJyB5Mj0nMTAnIHN0cm9rZT0nI2Y1ZjVmNScgc3Ryb2tlLXdpZHRoPScyJy8+CgkJPGxpbmUgeDE9JzcnIHkxPSc2JyB4Mj0nLTInIHkyPScxNScgc3Ryb2tlPScjZjVmNWY1JyBzdHJva2Utd2lkdGg9JzInLz4KCQk8bGluZSB4MT0nNycgeTE9Jy00JyB4Mj0nLTInIHkyPSc1JyBzdHJva2U9JyNmNWY1ZjUnIHN0cm9rZS13aWR0aD0nMicvPgoJPC9wYXR0ZXJuPiAKCTxmaWx0ZXIgaWQ9J2Z1enonIHg9JzAnIHk9JzAnPgoJCTxmZVR1cmJ1bGVuY2UgdHlwZT0ndHVyYnVsZW5jZScgcmVzdWx0PSd0JyBiYXNlRnJlcXVlbmN5PScuMiAuMScgbnVtT2N0YXZlcz0nMicgc3RpdGNoVGlsZXM9J3N0aXRjaCcvPgoJCTxmZUNvbG9yTWF0cml4IHR5cGU9J3NhdHVyYXRlJyBpbj0ndCcgdmFsdWVzPScwLjQnLz4KCQk8ZmVDb252b2x2ZU1hdHJpeCBvcmRlcj0nMywzJyBrZXJuZWxNYXRyaXg9JzAsLS4yNSwwLC0uMjUsMiwtLjI1LDAsLS4yNSwwJy8+Cgk8L2ZpbHRlcj4KPC9kZWZzPgo8cmVjdCB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJyBmaWxsPSd1cmwoI2JsdWVzdHJpcGUpJy8+CjxyZWN0IHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnIGZpbHRlcj0ndXJsKCNmdXp6KScgb3BhY2l0eT0nMC4xJy8+Cjwvc3ZnPg==');*/
            /*background-color: #ffffff;background-image:url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPSc0MDAnIGhlaWdodD0nNDAwJyB2aWV3Qm94PScwIDAgNDAwIDQwMCc+CjxkZWZzPgoJPHBhdHRlcm4gaWQ9J2JsdWVzdHJpcGUnIHBhdHRlcm5Vbml0cz0ndXNlclNwYWNlT25Vc2UnIHg9JzAnIHk9JzAnIHdpZHRoPSczLjEnIGhlaWdodD0nNi4yJyB2aWV3Qm94PScwIDAgNSAxMCcgPgoJCTxyZWN0IHg9Jy01JyB5PSctNScgd2lkdGg9JzE1JyBoZWlnaHQ9JzIwJyBmaWxsPScjZmZmZmZmJy8+CgkJPGxpbmUgeDE9Jy0yJyB5MT0nMScgeDI9JzcnIHkyPScxMCcgc3Ryb2tlPScjZmFmYWZhJyBzdHJva2Utd2lkdGg9JzEuNjMnLz4KCQk8bGluZSB4MT0nLTInIHkxPSc2JyB4Mj0nNycgeTI9JzE1JyBzdHJva2U9JyNmYWZhZmEnIHN0cm9rZS13aWR0aD0nMS42MycvPgoJCTxsaW5lIHgxPSctMicgeTE9Jy00JyB4Mj0nNycgeTI9JzUnIHN0cm9rZT0nI2ZhZmFmYScgc3Ryb2tlLXdpZHRoPScxLjYzJy8+CgkJPGxpbmUgeDE9JzcnIHkxPScxJyB4Mj0nLTInIHkyPScxMCcgc3Ryb2tlPScjZjVmNWY1JyBzdHJva2Utd2lkdGg9JzEuNjMnLz4KCQk8bGluZSB4MT0nNycgeTE9JzYnIHgyPSctMicgeTI9JzE1JyBzdHJva2U9JyNmNWY1ZjUnIHN0cm9rZS13aWR0aD0nMS42MycvPgoJCTxsaW5lIHgxPSc3JyB5MT0nLTQnIHgyPSctMicgeTI9JzUnIHN0cm9rZT0nI2Y1ZjVmNScgc3Ryb2tlLXdpZHRoPScxLjYzJy8+Cgk8L3BhdHRlcm4+IAoJPGZpbHRlciBpZD0nZnV6eicgeD0nMCcgeT0nMCc+CgkJPGZlVHVyYnVsZW5jZSB0eXBlPSd0dXJidWxlbmNlJyByZXN1bHQ9J3QnIGJhc2VGcmVxdWVuY3k9Jy4yIC4xJyBudW1PY3RhdmVzPScyJyBzdGl0Y2hUaWxlcz0nc3RpdGNoJy8+CgkJPGZlQ29sb3JNYXRyaXggdHlwZT0nc2F0dXJhdGUnIGluPSd0JyB2YWx1ZXM9JzAuNCcvPgoJCTxmZUNvbnZvbHZlTWF0cml4IG9yZGVyPSczLDMnIGtlcm5lbE1hdHJpeD0nMCwtLjI1LDAsLS4yNSwyLC0uMjUsMCwtLjI1LDAnLz4KCTwvZmlsdGVyPgo8L2RlZnM+CjxyZWN0IHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnIGZpbGw9J3VybCgjYmx1ZXN0cmlwZSknLz4KPHJlY3Qgd2lkdGg9JzEwMCUnIGhlaWdodD0nMTAwJScgZmlsdGVyPSd1cmwoI2Z1enopJyBvcGFjaXR5PScwLjEnLz4KPC9zdmc+');*/
            /*border-right: 1px solid #efefef;*/
            background-image: url(<?php echo ASSETS_URL; ?>/img/demos/rope.svg);
            background-size: contain;
            background-repeat: repeat-y;
        }

        .el + .el { left: 100px; }
        .el + .el + .el { left: 200px; }
        .el + .el + .el + .el { left: 300px; }
        .el + .el + .el + .el + .el { left: 400px; }

        .l {
            position: absolute;
            bottom: -58px;
            left: -26px;
            display: inline-block;
            width: 60px;
            height: 60px;
            line-height: 40px;
            font-size: 30px;
            font-weight: bold;
            color: #efefef;
            /*background-color: #d04c4f;*/
            cursor: pointer;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-transition: all 1.2s cubic-bezier(.05,.65,1,1.2);
            transition: all 2.2s cubic-bezier(.05,.65,.67,.99);
        }

        .l .front,
        .l .back {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 40px;
            height: 40px;
            padding: 10px;
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .l .front {
            z-index: 10;
            background-color: #d04c4f;
            -webkit-transform: rotateY( 0deg ) translateZ(1px);
            transform: rotateY(0deg);
        }

        .l .back {
            z-index: 1;
            /*background: #3164C1;*/
            background: #B9E421;
            -webkit-transform: rotateY( 180deg ) translateZ(-1px);
            transform: rotateY(180deg);
        }

        .l.to-rotate {
            -webkit-transform: rotateY( -540deg );
            transform: rotateY( -540deg);
        }

        .l.to-rotate-back {
            -webkit-transition: all 1.2s cubic-bezier(.75,.65,.65,1);
            transition: all 1.2s cubic-bezier(.75,.65,.65,1);
            -webkit-transform: rotateY( 12deg );
            transform: rotateY( 12deg);
        }


        /* Anims */

        .l.wiggle {
            -webkit-animation: wiggle 6s 0 infinite ease-in-out;
            animation: wiggle 6s 0 infinite ease-in-out;
        }

        .el + .el .l.wiggle {
            -webkit-animation-delay: 2.1s;
            animation-delay: 2.1s;
        }
        .el + .el + .el .l.wiggle {
            -webkit-animation-delay: 1.8s;
            animation-delay: 1.8s;
        }
        .el + .el + .el + .el .l.wiggle {
            -webkit-animation-delay: 4.6s;
            animation-delay: 4.6s;
        }
        .el + .el + .el + .el .l.wiggle {
            -webkit-animation-delay: 3.6s;
            animation-delay: 3.6s;
        }

        @-webkit-keyframes wiggle {
            from {
                -webkit-transform: rotateY( 0deg );
                transform: rotateY( 0deg);
            }
            25% {
                -webkit-transform: rotateY( -19deg );
                transform: rotateY( -19deg);
            }
            75% {
                -webkit-transform: rotateY( 28deg );
                transform: rotateY( 28deg);
            }
            to {
                -webkit-transform: rotateY( 0deg );
                transform: rotateY( 0deg);
            }
        }
        @keyframes wiggle {
            from {
                -webkit-transform: rotateY( 0deg );
                transform: rotateY( 0deg);
            }
            25% {
                -webkit-transform: rotateY( -19deg );
                transform: rotateY( -19deg);
            }
            75% {
                -webkit-transform: rotateY( 28deg );
                transform: rotateY( 28deg);
            }
            to {
                -webkit-transform: rotateY( 0deg );
                transform: rotateY( 0deg);
            }
        }

    </style>
</head>
<body>

    <div class="hero">
        <?php
        $letters = array( array('B', 'A'), array('O', 'N'), array('N', 'N'), array('N', 'É'), array('E', 'E') );
        foreach( $letters as $ls ) { ?>
            <div class="el"><div class="l wiggle"><div class="front"><?php echo $ls[0] ?></div><div class="back"><?php echo $ls[1] ?></div></div></div>
        <?php } ?>
    </div>

    <script type="text/javascript">

        // https://github.com/cferdinandi/buoy
        var classList = document.documentElement.classList;
        var hasClass = function (elem, className) {
            if ( classList ) {
                return elem.classList.contains(className);
            } else {
                return new RegExp('(^|\\s)' + className + '(\\s|$)').test(elem.className);
            }
        };

        var duration = 1200 + 1000;
        var letters = document.querySelectorAll('.l');
        Array.prototype.forEach.call( letters, function(letter) {
            letter.addEventListener('mouseover', function(event) {
                if( ! hasClass(letter, 'wiggle') ) return;

                letter.classList.toggle('to-rotate');
                letter.classList.remove('wiggle');
                letter.classList.remove('to-rotate-back');

                setTimeout(function() {
                    letter.classList.remove('to-rotate');
                    letter.classList.toggle('to-rotate-back');
                    setTimeout(function() {
                        letter.classList.add('wiggle');
                        letter.classList.remove('to-rotate-back');
                    }, duration);
                }, duration);
            });
        });
    </script>

</body>
</html>