<?php


namespace Alura\Cursos\Controller;


class FormularioInsercao implements InterfaceControladorRequisicao
{
    public function processaRequisicao(): void
    {
        $titulo = 'Novo Curso';
        require __DIR__ . '/../../view/cursos/formulario-view.php';
    }
}

/*Qd a view formulario-view for carregada ele trará o header e o header vai enxergar a var $titulo*/