<?php

    require_once('config.php');

    try {
        $bd = new PDO($host . ';dbname=' . $nomBase, $ndc, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

?>