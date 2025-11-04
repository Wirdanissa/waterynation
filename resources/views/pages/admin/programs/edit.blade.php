@extends('layouts.admin')
@section('menuProgram', 'active')
@section('title', 'Program | Admin Dangau Studio')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Program</h5>
            <form action="{{ route('admin.program.update', $programs->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row text-dark">
                    <!-- Kolom pertama -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="title" class="form-label mb-3">
                                Nama Program
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                class="form-control rounded-0 @error('title') is-invalid @enderror"
                                placeholder="Masukkan nama program" value="{{ old('title', $programs->title) }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label mb-3">
                                Tanggal Mulai Program
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="start_date" id="start_date"
                                class="form-control rounded-0 @error('start_date') is-invalid @enderror"
                                min="{{ date('Y-m-d') }}"value="{{ old('start_date', $programs->start_date) }}">
                            @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label mb-3">
                                Lokasi Program
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="form-control rounded-0 @error('lokasi') is-invalid @enderror"
                                placeholder="Masukkan lokasi program" value="{{ old('lokasi', $programs->lokasi) }}">
                            @error('lokasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <!-- Kolom kedua -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="category" class="form-label mb-3">
                                Kategori Program
                                <span class="text-danger">*</span>
                            </label>
                            <select name="category" class="form-control rounded-0 @error('category') is-invalid @enderror">
                                @foreach ($category as $key => $status)
                                    <option value="{{ $key }}"
                                        {{ old('category', $programs->category) == $key ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label mb-3">
                                Tanggal Akhir Program
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="end_date" id="end_date"
                                class="form-control rounded-0 @error('end_date') is-invalid @enderror"
                                min="{{ date('Y-m-d') }}"value="{{ old('end_date', $programs->end_date) }}">
                            @error('end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status_publikasi" class="form-label mb-3">
                                Status Program
                                <span class="text-danger">*</span>
                            </label>
                            <select name="status_publikasi"
                                class="form-control rounded-0 @error('status_publikasi') is-invalid @enderror">
                                @foreach ($status_publikasi as $key => $status)
                                    <option value="{{ $key }}"
                                        {{ old('status_publikasi', $programs->status_publikasi) == $key ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_publikasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row text-dark">
                    <div class="col-lg-12">
                        @if (old('category', $programs->category) === 'Modul Development For Kids')
                            <div class="mb-3">
                                <label for="link_url" class="form-label mb-3">
                                    Link Url
                                </label>
                                <input type="text" name="link_url" id="link_url"
                                    class="form-control rounded-0 @error('link_url') is-invalid @enderror"
                                    placeholder="Masukkan link url program"
                                    value="{{ old('link_url', $programs->link_url) }}">
                                @error('link_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="description" class="form-label mb-3">
                                Deskripsi Program
                                <span class="text-danger">*</span>
                            </label>
                            <textarea id="editor" name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Masukkan isi deskripsi program">{{ old('description', $programs->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label mb-3">
                                Gambar Program
                            </label>
                            <img class="img-preview img-fluid mb-3 mt-2 col-sm-4">
                            <input class="form-control mb-3" type="file" name="image" id="image"
                                onchange="previewImage()">
                            <span class="text-dark" style="font-size: 13px;">Ukuran gambar maksimal 2MB</span>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer mt-3">
                    <a href="{{ route('admin.program.index') }}" class="btn btn-dark rounded-3 me-3 ">Kembali</a>
                    <button type="submit" class="btn btn-primary rounded-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFRGallery) {
                imgPreview.src = oFRGallery.target.result;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const urlWrapper = document.getElementById('url_link_wrapper');

            categorySelect.addEventListener('change', function() {
                if (this.value === 'Modul Development For Kids') {
                    urlWrapper.style.display = 'block';
                } else {
                    urlWrapper.style.display = 'none';
                }
            });
        });
    </script>
@endpush
