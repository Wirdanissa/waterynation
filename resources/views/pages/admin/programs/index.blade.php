@extends('layouts.admin')
@section('menuProgramShow', 'show')
@section('menuProgramExpanded', 'true')
@section('menuProgramList', 'active')
@section('title', 'Program | Admin Dangau Studio')

@section('admin-content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="nav d-flex flex-column flex-md-row mb-3 align-items-md-center">
                <h5 class="mb-3 fw-bold me-md-auto">Program</h5>
                <a href="{{ route('admin.program.create') }}"
                    class="btn btn-primary rounded-3 btn-sm d-flex align-items-center py-2 px-3 me-3 mb-3" role="button">
                    <i class="ti ti-plus fs-7 me-2"></i>
                    Tambah Program
                </a>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table table-bordered align-middle text-nowrap text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Gambar Program</th>
                            <th scope="col">Judul Program</th>
                            <th scope="col">Deskripsi Program</th>
                            <th scope="col">Tanggal Kegiatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programs as $program)
                            <tr>
                                <td>
                                    @if ($program->category === 'Modul Development For Kids' && $program->link_url)
                                        <iframe width="150" height="80" src="{{ $program->link_url }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    @else
                                        <img src="{{ asset('storage/' . $program->image) }}"
                                            class="rounded shadow border border-secondary" width="150" height="80"
                                            alt="Program {{ $program->title }}">
                                    @endif
                                </td>
                                <td>{{ Str::limit($program->title, 20) }}</td>
                                <td>{{ $program->category }}</td>
                                <td>
                                    {{ tanggal($program->start_date) }} -
                                    {{ tanggal($program->end_date) }}
                                </td>
                                <td>
                                    @if ($program->status_publikasi == 'Published')
                                        <span
                                            class="badge bg-light-success rounded-pill text-success px-3 py-2 fs-3">Published</span>
                                    @else
                                        <span
                                            class="badge bg-light-danger rounded-pill text-danger px-3 py-2 fs-3">Hidden</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.program.edit', $program->id) }}" class="btn btn-primary"><i
                                            class="ti ti-edit"></i></a>
                                    <a href="{{ route('admin.program.destroy', $program->id) }}" class="btn btn-danger"
                                        data-confirm-delete="true"><i class="ti ti-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center pt-4">Belum ada data program</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $programs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
