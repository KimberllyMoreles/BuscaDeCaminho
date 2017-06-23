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
		$posicoesCandidatas[0] = [$posicaoAtual['posicaoX'] - 1, $posicaoAtual['posicaoY']];
		$posicoesCandidatas[1] = [$posicaoAtual['posicaoX'] + 1, $posicaoAtual['posicaoY']];
		$posicoesCandidatas[2] = [$posicaoAtual['posicaoX'], $posicaoAtual['posicaoY'] - 1];
		$posicoesCandidatas[3] = [$posicaoAtual['posicaoX'], $posicaoAtual['posicaoY'] + 1];
		
		for ($i =0; $i <=count ($posicoesCandidatas) - 1; $i++) {
			validarPosicoesCandidatas($posicoesFechadas, $posicoesCandidatas[$i], $posicoesAbertas);
		}
	}
	
	function validarPosicoesCandidatas($posicoesFechadas, $posicaoCandidata, &$posicoesAbertas){	
		for($i=0; $i<sizeof($posicoesFechadas); $i++){
			if($posicaoCandidata != $posicoesFechadas[$i]){
				adicionarNasPosicoesAbertas($posicaoCandidata, $posicoesAbertas);
			}		
		}
	}
	
	function descobrirMelhorPosicaoAberta(&$posicoesAbertas, $objetivo, $posicaoAtual){
		$custos = array();
		for($i=0; $i<sizeof($posicoesAbertas); $i++){	
			if($posicoesAbertas[$i] != $posicaoAtual)
				array_push($custos, custo($posicoesAbertas[$i], $objetivo));								
		}
		return array_search(min($custos), $custos);			
	}
	
	function custo($posicaoAtual, $objetivo){
		return abs($objetivo['posicaoX'] - $posicaoAtual['posicaoX']) + abs($objetivo['posicaoY'] - $posicaoAtual['posicaoY']);
	}
	
	function moverAgente(&$posicaoAtual, $melhorPosicaoAberta, &$posicoesAbertas, &$posicoesFechadas){
		adicionarNasPosicoesFechadas($posicaoAtual, $posicoesFechadas);
		removerDasPosicoesAbertas($posicaoAtual, $posicoesAbertas);
		$posicaoAtual = $melhorPosicaoAberta;
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
	
	criarPosicoesAbertas($posicaoAtual, $posicoesFechadas, $posicoesAbertas);	
	$melhorPosicaoAberta = $posicoesAbertas[descobrirMelhorPosicaoAberta($posicoesAbertas,  $objetivo, $posicaoAtual)];
	
	moverAgente($posicaoAtual, $melhorPosicaoAberta, $posicoesAbertas, $posicoesFechadas);
