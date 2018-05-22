window.onload = function(){
	var bodyId = document.body.id;

	if(bodyId == 'admin_aluno'){
		urls = {};
		urls.fetchTable = 'ajax/alunoRepository_getCollection.php';
	}
	if(urls){
		dataTable.init(urls);
		formSearch.init(dataTable);
	}
};
