<?php


namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin implements InterfaceControladorRequisicao
{

    private $repositorioUsuarios;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioUsuarios = $entityManager->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST,
            'email',
            FILTER_VALIDATE_EMAIL
        );

        if (is_null($email) || $email === false) {
            echo "O e-mail digitado não é um e-mail válido";
            exit();
        }

        $senha = filter_input(INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING);

        /** @var  $usuario */
        $usuario = $this->repositorioUsuarios
            ->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            echo "E-mail ou senha inválidos";
            return;
        }

        header('Location: /listar-cursos');
    }
}

/*As requisições http entre uma rota e outra sao independentes e para manter dados entre elas usamos a sessão, dessa
 * forma conseguimos manter os dados de login e evitar que alguem acesse diretamente a rota dos cursos.
 *
 * Inserir usuario no banco ser usar cliente de bd: *
 * vendor\bin\doctrine dbal:run-sql "INSERT INTO usuarios (email, senha) VALUES ('jamilabuyagui@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$NEJHU0NMZUptQnNHQTN2Mg$ai6vnv0KFL/S0RPF6NbOZZ3Urqe63xZBPNnbt54eV/o');"
 * A COMPARAÇÃO DA SENHA INSERIDA NO FORM COM A SENHA DO BANCO OCORRE CONVERTENDO A SENHA PARA A MESMA CRIPTOGRAFADA NO BANCO COM A FÇ password_verify(metodo na classe Usuario)
*/