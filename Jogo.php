<?php
		
	
	function inicializarListas($posicaoAtual, $obstaculos, $posicoesAbertas, $posicoesFechadas){
		adicionarNasPosicoesAbertas($posicaoAtual, $posicoesAbertas);
		for ($i =0; $i <=count ($obstaculos) - 1; $i++) {
			adicionarNasPosicoesFechadas($obstaculos[$i], $posicoesFechadas);
		}
	}
	
	function adicionarNasPosicoesAbertas($posicao, $posicoesAbertas){
		array_push($posicoesAbertas, array($posicao));
	}
	
	function adicionarNasPosicoesFechadas($posicao, $posicoesFechadas){		
		array_push($posicoesFechadas, array($posicao));
	}
	
	function criarPosicoesAbertas($posicaoAtual, $obstaculos){
		verificarObstaculos($obstaculos, $posicaoCandidata);
		return adicionarNasPosicoesAbertas($posicaoCandidata);
	}
	
	function verificarObstaculos($obstaculos, $posicaoCandidata){
	
	}
	
	function descobrirMelhorPosicaoAberta($posicoesAbertas, $custo){
		for($i=0; $i<sizeof($posicoesAbertas); $i++){
			
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
	/*$melhorPosicaoAberta = descobrirMelhorPosicaoAberta($posicoesAbertas, $custo);
	moverAgente($posicaoAtual, $melhorPosicaoAberta);
*/
