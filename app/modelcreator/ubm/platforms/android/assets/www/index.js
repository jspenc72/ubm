var stage;
var queue;

function init() {
    stage = new createjs.Stage("myCanvas");
    queue = new createjs.LoadQueue(false);
    queue.installPlugin(createjs.Sound);
    queue.addEventListener("complete", handleComplete);
    queue.loadManifest([{
        id: "flower",
        src: "assets/flower.png"
    }, {
        id: "sound", src: "assets/pop.mp3"
    }]);
}

function tick(event) {
    stage.update();
}

function handleClick(event) {
    var bmp = new createjs.Bitmap(queue.getResult("flower"));
    bmp.x = Math.random() * 500;
    bmp.y = Math.random() * 500;
    stage.addChild(bmp);
    createjs.Sound.play("sound");
}

function handleComplete(event) {
    var ball = new createjs.Shape();;
    ball.addEventListener("click", handleClick);
    ball.graphics.beginFill("#000").drawCircle(0, 0, 50);
    ball.x = 50;
    ball.y = 200;
    createjs.Tween.get(ball, {
        loop: true
    }).to({
        x: 450
    }, 3000).to({
        x: 50
    }, 3000);
    createjs.Ticker.addEventListener("tick", tick);
    stage.addChild(ball);
}