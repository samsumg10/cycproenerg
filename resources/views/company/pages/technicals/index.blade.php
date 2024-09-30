@extends('company.layouts.user_type.auth')

@section('content')

    <div class="container-fluid py-4">

        {{-- <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <a href="" id="upload-trigger">
                        <div class=" text-center border-radius-xl mt-n4 position-absolute">
                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><rect width="16" height="9" x="28" y="15" fill="#21a366"/><path fill="#185c37" d="M44,24H12v16c0,1.105,0.895,2,2,2h28c1.105,0,2-0.895,2-2V24z"/><rect width="16" height="9" x="28" y="24" fill="#107c42"/><rect width="16" height="9" x="12" y="15" fill="#3fa071"/><path fill="#33c481" d="M42,6H28v9h16V8C44,6.895,43.105,6,42,6z"/><path fill="#21a366" d="M14,6h14v9H12V8C12,6.895,12.895,6,14,6z"/><path d="M22.319,13H12v24h10.319C24.352,37,26,35.352,26,33.319V16.681C26,14.648,24.352,13,22.319,13z" opacity=".05"/><path d="M22.213,36H12V13.333h10.213c1.724,0,3.121,1.397,3.121,3.121v16.425	C25.333,34.603,23.936,36,22.213,36z" opacity=".07"/><path d="M22.106,35H12V13.667h10.106c1.414,0,2.56,1.146,2.56,2.56V32.44C24.667,33.854,23.52,35,22.106,35z" opacity=".09"/><linearGradient id="flEJnwg7q~uKUdkX0KCyBa" x1="4.725" x2="23.055" y1="14.725" y2="33.055" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#18884f"/><stop offset="1" stop-color="#0b6731"/></linearGradient><path fill="url(#flEJnwg7q~uKUdkX0KCyBa)" d="M22,34H6c-1.105,0-2-0.895-2-2V16c0-1.105,0.895-2,2-2h16c1.105,0,2,0.895,2,2v16	C24,33.105,23.105,34,22,34z"/><path fill="#fff" d="M9.807,19h2.386l1.936,3.754L16.175,19h2.229l-3.071,5l3.141,5h-2.351l-2.11-3.93L11.912,29H9.526	l3.193-5.018L9.807,19z"/></svg>
                        </div>
                    </a>
                    <div class="text-end pt-1">
                        <h4 class="mb-0 text-capitalize">Cargar Datos</h4>
                        <p id="result-message" class="text-sm mb-0 text-capitalize">...</p>
                        

                        <div class="progress" id="progress-bar-container" style="height: 25px; display: none;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" id="progress-bar"></div>
                        </div>
                        <div id="result-icon" class="text-center mt-3" style="display: none;">
                            <!-- Aquí se mostrará el icono de éxito o error después de la carga -->
                        </div>
                        
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- Sección de error -->
                    <div id="error-message" style="display: none;" class="text-danger">
                       
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <a class="btn btn-primary OpenModal" data-toggle="modal" data-target="myModal">Registrar</a>
                        <div class="row mt-3">
                            <div class="col-lg-6 col-7">
                                <h6>Tecnicos</h6>
                                {{-- <p class="text-sm mb-0">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">30 done</span> this month
                            </p> --}}
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a>
                                        </li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Another
                                                action</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Something
                                                else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">

                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Vendedor</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Solicitudes
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($tecnicos ?? []) > 0)
                                        @foreach ($tecnicos as $tecnico)
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold">{{ $tecnico->nombre }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold"></span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a class="mx-3 edit-form-data  OpenModal" data-toggle="modal"
                                                        data-target="#myModal" data-head-id="{{ $tecnico->id }}">
                                                        <i class="fa fa-edit fa-lg text-secundary"></i>
                                                    </a>
                                                    <a class="delete-btn" data-head-id="{{ $tecnico->id }}">
                                                        <i class="far fa-trash-alt fa-lg text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="align-middle text-center text-sm" colspan="5">No existen técnicos
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <br>
                            <div class="d-flex justify-content-center">
                                {{ $tecnicos->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="form-delete"
            action="{{ route('company.technicals.destroy', '') }}"
            method="POST" class="d-inline" style="cursor:pointer">
            @csrf
            @method('DELETE')
        </form>

        @include('company.pages.technicals.form')

        {{-- <input type="file" id="file-input" style="display: none;" accept=".xls,.xlsx" /> --}}

        <script>
            $(document).ready(function() {
                initModal('.OpenModal', '/company/technicals/', {
                    id: 'head-id',
                    titleEdit: "Editar",
                    titleCreate: "Registrar",
                    submitTextEdit: "Actualizar",
                    submitTextCreate: "Guardar",
                    modalID: '#myModal',
                });

                initFormSubmission('#myForm', '#myModal');

                //Delete Tecnico
                $('.delete-btn').on('click', function() {
                    var tecnicoId = $(this).data('head-id')
                    var action = $('#form-delete').attr('action') + '/' +  tecnicoId;
                    console.log(action);
                    confirmDelete(function() {
                        $('#form-delete').attr('action', action).submit();
                    });
                });

                //Edit Tecncio
                $(document).ready(function() {
                    $('.edit-form-data').on('click', function() {
                        var tecnicoId = $(this).data('head-id');
                        $('#myModal input#tecnicoId').val(tecnicoId);
                    })
                });
            });
        </script>
        {{-- <script>
        // Elementos del DOM
        const uploadTrigger = document.getElementById('upload-trigger');
        const fileInput = document.getElementById('file-input');
        const progressBar = document.getElementById('progress-bar');
        const progressBarContainer = document.getElementById('progress-bar-container');
        const resultIcon = document.getElementById('result-icon');
        const resultMessage = document.getElementById('result-message');
        const titleElement = document.querySelector('h4.mb-0.text-capitalize');

        // Evento cuando se hace clic en el ícono de Excel
        uploadTrigger.addEventListener('click', function(event) {
            event.preventDefault();
            fileInput.click();
        });

        // Evento cuando se selecciona un archivo
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                uploadExcel(file);
            }
        });

        // Función para realizar una carga de archivo con seguimiento de progreso real
        function uploadExcel(file) {
            // Resetear la interfaz
            resetUI();
            
            // Cambiar el título y mensaje durante la carga
            titleElement.textContent = 'Cargando...';
            resultMessage.textContent = 'Procesando...';

            const xhr = new XMLHttpRequest();
            const formData = new FormData();
            formData.append('file', file);

            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    const percentComplete = (event.loaded / event.total) * 100;
                    progressBar.style.width = percentComplete + '%';
                }
            });

            xhr.addEventListener('load', function() {
                let response;
                try {
                    response = JSON.parse(xhr.responseText);
                } catch (e) {
                    handleError('Error al procesar la respuesta del servidor.');
                    return;
                }

                if (xhr.status === 200 && response.success) {
                    handleSuccess(response.message);
                } else {
                    handleError(response.message || 'Error al procesar el archivo.');
                }
            });

            xhr.addEventListener('error', function() {
                handleError('Error de conexión al servidor.');
            });

            xhr.addEventListener('timeout', function() {
                handleError('La solicitud ha excedido el tiempo de espera.');
            });

            xhr.open('POST', '/company/change');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(formData);
        }

        function resetUI() {
            progressBar.style.width = '0%';
            progressBar.classList.remove('bg-success', 'bg-danger');
            progressBar.classList.add('bg-secondary');
            progressBarContainer.style.display = 'block';
            resultIcon.style.display = 'none';
            titleElement.textContent = 'Cargar Datos';
            resultMessage.textContent = '';
        }

        function handleSuccess(message) {
            progressBar.classList.remove('bg-secondary');
            progressBar.classList.add('bg-success');
            resultIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 48 48" width="48px" height="48px"><path d="M 24 4 C 12.972874 4 4 12.972874 4 24 C 4 35.027126 12.972874 44 24 44 C 35.027126 44 44 35.027126 44 24 C 44 12.972874 35.027126 4 24 4 z M 24 6 C 34.010184 6 42 13.989816 42 24 C 42 34.010184 34.010184 42 24 42 C 13.989816 42 6 34.010184 6 24 C 6 13.989816 13.989816 6 24 6 z M 20.792969 31.707031 L 12.792969 23.707031 L 14.207031 22.292969 L 20.792969 28.878906 L 33.792969 15.878906 L 35.207031 17.292969 L 20.792969 31.707031 z"/></svg>';
            resultIcon.style.display = 'block';
            titleElement.textContent = 'Datos Cargados';
            resultMessage.textContent = message;
        }

        function handleError(message) {
            progressBar.classList.remove('bg-secondary');
            progressBar.classList.add('bg-danger');
            resultIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 48 48" width="48px" height="48px"><path d="M 24 4 C 12.972874 4 4 12.972874 4 24 C 4 35.027126 12.972874 44 24 44 C 35.027126 44 44 35.027126 44 24 C 44 12.972874 35.027126 4 24 4 z M 24 6 C 34.010184 6 42 13.989816 42 24 C 42 34.010184 34.010184 42 24 42 C 13.989816 42 6 34.010184 6 24 C 6 13.989816 13.989816 6 24 6 z M 16.585938 16.585938 L 15.171875 18 L 22.171875 25 L 15.171875 32 L 16.585938 33.414062 L 23.585938 26.414062 L 30.585938 33.414062 L 32 32 L 25 25 L 32 18 L 30.585938 16.585938 L 23.585938 23.585938 L 16.585938 16.585938 z"/></svg>';            resultIcon.style.display = 'block';
            titleElement.textContent = 'Error al Cargar Datos';
            resultMessage.textContent = message;
        }
    </script> --}}




    @endsection
