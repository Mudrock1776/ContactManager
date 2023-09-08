// setup
let canvas = document.getElementById('canvas1');
// let canvas = document.getElementById('canvas1');

const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
// canvas.height = window.innerHeight;
console.log(ctx);
let gradient = ctx.createLinearGradient(canvas.width / 2, 0, canvas.width / 2, canvas.height);
// const gradient = ctx.createLinearGradient(canvas.width / 2, 0, canvas.width / 2, canvas.height);

gradient.addColorStop(0, 'rgba(200, 200, 1, 1)');
gradient.addColorStop(0.5, 'rgba(0, 300, 128, 1)');
gradient.addColorStop(0.7, 'rgba(100, 210, 210, 1)');
gradient.addColorStop(1, 'rgba(100, 210, 210, 0)');

// gradient.addColorStop(0, 'white');
// gradient.addColorStop(1, 'red');
ctx.fillStyle = gradient;
// ctx.strokeStyle = 'hsl(100, 100%, 50%)';

ctx.strokeStyle = gradient;

// handles window resizing
function resizeCanvas() {
    // canvas width and height are set to new window width and height
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    //gradient = ctx.createLinearGradient(canvas.width / 2, 0, canvas.width / 2, canvas.height);

    // recreate canvas gradiewnt
    gradient = ctx.createLinearGradient(canvas.width / 2, 0, canvas.width / 2, canvas.height);
    // recreate gradient stop values
    gradient.addColorStop(0, 'rgba(200, 200, 1, 1)');
    gradient.addColorStop(0.5, 'rgba(0, 300, 128, 1)');
    gradient.addColorStop(0.7, 'rgba(100, 210, 210, 1)');
    gradient.addColorStop(1, 'rgba(100, 210, 210, 0)');

    // gradient.addColorStop(0, 'white');
    // gradient.addColorStop(1, 'red');

    // reset where effect takes place
    effect.width = canvas.width;
    effect.height = canvas.height;

    // color of dots and lines set back to original colors
    ctx.fillStyle = gradient;
    ctx.strokeStyle = gradient;
    //
}

//listens for window resize event
window.addEventListener('resize', () => {
    resizeCanvas();
})

class Particle {
    constructor(effect){
        this.effect = effect;
        this.radius = Math.random() * 3 + 1;
        this.x = this.radius + Math.random() * (this.effect.width - this.radius * 2);
        // this.x = Math.random() * this.effect.width;
        // this.y = Math.random() * this.effect.height;
        this.y = this.radius + Math.random() * (this.effect.height - this.radius * 2);
        this.vx = (Math.random() * 1 - 0.5) * 0.5;
        this.vy = (Math.random() * 1 - 0.5) * 0.5;
    }
    draw(context){
        context.beginPath();
        context.arc(this.x, this.y, this.radius, 0, Math.PI *2);
        context.fill();
        //context.stroke();
    }
    update(){
        this.x += this.vx;
        if (this.x > this.effect.width - this.radius || this.x < this.radius) this.vx *= -1;
        this.y += this.vy;
        if (this.y > this.effect.height - this.radius || this.y < this.radius) this.vy *= -1;

    }
}

class Effect {
    constructor(canvas){
        this.canvas = canvas;
        this.width = this.canvas.width;
        this.height = this.canvas.height;
        this.particles = [];
        this.numberOfParticles = 150;
        this.createParticles();
    }
    createParticles(){
        for (let i = 0; i < this.numberOfParticles; i++) {
            this.particles.push(new Particle(this));
        }
    }
    handleParticles(context){
        this.connectParticles(context);
        this.particles.forEach(particle => {
            particle.draw(context);
            particle.update();
        })
    }
    connectParticles(context){
        const maxDistance = 150;
        for (let a = 0; a < this.particles.length; a++){
            for (let b = a; b < this.particles.length; b++){
                const dx = this.particles[a].x - this.particles[b].x;
                const dy = this.particles[a].y - this.particles[b].y;
                const distance = Math.hypot(dx, dy);
                if (distance < maxDistance){
                    context.save();
                    const opacity = 1 - (distance/maxDistance);
                    context.globalAlpha = opacity;
                    context.beginPath();
                    context.moveTo(this.particles[a].x, this.particles[a].y);
                    context.lineTo(this.particles[b].x, this.particles[b].y);
                    context.stroke();
                    context.restore();
                }
            }
        }
    }
}
const effect = new Effect(canvas);
effect.handleParticles(ctx);

function animate(){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    effect.handleParticles(ctx);
    requestAnimationFrame(animate);
}
animate();

// i want to go through the video again sometime soon to get a better understanding of the logic.