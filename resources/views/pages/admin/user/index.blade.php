@extends('layouts.admin')
@section('title', 'User | Admin Watery Nation')
@section('menuUser', 'active')
@section('admin-content')

    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <h5 class="mb-3 fw-bold mt-2">User</h5>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table table-bordered align-middle text-nowrap text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col" class=" text-light">No</th>
                            <th scope="col" class=" text-light">Nama Pengguna</th>
                            <th scope="col" class=" text-light">Email Pengguna</th>
                            <th scope="col" class=" text-light">Email Verifikasi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->email_verified_at)
                                        <span class="btn btn-success">Verifikasi</span>
                                    @endif
                                </td>
                                @if ($user->email_verified_at == null)
                                    <td>
                                        {{-- <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning"><i
                                            class="ti ti-edit"></i></a> --}}
                                        <a href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-danger"
                                            data-confirm-delete="true"><i class="ti ti-trash"></i></a>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary"><i
                                                class="ti ti-edit"></i></a>
                                        <a href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-danger"
                                            data-confirm-delete="true"><i class="ti ti-trash"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center pt-4">Belum ada data pengguna</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
