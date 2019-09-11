<?php

use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;

return [
  '/listar-cursos' => ListarCursos::class,
  '/novo-curso' => FormularioInsercao::class,
  '/salvar-curso' =>Persistencia::class
];

/*Retornaremos o arquivo para quem chamar ele, no caso o front controller(um arquivo tb pode ser retornado)*/
