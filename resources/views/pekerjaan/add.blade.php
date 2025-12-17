@extends('base')
@section('title','Pekerjaan')
@section('menupekerjaan', 'underline decoration-4 underline-offset-7')
@section('content')
    <section class="p-4 bg-white rounded-lg min-h-[50vh]">
        <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Pekerjaan</h1>
        <div class="mx-auto max-w-screen-xl">
            <form action="{{ route('pekerjaan.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                    <input type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Contoh: Back-end Developer" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" autocomplete="off" placeholder="Masukkan deskripsi" required></textarea>
                </div>

                {{-- AREA CAPTCHA --}}
                <div class="sm:col-span-2 mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Kode Keamanan</label>
                    <div class="flex gap-4 items-center">
                        <div class="captcha-img border rounded-lg overflow-hidden">
                            {!! captcha_img('flat') !!}
                        </div>

                        <input type="text" name="captcha" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" 
                            placeholder="Masukkan kode di samping" required>
                    </div>
                    @error('captcha')
                        <p class="mt-1 text-xs text-red-600">Kode captcha salah!</p>
                    @enderror
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button type="reset" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer">Reset</button>
                    <button type="submit" class="rounded-md bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700 cursor-pointer">Simpan</button>
                </div>
                </div>
            </form>
        </div>
    </section>
@endsection
