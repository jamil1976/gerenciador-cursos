<?php
/*Front controller ou dispatcher - usaremos arquivos para controlar cada entrada no front controller*/
require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;

$caminho = $_SERVER['PATH_INFO']; // /listar-cursos, /novo-curso,...
$rotas = require __DIR__ . '/../config/routes.php';

/*Se não existir o caminho path na chave do array de rotas(a rota/url) eu paro o script e exibo erro*/
if(!array_key_exists($caminho, $rotas))
{
    http_response_code(404);
    exit();
}

/* A sessão é inicializada antes da chamada de qualquer controlador - ou seja, qualquer controlador será executado já com a sessão inicializada.*/
/*Um cookie no HTTP é uma informação de texto armazenada pelo navegador e utilizada sempre que uma nova requisição é enviada para o servidor. O PHP manda um cookie chamado PHPSESSID,
  ou "sessão do PHP", contendo uma hash que permitirá a identificação do usuário. Dessa forma, quando o nosso navegador enviar essa hash na próxima requisição, o PHP reconhecerá que essa sessão é nossa e que temos o atributo logado na sessão, permitindo que continuemos.
A sessao é mantida mesmo que façamos outra requisição http (a nao ser que se encerre a sessao - é qd o user sera deslogado).
*/
session_start();

/*ehRotaLogin === false significa q n existe na rota a palavra login, então, podemos ser redirecionados para login(claro, se a sessao não existir/deslogado)*/
if (!isset($_SESSION['logado']) && $caminho !=='/login' && $caminho !=='/realiza-login') {
    header('Location: /login');
    exit();
}


/*Eu vou pegar o valor da chave(rota), que é a classe controladora correspondente a chave/rota recebida.
 posso instanciar o controller/valor recebido pela variavel classeControladora(virou uma classe).
 O PHP permite que nós utilizemos uma variável como o nome da classe que queremos instanciar
 */
//recebo a classe da rota: Persistencia, FormularioInsercao...

$classeControladora = $rotas[$caminho];

/** @var InterfaceControladorRequisicao $controlador */
$controlador = new $classeControladora();
$controlador->processaRequisicao();


/*Não mexemos mais aqui, basta ir no arquivo de rotas e incluir uma nova rota/controller
O metodo processRequisicao vai executar de acordo com o controler que foi chamado.
*
*
* Temos um front controller, por onde todas requisições passam atraves de url's amigaveis
* O front chama o controller correspondente da rota solicitada e este controler
* busca as informações no model(ENTITY) e retorno para o cliente o resultado(view ou API REST-xml/json).
 * A função http_response_code = header, porém, não redireciona para          uma rota, apenas exibe mensagem.
 * Podemos criar um controler e uma view de erros tambem e nesta view aplicar css/js(front end).
*/