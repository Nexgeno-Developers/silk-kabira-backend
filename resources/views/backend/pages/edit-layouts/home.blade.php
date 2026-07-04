@php
    $getMeta = function ($key, $default = '') use ($pageData) {
        return $pageData->meta->where('meta_key', $key)->first()->meta_value ?? $default;
    };

    $getRepeater = function ($key) use ($getMeta) {
        $data = json_decode($getMeta($key, '[]'), true);

        return is_array($data) ? $data : [];
    };

    $hero_title = $getMeta('hero_title');
    $hero_video_url = $getMeta('hero_video_url');
    $hero_navigation_text = $getMeta('hero_navigation_text');
    $hero_navigation_url = $getMeta('hero_navigation_url');

    $about_title = $getMeta('about_title');
    $about_subtitle = $getMeta('about_subtitle');
    $about_image_1 = $getMeta('about_image_1');
    $about_image_2 = $getMeta('about_image_2');

    $premium_collection_navigation_text = $getMeta('premium_collection_navigation_text');
    $premium_collection_navigation_url = $getMeta('premium_collection_navigation_url');

    $craft_title = $getMeta('craft_title');
    $craft_description = $getMeta('craft_description');
    $craft_video_url = $getMeta('craft_video_url');

    $trust_title = $getMeta('trust_title');
    $trust_items = $getRepeater('trust_items');

    $best_seller_navigation_text = $getMeta('best_seller_navigation_text');
    $best_seller_navigation_url = $getMeta('best_seller_navigation_url');

    $partners_title = $getMeta('partners_title');
    $partners_subtitle = $getMeta('partners_subtitle');
    $partners_video_url = $getMeta('partners_video_url');
    $partners_amazon_url = $getMeta('partners_amazon_url');
    $partners_ajio_url = $getMeta('partners_ajio_url');

    $blogs_title = $getMeta('blogs_title');
    $blogs_navigation_text = $getMeta('blogs_navigation_text');
    $blogs_navigation_url = $getMeta('blogs_navigation_url');
@endphp

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Hero Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[hero_title]" value="{{ $hero_title }}" placeholder="Enter hero title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Video <span class="text-danger">*</span></label>
        <input type="url" class="form-control" name="meta[hero_video_url]" value="{{ $hero_video_url }}" placeholder="https://example.com/video" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Navigation Text <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[hero_navigation_text]" value="{{ $hero_navigation_text }}" placeholder="Enter navigation text" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Navigation Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[hero_navigation_url]" value="{{ $hero_navigation_url }}" placeholder="/about-us or https://example.com" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">About Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[about_title]" value="{{ $about_title }}" placeholder="Enter about title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[about_subtitle]" value="{{ $about_subtitle }}" placeholder="Enter about subtitle" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image 1 <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $about_image_1 }}" type="hidden" name="meta[about_image_1]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image 2 <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $about_image_2 }}" type="hidden" name="meta[about_image_2]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Premium Collection Section</h4>
    </div>

    <div class="col-md-12">
        <div class="text-center py-2">
            <label class="form-label mb-0">Premium products will be automatically fetched.</label>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Navigation Text <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[premium_collection_navigation_text]" value="{{ $premium_collection_navigation_text }}" placeholder="Enter navigation text" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Navigation Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[premium_collection_navigation_url]" value="{{ $premium_collection_navigation_url }}" placeholder="/collections or https://example.com" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Craft Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[craft_title]" value="{{ $craft_title }}" placeholder="Enter craft title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Video <span class="text-danger">*</span></label>
        <input type="url" class="form-control" name="meta[craft_video_url]" value="{{ $craft_video_url }}" placeholder="https://example.com/video" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[craft_description]" value="{{ $craft_description }}" placeholder="Enter craft description" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Trust Section</h4>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[trust_title]" value="{{ $trust_title }}" placeholder="Enter trust section title" required>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Trust Items</h5>
    </div>

    <div class="trust-items-target col-md-12">
        @if(isset($trust_items['itration']) && is_array($trust_items['itration']))
            @foreach($trust_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[trust_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[trust_items][title][]" value="{{ $trust_items['title'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[trust_items][description][]" value="{{ $trust_items['description'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                <div class="form-group mb-2">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                        <input value="{{ $trust_items['image'][$index] ?? '' }}" type="hidden" name="meta[trust_items][image][]" class="selected-files" required>
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1 btn-dynamic-fields">
                        <button type="button" class="btn btn-icon btn-circle btn-soft-danger mb-1" data-toggle="remove-parent" data-parent=".remove-parent">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <button
        type="button"
        class="mt-1 btn btn-soft-success btn-icon w-100 mb-2"
        data-toggle="add-more"
        data-limit="20"
        data-content='
            <div class="row remove-parent">
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <input value="data" name="meta[trust_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta[trust_items][title][]" class="form-control" placeholder="Enter title" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <input type="text" name="meta[trust_items][description][]" class="form-control" placeholder="Enter description" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <div class="form-group mb-2">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                    <input type="hidden" name="meta[trust_items][image][]" class="selected-files" required>
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 btn-dynamic-fields">
                    <button type="button" class="btn btn-icon btn-circle btn-soft-danger mb-1" data-toggle="remove-parent" data-parent=".remove-parent">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
        '
        data-target=".trust-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Best Seller Section</h4>
    </div>

    <div class="col-md-12">
        <div class="text-center py-2">
            <label class="form-label mb-0">Best seller products will be automatically fetched.</label>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Navigation Text <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[best_seller_navigation_text]" value="{{ $best_seller_navigation_text }}" placeholder="Enter navigation text" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Navigation Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[best_seller_navigation_url]" value="{{ $best_seller_navigation_url }}" placeholder="/best-sellers or https://example.com" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Partners Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[partners_title]" value="{{ $partners_title }}" placeholder="Enter partners title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[partners_subtitle]" value="{{ $partners_subtitle }}" placeholder="Enter partners subtitle" required>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">Video <span class="text-danger">*</span></label>
        <input type="url" class="form-control" name="meta[partners_video_url]" value="{{ $partners_video_url }}" placeholder="https://example.com/video" required>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">Amazon Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[partners_amazon_url]" value="{{ $partners_amazon_url }}" placeholder="https://amazon.in/..." required>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">Ajio Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[partners_ajio_url]" value="{{ $partners_ajio_url }}" placeholder="https://www.ajio.com/..." required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Blogs Section</h4>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[blogs_title]" value="{{ $blogs_title }}" placeholder="Enter blogs title" required>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">Navigation Text <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[blogs_navigation_text]" value="{{ $blogs_navigation_text }}" placeholder="Enter navigation text" required>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">Navigation Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[blogs_navigation_url]" value="{{ $blogs_navigation_url }}" placeholder="/blogs or https://example.com" required>
    </div>

    <div class="col-md-12">
        <div class="text-center py-2">
            <label class="form-label mb-0">Blogs will be automatically fetched.</label>
        </div>
    </div>
</div>
