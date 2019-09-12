<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao implements InterfaceControladorRequisicao
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
        */
        $curso = $this->repositorioCursos->find($id);
        $titulo = "Alterar Curso - " . $curso->getDescricao();
        require __DIR__ . '/../../view/cursos/formulario-view.php';

    }

}









