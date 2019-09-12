<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao extends ControllerComHtml implements InterfaceControladorRequisicao
{

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
          INPUT_GET,
          'id',
          FILTER_VALIDATE_INT
        );

        if (is_null($id || $id === false)) {
            header('Location: /listar-cursos');
            return;
        }

        /*Buscaremos o curso correspondente do repositorio e ao carregar a view ela vai enxergar a var curso e seus valores
        No formulario-view eu faço a a verificação e envio dados para Persistencia.
        A função renderiza retorna uma string da view renderizada
        */
        $curso = $this->repositorioCursos->find($id);
        echo $this->renderizaHtml('cursos/formulario-view.php', [
            'curso' => $curso,
            'titulo' => "Alterar Curso - " . $curso->getDescricao()
        ]);

    }

}









