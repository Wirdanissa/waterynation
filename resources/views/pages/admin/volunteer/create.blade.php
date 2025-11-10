@extends('layouts.admin')
@section('menuVolunteerShow', 'show')
@section('menuVolunteerExpanded', 'true')
@section('menuVolunteerList', 'active')
@section('title', 'Volunteer | Admin Dangau Studio')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Volunteer</h5>
            <form action="{{ route('admin.volunteer.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row text-dark">
                    <!-- Nama Volunteer -->
                    <div class="col-lg-6 mb-3">
                        <label for="title" class="form-label mb-2">
                            Nama Volunteer <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="title"
                            class="form-control rounded-0 @error('title') is-invalid @enderror"
                            placeholder="Masukkan nama volunteer" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Volunteer -->
                    <div class="col-lg-6 mb-3">
                        <label for="status_publikasi" class="form-label mb-2">
                            Status Volunteer <span class="text-danger">*</span>
                        </label>
                        <select name="status_publikasi" id="status_publikasi"
                            class="form-control rounded-0 @error('status_publikasi') is-invalid @enderror">
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Hidden" {{ old('status_publikasi') == 'Hidden' ? 'selected' : '' }}>Hidden
                            </option>
                            <option value="Published" {{ old('status_publikasi') == 'Published' ? 'selected' : '' }}>
                                Published</option>
                        </select>
                        @error('status_publikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Posisi Volunteer -->
                <div class="mb-3">
                    <label class="form-label mb-2">Posisi Volunteer <span class="text-danger">*</span></label>
                    <div id="positions-container">
                        <div class="input-group mb-2 position-item">
                            <input type="text" name="positions[]" class="form-control" placeholder="Masukkan posisi">
                            <button type="button" class="btn btn-danger remove-position">-</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="add-position">+ Tambah Posisi</button>
                    @error('positions')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi Program -->
                <div class="mb-3">
                    <label for="description" class="form-label mb-2">
                        Deskripsi Program <span class="text-danger">*</span>
                    </label>
                    <textarea id="description_editor" name="description" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Masukkan deskripsi program">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gambar Program -->
                <div class="mb-3">
                    <label for="image" class="form-label mb-2">Gambar Program</label>
                    <img class="img-preview img-fluid mb-3 mt-2 col-sm-4" style="display: none;">
                    <input class="form-control mb-2" type="file" name="image" id="image" onchange="previewImage()">
                    <span class="text-dark" style="font-size: 13px;">Ukuran gambar maksimal 2MB</span>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-footer mt-3">
                    <a href="{{ route('admin.program.index') }}" class="btn btn-dark rounded-3 me-3">Kembali</a>
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
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('positions-container');
            const addBtn = document.getElementById('add-position');

            // Tambah input baru
            addBtn.addEventListener('click', () => {
                const div = document.createElement('div');
                div.classList.add('input-group', 'mb-2', 'position-item');
                div.innerHTML = `
                <input type="text" name="positions[]" class="form-control" placeholder="Masukkan posisi">
                <button type="button" class="btn btn-danger remove-position">-</button>
            `;
                container.appendChild(div);
            });

            // Hapus input
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-position')) {
                    e.target.parentElement.remove();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Editor untuk posisi
            ClassicEditor.create(document.querySelector('#positions_editor')).catch(error => console.error(error));
            // Editor untuk deskripsi
            ClassicEditor.create(document.querySelector('#description_editor')).catch(error => console.error(
                error));
        });
    </script>
@endpush
