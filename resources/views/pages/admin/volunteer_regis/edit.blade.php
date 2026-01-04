@extends('layouts.admin')
@section('menuVolunteerShow', 'show')
@section('menuVolunteerExpanded', 'true')
@section('menuVolunteerRegistrations', 'active')
@section('title', 'Volunter | Admin WateryNation')

@section('admin-content')
    <div class="card">
        <div class="card-body">

            <h5 class="card-title fw-semibold mb-4">Detail Volunteer</h5>

            <form action="{{ route('admin.volunteer-registrasi.update', $volunteer->id) }}" method="post">
                @csrf
                @method('PUT')

                <!-- ROW UTAMA: Foto kiri, biodata kanan -->
                <div class="row mb-4">

                    <!-- Foto -->
                    <div class="col-md-4 text-center">
                        <img class="img-fluid rounded mb-3"
                            src="{{ $volunteer->image ? asset('storage/' . $volunteer->image) : '' }}"
                            style="max-width: 250px; border: 1px solid #ddd;">
                    </div>

                    <!-- Biodata -->
                    <div class="col-md-8">
                        <div class="row">

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Nama Volunteer</label>
                                <input type="text" class="form-control" value="{{ $volunteer->name }}" readonly>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" value="{{ $volunteer->email }}" readonly>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="{{ $volunteer->phone }}" readonly>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Instagram</label>
                                <input type="text" class="form-control" value="{{ $volunteer->instagram }}" readonly>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">LinkedIn</label>
                                <input type="text" class="form-control" value="{{ $volunteer->linkedin }}" readonly>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Posisi</label>
                                <input type="text" class="form-control" value="{{ $volunteer->position }}" readonly>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Program Volunteer</label>
                                <input type="text" class="form-control" value="{{ $volunteer->volunter->title }}"
                                    readonly>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- BAGIAN STATUS DI BAWAH -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Update Status</h5>

                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Status Volunteer</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{ $volunteer->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="accepted" {{ $volunteer->status == 'accepted' ? 'selected' : '' }}>Accepted
                                </option>
                            </select>
                        </div>

                        <div class="mt-3 justify-content-end d-flex">
                            <a href="{{ route('admin.volunteer.index') }}" class="btn btn-dark rounded-3 me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary rounded-3">Update</button>
                        </div>
                    </div>
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
            // Editor untuk deskripsi
            ClassicEditor.create(document.querySelector('#description_editor')).catch(error => console.error(
                error));
        });
    </script>
@endpush
