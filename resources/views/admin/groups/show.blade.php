@extends('layouts.layout')

@section('title', 'Mostrar Grupo')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Grupo: {{ $group->name }}
        </h1>
        <a href="{{ route('grupos.index') }}" class="btn btn-sm btn-primary pull-right">Volver</a>
    </div>

    <p>Cada Grupo esta conformado por 3 a más estudiantes, y por 1 a más asesores.</p>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Estudiantes
                        <a href="#" class="btn btn-sm btn-success float-right" id="btn_add_student">Nuevo Estudiante</a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered" id="students">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="add_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form_output"></div>
                <form method="POST" id="newStudentForm">
                    @csrf
                    <input type="hidden" id="group_id" name="group_id" value="{{ $group->id }}">
                    <div class="form-group row">
                        <label for="code" class="col-form-label col-sm-2">Código</label>
                        <div class="col-sm-10">
                            <input type="text" id="code" name="code" class="form-control" value="{{ old('code') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-form-label col-sm-2">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-sm btn-success">Nuevo Estudiante</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="salida"></div>
                <form method="POST" id="editStudentForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="student_id" name="student_id">
                    <div class="form-group row">
                        <label for="edit_code" class="col-form-label col-sm-2">Código</label>
                        <div class="col-sm-10">
                            <input type="text" id="edit_code" name="code" class="form-control" id="edit_code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit_name" class="col-form-label col-sm-2">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" id="edit_name" name="name" class="form-control" id="edit_name">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-sm btn-primary">Editar Estudiante</button>
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            var group_id = $("#group_id").val();
            $("#students").DataTable({
                processing: true,
                serverside: true,
                ajax: "/admin/students/" + group_id,
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'code'},
                    {data: 'action', orderable: false, searchable: false}
                ],
                order: [[0, "DESC"]],
                "language": { "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json" }
            });

            // open modal
            $("#btn_add_student").click(function() {
                $('#add_modal').modal('show');
                $('#form_output').html('');
                $("#newStudentForm").trigger("reset");
            });

            // store student
            $("#newStudentForm").on("submit", function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('students.store') }}",
                    method: "POST",
                    data: form_data,
                    success: function(data)
                    {
                        if (data.errors.length > 0)
                        {
                            var errors_html = "<div class='alert alert-danger'><ul>";
                            for (var i = 0; i < data.errors.length; i++)
                            {
                                errors_html += "<li>" + data.errors[i] + "</li>";
                            }
                            errors_html += "</ul></div>";
                            $("#form_output").html(errors_html);
                        }
                        else
                        {
                            $("#form_output").html(data.message);
                            $("#newStudentForm").trigger("reset");
                            $("#students").DataTable().ajax.reload();
                        }
                    }
                });

            });

            //show edit form
            $(document).on('click', '.edit', function() {
                var id = $(this).attr("id");
                $("#salida").html('');
                $.ajax({
                    url: "students/" + id,
                    success: function(data)
                    {
                        $("#edit_code").val(data.code);
                        $("#edit_name").val(data.name);
                        $("#student_id").val(id);
                        $("#edit_modal").modal("show");
                    }
                });
            });

            // update student
            $("#editStudentForm").on("submit", function(event) {
                event.preventDefault();
                var id = $("#student_id").val();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "students/" + id,
                    method: "POST",
                    data: form_data,
                    success: function(data)
                    {
                        if(data.errors.length > 0)
                        {
                            // contenido del mensaje de errores
                            var errors_html = "<div class='alert alert-danger'><ul>";
                            for(var i = 0; i < data.errors.length; i++)
                            {
                                errors_html += "<li>" + data.errors[i] + "</li>";
                            }
                            errors_html += "</ul></div>";
                            $("#salida").html(errors_html);
                        }
                        else
                        {
                            $("#salida").html(data.message);
                            $("#students").DataTable().ajax.reload();
                        }
                    }
                });
            });

            // delete
            $(document).on('click', '.delete', function(){
                var id = $(this).attr('id');
                if(confirm("Are you sure you want to Delete this data?"))
                {
                    $.ajax({
                        url: "students/" + id,
                        method: "POST",
                        data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "DELETE",
                                "id": id,
                                },
                        success: function(data)
                        {
                            alert(data);
                            $('#students').DataTable().ajax.reload();
                        }
                    })
                }
                else
                {
                    return false;
                }
            }); 

        });
    </script>
@endpush