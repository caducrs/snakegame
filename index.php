<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Cobrinha!</title>
    <p>@caducrs</p>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Código JavaScript do jogo será incluído aqui
    </script>
</head>
<body>
    <h1>Jogo da Cobrinha</h1>
    <canvas id="gameCanvas" width="400" height="400"></canvas>
    <script>
        const canvas = document.getElementById('gameCanvas');
        const context = canvas.getContext('2d');
        const grid = 20;
        let count = 0;
        let snake = [{x: 160, y: 160}, {x: 140, y: 160}, {x: 120, y: 160}, {x: 100, y: 160}];
        let food = {x: 320, y: 320};
        let dx = grid;
        let dy = 0;

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }

        function loop() {
            requestAnimationFrame(loop);
            if (++count < 4) return;
            count = 0;

            context.clearRect(0, 0, canvas.width, canvas.height);

            snake.unshift({x: snake[0].x + dx, y: snake[0].y + dy});

            if (snake[0].x === food.x && snake[0].y === food.y) {
                food.x = getRandomInt(0, 25) * grid;
                food.y = getRandomInt(0, 25) * grid;
            } else {
                snake.pop();
            }

            context.fillStyle = 'red';
            context.fillRect(food.x, food.y, grid - 1, grid - 1);

            context.fillStyle = 'purple';
            snake.forEach(function (part) {
                context.fillRect(part.x, part.y, grid - 1, grid - 1);
            });

            for (let i = 4; i < snake.length; i++) {
                if (snake[0].x === snake[i].x && snake[0].y === snake[i].y) {
                    snake = [{x: 160, y: 160}, {x: 140, y: 160}, {x: 120, y: 160}, {x: 100, y: 160}];
                    dx = grid;
                    dy = 0;
                    break;
                }
            }

            if (snake[0].x < 0 || snake[0].x >= canvas.width || snake[0].y < 0 || snake[0].y >= canvas.height) {
                snake = [{x: 160, y: 160}, {x: 140, y: 160}, {x: 120, y: 160}, {x: 100, y: 160}];
                dx = grid;
                dy = 0;
            }
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft' && dx === 0) {
                dx = -grid;
                dy = 0;
            } else if (e.key === 'ArrowUp' && dy === 0) {
                dx = 0;
                dy = -grid;
            } else if (e.key === 'ArrowRight' && dx === 0) {
                dx = grid;
                dy = 0;
            } else if (e.key === 'ArrowDown' && dy === 0) {
                dx = 0;
                dy = grid;
            }
        });

        requestAnimationFrame(loop);
    </script>
</body>
</html>
