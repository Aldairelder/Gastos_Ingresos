@extends('layouts.app')
@section('roles', 'active')
@section('titulo', 'Roles')
@section('contenido')
<section class="content">
    <!-- container-fluid -->
    <div class="container-fluid">
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="icon fas fa-check"></i>
            <strong>Success!</strong> {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">.:. Listado - roles .:. </h3>
                <div class="card-tools">
                    <div class="btn btn-tool">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">Añadir</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>ROL</th>
                                <th>DESCRIPCION</th>
                                <th>REGISTRADO</th>
                                <th style="width: 50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($roles->count() > 0)
                            @foreach ($roles as $rs)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $rs->rol }}</td>
                                <td class="align-middle">{{ $rs->descripcion }}</td>
                                <td class="align-middle" title="{{ $rs->created_at }}">{{ $rs->created_at->diffForHumans() }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('permisos', $rs->id) }}" type="button" class="btn btn-dark"><i class="fas fa-key"></i></a>
                                        <a data-target="#modal-edit-{{ $rs->id }}" type="button" data-toggle="modal" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                        <a data-target="#modal-delete-{{ $rs->id }}" type="button" data-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            {{-- <!-- @include('roles.modal.show') -->
                                        <!-- @include('roles.modal.edit') -->
                                        <!-- @include('roles.modal.delete') --> --}}
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="5">No Tiene registros</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>ROL</th>
                                <th>DESCRIPCION</th>
                                <th>REGISTRADO</th>
                                <th style="width: 50px"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!--/. container-fluid -->
</section>
@endsection