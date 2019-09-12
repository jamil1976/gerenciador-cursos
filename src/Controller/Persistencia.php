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

        /*Se o id ja existe eu atualizo/altero senao eu crio um novo curso*/
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT);

        if (!is_null($id) && $id !== false) {
            /* atualizar - ja tenho a entidade curso montada, só vou juntar/merge as atualizaçoes nesta entidade
             curso com o curso que ja existe no banco para este id*/
            $curso->setId($id);
            $this->entityManager->merge($curso);
        } else {
            //inserir
            $this->entityManager->persist($curso);
        }
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
 * O controller de persistencia faz tanto a inclusão de umnovo curso como a alteração do curso existente. Tudo depende
 * do que é enviado via no formulario.view via query string(na url o id ou não).
 * */






