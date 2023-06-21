<?php
/* TODO: LLAMANDO CLASES */
require_once("../config/conexion.php");
require_once("../models/Cliente.php");
/* TODO: INICIALIZACION CLASE */
$cliente=new Cliente();

switch($_GET["op"]){
    /* TODO: GUARDAR Y EDITAR */
    case "guardaryeditar";
        if(empty($_POST["cli_id"])){
            $cliente->insert_cliente($_PSOT["emp_id"],$_POST["cli_nom"],$_POST["cli_ruc"],$_POST["cli_telf"],$_POST["cli_direcc"],$_POST["cli_correo"]);
        }else{
            $cliente->update_cliente($_POST["cli_id"],$_PSOT["emp_id"],$_POST["cli_nom"],$_POST["cli_ruc"],$_POST["cli_telf"],$_POST["cli_direcc"],$_POST["cli_correo"]);
        }
        break;

        /* TODO: LISTADO DE REGISTROS */
    case "listar";
        $datos=$cliente->get_cliente_x_semp_id($_POST["emp_id"]);
        $data=Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array = $row["cli_nom"];
            $sub_array = $row["cli_ruc"];
            $sub_array = $row["cli_telf"];
            $sub_array = $row["cli_direcc"];
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
        $datos=$cliente->get_cliente_x_cli_id($_POST["cli_id"]);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $output["cli_id"] = $row["cli_id"];
                $output["emp_id"] = $row["emp_id"];
                $output["cli_nom"] = $row["cli_nom"];
                $output["cli_ruc"] = $row["cli_ruc"];
                $output["cli_telf"] = $row["cli_telf"];
                $output["cli_direcc"] = $row["cli_direcc"];
                $output["cli_correo"] = $row["cli_correo"];

            }
            echo json_encode($output);
        }
        break;

        /* TODO: ELIMINAR */
    case "eliminar";
        $cliente->delete_cliente($_POST["cli_id"]);
        break;

}
?>