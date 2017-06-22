<?php		
	
	function adicionarNasPosicoesAbertas($posicao, &$posicoesAbertas){
		array_push($posicoesAbertas, $posicao);
	}
	
	function adicionarNasPosicoesFechadas($posicao, &$posicoesFechadas){		
		array_push($posicoesFechadas, $posicao);
	}
	
	function inicializarListas($posicaoAtual, $obstaculos, &$posicoesAbertas, &$posicoesFechadas){
		adicionarNasPosicoesAbertas($posicaoAtual, $posicoesAbertas);
		
		for ($i =0; $i <=count ($obstaculos) - 1; $i++) {
			adicionarNasPosicoesFechadas($obstaculos[$i], $posicoesFechadas);
		}
		
	}	
	
	function criarPosicoesAbertas($posicaoAtual, $obstaculos){
		verificarObstaculos($obstaculos, $posicaoCandidata);
		return adicionarNasPosicoesAbertas($posicaoCandidata);
	}
	
	function verificarObstaculos($obstaculos, $posicaoCandidata){
	
	}
	
	function descobrirMelhorPosicaoAberta(&$posicoesAbertas, $objetivo){
		$custos = array();
		for($i=0; $i<sizeof($posicoesAbertas); $i++){		
			array_push($custos, custo($posicoesAbertas[$i], $objetivo));								
		}
		return array_search(min($custos), $custos);			
	}
	
	function custo($posicaoAtual, $objetivo){
		return abs($objetivo['posicaoX'] - $posicaoAtual['posicaoX']) + abs($objetivo['posicaoY'] - $posicaoAtual['posicaoY']);
	}
	
	function moverAgente($posicaoAtual, $melhorPosicaoAberta){
	
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
	
	$custo = custo($posicaoAtual, $objetivo);

	$melhorPosicaoAberta = $posicoesAbertas[descobrirMelhorPosicaoAberta($posicoesAbertas,  $objetivo)];
	/*
	moverAgente($posicaoAtual, $melhorPosicaoAberta);
*/
