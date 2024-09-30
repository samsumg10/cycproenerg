<style>
    .new-form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem; /* Espaciado interno (padding) */
    font-size: 1rem;
    line-height: 1.5;
    color: #495057; /* Color del texto */
    background-color: #fff; /* Fondo blanco */
    background-clip: padding-box;
    border: 1px solid #ced4da; /* Borde gris claro */
    border-radius: 0.25rem; /* Bordes redondeados */
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; /* Transiciones para foco */
}
</style>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <form id="myForm" action="{{ route('company.technicals.store') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="title" class="modal-title text-inspinia text-primary">Registrar Técnico</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" style="color:red; font-size:30px">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input id="tecnicoId" type="hidden" value="" name="tecnicoId">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="new-form-control" id="nombre" name="nombre" value="">
                            <div class="invalid-feedback" id="nombreError"></div>
                        </div>
                        {{-- <div class="col-md-4">
                            <label for="numero_de_documento">Número de documento:</label>
                            <input  type="text" class="new-form-control" id="numero_de_documento" name="numero_de_documento"></input>
                            <div class="invalid-feedback" id="numero_de_documentoError"></div>
                        </div> --}}
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <button id="submitBtn" type="submit" class="btn btn-primary mx-2 submitButton mt-3"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
