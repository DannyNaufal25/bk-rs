<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Pemeriksaan Pasien') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-lg rounded-lg">
                <form action="{{ route('dokter.memeriksa.update', $periksa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_janji_periksa" value="{{ $janji->id }}">
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Pasien</label>
                        <input type="text" class="form-control w-full" value="{{ $janji->pasien->name ?? '-' }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">No RM</label>
                        <input type="text" class="form-control w-full" value="{{ $janji->pasien->no_rm ?? '-' }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Keluhan</label>
                        <textarea class="form-control w-full" rows="2" readonly>{{ $janji->keluhan }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tanggal Periksa</label>
                        <input type="date" name="tgl_periksa" class="form-control w-full" value="{{ old('tgl_periksa', $periksa->tgl_periksa->format('Y-m-d')) }}" required>
                        @error('tgl_periksa')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Catatan Pemeriksaan</label>
                        <textarea name="catatan" class="form-control w-full" rows="3" required>{{ old('catatan', $periksa->catatan) }}</textarea>
                        @error('catatan')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Obat</label>
                        <div id="obat-list">
                            @php $idx = 0; @endphp
                            @foreach($selectedObatIds as $obat_id)
                                <div class="flex gap-2 mb-2">
                                    <select name="obat_ids[]" class="form-control obat-dropdown">
                                        <option value="">-- Pilih Obat --</option>
                                        @foreach($obats as $obat)
                                            <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}" @if($obat->id == $obat_id) selected @endif>{{ $obat->nama_obat }} ({{ $obat->kemasan }}) - Rp{{ number_format($obat->harga,0,',','.') }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn {{ $idx == 0 ? 'btn-success add-obat' : 'btn-danger remove-obat' }}">{{ $idx == 0 ? '+' : '-' }}</button>
                                </div>
                                @php $idx++; @endphp
                            @endforeach
                            @if(count($selectedObatIds) == 0)
                                <div class="flex gap-2 mb-2">
                                    <select name="obat_ids[]" class="form-control obat-dropdown">
                                        <option value="">-- Pilih Obat --</option>
                                        @foreach($obats as $obat)
                                            <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">{{ $obat->nama_obat }} ({{ $obat->kemasan }}) - Rp{{ number_format($obat->harga,0,',','.') }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-success add-obat">+</button>
                                </div>
                            @endif
                        </div>
                        <small class="text-gray-500">Klik + untuk menambah pilihan obat, klik - untuk menghapus baris.</small>
                        @error('obat_ids')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Daftar Harga Obat</label>
                        <table class="table table-bordered w-full text-sm">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Kemasan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($obats as $obat)
                                <tr>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->kemasan }}</td>
                                    <td>Rp{{ number_format($obat->harga,0,',','.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Estimasi Total Biaya</label>
                        <input type="text" id="totalBiaya" class="form-control w-full bg-gray-100 font-bold" value="Rp{{ number_format($periksa->biaya_periksa,0,',','.') }}" readonly>
                        <small class="text-gray-500">Biaya pemeriksaan: Rp100.000 + total harga obat yang dipilih.</small>
                    </div>
                    <script>
                        function updateTotalBiaya() {
                            let total = 100000;
                            document.querySelectorAll('.obat-dropdown').forEach(function(select) {
                                const harga = select.options[select.selectedIndex]?.getAttribute('data-harga');
                                if (harga) total += parseInt(harga);
                            });
                            document.getElementById('totalBiaya').value = 'Rp' + total.toLocaleString('id-ID');
                        }
                        document.addEventListener('DOMContentLoaded', function() {
                            updateTotalBiaya();
                            document.getElementById('obat-list').addEventListener('change', function(e) {
                                if (e.target.classList.contains('obat-dropdown')) {
                                    updateTotalBiaya();
                                }
                            });
                            document.getElementById('obat-list').addEventListener('click', function(e) {
                                setTimeout(updateTotalBiaya, 10);
                            });
                        });
                    </script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const obatList = document.getElementById('obat-list');
                            obatList.addEventListener('click', function(e) {
                                if (e.target.classList.contains('add-obat')) {
                                    const newRow = obatList.firstElementChild.cloneNode(true);
                                    newRow.querySelector('select').value = '';
                                    let btn = newRow.querySelector('button');
                                    btn.classList.remove('btn-success', 'add-obat');
                                    btn.classList.add('btn-danger', 'remove-obat');
                                    btn.textContent = '-';
                                    obatList.appendChild(newRow);
                                } else if (e.target.classList.contains('remove-obat')) {
                                    if (obatList.children.length > 1) {
                                        e.target.parentElement.remove();
                                    }
                                }
                            });
                        });
                    </script>
                    <div class="flex gap-2 justify-end mt-6">
                        <a href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary px-5 py-2 rounded">Batal</a>
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded">Update Pemeriksaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
