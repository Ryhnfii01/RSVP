@extends('admin.layouts.app')

@section('title', 'Gallery')
@section('subtitle', 'Photos shown in the gallery section of the invitation')

@section('content')
<!-- Upload -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
    <div class="flex flex-wrap items-start justify-between gap-4 mb-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Upload Photos</h3>
            <p class="text-sm text-gray-500">
                JPG, PNG, or WebP, up to 10 MB each and 20 per upload.
                {{ $photos->count() }} of {{ $maxPhotos }} photos used.
            </p>
        </div>
        @if ($canCompress)
            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Auto-resize on: max 1600 px, compressed</span>
        @else
            <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800" title="Enable extension=gd in php.ini to resize and compress photos">Auto-resize off: PHP GD extension not enabled, originals are stored</span>
        @endif
    </div>

    @if ($photos->count() < $maxPhotos)
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="flex flex-wrap items-center gap-4">
            @csrf
            <label for="photos" class="sr-only">Photos</label>
            <input id="photos" type="file" name="photos[]" accept="image/jpeg,image/png,image/webp" multiple required
                   class="flex-1 min-w-0 block text-sm text-gray-700 file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0 file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">Upload</button>
        </form>
    @else
        <p class="text-sm text-gray-600">The gallery is full. Remove a photo to add a new one.</p>
    @endif

    @if ($errors->any())
        <div class="mt-4 text-sm text-red-600 space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</div>

<!-- Photos -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
    @if ($photos->isEmpty())
        <div class="py-12 text-center">
            <p class="text-gray-800 font-medium mb-1">No photos yet</p>
            <p class="text-sm text-gray-500">The gallery section stays hidden on the invitation until you upload at least one photo.</p>
        </div>
    @else
        <p class="text-sm text-gray-500 mb-4">Shown on the invitation in this order. Use the arrows to rearrange.</p>
        <ol class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach ($photos as $photo)
            <li class="rounded-xl border border-gray-200 overflow-hidden">
                <div class="relative aspect-square bg-gray-100">
                    <img src="{{ $photo->url() }}" alt="Gallery photo {{ $loop->iteration }}" loading="lazy" class="w-full h-full object-cover">
                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded-md bg-black/60 text-white text-xs tabular-nums">{{ $loop->iteration }}</span>
                </div>
                <div class="flex items-center justify-between gap-1 p-2">
                    <div class="flex gap-1">
                        <form method="POST" action="{{ route('admin.gallery.move', $photo) }}">
                            @csrf
                            <input type="hidden" name="direction" value="up">
                            <button type="submit" @disabled($loop->first) aria-label="Move photo {{ $loop->iteration }} earlier" class="w-8 h-8 inline-flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 disabled:opacity-30 disabled:hover:bg-transparent">&larr;</button>
                        </form>
                        <form method="POST" action="{{ route('admin.gallery.move', $photo) }}">
                            @csrf
                            <input type="hidden" name="direction" value="down">
                            <button type="submit" @disabled($loop->last) aria-label="Move photo {{ $loop->iteration }} later" class="w-8 h-8 inline-flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 disabled:opacity-30 disabled:hover:bg-transparent">&rarr;</button>
                        </form>
                    </div>
                    <span class="text-xs text-gray-400 tabular-nums whitespace-nowrap" title="{{ $photo->width }}×{{ $photo->height }} px">{{ $photo->size < 1024 ? '< 1' : number_format($photo->size / 1024) }} KB</span>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $photo) }}" onsubmit="return confirm('Delete photo {{ $loop->iteration }}? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 text-xs font-medium text-red-600 hover:bg-red-50 rounded-lg">Delete</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ol>
    @endif
</div>
@endsection
