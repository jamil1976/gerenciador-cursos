<?php
/*Front controller ou dispatcher - usaremos arquivos para controlar cada entrada no front controller*/
require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\ListarCursos;

switch ($_SERVER['PATH_INFO']) {
    case '/listar-cursos':
        $controlador = new ListarCursos();
        $controlador->processaRequisicao();
        break;
    case '/novo-curso':
        $controlador = new FormularioInsercao();
        $controlador->processaRequisicao();
        break;
    default:
        echo "Erro 404";
        break;
}

/**
 * Temos um front controller, por onde todas requisições passam atraves de url's amigaveis
 * O front chama o controler correspondente a rota solicitada e este controler
 * busca as informações no model(ENTITY) e retorno para o cliente o resultado(view ou API REST-xml/json).
 */