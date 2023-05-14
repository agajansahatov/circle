if(document.getElementById('search_list').value !== ""){
	var s = '';
	var result = [];
	//Gözletmek üçin 2 ýol badyr, objects-ň içinden 1 adamy barlanda hemme informasiýalaryny barmatmaly, bärde dälde
	
	//Searches firstname
	result = finder.search_via('firstname', <?=$selected_id ?>, '', 0);
	s += result['result'];
	//Searches lastname
	result = finder.search_via('lastname', <?=$selected_id ?>, '', result['number']);
	s += result['result'];
	//Searches email
	result = finder.search_via('email', <?=$selected_id ?>, 'Email: ', result['number']);
	s += result['result'];
	//Searches mobilenumber
	result = finder.search_via('mobilenumber', <?=$selected_id ?>, 'Mobile number: ', result['number']);
	s += result['result'];
	//Searches hobby
	result = finder.search_via('hobby', <?=$selected_id ?>, 'Hobby: ', result['number']);
	s += result['result'];
	
	s = ('<li id="search_indicator">' + result['number'] + ' people are found</li>') + s;
	
	var counter = 0;
	var interval = setInterval(function(){
		if(counter == 1){
			document.getElementById('friends_list').innerHTML = '<img src="assets/loading1.gif" id="load_gif"/><p align="center">Searching...</p>';
		}
		if(counter == 3){
			clearInterval(interval);
			document.getElementById('friends_list').innerHTML = s;
		}
		counter += 1;
	}, 500);
}