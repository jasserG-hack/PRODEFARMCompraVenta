<?php
/* TODO: LLAMANDO CLASES */
require_once("../config/conexion.php");
require_once("../models/Unidad.php");
/* TODO: INICIALIZACION CLASE */
$unidad=new Unidad();

switch($_GET["op"]){
    /* TODO: GUARDAR Y EDITAR */
    case "guardaryeditar";
        if(empty($_POST["und_id"])){
            $unidad->insert_unidad($_PSOT["suc_id"],$_POST["und_nom"]);
        }else{
            $unidad->update_unidad($_POST["und_id"],$_POST["suc_id"],$_POST["und_nom"]);
        }
        break;

        /* TODO: LISTADO DE REGISTROS */
    case "listar";
        $datos=$unidad->get_unidad_x_suc_id($_POST["suc_id"]);
        $data=Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array = $row["und_nom"];
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
        $datos=$unidad->get_unidad_x_und_id($_POST["und_id"]);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $output["und_id"] = $row["und_id"];
                $output["suc_id"] = $row["suc_id"];
                $output["und_nom"] = $row["und_nom"];
            }
            echo json_encode($output);
        }
        break;

        /* TODO: ELIMINAR */
    case "eliminar";
        $unidad->delete_unidad($_POST["und_id"]);
        break;

}
?>