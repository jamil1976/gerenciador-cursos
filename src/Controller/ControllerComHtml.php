<?php


namespace Alura\Cursos\Controller;


/*A classe é abstrata, nunca sera instanciada, utilizamos apenas para o metodo de renderizacao das views
 * O metodo alem de carregar a view vai restringir quais dados ele poderá manipular e exibir no html
Vamos receber os dados(que são os atributos da classe) e converte-los em variaveis para manipular na view
*/
abstract class ControllerComHtml
{
    public function renderizaHtml(string $caminhoTemplate, array $dados): string
    {
        extract($dados);
        ob_start(); //guarde tudo que sera exibido no buffer
        require __DIR__ . '/../../view/' . $caminhoTemplate;
        //pegue/retorne os dados do buffer(o html) como um texto/string e armazena na var html e depois limpe o buffer
        $html = ob_get_clean();

        return $html;
    }
}