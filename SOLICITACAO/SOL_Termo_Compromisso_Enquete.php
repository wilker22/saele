<?php
/*
Copyright 2011 da UFRGS - Universidade Federal do Rio Grande do Sul

Este arquivo � parte do programa SAELE - Sistema Aberto de Elei��es Eletr�nicas.

O SAELE � um software livre; voc� pode redistribu�-lo e/ou modific�-lo dentro dos
termos da Licen�a P�blica Geral GNU como publicada pela Funda��o do Software Livre
(FSF); na vers�o 2 da Licen�a.

Este programa � distribu�do na esperan�a que possa ser �til, mas SEM NENHUMA GARANTIA;
sem uma garantia impl�cita de ADEQUA��O a qualquer MERCADO ou APLICA��O EM PARTICULAR.
Veja a Licen�a P�blica Geral GNU/GPL em portugu�s para maiores detalhes.

Voc� deve ter recebido uma c�pia da Licen�a P�blica Geral GNU, sob o t�tulo "LICENCA.txt",
junto com este programa, se n�o, acesse o Portal do Software P�blico Brasileiro no
endere�o www.softwarepublico.gov.br ou escreva para a Funda��o do Software Livre(FSF)
Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301, USA
*/

require_once('../CABECALHO.PHP');

$_SESSION['Campos'] = $_POST;

MostraCabecalho("Solicita��o de Enquete");

$Erros = array();
if(trim($_POST['NomeConcurso']) == "")
    $Erros[] = "Nome da Enquete";
if((trim($_POST['DataInicio']) == "") || (Consulta::formataValidaData($_POST['DataInicio']) === false))
    $Erros[] = "Data de in�cio";
if((trim($_POST['HoraInicio']) == "") || (Consulta::validaHora($_POST['HoraInicio']) === false))
    $Erros[] = "Hora de in�cio";
if((trim($_POST['DataFim']) == "") || (Consulta::formataValidaData($_POST['DataFim']) === false))
    $Erros[] = "Data de fim";
if((trim($_POST['HoraFim']) == "") || (Consulta::validaHora($_POST['HoraFim']) === false))
    $Erros[] = "Hora de fim";
if(trim($_POST['Contato']) == "")
    $Erros[] = "Pessoa para contato";
if((trim($_POST['RamalContato']) == "") || (Consulta::formataNumero($_POST['RamalContato']) === false))
    $Erros[] = "Ramal para contato";
if((trim($_POST['EMail']) == "") || (Consulta::validaEMail($_POST['EMail']) === false))
    $Erros[] = "E-Mail para contato";
$TemEleicao = false;
foreach($_POST['Eleicao'] as $Eleicao)
    $TemEleicao = $TemEleicao || (trim($Eleicao) != "");
if(!$TemEleicao)
    $Erros[] = "Quest�es da enquete";
if(!in_array($_POST['TipoEleicao'], array("S", "E", "N")))
    $Erros[] = "Tipo de enquete";

if(!empty($Erros)) { ?>
    <div class="Erro">
        <p><strong>Aten��o:</strong> os seguintes campos n�o foram informados ou est�o inv�lidos:</p>

        <ul>
            <?php
            foreach($Erros as $Erro)
                echo '<li>'.$Erro.'</li>';
            ?>
        </ul>

        <p><input type="button" value="Voltar" onclick="javascript: location.href = 'SOL_Solicitacao.php';" /></p>
    </div>
    <?php
    exit;
}
$_SESSION['Valido'] = true;
$_SESSION['ModalidadeConcurso'] = "Q";
?>

<form action="SOL_Confirma_Solicitacao_Enquete.php" method="POST" name="Form">

<div class="molduraExterna">
<p class="TermoTitulo">
  ENQUETES ELETR&Ocirc;NICAS
</p>

<div class="TermoParagrafo">
  A partir desta solicita&ccedil;&atilde;o, os respons&aacute;veis (gerentes)
  ser&atilde;o respons&aacute;veis pela defini&ccedil;&atilde;o do p�blico-alvo,
  dos locais de vota&ccedil;&atilde;o e do cronograma eleitoral.
</div>
<div class="TermoParagrafo">
  Para configura&ccedil;&atilde;o da Elei&ccedil;&atilde;o, o respons&aacute;vel pelo
	sistema entrar&aacute; em contato para agendar uma reuni&atilde;o presencial, onde
	ser&atilde;o estabelecidas as especifica&ccedil;&otilde;es para o arquivo com a
	lista de participantes do Concurso e as imagens das op&ccedil;&otilde;es.
</div>

<div class="botoes">
  <input type="submit" value="Concordo" /> &nbsp;
  <input type="button" value="Cancelar" onClick="javascript: document.Form.action = 'SOL_Solicitacao_Enquete_Form.php'; document.Form.submit();" /> &nbsp;
</div> 
</div>

</form>

</body>
</html>