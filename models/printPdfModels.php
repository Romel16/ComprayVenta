<?php
    require_once '../include/vendor/autoload.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;

    require_once("../config/conexion.php");
    require_once("../models/ventaModels.php");

    class printPdfModels extends Conectar {

        public function getPdfVenta($idventa){
            
            $options = new Options();

            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);

            $css = file_get_contents('../assets/css/stylepdf.css');

            $venta = new VentaModels();

             /* Obteniendo el detalle de cabezera */
             $cabezera = $venta->getVenta($idventa);
             foreach ($cabezera as $rowc){
                 $documento = $rowc["documentoNombre"];
 
                 $empresa = $rowc["empresaNombre"];
                 $empresaruc = $rowc["empresaRuc"];
                 $empresacorreo = $rowc["empresaCorreo"];
                 $empresatelf = $rowc["empresaTelefono"];
 
                 $clinom = $rowc["clienteNombre"];
                 $cliruc = $rowc["clienteRuc"];
                 $clidirecc = $rowc["clienteDireccion"];
                 $clicorreo = $rowc["clienteCorreo"];
                 $fechcrea = $rowc["ventaFechaCreacion"];
                 $pago = $rowc["pagoNombre"];
 
                 $subtotal = $rowc["ventaSubTotal"];
                 $igv = $rowc["ventaIgv"];
                 $total = $rowc["ventaTotal"];
             }

            $detalle = $venta->getList_detalleventa($idventa);
            $tbody = "";

            foreach ($detalle as $row) {
                $tbody.='
                    <tr>
                        <td class="service">'.$row["categoriaNombre"].'</td>
                        <td class="desc">'.$row["productoNombre"].'</td>
                        <td class="service">'.$row["unidadNombre"].'</td>
                        <td class="unit">'.$row["detalleventaProductoPrecioVenta"].'</td>
                        <td class="qty">'.$row["detalleventaCantidad"].'</td>
                        <td class="total">'.$row["detalleventaTotal"].'</td>
                    </tr>
                ';
            }


            $html = '
            
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <title>v-' . $idventa . '</title>
                    <style>' . $css . '</style>
                </head>
                <body>
                    <header class="clearfix">
                    <div id="logo">
                        <img src="">
                    </div>
                    <h1>' . $documento . ' ' . $idventa . '</h1>
                    <div id="company" class="clearfix">
                        <div><span>Empresa</span> ' . $empresa . '</div>
                        <div><span>Ruc</span> ' . $empresaruc . '</div>
                        <div><span>Telefono</span> ' . $empresatelf . '</div>
                        <div><span>Correo</span> ' . $empresacorreo . '</div>
                    </div>
                    <div id="project">
                        <div><span>Nombre</span> ' . $clinom . '</div>
                        <div><span>RUC</span> ' . $cliruc . '</div>
                        <div><span>Dirección</span> ' . $clidirecc . '</div>
                        <div><span>Correo</span> <a href="' . $clicorreo . '">' . $clicorreo . '</a></div>
                        <div><span>Fecha</span> ' . $fechcrea . '</div>
                        <div><span>Pago</span> ' . $pago . '</div>
                    </div>
                    </header>
                    <main>
                    <table>
                        <thead>
                        <tr>
                            <th class="service">Categoria</th>
                            <th class="desc">Producto</th>
                            <th>Und</th>
                            <th>P.Venta</th>
                            <th>Cant</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        '.$tbody.'
                        <tr>
                            <td colspan="5">SubTotal</td>
                            <td class="total">' . $subtotal . '</td>
                        </tr>
                        <tr>
                            <td colspan="5">IGV (18%)</td>
                            <td class="total">' . $igv . '</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="grand total">Total</td>
                            <td class="grand total">' . $total . '</td>
                        </tr>
                        </tbody>
                    </table>
                    <div id="notices">
                        <div>NOTICE:</div>
                        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    </div>
                    </main>
                    <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                    </footer>
                </body>
                </html>
            ';

            $dompdf->loadHtml($html);
            $dompdf->render();

            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=v-'.$idventa.'.pdf');
            header('Cache-Control: public, must-revalidate, max-age=0');
            header('Pragma: public');

            $filelocation = "../assets/pdf/venta/v-".$idventa.".pdf";
            $dompdf->output();
            file_put_contents($filelocation,$dompdf->output());

            exit();
        }

    }

?>