<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Data Obat') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan perbarui informasi obat sesuai dengan nama, kemasan, dan harga terbaru.') }}
                            </p>
                        </header>

                        <form class="mt-6" action="{{ route('dokter.obat.update', $obat->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            {{-- Nama Obat --}}
                            <div class="mb-3 form-group">
                                <label for="editNamaObatInput">Nama Obat</label>
                                <input
                                    type="text"
                                    class="rounded form-control"
                                    id="editNamaObatInput"
                                    name="nama_obat"
                                    value="{{ old('nama_obat', $obat->nama_obat) }}"
                                >
                            </div>

                            {{-- Kemasan --}}
                            <div class="mb-3 form-group">
                                <label for="editKemasanInput">Kemasan</label>
                                <select
                                    id="editKemasanInput"
                                    name="kemasan"
                                    class="rounded form-control"
                                >
                                    <option value="" disabled>Pilih Kemasan</option>
                                    <option value="Tablet" {{ (old('kemasan', $obat->kemasan) == 'Tablet') ? 'selected' : '' }}>Tablet</option>
                                    <option value="Kapsul" {{ (old('kemasan', $obat->kemasan) == 'Kapsul') ? 'selected' : '' }}>Kapsul</option>
                                    <option value="Sirup" {{ (old('kemasan', $obat->kemasan) == 'Sirup') ? 'selected' : '' }}>Sirup</option>
                                    <option value="Salep" {{ (old('kemasan', $obat->kemasan) == 'Salep') ? 'selected' : '' }}>Salep</option>
                                    <option value="Suntik" {{ (old('kemasan', $obat->kemasan) == 'Suntik') ? 'selected' : '' }}>Suntik</option>
                                </select>
                            </div>

                            {{-- Harga --}}
                            <div class="mb-3 form-group">
                                <label for="editHargaInput">Harga</label>
                                <input
                                    type="text"
                                    class="rounded form-control"
                                    id="editHargaInput"
                                    name="harga"
                                    value="{{ old('harga', $obat->harga) }}"
                                >
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ route('dokter.obat.index') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
