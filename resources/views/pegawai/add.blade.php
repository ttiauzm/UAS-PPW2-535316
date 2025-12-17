@extends('base')
@section('title','Tambah Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')

@section('content')
    <section class="p-4 bg-white rounded-lg min-h-[50vh]">
        <div class="mx-auto max-w-screen-md">
            
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#C0392B]">Tambah Pegawai Baru</h1>
                <a href="{{ route('pegawai.index') }}" class="text-gray-500 hover:text-gray-700">
                    &larr; Kembali
                </a>
            </div>

            {{-- FORM TAMBAH --}}
            {{-- Action mengarah ke route STORE --}}
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf 
                {{-- Tidak perlu @method('PUT') karena ini POST biasa --}}

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    
                    {{-- 1. NAMA LENGKAP --}}
                    <div class="sm:col-span-2">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" 
                            placeholder="Contoh: Budi Santoso" 
                            value="{{ old('nama') }}" required> 
                        {{-- old('nama') menjaga agar tulisan tidak hilang kalau ada error validasi --}}
                        @error('nama')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 2. EMAIL --}}
                    <div class="sm:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" 
                            placeholder="nama@email.com" 
                            value="{{ old('email') }}" required>
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 3. PEKERJAAN (Dropdown) --}}
                    <div>
                        <label for="pekerjaan_id" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan</label>
                        <select id="pekerjaan_id" name="pekerjaan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Pilih Pekerjaan</option>
                            @foreach($pekerjaan as $p)
                                <option value="{{ $p->id }}" {{ old('pekerjaan_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('pekerjaan_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 4. STATUS (Dropdown - Default Aktif) --}}
                    <div>
                        <label for="is_active" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select id="is_active" name="is_active" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>

                    {{-- 5. GENDER (Radio Button) --}}
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                        <div class="flex gap-4">
                            <div class="flex items-center">
                                <input id="gender-l" type="radio" value="male" name="gender" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                    {{ old('gender') == 'male' ? 'checked' : '' }}>
                                <label for="gender-l" class="ms-2 text-sm font-medium text-gray-900">Laki-laki</label>
                            </div>
                            <div class="flex items-center">
                                <input id="gender-p" type="radio" value="female" name="gender" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                    {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label for="gender-p" class="ms-2 text-sm font-medium text-gray-900">Perempuan</label>
                            </div>
                        </div>
                        @error('gender')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- TOMBOL SIMPAN --}}
                <button type="submit" class="mt-6 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                    Tambah Pegawai
                </button>
            </form>

        </div>
    </section>
@endsection