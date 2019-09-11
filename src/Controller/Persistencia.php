<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        //pegar dados do formulario-view
        //Vou filtrar os dados enviados via post do campo descricao(filter_var analisa uma variavel interna da aplicação)
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        //montar modelo curso-entity com os dados enviados via post do formulario
        $curso = new Curso();
        $curso->setDescricao($descricao);

        //inserir no banco
        $this->entityManager->persist($curso);
        $this->entityManager->flush();

        header('Location: /listar-cursos');
    }

}

/*
 * O php pode mandar para o navegador, com a função header,  um cabeçalho de nome Location com valor (a url de destino)
 * 302 é status de redirecionamento
 * Não podemos redirecionar e mandar uma mensagem, isto é feito do lado client/front end...com JS ou JQuery
 * A função filter_input filtra os dados recebidos da requisição, enquanto filter_var filtra
 * o valor de qualquer variável que tenhamos no código.
 *
 * */






