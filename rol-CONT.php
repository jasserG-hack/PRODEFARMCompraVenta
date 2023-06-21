<?php
/* TODO: LLAMANDO CLASES */
require_once("../config/conexion.php");
require_once("../models/Rol.php");
/* TODO: INICIALIZACION CLASE */
$rol=new Rol();

switch($_GET["op"]){
    /* TODO: GUARDAR Y EDITAR */
    case "guardaryeditar";
        if(empty($_POST["rol_id"])){
            $rol->insert_rol($_PSOT["suc_id"],$_POST["rol_nom"]);
        }else{
            $rol->update_rol($_POST["rol_id"],$_POST["suc_id"],$_POST["rol_nom"]);
        }
        break;

        /* TODO: LISTADO DE REGISTROS */
    case "listar";
        $datos=$rol->get_rol_x_suc_id($_POST["suc_id"]);
        $data=Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array = $row["rol_nom"];
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
        $datos=$rol->get_rol_x_rol_id($_POST["rol_id"]);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $output["rol_id"] = $row["rol_id"];
                $output["suc_id"] = $row["suc_id"];
                $output["rol_nom"] = $row["rol_nom"];
            }
            echo json_encode($output);
        }
        break;

        /* TODO: ELIMINAR */
    case "eliminar";
        $rol->delete_rol($_POST["rol_id"]);
        break;

}
?>