<?php


namespace Alura\Cursos\Controller;

/*A interface evita erros para as classes que implementam seus metodos. É uma segurança a mais para quem implementa a interface*/
interface InterfaceControladorRequisicao
{
    public function processaRequisicao(): void;
}