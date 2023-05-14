var flash = {};
flash.loading1 = function(name, start, finish){
	var counter = 0;
	var interval = setInterval(function(){
		counter += 1;
		if(counter == start){
			document.getElementById( name+'_notification' ).style.backgroundColor = '#04e30a';
			document.getElementById( name+'_notification_message').style.display = 'block';
			document.getElementById( name+'_notification').style.width = '100%';
			document.getElementById( name+'_notification').style.opacity = '0.8';
		}else if(counter == finish-2){
			document.getElementById( name+'_notification').style.opacity = '0.01';
			document.getElementById( name+'_notification_message').style.opacity = '0.01';
		}else if(counter == finish){
			document.getElementById( name+'_notification').style.display = 'none';
			clearInterval(interval);
		}
	}, 1000);/* Eger-de 1000 etsen sagat(sekunt) bilen den bolyar*/
}
flash.status1 = function(id, start, finish, left, top){
	box = document.getElementById(id);
	//margin-top sazlamaly
	var st = '';
	st += 'border-radius: 10px;';
	st += 'height: 1cm;';
	st += 'padding-top: 0.38cm;';
	st += 'padding-left: 0.3cm;';
	st += 'padding-right: 0.3cm;';
	st += 'font-size: 17px;';
	st += 'font-family: Century Gothic;';
	st += 'text-align: center;';
	st += 'color: white;';
	st += 'background-color: #04e30a;';
	st += 'position: absolute;';
	st += 'top: ' + top +';';
	st += 'left: ' + left +';';
	st += 'opacity: 0;';
	st += 'transition: opacity 0.7s;';
	st += '-webkit-transition: opacity 0.7s;';
	st += '-moz-transition: opacity 0.7s;';
	box.setAttribute('style', st);
	
	var counter = 0;
	var interval = setInterval(function(){
		counter += 1;
		if(counter == start){
			box.style.opacity = '0.9';
			box.style.marginTop = '2.5cm';
		}
		else if(counter == finish-1){
			box.style.opacity = '0.1';
		}else if(counter == finish){
			box.style.display = 'none';
			clearInterval(interval);
		}
	}, 1000);/* Eger-de 1000 etsen sagat(sekunt) bilen den bolyar*/
}