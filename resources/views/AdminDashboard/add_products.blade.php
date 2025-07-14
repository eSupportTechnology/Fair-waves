@extends ('AdminDashboard.master')

@section('content')
<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Add New Product</h2>
            <div>
                <button type="submit" class="btn btn-md rounded font-sm hover-up">Publish</button>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Basic</h4>
            </div>
            <div class="card-body">
                <!-- The same form continues here -->
                <div class="mb-4">
                    <label for="product_name" class="form-label">Product title <i class="text-danger">*</i></label>
                    <input type="text" name="product_name" placeholder="Type here" class="form-control" id="product_name" />
                </div>
                <div class="mb-4">
                    <label class="form-label">Product description<i class="text-danger">*</i></label>
                    <textarea name="product_description" placeholder="Type here" class="form-control" rows="4"></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Total Quantity <i class="text-danger">*</i></label>
                    <input name="quantity" id="quantity" type="number" class="form-control"/>
                </div>
                {{-- <label class="form-check mb-4">
                    <input name="is_affiliate" id="affiliate_checkbox" class="form-check-input" type="checkbox" />
                    <span class="form-check-label">Affiliate the Product</span>
                </label> --}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label class="form-label">Selling Price <i class="text-danger">*</i></label>
                            <input name="normal_price" id="selling_price" placeholder="Rs" type="number" step="0.01" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label class="form-label">Purchased Price <i class="text-danger">*</i></label>
                            <input name="purchased_price" id="purchased_price" placeholder="Rs" type="number" step="0.01" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label class="form-label">Profit</label>
                            <input name="profit" id="profit" placeholder="Rs" type="number" step="0.01" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label class="form-label">IV</label>
                            <input name="bv" id="bv" placeholder="IV" type="number" step="0.01" class="form-control" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Variations</h4>
            </div>
            <div class="card-body">
                <div id="variationsContainer">
                    <!-- Initial Row -->
                    <div class="row mb-3 variation-row">
                        <div class="col-lg-4">
                            <label class="form-label">Select Type</label>
                            <select name="variations[0][type]" class="form-select" onchange="toggleColorInput(this)">
                                <option value="">Select</option>
                                <option value="size">Size</option>
                                <option value="color">Color</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Value</label>
                            <input type="text" name="variations[0][value]" class="form-control" placeholder="Enter value" />
                            <input type="color" name="variations[0][hex_value]" class="form-control color-input" style="display: none;" />
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="variations[0][quantity]" class="form-control" placeholder="Qty" />
                        </div>
                        <div class="col-lg-1 text-center">
                            <label class="form-label">Delete</label>
                            <button type="button" class="btn btn-danger delete-variation" onclick="removeVariation(this)">✖</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success" onclick="addVariation()">Add Variation</button>
            </div>
        </div>

    </div>

    <div class="col-lg-5">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Media</h4>
            </div>
            <div class="card-body">
                <div class="input-upload">
                    <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="" />
                    <input name="images[]" id="media_upload" class="form-control" type="file" multiple />
                </div>
                <div class="image-preview mt-4" id="image_preview_container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <!-- Image previews will appear here -->
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h4>Organization</h4>
            </div>
            <div class="card-body">
                <div class="row gx-2">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Category <i class="text-danger">*</i></label>
                        <select name="category_id" class="form-select" id="categorySelect">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Subcategory</label>
                        <select name="subcategory_id" class="form-select" id="subcategorySelect" disabled>
                            <option value="">Select a subcategory</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Sub-Subcategory</label>
                        <select name="sub_subcategory_id" class="form-select" id="subsubcategorySelect" disabled>
                            <option value="">Select a sub-subcategory</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Brand </label>
                        <select name="brand_id" class="form-select" id="brandSelect">
                            <option value="">Select a brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="product_tags" class="form-label">Tags</label>
                        <input name="tags" type="text" class="form-control" />
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
</form>

<script>
    const sellingPriceInput = document.getElementById('selling_price');
    const purchasedPriceInput = document.getElementById('purchased_price');
    const profitInput = document.getElementById('profit');
    const bvInput = document.getElementById('bv');

    function calculateProfitAndBV() {
        const sellingPrice = parseFloat(sellingPriceInput.value) || 0;
        const purchasedPrice = parseFloat(purchasedPriceInput.value) || 0;

        const profit = sellingPrice - purchasedPrice;
        const bv = (profit * 0.4) / 100;

        profitInput.value = profit.toFixed(2);
        bvInput.value = bv.toFixed(2);
    }

    sellingPriceInput.addEventListener('input', calculateProfitAndBV);
    purchasedPriceInput.addEventListener('input', calculateProfitAndBV);
</script>

<script>

    //image upload
    document.addEventListener('DOMContentLoaded', function () {
        const mediaUploadInput = document.getElementById('media_upload');
        const imagePreviewContainer = document.getElementById('image_preview_container');
        let currentFiles = [];

        mediaUploadInput.addEventListener('change', function () {
            const files = Array.from(mediaUploadInput.files);
            files.forEach((file, index) => {
                currentFiles.push(file);
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageUrl = e.target.result;
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('position-relative');
                    imageContainer.style.width = '100px';
                    imageContainer.style.height = '100px';

                    const imgElement = document.createElement('img');
                    imgElement.src = imageUrl;
                    imgElement.classList.add('img-thumbnail');
                    imgElement.style.width = '100%';
                    imgElement.style.height = '100%';
                    imgElement.style.objectFit = 'cover';

                    const deleteIcon = document.createElement('span');
                    deleteIcon.classList.add('position-absolute', 'top-0', 'end-0', 'bg-danger', 'text-white', 'rounded-circle', 'p-1', 'cursor-pointer');
                    deleteIcon.innerHTML = '&times;';
                    deleteIcon.style.cursor = 'pointer';

                    deleteIcon.addEventListener('click', function () {
                        imageContainer.remove();
                        removeImageFromFileList(currentFiles.indexOf(file));
                    });

                    imageContainer.appendChild(imgElement);
                    imageContainer.appendChild(deleteIcon);
                    imagePreviewContainer.appendChild(imageContainer);
                };

                reader.readAsDataURL(file);
            });

            updateFileInput();
        });

        function removeImageFromFileList(index) {
            currentFiles.splice(index, 1);
            updateFileInput();
        }

        function updateFileInput() {
            const dt = new DataTransfer();
            currentFiles.forEach(file => {
                dt.items.add(file);
            });
            mediaUploadInput.files = dt.files;
        }
    });


    //categories dropdown
    document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const subsubcategorySelect = document.getElementById('subsubcategorySelect');

    categorySelect.addEventListener('change', function () {
        const categoryId = this.value;

        subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';
        subsubcategorySelect.innerHTML = '<option value="">Select a sub-subcategory</option>';
        subcategorySelect.disabled = true;
        subsubcategorySelect.disabled = true;

        if (categoryId) {
            fetch(`/api/subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        subcategorySelect.appendChild(option);
                    });
                    subcategorySelect.disabled = false;
                })
                .catch(error => console.error('Error fetching subcategories:', error));
        }
    });

    subcategorySelect.addEventListener('change', function () {
        const subcategoryId = this.value;

        subsubcategorySelect.innerHTML = '<option value="">Select a sub-subcategory</option>';
        subsubcategorySelect.disabled = true;

        if (subcategoryId) {
            fetch(`/api/sub-subcategories/${subcategoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subSubcategory => {
                        const option = document.createElement('option');
                        option.value = subSubcategory.id;
                        option.textContent = subSubcategory.name;
                        subsubcategorySelect.appendChild(option);
                    });
                    subsubcategorySelect.disabled = false;
                })
                .catch(error => console.error('Error fetching sub-subcategories:', error));
        }
    });
});

