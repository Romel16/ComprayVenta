<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/categoriaModels.php");

/*TODO: inicializando clases */
$categoria = new CategoriaModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["categoriaId"])) {
            $categoria->insertarCategoria($_POST["categoriaSucursalId"], $_POST["categoriaNombre"]);
        }else{
            $categoria->updateCategoria($_POST["categoriaId"], $_POST["categoriaSucursalId"],$_POST["categoriaNombre"]);
        }
    break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $categoria->getCategoria_x_sucursalId($_POST["idsucursal"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["categoriaNombre"];
            $sub_array[] = $row["categoriaFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["categoriaId"].')" id="'.$row["categoriaId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["categoriaId"].')" id="'.$row["categoriaId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
            $data[] = $sub_array;

        }

        $result = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
                        
        echo json_encode($result);
        break;
    
        /*TODO: mostrar registros con informacion por medio ID */
    case 'mostrar':
        $datos = $categoria->getCategoria_x_id($_POST["categoriaId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["categoriaId"] = $row["categoriaId"];
                $output["categoriaSucursalId"] = $row["categoriaSucursalId"];
                $output["categoriaNombre"] = $row["categoriaNombre"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $categoria->eliminarCategoria($_POST["categoriaId"]);
        break;
    
        
    /*TODO: Listar Combobox */
    case "combo":
        $datos = $categoria->getCategoria_x_sucursalId($_POST["sucursalId"]);
                   
        if (is_array($datos)==true and count($datos)>0) {
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach ($datos as $row) {
                $html.="<option value='".$row["categoriaId"]."'>".$row["categoriaNombre"]."</option>";
            }
            echo $html;
        }
    break;
    /*TODO: Listar Producto x Categoria */
    case "stock":
        $datos = $categoria->StockProductoxCategoria($_POST["idsucursal"]);
        foreach($datos as $row){
            ?>
                <li class="py-1">
                    <a href="#" class="text-muted"><?php echo $row["categoriaNombre"];?> <span class="float-end">(<?php echo $row["stock"];?>)</span></a>
                </li>
            <?php
        }
    break;
   
}

?>