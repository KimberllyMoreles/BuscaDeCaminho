<?php		
	
	function adicionarNasPosicoesAbertas($posicao, &$posicoesAbertas){
		array_push($posicoesAbertas, array('posicaoX'=>$posicao[0], 'posicaoY'=>$posicao[1]));
	}
	
	function adicionarNasPosicoesFechadas($posicao, &$posicoesFechadas){		
		array_push($posicoesFechadas, array($posicao));
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
	array_push($posicoesAbertas, array([2, 3]));
		$custos = array();
		for($i=0; $i<sizeof($posicoesAbertas); $i++){
			
		var_dump($posicoesAbertas[$i]['posicaoX']);
		var_dump($posicoesAbertas[$i]['posicaoY']);
			//array_push($custos, custo($posicoesAbertas[$i], $objetivo));	*/}					
		}
	}
	
	function custo($posicaoAtual, $objetivo){
		return abs($objetivo[0] - $posicaoAtual[0]) + abs($objetivo[1] - $posicaoAtual[1]);
	}
	
	function moverAgente($posicaoAtual, $melhorPosicaoAberta){
	
	}
	
	$posicoesAbertas = array();
	$posicoesFechadas = array();
	$posicaoAtual = [1, 3];
	$obstaculos = [[4,1], [4, 2], [4, 3]];	
	$objetivo = [7, 1];	
	inicializarListas($posicaoAtual, $obstaculos, $posicoesAbertas, $posicoesFechadas);	
	
	$custo = custo($posicaoAtual, $objetivo);
	$melhorPosicaoAberta = descobrirMelhorPosicaoAberta($posicoesAbertas,  $objetivo);/*
	moverAgente($posicaoAtual, $melhorPosicaoAberta);
*/
