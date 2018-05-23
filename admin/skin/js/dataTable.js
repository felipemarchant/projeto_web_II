dataTable = {
	//table : document.getElementById("dataTable_table"),
	//body  : document.getElementById("dataTable_body"),
	init  : function(urls){
		this.urls = urls;
	},
	fetchTable: function(filtro){
		if(filtro === null){
			filtro = {};
		}
		var eHTTP = new easyHTTP();
		eHTTP.post(this.urls.fetchTable, filtro ,function(error, data){
			var datas = JSON.parse(data);
			var bodyTable = document.getElementById("dataTable_tbody");
			bodyTable.innerHTML = null;
			if (datas === undefined || datas.length == 0) {
				var html  = '<tr>';
					html += '<td colspan="5"><p class="text-center">Nenhum Registro Encontrado</p></td>';
				    html += '</tr>';
				    bodyTable.insertAdjacentHTML('beforeend',html);
			}
			datas.forEach(function(data){
				var clasz = parseInt(data.pro_ativo);
				var textT = (clasz == 0)?'Ativar':'Desativar';
				var flag  =  clasz;
				clasz = (clasz == 0)?'btn-success':'btn-danger';
				var html  = '<tr>';
					html += '<td>'+ data.usu_ra +'</td>';
					html += '<td>'+ data.pro_nome +" "+ data.pro_sobrenome +'</td>';
					html += '<td>'+ data.usu_email +'</td>';
					html += '<td>'+ data.mat_nome +'</td>';
					html += '<td><div class="action"><button onclick="editProfessor('+data.pro_id+')" class="btn btn-primary btn-small">Editar</button> | <button onclick="deleteProfessor('+data.pro_id+','+data.pro_ativo+')" class="btn '+clasz+' btn-small">'+textT+'</button></div></td>';
					html += '</tr>';
					bodyTable.insertAdjacentHTML('beforeend',html);
			});
		});
	}

};

function editProfessor(id){
	var formEditarProfessor = document.getElementById('formProfessor_edit');
	var eHTTP = new easyHTTP();
	id = parseInt(id);
	eHTTP.post('ajax/professorRepository_findOnly.php', {"id":id},function(error, data){
		var data = JSON.parse(data);
		formEditarProfessor.elements['nome'].value =  data.pro_nome;
		formEditarProfessor.elements['sobrenome'].value = data.pro_sobrenome;
		formEditarProfessor.elements['email'].value =  data.usu_email;
		formEditarProfessor.elements['senha'].value =  null;
		showEdit();
	});
}
function deleteProfessor(id, ativo){
	var paramAction = (ativo == 0)?1:0;
	var eHTTP = new easyHTTP();
	eHTTP.post('ajax/professorRepository_deleteOrActive.php', {"id":id, "action":paramAction} ,function(error, data){
		urls = {};
		urls.fetchTable = 'ajax/professorRepository_getCollection.php';
		dataTable.init(urls);
		dataTable.fetchTable(null);
		document.getElementById('formSearch_searchInput').value = null;
	});
}