<?php


namespace Alura\Cursos\Controller;


class FormularioInsercao extends ControllerComHtml implements InterfaceControladorRequisicao
{
    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/formulario-view.php', [
            'titulo' => 'Novo Curso'
        ]);
    }
}

/*Qd a view formulario-view for carregada ele trará o header e o header vai enxergar a var $titulo*/