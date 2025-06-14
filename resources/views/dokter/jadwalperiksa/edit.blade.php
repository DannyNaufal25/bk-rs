<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-md sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold mb-4">Edit Jadwal Periksa</h2>
                @if ($errors->has('error'))
                    <div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-300">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                <form action="{{ route('dokter.jadwalperiksa.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="hari" class="block font-medium mb-1">Hari</label>
                        <select name="hari" id="hari" class="form-control" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin" {{ old('hari', $jadwal->hari) == 'Senin' ? 'selected' : '' }}>Senin
                            </option>
                            <option value="Selasa" {{ old('hari', $jadwal->hari) == 'Selasa' ? 'selected' : '' }}>Selasa
                            </option>
                            <option value="Rabu" {{ old('hari', $jadwal->hari) == 'Rabu' ? 'selected' : '' }}>Rabu
                            </option>
                            <option value="Kamis" {{ old('hari', $jadwal->hari) == 'Kamis' ? 'selected' : '' }}>Kamis
                            </option>
                            <option value="Jumat" {{ old('hari', $jadwal->hari) == 'Jumat' ? 'selected' : '' }}>Jumat
                            </option>
                            <option value="Sabtu" {{ old('hari', $jadwal->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu
                            </option>
                            <option value="Minggu" {{ old('hari', $jadwal->hari) == 'Minggu' ? 'selected' : '' }}>Minggu
                            </option>
                        </select>
                        @error('hari')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jam_mulai" class="block font-medium mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                            value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
                        @error('jam_mulai')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jam_selesai" class="block font-medium mb-1">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                            value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
                        @error('jam_selesai')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('dokter.jadwalperiksa.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>