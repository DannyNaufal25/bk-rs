<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Riwayat Janji Periksa') }}
                        </h2>
                    </header>

                    {{-- Table dibungkus dengan table-responsive agar bisa discroll di layar kecil --}}
                    <div class="table-responsive mt-4">
                        <table class="table mt-6 overflow-hidden rounded table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Poliklinik</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Antrian</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($janjiPeriksas as $janjiPeriksa)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                        <td class="align-middle text-start">
                                            {{ $janjiPeriksa->jadwalPeriksa->dokter->poli->nama ?? "N/A" }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $janjiPeriksa->jadwalPeriksa->dokter->name }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $janjiPeriksa->jadwalPeriksa->hari }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_mulai)->format('H.i') }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_selesai)->format('H.i') }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $janjiPeriksa->no_antrian }}
                                        </td>
                                        <td class="align-middle text-start">
                                            @if ($janjiPeriksa->periksa->isEmpty())
                                                <span class="badge badge-pill badge-warning">Belum Diperiksa</span>
                                            @else
                                                <span class="badge badge-pill badge-success">Sudah Diperiksa</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-start">
                                            @if ($janjiPeriksa->periksa->isEmpty())
                                                <a href="{{ route('pasien.riwayat-periksa.detail', $janjiPeriksa->id) }}"
                                                    class="btn btn-info">Detail</a>
                                            @else
                                                <a href="{{ route('pasien.riwayat-periksa.riwayat', $janjiPeriksa->id) }}"
                                                    class="btn btn-secondary">Riwayat</a>
                                            @endif
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
