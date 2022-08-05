<?php
function telefone_digitos($telefone, $formato, $zero, $nove){
	//EXEMPLOS:
	//Com INT, que é só números
	//telefone_digitos($telefone, "int", "", "") Resultado =>  66987654321
	//telefone_digitos($telefone, "int", "0", "") Resultado => 066987654321
	//telefone_digitos($telefone, "int", "0", "9") Resultado => de 06687654321 para 066987654321
	//telefone_digitos($telefone, "int", "", "9") Resultado => de 6687654321 para 66987654321
	//Com STRING completa, com caracteres especiais de formato padrão
	//telefone_digitos($telefone, "string", "", "") Resultado => (66) 98765-4321
	//telefone_digitos($telefone, "string", "0", "") Resultado => 0 (66) 98765-4321
	//telefone_digitos($telefone, "string", "0", "9") Resultado => de 0(66) 98765-4321 para 0(66) 998765-4321
	//telefone_digitos($telefone, "string", "", "9") Resultado=> de (66) 98765-4321 para (66) 998765-4321
	
	if(empty($telefone)){
		return "Telefone não existe";
	} else {
		$telefone = ltrim($telefone, '0');
		$strlen_telefone = strlen(preg_replace( '/[^0-9]/is', '', $telefone));
		if($strlen_telefone==10){
			$telefone9 = preg_replace( '/[^0-9]/is', '', $telefone);
			$telefone9 = preg_replace("/(\d{2})(\d{4})(\d{4})/", $zero." (\$1) ".$nove."\$2-\$3", $telefone9);
		} elseif($strlen_telefone==11){
			$telefone9 = preg_replace( '/[^0-9]/is', '', $telefone);
			$telefone9 = preg_replace("/(\d{2})(\d{1})(\d{4})(\d{4})/", $zero."(\$1) \$2\$3-\$4", $telefone9);
		}
		if($strlen_telefone==NULL or $strlen_telefone==0){
			return "Quantidade de digitos do telefone está errado! ==> ".$telefone;
		}else{
			if(empty($formato)){
				return $telefone9;
			} else {
				if($formato=="int"){
					return preg_replace( '/[^0-9]/is', '', $telefone9);
				} elseif($formato=="string"){
					return $telefone9;
				} else {
					return $telefone9;
				}
			}
		}
	}
}
$meu_telefone = "66996278008"; //Vindo do Banco de dados em INT, Converter para STRING
echo telefone_digitos($meu_telefone, "string", "", "");
//Resultado: (66) 99627-8008

$meu_telefone = "(66) 99627-8008"; //Vindo do Banco de dados em STRING, Converter para INT
echo telefone_digitos($meu_telefone, "int", "", "");
//Resultado: 66996278008

?>
