<?php
include_once ("controller/SongsController.php");
include_once ("controller/ToursController.php");
include_once ("controller/LaBandaController.php");
include_once ("controller/PokedexController.php");

include_once ("model/SongsModel.php");
include_once ("model/ToursModel.php");
include_once ("model/PokedexModel.php");

include_once ("helper/Database.php");
include_once ("helper/Router.php");

include_once ("helper/Presenter.php");
include_once ("helper/MustachePresenter.php");

include_once('vendor/mustache/src/Mustache/Autoloader.php');

class Configuration
{

    // CONTROLLERS
    public static function getLaBandaController()
    {
        return new LaBandaController(self::getPresenter());
    }

    public static function getPokedexController()
    {
        return new PokedexController(self::getPokedexModel(), self::getPresenter());
    }

    public static function getToursController()
    {
        return new ToursController(self::getToursModel(), self::getPresenter());
    }

    public static function getSongsController()
    {
        return new SongsController(self::getSongsModel(), self::getPresenter());
    }

    // MODELS
    private static function getToursModel()
    {
        return new ToursModel(self::getDatabase());
    }

    private static function getPokedexModel()
    {
        return new PokedexModel(self::getDatabase());
    }

    private static function getSongsModel()
    {
        return new SongsModel(self::getDatabase());
    }


    // HELPERS
    //Para crear la conexion a la Base de Datos
    public static function getDatabase()
    {
        $config = self::getConfig();
        return new Database($config["servername"], $config["username"], $config["password"], $config["dbname"]);
    }

    private static function getConfig()
    {
        return parse_ini_file("config/config.ini");
    }

    //Si lo que te piden no existe agarra este particular
    public static function getRouter()
    {
        return new Router("getPokedexController", "get");
    }

    private static function getPresenter()
    {
        return new MustachePresenter("view/template");
    }

}