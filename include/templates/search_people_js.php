<script>
	var users = [];
	<?=$js_users ?>
	document.getElementById('search_list').oninput = function(){
		<?php require "include/templates/search_people_js2.js"; ?>
	}
	document.getElementById('btn_search').onclick = function(){
		<?php require "include/templates/search_people_js2.js"; ?>
		return false;//It does not submit when it returns false;
	}
	
	//onload - if not empty values it displayes the search results automatically
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

	document.getElementById('friends_list').innerHTML = s;
}
</script>