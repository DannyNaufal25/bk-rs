<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow-sm sm:rounded-lg sm:p-8">
                <section>
                    <header class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>

                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('dokter.obat.create') }}"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full text-sm font-semibold text-center">
                                Tambah Obat
                            </a>
                            <a href="{{ route('dokter.obat.trash') }}"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-full text-sm font-semibold text-center">
                                Obat Hilang
                            </a>
                        </div>
                    </header>

                    {{-- Status Notification --}}
                    @if (session('status') === 'obat-created')
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="mt-2 text-sm text-green-600">
                            Obat berhasil ditambahkan.
                        </p>
                    @elseif (session('status') === 'obat-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="mt-2 text-sm text-yellow-600">
                            Obat berhasil diperbarui.
                        </p>
                    @elseif (session('status') === 'obat-hapus')
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="mt-2 text-sm text-red-600">
                            Obat berhasil dihapus.
                        </p>
                    @elseif (session('status') === 'obat-restore')
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="mt-2 text-sm text-blue-600">
                            Obat berhasil dikembalikan.
                        </p>
                    @endif

                    {{-- Tabel Obat --}}
                    <div class="overflow-x-auto w-full rounded mt-6">
                        <table class="min-w-full table-auto border border-gray-200">
                            <thead class="bg-gray-100 text-gray-700 text-sm uppercase font-semibold">
                                <tr>
                                    <th class="text-center px-4 py-2">No</th>
                                    <th class="text-center px-4 py-2">Nama Obat</th>
                                    <th class="text-center px-4 py-2">Kemasan</th>
                                    <th class="text-center px-4 py-2">Harga</th>
                                    <th class="text-center px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800">
                                @forelse ($obats as $obat)
                                    <tr class="border-t hover:bg-blue-50 transition">
                                        <td class="text-center px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="text-center px-4 py-2 font-semibold">{{ $obat->nama_obat }}</td>
                                        <td class="text-center px-4 py-2">{{ $obat->kemasan }}</td>
                                        <td class="text-center px-4 py-2">
                                            {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center px-4 py-2 space-x-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('dokter.obat.edit', $obat->id) }}"
                                                class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded-full text-sm">
                                                Edit
                                            </a>

                                            {{-- Soft Delete --}}
                                            <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-500">
                                            Tidak ada data obat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
