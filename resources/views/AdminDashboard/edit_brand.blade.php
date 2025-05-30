@extends('AdminDashboard.master')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Edit Brand</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="brandName" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" id="brandName" name="name"
                        value="{{ old('name', $brand->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="brandSlug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="brandSlug" name="slug"
                        value="{{ old('slug', $brand->slug) }}" required>
                </div>

                <div class="mb-3">
                    <label for="brandImage" class="form-label">Brand Image</label>
                    <input type="file" class="form-control" id="brandImage" name="image" accept="image/*">

                    @if ($brand->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"
                                style="width: 100px; height: auto; border-radius: 8px;">
                        </div>
                    @endif
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="isTopBrand" name="is_top_brand" value="1"
                        {{ $brand->is_top_brand ? 'checked' : '' }}>
                    <label class="form-check-label" for="isTopBrand">Top Brand</label>
                </div>

                <button type="submit" class="btn btn-primary">Update Brand</button>
                <a href="{{ route('brand_list') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection
