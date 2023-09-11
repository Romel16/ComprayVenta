<div id="modalmantenimiento" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento de Usuario-->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="usuarioId" id="usuarioId"/>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Correo</label>
                                <input type="text" class="form-control" id="usuarioCorreo" name="usuarioCorreo" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="usuarioNombre" name="usuarioNombre" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="usuarioApellido" name="usuarioApellido" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Dni</label>
                                <input type="text" class="form-control" id="usuarioDni" name="usuarioDni" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Telefono</label>
                                <input type="text" class="form-control" id="usuarioTelefono" name="usuarioTelefono" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" id="usuarioPassword" name="usuarioPassword" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Rol</label>
                                <select type="text" class="form-control" id="usuarioRolId" name="usuarioRolId" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>
                                </select>
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