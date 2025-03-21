const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');

let player = { x: 100, y: 300, width: 50, height: 50, color: 'red', health: 100 };
let opponent = { x: 600, y: 300, width: 50, height: 50, color: 'blue', health: 100 };

function drawCharacter(character) {
    ctx.fillStyle = character.color;
    ctx.fillRect(character.x, character.y, character.width, character.height);
}

function update() {
    document.addEventListener('keydown', function(event) {
        switch (event.key) {
            case 'ArrowUp': 
                player.y -= 5; // Jump
                break;
            case 'ArrowDown': 
                player.y += 5; // Crouch
                break;
            case 'ArrowLeft': 
                player.x -= 5; // Move Left
                break;
            case 'ArrowRight': 
                player.x += 5; // Move Right
                break;
        }
    });

    // Basic opponent AI
    if (opponent.x > player.x) {
        opponent.x -= 3; // Move towards player
    } else {
        opponent.x += 3;
    }

    // Collision detection
    if (Math.abs(player.x - opponent.x) < 50 && Math.abs(player.y - opponent.y) < 50) {
        // Simple attack logic
        opponent.health -= 1;
        player.health -= 1;
    }
}

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawCharacter(player);
    drawCharacter(opponent);

    // Draw health bars
    ctx.fillStyle = 'black';
    ctx.fillText(`Player Health: ${player.health}`, 10, 10);
    ctx.fillText(`Opponent Health: ${opponent.health}`, 650, 10);
}

function gameLoop() {
    update();
    draw();
    requestAnimationFrame(gameLoop);
}

gameLoop();
