var canvas = document.getElementById( "c" ),
    ctx = canvas.getContext( "2d" );

ctx.lineWidth = 3;

ctx.beginPath();
ctx.arc( 500, 350, 60, 0, 2 * Math.PI, false );
ctx.fillStyle = "#4DA54D";
ctx.fill();
ctx.strokeStyle = "DarkRed";
ctx.stroke();

ctx.beginPath();
ctx.arc( 500, 350, 120, 0, 2 * Math.PI, false );
ctx.strokeStyle = "OliveDrab";
ctx.stroke();

ctx.beginPath();
ctx.arc( 500, 350, 180, 0, 2 * Math.PI, false );
ctx.strokeStyle = "#530053";
ctx.stroke();

ctx.beginPath();
ctx.arc( 500, 350, 240, 0, 2 * Math.PI, false );
ctx.strokeStyle = "#208181";
ctx.stroke();

ctx.beginPath();
ctx.arc( 500, 350, 300, 0, 2 * Math.PI, false );
ctx.strokeStyle = "#CC7A00";
ctx.stroke();