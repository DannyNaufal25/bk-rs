<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat Terhapus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat yang Dihapus') }}
                        </h2>
                        <a href="{{ route('dokter.obat.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white rounded-full px-4 py-2 text-sm">
                            Kembali
                        </a>
                    </header>

                    @if(session('status'))
                        <div class="mt-4 text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto w-full rounded mt-4">
                        <table class="min-w-full table-auto border border-gray-200">
                            <thead class="bg-gray-100 text-gray-700 text-sm uppercase font-semibold">
                                <tr>
                                    <th class="px-4 py-2 text-center">No</th>
                                    <th class="px-4 py-2 text-center">Nama Obat</th>
                                    <th class="px-4 py-2 text-center">Kemasan</th>
                                    <th class="px-4 py-2 text-center">Harga</th>
                                    <th class="px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($obatsTrashed as $obat)
                                    <tr class="border-t hover:bg-red-50 transition">
                                        <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 text-center font-semibold">{{ $obat->nama_obat }}</td>
                                        <td class="px-4 py-2 text-center">{{ $obat->kemasan }}</td>
                                        <td class="px-4 py-2 text-center">
                                            {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2 text-center space-x-2">
                                                <form action="{{ route('dokter.obat.restore', $obat->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded">
                                                        Restore
                                                    </button>
                                                </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500 py-4">
                                            Tidak ada data obat yang terhapus.
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