</script>

<script>
    let variationIndex = 1;

    function addVariation() {
        const variationsContainer = document.getElementById('variationsContainer');

        const newVariationRow = document.createElement('div');
        newVariationRow.className = 'row mb-3 variation-row';
        newVariationRow.innerHTML = `
            <div class="col-lg-4">
                <label class="form-label">Select Type</label>
                <select name="variations[${variationIndex}][type]" class="form-select" onchange="toggleColorInput(this)">
                    <option value="">Select</option>
                    <option value="size">Size</option>
                    <option value="color">Color</option>
                </select>
            </div>
            <div class="col-lg-4">
                <label class="form-label">Value</label>
                <input type="text" name="variations[${variationIndex}][value]" class="form-control" placeholder="Enter value" />
                <input type="color" name="variations[${variationIndex}][hex_value]" class="form-control color-input" style="display: none;" />
            </div>
            <div class="col-lg-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="variations[${variationIndex}][quantity]" class="form-control" placeholder="Qty" />
            </div>
            <div class="col-lg-1 text-center">
                <label class="form-label">Delete</label>
                <button type="button" class="btn btn-danger delete-variation" onclick="removeVariation(this)">✖</button>
            </div>
        `;

        variationsContainer.appendChild(newVariationRow);
        variationIndex++;
    }

    function toggleColorInput(select) {
        const colorInput = select.closest('.variation-row').querySelector('.color-input');
        const valueInput = select.closest('.variation-row').querySelector('input[name*="[value]"]');

        if (select.value === 'color') {
            colorInput.style.display = 'block';
            valueInput.style.display = 'none';
            valueInput.value = '';
        } else {
            colorInput.style.display = 'none';
            valueInput.style.display = 'block';
            colorInput.value = '';
        }
    }

    function removeVariation(button) {
        const variationRow = button.closest('.variation-row');
        variationRow.remove();
    }
</script>

@endsection
