@php
    $getMeta = function ($key, $default = '') use ($pageData) {
        return $pageData->meta->where('meta_key', $key)->first()->meta_value ?? $default;
    };

    $getRepeater = function ($key) use ($getMeta) {
        $data = json_decode($getMeta($key, '[]'), true);

        return is_array($data) ? $data : [];
    };

    $breadcrumb_image = $getMeta('breadcrumb_image');
    $breadcrumb_title = $getMeta('breadcrumb_title');

    $process_title = $getMeta('process_title');
    $process_subtitle = $getMeta('process_subtitle');
    $process_items = $getRepeater('process_items');

    $highlight_image = $getMeta('highlight_image');
    $highlight_items = $getRepeater('highlight_items');

    $craft_title = $getMeta('craft_title');
    $craft_description = $getMeta('craft_description');
    $craft_video_url = $getMeta('craft_video_url');
@endphp

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Breadcrumb Section</h4>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $breadcrumb_image }}" type="hidden" name="meta[breadcrumb_image]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[breadcrumb_title]" value="{{ $breadcrumb_title }}" placeholder="Enter breadcrumb title" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Process Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[process_title]" value="{{ $process_title }}" placeholder="Enter process title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[process_subtitle]" value="{{ $process_subtitle }}" placeholder="Enter process subtitle" required>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Process Items</h5>
    </div>

    <div class="process-items-target col-md-12">
        @if(isset($process_items['itration']) && is_array($process_items['itration']))
            @foreach($process_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[process_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Counts <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[process_items][count][]" value="{{ $process_items['count'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[process_items][title][]" value="{{ $process_items['title'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[process_items][description][]" value="{{ $process_items['description'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[process_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Counts <span class="text-danger">*</span></label>
                            <input type="text" name="meta[process_items][count][]" class="form-control" placeholder="Enter count" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta[process_items][title][]" class="form-control" placeholder="Enter title" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <input type="text" name="meta[process_items][description][]" class="form-control" placeholder="Enter description" required>
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
        data-target=".process-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Highlight Section</h4>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $highlight_image }}" type="hidden" name="meta[highlight_image]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Highlight Items</h5>
    </div>

    <div class="highlight-items-target col-md-12">
        @if(isset($highlight_items['itration']) && is_array($highlight_items['itration']))
            @foreach($highlight_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[highlight_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Key <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[highlight_items][key][]" value="{{ $highlight_items['key'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Value <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[highlight_items][value][]" value="{{ $highlight_items['value'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[highlight_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label class="form-label">Key <span class="text-danger">*</span></label>
                            <input type="text" name="meta[highlight_items][key][]" class="form-control" placeholder="Enter key" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label class="form-label">Value <span class="text-danger">*</span></label>
                            <input type="text" name="meta[highlight_items][value][]" class="form-control" placeholder="Enter value" required>
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
        data-target=".highlight-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>
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
