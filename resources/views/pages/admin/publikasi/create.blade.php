@extends('layouts.admin')
@section('menuPublikasi', 'active')
@section('title', 'Publikasi | Admin Dangau Studio')

@section('admin-content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Publikasi</h5>
            <form action="{{ route('admin.publikasi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row text-dark">
                    <!-- Kolom pertama -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="title" class="form-label mb-3">
                                Nama Publikasi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                class="form-control rounded-0 @error('title') is-invalid @enderror"
                                placeholder="Masukkan nama publikasi" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom kedua -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="status_publikasi" class="form-label mb-3">
                                Status Gallery
                                <span class="text-danger">*</span>
                            </label>
                            <select name="status_publikasi" id="status_publikasi"
                                class="form-control rounded-0 @error('status_publikasi') is-invalid @enderror">
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="Hidden" {{ old('status_publikasi') == 'Hidden' ? 'selected' : '' }}>
                                    Hidden</option>
                                <option value="Published" {{ old('status_publikasi') == 'Published' ? 'selected' : '' }}>
                                    Published</option>
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
                        <div class="mb-3">
                            <label for="author" class="form-label mb-3">
                                Penulis
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="author" id="author"
                                class="form-control rounded-0 @error('author') is-invalid @enderror"
                                placeholder="Masukkan penulis publikasi">
                            @error('author')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label mb-3">
                                Deskripsi Publikasi
                                <span class="text-danger">*</span>
                            </label>
                            <textarea id="editor" name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Masukkan isi deskripsi publikasi">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label mb-3">
                                Gambar
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
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush
