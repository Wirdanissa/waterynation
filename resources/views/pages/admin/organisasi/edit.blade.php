@extends('layouts.admin')
@section('menuOrganisasi', 'active')
@section('title', 'Edit Organisasi | Admin WateryNation')

@section('admin-content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Organisasi</h5>
            <form action="{{ route('admin.organisasi.update', $organisasi->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row text-dark">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Organisasi <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $organisasi->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Email Kontak <span
                                    class="text-danger">*</span></label>
                            <input type="email" name="contact_email" id="contact_email"
                                class="form-control @error('contact_email') is-invalid @enderror"
                                value="{{ old('contact_email', $organisasi->contact_email) }}">
                            @error('contact_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row text-dark">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">No. Telepon <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="contact_phone" id="contact_phone"
                                class="form-control @error('contact_phone') is-invalid @enderror"
                                value="{{ old('contact_phone', $organisasi->contact_phone) }}">
                            @error('contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="qris_name" class="form-label">Nama QRIS <span class="text-danger">*</span></label>
                            <input type="text" name="qris_name" id="qris_name"
                                class="form-control @error('qris_name') is-invalid @enderror"
                                value="{{ old('qris_name', $organisasi->qris_name) }}">
                            @error('qris_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="qris_info" class="form-label">Info QRIS <span class="text-danger">*</span></label>
                            <input type="text" name="qris_info" id="qris_info"
                                class="form-control @error('qris_info') is-invalid @enderror"
                                value="{{ old('qris_info', $organisasi->qris_info) }}">
                            @error('qris_info')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row text-dark">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi <span class="text-danger">*</span></label>
                            <textarea name="visi" id="visi" class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $organisasi->visi) }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi <span class="text-danger">*</span></label>
                            <textarea name="misi" id="misi" class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $organisasi->misi) }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row text-dark">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="core_values" class="form-label">Core Values <span
                                    class="text-danger">*</span></label>
                            <textarea name="core_values" id="core_values" class="form-control @error('core_values') is-invalid @enderror">{{ old('core_values', $organisasi->core_values) }}</textarea>
                            @error('core_values')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="focus_areas" class="form-label">Focus Areas <span
                                    class="text-danger">*</span></label>
                            <textarea name="focus_areas" id="focus_areas" class="form-control @error('focus_areas') is-invalid @enderror">{{ old('focus_areas', $organisasi->focus_areas) }}</textarea>
                            @error('focus_areas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="about" class="form-label text-dark">Tentang Organisasi <span
                            class="text-danger">*</span></label>
                    <textarea name="about" id="about" class="form-control @error('about') is-invalid @enderror">{{ old('about', $organisasi->about) }}</textarea>
                    @error('about')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="qris_image" class="form-label text-dark">QRIS Image <span
                            class="text-danger">*</span></label>
                    <input type="file" name="qris_image" id="qris_image"
                        class="form-control @error('qris_image') is-invalid @enderror"
                        onchange="previewImage(this,'.qris-preview')">
                    <img class="qris-preview img-fluid mt-2 col-sm-4"
                        style="display: {{ $organisasi->qris_image ? 'block' : 'none' }};"
                        src="{{ $organisasi->qris_image ? asset('storage/' . $organisasi->qris_image) : '' }}">
                    @error('qris_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label text-dark">Logo Organisasi <span
                            class="text-danger">*</span></label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror"
                        onchange="previewImage(this,'.img-preview')">
                    <img class="img-preview img-fluid mb-3 mt-2 col-sm-4"
                        style="display: {{ $organisasi->image ? 'block' : 'none' }};"
                        src="{{ $organisasi->image ? asset('storage/' . $organisasi->image) : '' }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-footer mt-3">
                    <a href="{{ route('admin.organisasi.index') }}" class="btn btn-dark rounded-3 me-3">Kembali</a>
                    <button type="submit" class="btn btn-primary rounded-3">Update</button>
                </div>

            </form>
        </div>
    </div>

@endsection

@push('custom-script')
    <script>
        function previewImage(input, selector) {
            const file = input.files[0];
            const imgPreview = document.querySelector(selector);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const editors = ['about', 'visi', 'misi', 'core_values', 'focus_areas'];
            editors.forEach(id => {
                ClassicEditor.create(document.getElementById(id))
                    .catch(error => console.error(error));
            });
        });
    </script>
@endpush
