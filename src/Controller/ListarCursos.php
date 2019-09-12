<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private $repositorioDeCursos;


    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioDeCursos = $entityManager
            ->getRepository(Curso::class);

    }

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/listar-cursos-view.php', [
            'cursos' => $this->repositorioDeCursos->findAll(),
            'titulo' => 'Lista de Cursos'
        ]);
    }
}
/*findAll traz os dados do modelo e armazena em $cursos, para então ser renderizado na view*/
/*O arquivo carregado da view tem acesso a todas as variaveis deste controle, inclçusive os $cursos*/
/*Qd a view listar-cursos for carregada ele trará o header e o header vai enxergar a var $titulo*/