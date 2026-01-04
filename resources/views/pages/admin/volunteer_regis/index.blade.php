@extends('layouts.admin')
@section('menuVolunteerShow', 'show')
@section('menuVolunteerExpanded', 'true')
@section('menuVolunteerRegistrations', 'active')
@section('title', 'Volunter | Admin WateryNation')

@section('admin-content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="nav d-flex flex-column flex-md-row mb-3 align-items-md-center">
                <h5 class="mb-3 fw-bold me-md-auto">Daftar Volunteer</h5>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table table-bordered align-middle text-nowrap text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Gambar Volunteer</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nama Volunteer</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($volunteers as $volunter)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $volunter->image) }}"
                                        class="rounded shadow border border-secondary" width="150" height="80"
                                        alt="Volunteer {{ $volunter->title }}">
                                </td>
                                <td>
                                    {{ $volunter->name }}
                                </td>
                                <td>
                                    {{ $volunter->email }}
                                </td>
                                <td>{{ Str::limit($volunter->volunter->title, 20) }}</td>
                                <td>
                                    {{ $volunter->position }}
                                </td>
                                <td>
                                    @if ($volunter->status == 'accepted')
                                        <span
                                            class="badge bg-light-success rounded-pill text-success px-3 py-2 fs-3">Accepted</span>
                                    @else
                                        <span
                                            class="badge bg-light-danger rounded-pill text-danger px-3 py-2 fs-3">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.volunteer-registrasi.edit', $volunter->id) }}" class="btn btn-primary"><i
                                            class="ti ti-edit"></i></a>
                                    <form action="{{ route('admin.volunteer.destroy', $volunter->id) }}" method="POST"
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
                                <td colspan="6" class="text-center pt-4">Belum ada data volunter</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $volunteers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
