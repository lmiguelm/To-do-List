$(function(){

	var linhasPorPagina=5;
	var paginaAtual=1;
	var totalPaginas;
	var numeroLinhas;
	var url="http://localhost:8083/WEB/todo_list_bootstrap/php";

	function loadTarefas() {
	    $("#tarefa-list").empty();
	    $.getJSON(url + "/listar_tarefas.php", {linhasPorPagina: linhasPorPagina, paginaAtual: paginaAtual,id_usuario: $.cookie("id_usuario")})
	      .done(function(data) {
	        for(var tarefa = 0; tarefa < data.length; tarefa++) {
	          addTarefa(data[tarefa].texto, data[tarefa].id, data[tarefa].status, data[tarefa].data);
	        }
	      });
	}

	function gerarPaginacao(){
	    $(".pagination").empty();
	    $.get(url + "/contadorTarefas.php", {id_usuario: $.cookie("id_usuario")})
	      .done(function(data){
	        numeroLinhas = data[0].contador;
	        totalPaginas = Math.ceil(numeroLinhas / linhasPorPagina);
	        addPaginacao();
	      });
	}

	function addPaginacao(){
    
	    var $anterior = $("<li />")
	                    .addClass("page-item disabled")
	                    .attr("id", "anterior")                
	                    .append($("<a />")
	                              .addClass('page-link')
	                              .attr("href","#")
	                              .append("<span />")
	                                        .text('<<'));
	    $(".pagination").append($anterior);
	    $("#anterior").click(onPaginaClick);
	    
	    for(var i = 1; i <= totalPaginas; i++){
	      if(paginaAtual == i){
	        var $paginaAtiva = $("<li />")
	                    .addClass("page-item active")
	                    .attr("id", "pag" + i)                
	                    .append($("<a />")
	                              .addClass('page-link')
	                              .attr("href","#pag" + i)
	                              .text(i));
	        $(".pagination").append($paginaAtiva);
	      }
	      else{
	        var $pagina = $("<li />")
	                    .addClass("page-item")
	                    .attr("id", "pag" + i)                
	                    .append($("<a />")
	                              .addClass('page-link')
	                              .attr("href","#pag" + i)
	                              .text(i));
	        $(".pagination").append($pagina);
	      }
	      $("#pag" + i).click(onPaginaClick);
	    }
	    
	    var $posterior;
	    if(numeroLinhas > 5){
	      $posterior = $("<li />")
	                    .addClass("page-item")
	                    .attr("id", "posterior")                
	                    .append($("<a />")
	                              .addClass('page-link')
	                              .attr("href","#pag2")
	                              .append("<span />")
	                                        .text(">>"));
	    }
	    else{
	      $posterior = $("<li />")
	                    .addClass("page-item disabled")
	                    .attr("id", "posterior")                
	                    .append($("<a />")
	                              .addClass('page-link')
	                              .attr("href","#pag1")
	                              .append("<span />")
	                                        .text(">>"));
	    }
	    $(".pagination").append($posterior);
	    $("#posterior").click(onPaginaClick);
	}

	function onPaginaClick(){
	    var pagina;
	    var paginaAntiga = paginaAtual;
	    var id = $(this).prop("id");
	    if(id == "anterior" || id == "posterior"){
	      var url = $(this).children().prop("href");
	      var numero = url.substring(url.length -1);
	      if(numero != '#'){
	        pagina = numero;
	      }else{
	        if(paginaAtual == totalPaginas){
	          pagina = totalPaginas;
	        }else{
	          pagina = 1;
	        }
	        
	      }
	    }else{
	      pagina = id.substring(3);
	    }
	    paginaAtual = pagina;
	    var anterior = paginaAtual - 1;
	    var posterior = parseInt(paginaAtual) + 1;
	    $("#anterior").children().prop("href", "#pag" + anterior);
	    $("#posterior").children().prop("href", "#pag" + posterior);
	    $("#pag" + paginaAtual).addClass("active");
	    $("#pag" + anterior).removeClass("active");
	    if(paginaAntiga != posterior){
	      $("#pag" + paginaAntiga).removeClass("active");
	    }else{
	      $("#pag" + posterior).removeClass("active");
	    }
	    
	    if(paginaAtual > 1){
	      $("#anterior").removeClass("disabled");
	    }else{
	      $("#anterior").addClass("disabled");
	      $("#anterior").children().prop("href", "#");
	      $("#pag" + 1).addClass("active");
	    }
	    if(posterior <= totalPaginas){
	      $("#posterior").removeClass("disabled");
	    }else{
	      $("#posterior").addClass("disabled");
	      $("#posterior").children().prop("href", "#");
	      $("#pag" + 3).addClass("active");
	    }
	    loadTarefas();
	  }

	function addTarefa(texto, id, status, data)
	{
		var $tarefa=$('<tr/>').addClass('tarefa-item')
						.append($('<td/>').addClass('tarefa-id').text(id))
						.append($('<td/>').addClass('tarefa-data').text(function(){return data.replace(/^(\d{4})-(\d{2})-(\d{2})/, '$3/$2/$1');}))
						.append($('<td/>').addClass('tarefa-texto').text(texto))
						.append($('<td/>').addClass('tarefa-status')
								.append($('<span/>').addClass(function(){
									switch(status)
									{
										case "1": return'badge badge-primary';
										case "2": return'badge badge-warning';
										case "3": return'badge badge-success';
									}
								})
								.text(function()
								{
									switch(status)
									{
										case "1": return'Nova';
										case "2": return'Em andamento';
										case "3": return'Finalizada';
									}
								})))
						
						.append($('<td/>').addClass('text-center')
							.append($('<div/>').addClass('tarefa-change-status')
								.append($('<i/>').addClass('material-icons text-success').attr('data-toggle', 'tooltip').attr('title', 'Mudar status').text('check')))

						
							.append($('<div/>').addClass('tarefa-edit')
								.append($('<i/>').addClass('material-icons text-warning').attr('data-toggle', 'tooltip').attr('title', 'Editar').text('create')))
						
						
							.append($('<div/>').addClass('tarefa-delete')
								.append($('<i/>').addClass('material-icons text-danger').attr('data-toggle', 'tooltip').attr('title', 'Excluir').text('delete'))));

		$('#tarefa-list').append($tarefa);
		$('[data-toggle="tooltip"]').tooltip();

		$('.tarefa-change-status').click(onTarefaChangeStatusClick);
		$('.tarefa-delete').click(onTarefaDeleteClick);
		$('.tarefa-edit').click(onTarefaEditClick);
	}

	function onTarefaChangeStatusClick()
	{
		var linha=$(this).closest('.tarefa-item');

		var id=linha.children('.tarefa-id').text();
		var texto=linha.children('.tarefa-texto').text();
		var data=linha.children('.tarefa-data').text();
		var status=linha.children('.tarefa-status').text();

		switch(status)
		{
			case 'Nova': status=2;
			break;

			case 'Em andamento': status=3;
			break;

			case 'Finalizada': status=3;
			break;
		}

		$.post(url+'/salvarTarefa.php', {id, descricao:texto, data, status: status}, 
		function(){
			location.reload(true);
		});
	}

	function onBtnLogoutClick(){
		$.get(url+'/logout.php').done(function(){
			window.location.href='../login.html';
		})
	}

	function onTarefaDeleteClick(){

		var linha=$(this).closest('.tarefa-item');

		linha.hide('slow', function(){
			var id=linha.children('.tarefa-id').text();
			$.post(url+'/removerTarefa.php', {id: id}, );

			linha.remove();
		})
	}

	function onTarefaEditClick(){

		var linha=$(this).closest('.tarefa-item');

		var id=linha.children('.tarefa-id').text();
		var texto=linha.children('.tarefa-texto').text();
		var data=linha.children('.tarefa-data').text();
		var status=linha.children('.tarefa-status').text();

		switch(status){

			case "Nova": status="1";
			break;

			case "Em andamento": status="2";
			break;

			case "Finalizada": status="3";
			break;
		}

		$('#id').val(id);
		$('#descricao').val(texto);
		$('#data').val(data);
		$('#status option').removeAttr('selected').filter('[value='+status +']').prop('selected', 'selected');

		$('#NovaTarefa').modal();
	}


	$('#NovaTarefa').on('hidden.bs.modal', function(){
		$('#id').val(0);
		$('#descricao').val("");
		$('#data').val("");
		$('#status option').removeAttr('selected').filter('[value=""]').prop('selected', 'selected');
	})
		
	$('#btnLogout').click(onBtnLogoutClick);

	loadTarefas();
	gerarPaginacao();


})