@extends('layouts.admin')
@section('menuVolunteerShow', 'show')
@section('menuVolunteerExpanded', 'true')
@section('menuVolunteerList', 'active')
@section('title', 'Volunter | Admin Dangau Studio')

@section('admin-content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="nav d-flex flex-column flex-md-row mb-3 align-items-md-center">
                <h5 class="mb-3 fw-bold me-md-auto">Volunteer</h5>
                <a href="{{ route('admin.volunteer.create') }}"
                    class="btn btn-primary rounded-3 btn-sm d-flex align-items-center py-2 px-3 me-3 mb-3" role="button">
                    <i class="ti ti-plus fs-7 me-2"></i>
                    Tambah Volunteer
                </a>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table table-bordered align-middle text-nowrap text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Gambar Volunteer</th>
                            <th scope="col">Judul Volunteer</th>
                            <th scope="col">Deskripsi Volunteer</th>
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
                                <td>{{ Str::limit($volunter->title, 20) }}</td>
                                <td>{!! Str::limit($volunter->description, 30) !!}</td>
                                <td>
                                    @if ($volunter->positions)
                                        @foreach ($volunter->positions as $position)
                                            <span class="badge bg-info me-1">{{ $position }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Belum ada posisi</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($volunter->status_publikasi == 'Published')
                                        <span
                                            class="badge bg-light-success rounded-pill text-success px-3 py-2 fs-3">Published</span>
                                    @else
                                        <span
                                            class="badge bg-light-danger rounded-pill text-danger px-3 py-2 fs-3">Hidden</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.volunteer.edit', $volunter->id) }}" class="btn btn-primary"><i
                                            class="ti ti-edit"></i></a>
                                    <a href="{{ route('admin.volunteer.destroy', $volunter->id) }}" class="btn btn-danger"
                                        data-confirm-delete="true"><i class="ti ti-trash"></i></a>
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
