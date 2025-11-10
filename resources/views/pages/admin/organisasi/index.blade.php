@extends('layouts.admin')
@section('menuOrganisasi', 'active')
@section('title', 'Profile Organisasi | Admin Dangau Studio')

@section('admin-content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="nav d-flex flex-column flex-md-row mb-3 align-items-md-center">
                <h5 class="mb-3 fw-bold me-md-auto">Profile Organisasi</h5>
                <a href="{{ route('admin.organisasi.create') }}"
                    class="btn btn-primary rounded-3 btn-sm d-flex align-items-center py-2 px-3 me-3 mb-3" role="button">
                    <i class="ti ti-plus fs-7 me-2"></i>
                    Tambah Organisasi
                </a>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table table-bordered align-middle text-nowrap text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Gambar Organisasi</th>
                            <th scope="col">Nama Organisasi</th>
                            <th scope="col">Deskripsi Organisasi</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($organisasis as $organisasi)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $organisasi->image) }}"
                                        class="rounded shadow border border-secondary" width="150" height="100"
                                        alt="organisasi {{ $organisasi->name }}">
                                </td>
                                <td>{{ Str::limit($organisasi->name, 20) }}</td>
                                <td>{!! Str::limit($organisasi->about, 30) !!}</td>
                                <td>
                                    {{ $organisasi->contact_email }}
                                </td>
                                <td>
                                    {{ $organisasi->contact_phone }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.organisasi.edit', $organisasi->id) }}"
                                        class="btn btn-primary"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('admin.organisasi.destroy', $organisasi->id) }}" method="POST"
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
                                <td colspan="6" class="text-center pt-4">Belum ada data organisasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{-- {{ $programs->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
