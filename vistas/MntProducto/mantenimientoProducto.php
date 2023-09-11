<div id="modalmantenimiento" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento de productonte-->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="productoId" id="productoId"/>

                    
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Categoria</label>
                                <select type="text" class="form-control" id="productoCategoriaId" name="productoCategoriaId" required>
                                        <option selected>Seleccionar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="productoNombre" name="productoNombre" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Descripcion</label>
                                <input type="text" rows="2" class="form-control" id="productoDescripcion" name="productoDescripcion" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Unidad</label>
                                <select type="text" class="form-control" id="productoUnidadId" name="productoUnidadId" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Moneda</label>
                                <select type="text" class="form-control" id="productoMonedaId" name="productoMonedaId" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Precio Compra</label>
                                <input type="text" class="form-control" id="productoPrecioCompra" name="productoPrecioCompra" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Precio Venta</label>
                                <input type="text" class="form-control" id="productoPrecioVenta" name="productoPrecioVenta" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="productoStock" name="productoStock" required/>
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary ">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>