<?php		
	//função para adicionar novas posições abertas
	function adicionarNasPosicoesAbertas($posicao, &$posicoesAbertas){
		array_push($posicoesAbertas, $posicao);
	}
	
	//função para adicionar novas posições fechadas
	function adicionarNasPosicoesFechadas($posicao, &$posicoesFechadas){		
		array_push($posicoesFechadas, $posicao);
	}
	
	//função para remover posições abertas
	function removerDasPosicoesAbertas($posicao, &$posicoesAbertas){	
		array_splice($posicoesAbertas, array_search($posicao, $posicoesAbertas), 1);
	}
	
	//define a posição atual, os obstáculos e os insere nas respectivas listas: posicoesAbertas ou posicoesFechadas
	function inicializarListas($posicaoAtual, $obstaculos, &$posicoesAbertas, &$posicoesFechadas){
		adicionarNasPosicoesAbertas($posicaoAtual, $posicoesAbertas);
		
		for ($i =0; $i <=count ($obstaculos) - 1; $i++) {
			adicionarNasPosicoesFechadas($obstaculos[$i], $posicoesFechadas);
		}
		
	}	
	
	//cria novas posições
	function criarPosicoesAbertas($posicaoAtual, $posicoesFechadas, &$posicoesAbertas){
		$posicoesCandidatas = array(4);
		$posicoesCandidatas[0] = array('posicaoX'=>$posicaoAtual['posicaoX'] - 1, 'posicaoY'=>$posicaoAtual['posicaoY']);
		$posicoesCandidatas[1] = array('posicaoX'=>$posicaoAtual['posicaoX'] + 1, 'posicaoY'=>$posicaoAtual['posicaoY']);
		$posicoesCandidatas[2] = array('posicaoX'=>$posicaoAtual['posicaoX'] , 'posicaoY'=>$posicaoAtual['posicaoY'] - 1);
		$posicoesCandidatas[3] = array('posicaoX'=>$posicaoAtual['posicaoX'] , 'posicaoY'=>$posicaoAtual['posicaoY'] + 1);
		
		for ($i =0; $i <=count ($posicoesCandidatas) - 1; $i++) {
			validarPosicoesCandidatas($posicoesFechadas, $posicoesCandidatas[$i], $posicoesAbertas);
		}		
	}
	
	//valida as posições criadas pela função que cria as novas posições abertas
	//verifica se as posições geradas já não estão na lista de posições fechadas
	function validarPosicoesCandidatas($posicoesFechadas, $posicaoCandidata, &$posicoesAbertas){		
		if(!(in_array($posicaoCandidata, $posicoesFechadas))){
			adicionarNasPosicoesAbertas($posicaoCandidata, $posicoesAbertas);
		}
	}
	
	//encontra a melhor posição aberta com base no custo
	function descobrirMelhorPosicaoAberta($posicoesAbertas, $objetivo, $posicaoAtual){	
		$custos = array();	
		for($i=0; $i<sizeof($posicoesAbertas); $i++){			
			if($posicoesAbertas[$i] != $posicaoAtual){
				array_push($custos, custo($posicoesAbertas[$i], $objetivo));
			}						
		}
		return array_search(min($custos), $custos) + 1;			
	}
	
	//calcula o custo da posição desejada até o objetivo
	function custo($posicao, $objetivo){
		return abs($objetivo['posicaoX'] - $posicao['posicaoX']) + abs($objetivo['posicaoY'] - $posicao['posicaoY']);
	}
	
	//adiciona a posição atual na lista de posições Fechadas
	//remove a posição atual da lista de posições Abertas
	//e troca o valor de posição atual para o valor da melhor posição aberta
	function moverAgente(&$posicaoAtual, $melhorPosicaoAberta, &$posicoesAbertas, &$posicoesFechadas){
		adicionarNasPosicoesFechadas($posicaoAtual, $posicoesFechadas);
		removerDasPosicoesAbertas($posicaoAtual, $posicoesAbertas);
		$posicaoAtual = $melhorPosicaoAberta;
	}
	
	//função para a impressão do vetor final contendo o caminho
	function imprimirCaminho($vetor){
		for($i=0; $i<sizeof($vetor); $i++){	
			echo '['.$vetor[$i]['posicaoX'].', '.$vetor[$i]['posicaoY'].']<br>';
		}
	}
	
	//função que faz o caminho
	function astar(&$posicoesAbertas, &$posicoesFechadas, &$posicaoAtual,  $objetivo){
		$caminho = array();	
		while($posicaoAtual != $objetivo){
			criarPosicoesAbertas($posicaoAtual, $posicoesFechadas, $posicoesAbertas);	
			$melhorPosicaoAberta = $posicoesAbertas[descobrirMelhorPosicaoAberta($posicoesAbertas,  $objetivo, $posicaoAtual)];
			array_push($caminho, $melhorPosicaoAberta);
			moverAgente($posicaoAtual, $melhorPosicaoAberta, $posicoesAbertas, $posicoesFechadas);
		}
		return $caminho;
	}
	
	$posicoesAbertas = array();
	$posicoesFechadas = array();
	$posicaoAtual = array('posicaoX'=>1, 'posicaoY'=>3);
	$obstaculos = array(
					array('posicaoX'=>3, 'posicaoY'=>1),
					array('posicaoX'=>4, 'posicaoY'=>2),
					array('posicaoX'=>3, 'posicaoY'=>3)
					);
	$objetivo = array('posicaoX'=>7, 'posicaoY'=>1);	
	inicializarListas($posicaoAtual, $obstaculos, $posicoesAbertas, $posicoesFechadas);	
	
	$caminho = astar($posicoesAbertas, $posicoesFechadas, $posicaoAtual,  $objetivo);	
	imprimirCaminho($caminho);	
