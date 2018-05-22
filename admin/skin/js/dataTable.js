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
				var html  = '<tr>';
					html += '<td>'+ data.usu_ra +'</td>';
					html += '<td>'+ data.pro_nome +" "+ data.pro_sobrenome +'</td>';
					html += '<td>'+ data.usu_email +'</td>';
					html += '<td>'+ data.mat_nome +'</td>';
					html += '<td><div class="action"><button class="btn btn-primary btn-small">Editar</button> | <button class="btn btn-danger btn-small">Desativar</button></div></td>';
					html += '</tr>';
					bodyTable.insertAdjacentHTML('beforeend',html);
			});
		});
	}

};