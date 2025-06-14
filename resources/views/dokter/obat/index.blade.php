<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.obat.create') }}" class="btn btn-primary w-full sm:w-auto bg-blue-600 hover:bg-blue-700 rounded-full">Tambah Obat</a>

                            @if (session('status') === 'obat-created')
                                <p
                                    x-data="{ show: true }" 
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >
                                    {{ __('Created.') }}
                                </p>
                            @endif
                        </div>
                    </header>

                    <div class="overflow-x-auto w-full rounded mt-4">
                        <table class="table table-hover min-w-full">
                            <thead class="bg-gray-300">
                                <tr>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">No</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Nama Obat</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Kemasan</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Harga</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obats as $obat)
                                    <tr class="align-middle hover:bg-blue-50 transition border-b border-blue-100">
                                        <th scope="row" class="text-center text-gray-700 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="text-center font-semibold text-black whitespace-nowrap">
                                            {{ $obat->nama_obat }}
                                        </td>
                                        <td class="text-center whitespace-nowrap">
                                            {{ $obat->kemasan }}
                                        </td>
                                        <td class="text-center whitespace-nowrap">
                                            {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center whitespace-nowrap">
                                            {{-- Button Edit --}}
                                            <a href="{{ route('dokter.obat.edit', $obat->id) }}" class="btn btn-secondary btn-sm rounded-pill px-4 py-1 shadow-sm transition-all duration-150 hover:scale-105 bg-yellow-400 rounded-full">
                                                Edit
                                            </a>

                                            {{-- Button Delete --}}
                                            <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST" class="d-inline inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4 py-1 shadow-sm transition-all duration-150 hover:scale-105 bg-red-500 rounded-full">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
