@extends('adminlte::page') {{-- Menggunakan layout AdminLTE --}}

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Tugas Pegawai</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Daftar Tugas Pegawai (Pokok & Tambahan) Per Semester</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <strong>INFORMASI:</strong>
                        <ul>
                            <li>Halaman ini menampilkan tugas pegawai untuk **Tahun Pelajaran dan Semester yang saat ini aktif**.</li>
                            <li>Setiap baris mewakili satu pegawai, dengan ringkasan tugas pokok dan tugas tambahan.</li>
                            <li>Kolom **Jumlah Jam, Nomor SK, TMT, dan Keterangan** untuk Tugas Pokok dapat langsung diedit di tabel dan akan **tersimpan otomatis** setelah Anda mengubahnya atau menekan **Enter**.</li>
                            <li>Untuk **Tugas Tambahan**, klik tombol <i class="fas fa-plus-circle"></i> di kolom "Tugas Tambahan" untuk menambah atau mengelola tugas tambahan pegawai tersebut.</li>
                            <li>Klik tombol <i class="fas fa-edit"></i> di kolom **Aksi** untuk mengelola file SK atau detail lainnya secara individual untuk Tugas Pokok.</li>
                            <li>Klik tombol <i class="fas fa-trash"></i> untuk menghapus data Tugas Pokok pegawai ini.</li>
                        </ul>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <strong>Perhatian!</strong> Ada kesalahan dalam pengisian data:
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Informasi Tahun Pelajaran dan Semester Aktif --}}
                    @if ($selectedTapel && $selectedSemester)
                        <div class="alert alert-secondary text-center">
                            Menampilkan data untuk Tahun Pelajaran: <strong>{{ $selectedTapel->tahun_pelajaran }}</strong> dan Semester: <strong>{{ $selectedSemester->name }}</strong>.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mt-3" id="tugasPegawaiTable">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA PEGAWAI</th>
                                        <th>TUGAS POKOK</th>
                                        <th>JUMLAH JAM</th>
                                        <th>NOMOR SK</th>
                                        <th>TMT</th>
                                        <th>KETERANGAN</th>
                                        <th>TUGAS TAMBAHAN</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendidiksWithTasks as $index => $pendidik)
                                        <tr id="row_{{ $index }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $pendidik->nama_lengkap }}</strong>
                                                <small class="text-muted">({{ $pendidik->tipe_pegawai }})</small>
                                                {{-- Hidden inputs untuk data yang dikirim via AJAX --}}
                                                <input type="hidden" class="data-id" value="{{ $pendidik->tugas_pokok->id ?? '' }}">
                                                <input type="hidden" class="data-pegawai-id" value="{{ $pendidik->id }}">
                                                <input type="hidden" class="data-tapel-id" value="{{ $selectedTapel->id }}">
                                                <input type="hidden" class="data-semester-id" value="{{ $selectedSemester->id }}">
                                                <input type="hidden" class="data-tipe" value="1"> {{-- Selalu tipe 1 (Tugas Pokok) --}}
                                                <input type="hidden" class="data-jenis-id" value="1"> {{-- Selalu jenis_id 1 untuk Tugas Pokok --}}
                                                <input type="hidden" class="data-tanggal" value="{{ $pendidik->tugas_pokok->tanggal ? $pendidik->tugas_pokok->tanggal->format('Y-m-d') : Carbon\Carbon::now()->format('Y-m-d') }}">
                                                <input type="hidden" class="data-tmt-default" value="{{ $pendidik->tugas_pokok->tmt ? $pendidik->tugas_pokok->tmt->format('Y-m-d') : Carbon\Carbon::now()->format('Y-m-d') }}">
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">{{ $pendidik->tipe_pegawai }}</span>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm editable-field form-control-noborder"
                                                       data-field="jumlah_jam"
                                                       value="{{ $pendidik->tugas_pokok->jumlah_jam ?? 0 }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm editable-field form-control-noborder"
                                                       data-field="nomor_sk"
                                                       value="{{ $pendidik->tugas_pokok->nomor_sk }}">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control form-control-sm editable-field form-control-noborder"
                                                       data-field="tmt"
                                                       value="{{ $pendidik->tugas_pokok->tmt ? $pendidik->tugas_pokok->tmt->format('Y-m-d') : '' }}">
                                            </td>
                                            <td>
                                                <textarea class="form-control form-control-sm editable-field form-control-noborder"
                                                          data-field="keterangan"
                                                          rows="1">{{ $pendidik->tugas_pokok->keterangan }}</textarea>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info">{{ $pendidik->tugas_tambahan_count }}</span>
                                                <button type="button" class="btn btn-sm btn-outline-success mt-1 manage-additional-tasks"
                                                        data-pegawai-id="{{ $pendidik->id }}"
                                                        data-pegawai-name="{{ $pendidik->nama_lengkap }}"
                                                        data-tapel-id="{{ $selectedTapel->id }}"
                                                        data-semester-id="{{ $selectedSemester->id }}"
                                                        title="Kelola Tugas Tambahan">
                                                    <i class="fas fa-plus-circle"></i>
                                                </button>
                                            </td>
                                            <td>
                                                @if($pendidik->tugas_pokok->id)
                                                    <a href="{{ route('pegawai_tugas.edit', $pendidik->tugas_pokok->id) }}" class="btn btn-sm btn-warning mb-1" title="Kelola File SK & Detail Lainnya">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if($pendidik->tugas_pokok->file_sk)
                                                    <a href="{{ asset($pendidik->tugas_pokok->file_sk) }}" target="_blank" class="btn btn-sm btn-info mb-1" title="Lihat File SK">
                                                        <i class="fas fa-file-alt"></i>
                                                    </a>
                                                    @endif
                                                    <form action="{{ route('pegawai_tugas.destroy', $pendidik->tugas_pokok->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data Tugas Pokok ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Tugas Pokok ini">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    {{-- Jika belum ada tugas pokok, tombol hapus tidak relevan di sini --}}
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                Tidak ada data pegawai ditemukan untuk Tahun Pelajaran dan Semester ini.
                                                @if($pendidiksWithTasks->isEmpty())
                                                    <p>Silakan pastikan ada Tahun Pelajaran dan Semester yang aktif, atau tambahkan data pegawai terlebih dahulu.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Tidak ada Tahun Pelajaran atau Semester yang aktif ditemukan. Mohon atur Tahun Pelajaran dan Semester yang aktif di pengaturan Anda.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .form-control-noborder {
        border: none;
        box-shadow: none;
        padding: .375rem .75rem; /* Sesuaikan padding agar tidak terlalu mepet */
    }
    .form-control-noborder:focus {
        border-color: #80bdff; /* Border saat fokus tetap ada untuk UX */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    textarea.form-control-noborder {
        resize: vertical; /* Izinkan resize vertikal pada textarea */
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk memperbarui nomor baris
        function updateRowNumbers() {
            const rows = document.querySelectorAll('#tugasPegawaiTable tbody tr');
            rows.forEach((row, idx) => {
                const firstTd = row.querySelector('td:first-child');
                if (firstTd) {
                    firstTd.innerText = idx + 1;
                }
            });
        }

        // Fungsi untuk memasang event listener ke semua field yang bisa diedit
        function attachEditableFieldListeners() {
            document.querySelectorAll('.editable-field').forEach(input => {
                // Hapus listener lama untuk menghindari duplikasi
                input.removeEventListener('change', handleFieldChange);
                input.removeEventListener('keyup', handleFieldKeyUp);

                // Tambahkan listener untuk event 'change' (saat fokus hilang)
                input.addEventListener('change', handleFieldChange);
                // Tambahkan listener untuk event 'keyup' (saat tombol dilepas)
                input.addEventListener('keyup', handleFieldKeyUp);

                // Simpan nilai awal untuk deteksi perubahan
                input.dataset.originalValue = input.value;
            });
        }

        // Handler untuk perubahan field (saat fokus hilang)
        async function handleFieldChange(event) {
            const input = event.target;
            // Panggil fungsi save jika ada perubahan
            if (input.dataset.originalValue !== input.value) { // Hanya simpan jika nilai berubah
                input.dataset.originalValue = input.value; // Update nilai original
                await saveField(input);
            }
        }

        // Handler untuk keyup (khususnya Enter)
        async function handleFieldKeyUp(event) {
            const input = event.target;
            if (event.key === 'Enter') { // Cek jika tombol yang ditekan adalah Enter
                input.blur(); // Hilangkan fokus untuk memicu event 'change'
            }
        }

        // Fungsi inti untuk menyimpan data ke server
        async function saveField(input) {
            const row = input.closest('tr');
            const field = input.dataset.field;
            const value = input.value;

            // Ambil data dari hidden inputs di <tr>
            const id = row.querySelector('.data-id').value;
            const pegawai_id = row.querySelector('.data-pegawai-id').value;
            const tapel_id = row.querySelector('.data-tapel-id').value;
            const semester_id = row.querySelector('.data-semester-id').value;
            const tipe = row.querySelector('.data-tipe').value;
            const jenis_id = row.querySelector('.data-jenis-id').value;
            const tanggal = row.querySelector('.data-tanggal').value;
            const tmt_default = row.querySelector('.data-tmt-default').value; // Ambil TMT default untuk pembuatan baru

            console.log('Mengirim data:', {
                id: id,
                pegawai_id: pegawai_id,
                tapel_id: tapel_id,
                semester_id: semester_id,
                tipe: tipe,
                jenis_id: jenis_id,
                field: field,
                value: value,
                tanggal: tanggal,
                tmt_default: tmt_default // Kirim ini untuk kasus pembuatan baru
            });

            // Tampilkan indikator loading
            input.style.backgroundColor = '#fffbe6'; // Warna kuning muda

            try {
                const response = await fetch('{{ route('pegawai_tugas.update_single_field') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: id,
                        pegawai_id: pegawai_id,
                        tapel_id: tapel_id,
                        semester_id: semester_id,
                        tipe: tipe,
                        jenis_id: jenis_id,
                        field: field,
                        value: value,
                        tanggal: tanggal,
                        tmt_default: tmt_default
                    })
                });

                const result = await response.json();
                console.log('Respons server:', result); // Log respons dari server

                if (response.ok && result.success) { // Periksa status HTTP dan properti 'success' dari respons JSON
                    input.style.backgroundColor = '#e6ffe6'; // Warna hijau muda
                    // Jika ini adalah record Tugas Pokok baru, perbarui ID di hidden input dan data-id di <tr>
                    if (!id && result.id) {
                        row.querySelector('.data-id').value = result.id;
                        // row.dataset.id = result.id; // Tidak perlu set data-id di <tr> lagi karena kita pakai hidden input
                    }
                } else {
                    input.style.backgroundColor = '#ffe6e6'; // Warna merah muda
                    let errorMessage = 'Gagal menyimpan data.';
                    if (result.message) {
                        errorMessage += ' ' + result.message;
                    } else if (result.errors) {
                        errorMessage += '\nErrors:\n' + Object.values(result.errors).flat().join('\n');
                    }
                    alert(errorMessage);
                }
            } catch (error) {
                console.error('Error saat fetch:', error); // Log error jaringan/server
                input.style.backgroundColor = '#ffe6e6'; // Warna merah muda
                alert('Terjadi kesalahan jaringan atau server: ' + error.message);
            } finally {
                // Hapus indikator loading setelah beberapa saat
                setTimeout(() => {
                    input.style.backgroundColor = ''; // Kembali ke warna semula
                }, 1000);
            }
        }


        // Fungsi untuk memasang event listener ke tombol "Kelola Tugas Tambahan"
        function attachManageAdditionalTasksListeners() {
            document.querySelectorAll('.manage-additional-tasks').forEach(button => {
                button.removeEventListener('click', handleManageAdditionalTasks); // Hapus listener lama
                button.addEventListener('click', handleManageAdditionalTasks);
            });
        }

        // Handler untuk tombol "Kelola Tugas Tambahan"
        function handleManageAdditionalTasks(event) {
            const button = event.target.closest('button'); // Pastikan mengambil elemen button
            const pegawaiId = button.dataset.pegawaiId;
            const pegawaiName = button.dataset.pegawaiName;
            const tapelId = button.dataset.tapelId;
            const semesterId = button.dataset.semesterId;

            // Di sini Anda bisa mengarahkan ke halaman baru atau membuka modal
            // Contoh: Mengarahkan ke halaman baru untuk mengelola tugas tambahan
            alert(`Mengelola tugas tambahan untuk ${pegawaiName} (ID: ${pegawaiId})\nTahun Pelajaran: ${tapelId}, Semester: ${semesterId}`);
            // window.location.href = `/pegawai_tugas/additional/${pegawaiId}?tapel_id=${tapelId}&semester_id=${semesterId}`;
            // Anda perlu membuat rute dan controller untuk ini jika ingin implementasi nyata.
        }

        // Panggil fungsi untuk pertama kali saat DOMContentLoaded
        updateRowNumbers();
        attachEditableFieldListeners();
        attachManageAdditionalTasksListeners();
    });
</script>
