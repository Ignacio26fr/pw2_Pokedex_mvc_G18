<?php

class PokedexController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function get()
    {
        $pokemones = $this->model->getPokemones();//buscar en la base de datos pokemones
        $this->presenter->render("view/PokedexView.mustache", ["pokemon" => $pokemones]);
    }

    public function info_pokedex()
    {
        $id = $_GET["id"];

        $pokemonEncontrado = $this->model->buscarPokemon($id);

        $this->presenter->render("view/InfoPokemonView.mustache", ["pokemon" => $pokemonEncontrado]);

        exit();
    }

    public function login()
    {
        session_start();

        $usuario = $_POST["name"];
        $password = $_POST["password"];

        $resultado = $this->model->iniciarSesion($usuario,$password);

        if($resultado == 1){
            header("Location:/homeUsuario");
            exit();
        }

        if($resultado == 0 || $resultado == 2 || $resultado == 3 ){
            header("Location:/pokedex");
            exit();
        }

    }


}
