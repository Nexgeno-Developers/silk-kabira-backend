@php
    $getMeta = function ($key, $default = '') use ($pageData) {
        return $pageData->meta->where('meta_key', $key)->first()->meta_value ?? $default;
    };

    $breadcrumb_image = $getMeta('breadcrumb_image');
    $breadcrumb_title = $getMeta('breadcrumb_title');
    $breadcrumb_description = $getMeta('breadcrumb_description');
    $occasions = $getMeta('occasions');
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

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[breadcrumb_description]" value="{{ $breadcrumb_description }}" placeholder="Enter breadcrumb description" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Occations Section</h4>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Occations <span class="text-danger">*</span></label>
        <input type="text" class="form-control aiz-tag-input" name="meta[occasions]" value="{{ $occasions }}" placeholder="Enter occasions separated by commas" required>
    </div>

    <div class="col-md-12">
        <div class="text-center py-2">
            <label class="form-label mb-0">Note: Be careful—editing or deleting an occasion affects all linked products.</label>
        </div>
    </div>
</div>
