window.onload = function(){
	var bodyId = document.body.id;

	if(bodyId == 'admin_professor'){
		urls = {};
		urls.fetchTable = 'ajax/professorRepository_getCollection.php';
	}
	if(urls){
		dataTable.init(urls);
		formSearch.init(dataTable);
	}
};
