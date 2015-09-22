window.onload = function() {
    var obtn = document.getElementById('btn');
    var timer = null;
    var isTop = true;

    window.onscroll = function(){
    	if(!isTop){
    		clearInterval(timer);
    	}
    	isTop = false;
    }

    obtn.onclick = function() {
        timer = setInterval(function() {
            var osTop = document.documentElement.scrollTop || document.body.scrollTop;
            var ispeed = Math.floor(-osTop/6);
            document.documentElement.scrollTop = document.body.scrollTop = osTop + ispeed;
           	isTop = true;
           	console.log(osTop);
            if (osTop == 0){
            	clearInterval(timer);
            }
        }, 30);


    }
}
