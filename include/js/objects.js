var form = {};
form.controll = function(field, warner){
	document.getElementById(warner).style.display = 'none';
	if(document.getElementById(field).value == ''){
		document.getElementById(warner).style.display = 'block';
		document.getElementById(field).focus();
		
		document.getElementById(field).onkeyup = function(){
			if(document.getElementById(warner).style.display = 'block'){
				document.getElementById(warner).style.display = 'none';
			}
		}
		return false;
	}
}
form.text_field_anim = function(id, text1, text2){
	function spell(id, s, rate, repeat){
			var i = 0;
			var t = '';
			var j = 0;
			var timeln = setInterval(function(){
				if(i<s.length){
					t += s[i];
					document.getElementById(id).setAttribute('placeholder', t);
					i++;
				}
				if(i == s.length){
					i = 0;
					t = '';
					j++;
				}
				if(j == repeat){
					clearInterval(timeln);
				}
			}, rate);
	}
	var counter = 0;
	var interval = setInterval(function(){
		if(counter == 1){
			spell(id, text1, 50, 1);
		}
		if(counter == 5){
			spell(id, text2, 100, 1);
		}
		counter++;
		if(counter == 8){
			counter = 0;
		}
	}, 1000);
}
form.button_anim = function(id, repeat){
	var counter = 0;
	var s = '';var t = 0;var k = 0;
	
	var value = document.getElementById(id).value;
	var fontsz = document.getElementById(id).style.fontSize;
	var color = document.getElementById(id).style.color;
	
	document.getElementById(id).value = s;
	document.getElementById(id).style.fontSize = '50px';
	document.getElementById(id).style.color = '#00fcff';
	document.getElementById(id).style.fontWeight = 'bold';
	var interval = setInterval(function(){
		t++;
		if(t == 1){
			document.getElementById(id).value = '-  ';
		}
		if(t == 2){
			document.getElementById(id).value = '-- ';
		}
		if(t == 3){
			document.getElementById(id).value = '---';
			t = 0;
			k++;
		}
		if(repeat>0 && k == repeat){
			document.getElementById(id).value = value;
			document.getElementById(id).style.fontSize = fontsz;
			document.getElementById(id).style.color = color;
			clearInterval(interval);
		}
	}, 300);
}
form.my_alert = function(t,width, height){
	var s = '';
	s += '<div id="body_outside">';
		s += '<div id="body_main">';
			s += '<nav id="btn_close" align="right">x</nav>';
			s += t;
		s += '</div>';
	s += '</div>';
	
	document.getElementById('bbbb').innerHTML = s;
	document.getElementById('my_alert_style').setAttribute('href', 'include/css/my_alert.css');
	document.getElementById('body_outside').style.width = '100%';
	document.getElementById('body_outside').style.height = '100%';
	document.getElementById('body_outside').style.minWidth = (document.body.offsetWidth + 'px');
	document.getElementById('body_outside').style.minHeight = (window.screen.height + 'px');
	document.getElementById('body_main').style.width = width;
	document.getElementById('body_main').style.height = height;
	document.getElementById('body_main').style.marginTop = ((100 - parseInt(height))/4) + '%';
	document.getElementById('body_main').style.marginLeft = ((100 - parseInt(width))/2) + '%';
	document.getElementById('body_main').style.minHeight = '10cm';
	document.getElementById('body_main').style.minWidth = '10cm';
	
	document.getElementById('btn_close').onmouseover = function(){
		document.getElementById('btn_close').style.color = '#ffffff';
		document.getElementById('btn_close').style.backgroundColor = '#ff5a00';
		document.getElementById('btn_close').style.fontWeight = 'bold';
	}
	document.getElementById('btn_close').onmouseout = function(){
		if(document.getElementById('btn_close')){
			document.getElementById('btn_close').style.color = '#ff0000';
			document.getElementById('btn_close').style.backgroundColor = '#ffffff';
			document.getElementById('btn_close').style.fontWeight = 'normal';
		}
	}
	document.getElementById('btn_close').onclick = function(){
		document.getElementById('btn_close').style.color = '#ffffff';
		document.getElementById('btn_close').style.backgroundColor = '#ff0000';
		document.getElementById('btn_close').style.fontWeight = 'bold';
		document.getElementById('bbbb').innerHTML = '';
	}
}

