<?php

namespace app\Http\Middleware;

class Queue {

    /**
     * Mapeamento de middleware
     * @var array
     */
    private static $map = [];

    /**
     * Mapeamento de middlewares que serao carregados em todas as rotas
     * @var array
     */
    private static $defaut = [];

    /**
     * Fila de middlewares a serem executados
     * @var array
     */
    private $middlewares = [];

    /**
     * Funcao de execucao do controlador
     * @var Closure
     */
    private $controller;

    /**
     * Aragumentos da funcao do controlador
     * @var array
     */
    private $controllerArgs = [];

    /**
     * Metodo responsavel por construir a classe de fula de middlewares
     * @param array $middlewares
     * @param Closure $controller
     * @param array $controllerArgs
     */
    public function __construct($middlewares,$controller,$controllerArgs) {
        $this->middlewares = array_merge(self::$defaut,$middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }


    /**
     * Metodo responsavel por definir o mapeamento de middlewares
     * @var array
     */
    public static function setMap($map){
        self::$map = $map;
    }

    /**
     * Metodo responsavel por definir o mapeamento de middlewares padroes
     * @var array $default
     */
    public static function setDefault($defaut){
        self::$defaut = $defaut;
    }

    /**
     * Metodo responsavel por executar o proximo nivel da fila de Middlewares
    //  * @param Request $request
    //  * @return Response
     */
    public function next($request){
        //VERIFICA SE A FILA ESTA VAZIA
        if(empty($this->middlewares)) return call_user_func_array($this->controller,$this->controllerArgs);

        //MIDDLEWARE
        $middleware = array_shift($this->middlewares);

        //VERIFICA O MAPEAMENTO
        if(!isset(self::$map[$middleware])){
            throw new \Exception("Problemas ao processar o middlewares da requisição", 500);
        }

        //NEXT
        $queue = $this;
        $next = function($request) use($queue){
            return $queue->next($request);
        };

        //EXECUTA O MIDDLEWARE
        return (new self::$map[$middleware])->handle($request,$next);
    }
}