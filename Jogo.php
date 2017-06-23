<?php		
	
	function adicionarNasPosicoesAbertas($posicao, &$posicoesAbertas){
		array_push($posicoesAbertas, $posicao);
	}
	
	function adicionarNasPosicoesFechadas($posicao, &$posicoesFechadas){		
		array_push($posicoesFechadas, $posicao);
	}
	
	function removerDasPosicoesAbertas($posicao, &$posicoesAbertas){	
		array_splice($posicoesAbertas, array_search($posicao, $posicoesAbertas), 1);
	}
	
	function inicializarListas($posicaoAtual, $obstaculos, &$posicoesAbertas, &$posicoesFechadas){
		adicionarNasPosicoesAbertas($posicaoAtual, $posicoesAbertas);
		
		for ($i =0; $i <=count ($obstaculos) - 1; $i++) {
			adicionarNasPosicoesFechadas($obstaculos[$i], $posicoesFechadas);
		}
		
	}	
	
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
	
	function validarPosicoesCandidatas($posicoesFechadas, $posicaoCandidata, &$posicoesAbertas){		
		if(!(in_array($posicaoCandidata, $posicoesFechadas))){
			adicionarNasPosicoesAbertas($posicaoCandidata, $posicoesAbertas);
		}
	}
	
	function descobrirMelhorPosicaoAberta($posicoesAbertas, $objetivo, $posicaoAtual){	
		$custos = array();	
		for($i=0; $i<sizeof($posicoesAbertas); $i++){			
			if($posicoesAbertas[$i] != $posicaoAtual){
				array_push($custos, custo($posicoesAbertas[$i], $objetivo));		
			}						
		}
		return array_search(min($custos), $custos) + 1;			
	}
	
	function custo($posicaoAtual, $objetivo){
		return abs($objetivo['posicaoX'] - $posicaoAtual['posicaoX']) + abs($objetivo['posicaoY'] - $posicaoAtual['posicaoY']);
	}
	
	function moverAgente(&$posicaoAtual, $melhorPosicaoAberta, &$posicoesAbertas, &$posicoesFechadas){
		adicionarNasPosicoesFechadas($posicaoAtual, $posicoesFechadas);
		removerDasPosicoesAbertas($posicaoAtual, $posicoesAbertas);
		$posicaoAtual = $melhorPosicaoAberta;
	}
	
	function imprimir($vetor){
		for($i=0; $i<sizeof($vetor); $i++){	
			echo '['.$vetor[$i]['posicaoX'].', '.$vetor[$i]['posicaoY'].']<br>';
		}
	}
	
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
					array('posicaoX'=>4, 'posicaoY'=>1),
					array('posicaoX'=>4, 'posicaoY'=>2),
					array('posicaoX'=>4, 'posicaoY'=>3)
					);
	$objetivo = array('posicaoX'=>7, 'posicaoY'=>1);	
	inicializarListas($posicaoAtual, $obstaculos, $posicoesAbertas, $posicoesFechadas);	
	
	$caminho = astar($posicoesAbertas, $posicoesFechadas, $posicaoAtual,  $objetivo);
	
	imprimir($caminho);
	
	
