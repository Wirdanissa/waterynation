@extends('layouts.admin')
@section('menuPublikasi', 'active')
@section('title', 'Publikasi | Admin Dangau Studio')

@section('admin-content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="nav d-flex flex-column flex-md-row mb-3 align-items-md-center">
                <h5 class="mb-3 fw-bold me-md-auto">Publikasi</h5>
                <a href="{{ route('admin.publikasi.create') }}"
                    class="btn btn-primary rounded-3 btn-sm d-flex align-items-center py-2 px-3 me-3 mb-3" role="button">
                    <i class="ti ti-plus fs-7 me-2"></i>
                    Tambah Publikasi
                </a>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table table-bordered align-middle text-nowrap text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Gambar Publikasi</th>
                            <th scope="col">Judul Publikasi</th>
                            <th scope="col">Deskripsi Publikasi</th>
                            <th scope="col">Author</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publikasis as $publikasi)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $publikasi->image) }}"
                                        class="rounded shadow border border-secondary" width="150" height="80"
                                        alt="publikasi {{ $publikasi->title }}">
                                </td>
                                <td>{{ Str::limit($publikasi->title, 20) }}</td>
                                <td>{!! Str::limit($publikasi->description, 20) !!}</td>
                                <td>{{ $publikasi->author }}</td>
                                <td>
                                    @if ($publikasi->status_publikasi == 'Published')
                                        <span
                                            class="badge bg-light-success rounded-pill text-success px-3 py-2 fs-3">Published</span>
                                    @else
                                        <span
                                            class="badge bg-light-danger rounded-pill text-danger px-3 py-2 fs-3">Hidden</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.publikasi.edit', $publikasi->id) }}" class="btn btn-primary"><i
                                            class="ti ti-edit"></i></a>
                                    <form action="{{ route('admin.publikasi.destroy', $publikasi->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center pt-4">Belum ada data publikasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $publikasis->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
