<?php
/* TODO: LLAMANDO CLASES */
require_once("../config/conexion.php");
require_once("../models/Categoria.php");
/* TODO: INICIALIZACION CLASE */
$categoria=new Categoria();

switch($_GET["op"]){
    /* TODO: GUARDAR Y EDITAR */
    case "guardaryeditar";
        if(empty($_POST["cat_id"])){
            $categoria->insert_categoria($_PSOT["suc_id"],$_POST["cat_nom"]);
        }else{
            $categoria->update_categoria($_POST["cat_id"],$_POST["suc_id"],$_POST["cat_nom"]);
        }
        break;

        /* TODO: LISTADO DE REGISTROS */
    case "listar";
        $datos=$categoria->get_categoria_x_suc_id($_POST["suc_id"]);
        $data=Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array = $row["cat_nom"];
            $sub_array = "Editar";
            $sub_array = "Eliminar";
            $data[] = $sub_array;
        }
        $result = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        break;

        /* TODO: MOSTRS INFORMACION DE REGISTRO */
    case "mostrar";
        $datos=$categoria->get_categoria_x_cat_id($_POST["cat_id"]);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $output["cat_id"] = $row["cat_id"];
                $output["suc_id"] = $row["suc_id"];
                $output["cat_nom"] = $row["cat_nom"];
            }
            echo json_encode($output);
        }
        break;

        /* TODO: ELIMINAR */
    case "eliminar";
        $categoria->delete_categoria($_POST["cat_id"]);
        break;

}
?>