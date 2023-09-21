const chicken = document.getElementById('chicken');
let position = 20;
const maxX = window.innerWidth - chicken.clientWidth;

function moveChicken() {
    position += 10;
    if (position > maxX) {
        position = 20;
    }
    chicken.style.left = position + 'px';
    requestAnimationFrame(moveChicken);
}

moveChicken();