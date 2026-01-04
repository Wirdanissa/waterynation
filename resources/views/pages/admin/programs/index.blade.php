@extends('layouts.admin')
@section('menuProgramShow', 'show')
@section('menuProgramExpanded', 'true')
@section('menuProgramList', 'active')
@section('title', 'Program | Admin WateryNation')

@section('admin-content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="nav d-flex flex-column flex-md-row mb-3 align-items-md-center">
                <h5 class="mb-3 fw-bold me-md-auto">Daftar Program</h5>
                <a href="{{ route('admin.programs.create') }}"
                    class="btn btn-primary rounded-3 btn-sm d-flex align-items-center py-2 px-3 me-3 mb-3" role="button">
                    <i class="ti ti-plus fs-7 me-2"></i>
                    Tambah Program
                </a>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table table-bordered align-middle text-nowrap text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col" style="width: 180px;">Media (Gambar/Video)</th>
                            <th scope="col">Judul Program</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Tanggal Kegiatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programs as $program)
                            <tr>
                                <td>
                                    @if ($program->youtube_url)
                                        @php
                                            // Ekstraksi ID YouTube untuk pratinjau kecil di tabel
                                            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $program->youtube_url, $match);
                                            $youtubeId = $match[1] ?? null;
                                        @endphp

                                        @if($youtubeId)
                                            <div class="rounded overflow-hidden shadow-sm border border-secondary" style="width: 150px; height: 85px;">
                                                <iframe width="100%" height="100%" 
                                                    src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                                    frameborder="0" allowfullscreen>
                                                </iframe>
                                            </div>
                                        @else
                                            <span class="badge bg-light-warning text-warning">Link Video Invalid</span>
                                        @endif
                                    @elseif($program->image)
                                        <img src="{{ asset('storage/' . $program->image) }}"
                                            class="rounded shadow-sm border border-secondary" 
                                            style="width: 150px; height: 85px; object-fit: cover;"
                                            alt="Program {{ $program->title }}">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="width: 150px; height: 85px;">
                                            <small class="text-muted">No Media</small>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-start">
                                    <span class="fw-semibold">{{ Str::limit($program->title, 30) }}</span>
                                </td>
                                <td>
                                    <small class="badge bg-light-info text-info border border-info">{{ $program->category }}</small>
                                </td>
                                <td>
                                    <div class="small">
                                        {{ tanggal($program->start_date) }} <br>
                                        <span class="text-muted">sampai</span> <br>
                                        {{ tanggal($program->end_date) }}
                                    </div>
                                </td>
                                <td>
                                    @if ($program->status_publikasi == 'Published')
                                        <span class="badge bg-light-success rounded-pill text-success px-3 py-2 fs-2">
                                            <i class="ti ti-circle-check me-1"></i>Published
                                        </span>
                                    @else
                                        <span class="badge bg-light-danger rounded-pill text-danger px-3 py-2 fs-2">
                                            <i class="ti ti-eye-off me-1"></i>Hidden
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.programs.edit', $program->id) }}" 
                                           class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="ti ti-edit fs-5"></i>
                                        </a>
                                        <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST"
                                            class="d-inline ms-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Yakin ingin menghapus program ini?')">
                                                <i class="ti ti-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="{{ asset('assets/images/logos/empty-data.png') }}" alt="" width="100" class="mb-3 opacity-50">
                                    <p class="text-muted">Belum ada data program yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $programs->links() }}
            </div>
        </div>
    </div>
@endsection