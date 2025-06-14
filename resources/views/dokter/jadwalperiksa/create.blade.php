<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-lg rounded-lg">
                @if ($errors->has('error'))
                    <div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-300">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                <form action="{{ route('dokter.jadwalperiksa.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="hari" class="block mb-1 font-semibold text-gray-700">Hari</label>
                        <select name="hari" id="hari" class="form-select w-full @error('hari') is-invalid @enderror" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                        @error('hari')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jam_mulai" class="block mb-1 font-semibold text-gray-700">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control w-full @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}" required>
                            @error('jam_mulai')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_selesai" class="block mb-1 font-semibold text-gray-700">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control w-full @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Status diset di controller, tidak perlu form --}}

                    <div class="flex gap-2 justify-end">
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded shadow">Simpan</button>
                        <a href="{{ route('dokter.jadwalperiksa.index') }}" class="btn btn-secondary px-5 py-2 rounded">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