var finder = {};

finder.search_via = function(name, selected, status, n){
	var result = [];
	var s = '';
	var st = '';
	for (var key in users){
		if((users[key][name] == document.getElementById('search_list').value) && (document.getElementById('search_list').value !== "")){
			//Calculates how many people found
			n += 1;
						
			//Sets just the status
			if(name == 'firstname' || name == 'lastname'){
				st = status + users[key]['status'];
			}else{
				st = status + users[key][name];
			}
			
			//Write them in a standart form
			var select = [];
			var select_id = [];
			select[key] = '';
			select[selected] = '_selected';
			select_id[key] = key;
			select_id[selected] = '_selected';
			
			s += '<a href="?search_type=people&search_list=' + document.getElementById('search_list').value + '&selected_id=' + key + '" class="found_anchor">'; /*  onclick="finder.show_user_information(' + key + '); return false;" */
				s += '<div class="found' + select[key] + '" id="found' + select_id[key] + '" name="' + key + '">';
					s += '<img src="uploads/user_images/' + users[key]['default_image'] + '" class="found_img"/>';
					s += '<div class="found_inf' + select[key] + '">';
						s += '<nav class="found_name' + select[key] + '" id="found_name' + select_id[key] + '">' + users[key]['firstname'] + ' ' + users[key]['lastname'] + '</nav>';
						s += '<nav class="found_status' + select[key] + '" id="found_status' + select_id[key] + '">' + st + '</nav>';
					s += '</div>';
				s += '</div>';
			s += '</a>';
		}
	}
	result['result'] = s;
	result['number'] = n;
	return result;
}
finder.show_user_information = function(id){
	var chosen = 0;
	if(document.getElementById('found_selected') !== null){
		chosen = document.getElementById('found_selected').getAttribute('name');
	}
	if(chosen > 0){
		document.getElementById('found_selected').setAttribute('class', 'found');
		document.getElementById('found_selected').setAttribute('id', 'found' + chosen);
		document.getElementById('found_name_selected').setAttribute('class', 'found_name');
		document.getElementById('found_name_selected').setAttribute('id', 'found_name' + chosen);
		document.getElementById('found_status_selected').setAttribute('class', 'found_status');
		document.getElementById('found_status_selected').setAttribute('id', 'found_status' + chosen);
	}
	if(id !== chosen){	
		document.getElementById('found' + id).setAttribute('class', 'found_selected');
		document.getElementById('found' + id).setAttribute('id', 'found_selected');
		document.getElementById('found_name' + id).setAttribute('class', 'found_name_selected');
		document.getElementById('found_name' + id).setAttribute('id', 'found_name_selected');
		document.getElementById('found_status' + id).setAttribute('class', 'found_status_selected');
		document.getElementById('found_status' + id).setAttribute('id', 'found_status_selected');
	}
	var inf = '';
	inf += '<div class="basic_informations">';
		inf += '<nav class="basic_nav_1">';
			inf += '<li class="inline"><h1 id="basic_name">' + users[id]['firstname'] + ' ' + users[id]['lastname'] + '</h1></li>';
			inf += '<li class="inline"><p align="right" id="basic_online">' + 'Online' + '</p></li>';
			inf += '<li id="basic_status">' + users[id]['status'] + '</li>';
		inf += '</nav>';
	inf += '</div>';
	inf += '<div class="basic_image_field">';
		inf += '<img src="uploads/user_images/' + users[id]['default_image'] + '" id="basic_main_image" align="center"/>';
	inf += '</div>';
	document.getElementById('friends_informations').innerHTML = inf;
}