@extends('base')
@section('title','Pekerjaan')
@section('menupekerjaan', 'underline decoration-4 underline-offset-7')

@section('content')
    <section class="p-4 bg-white rounded-lg min-h-[50vh]">
        <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Pekerjaan</h1>
        <div class="mx-auto max-w-screen-xl">
            
            {{-- 1. TASK 10: NOTIFIKASI --}}
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Berhasil!</span> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                    <span class="font-medium">Gagal!</span> {{ session('error') }}
                </div>
            @endif

            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('pekerjaan.add') }}" class="rounded-md bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                    Tambah Data
                </a>
                <form class="flex w-full max-w-sm gap-2" autocomplete="off">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Masukkan kata kunci..." class="w-full rounded-md border px-3 py-2 text-sm">
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700 cursor-pointer">
                        Cari
                    </button>
                </form>
            </div>
            
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-x divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700" width="1">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Pekerjaan</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Deskripsi</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Jumlah Pegawai</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700" width="1">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        {{-- Perhatikan variabelnya jadi $pekerjaan (sesuai controller) --}}
                        @forelse($pekerjaan as $k => $d)
                        <tr class="hover:bg-gray-50">
                            {{-- Trik agar nomor urut berlanjut saat pindah halaman --}}
                            <td class="px-4 py-3">{{ $pekerjaan->firstItem() + $k }}</td>
                            
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $d->nama }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $d->deskripsi }}</td>
                            
                            {{-- 2. TASK 12: JUMLAH PEGAWAI REAL-TIME --}}
                            <td class="px-4 py-3 text-gray-600 font-bold">
                                {{ $d->pegawai_count ?? 0 }} Orang
                            </td>

                            <td class="px-4 py-3 text-center text-gray-600">
                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <a href="{{ route('pekerjaan.edit', ['id' => $d->id]) }}" class="cursor-pointer rounded-l-md border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-50">
                                        Edit
                                    </a>
                                    <form action="{{ route('pekerjaan.destroy', ['id' => $d->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cursor-pointer rounded-r-md border border-l-0 border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                Data pekerjaan belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 3. TASK 11: PAGINATION --}}
            <div class="mt-4">
                {{ $pekerjaan->links() }}
            </div>

        </div>
    </section>
@endsection