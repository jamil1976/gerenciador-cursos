<?php

use Alura\Cursos\Controller\{Exclusao,
    FormularioEdicao,
    FormularioInsercao,
    FormularioLogin,
    ListarCursos,
    Persistencia,
    RealizarLogin};

return [
  '/listar-cursos' => ListarCursos::class,
  '/novo-curso' => FormularioInsercao::class,
  '/salvar-curso' =>Persistencia::class,
  '/excluir-curso' =>Exclusao::class,
  '/alterar-curso' =>FormularioEdicao::class,
  '/login' => FormularioLogin::class,
  '/realiza-login' => RealizarLogin::class
];

/*Retornaremos o arquivo para quem chamar ele, no caso o front controller(um arquivo tb pode ser retornado)*/
