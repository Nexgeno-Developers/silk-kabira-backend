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

    $why_we_title = $getMeta('why_we_title');
    $why_we_subtitle = $getMeta('why_we_subtitle');
    $why_we_items = $getRepeater('why_we_items');

    $plan_pricing_title = $getMeta('plan_pricing_title');
    $plan_pricing_subtitle = $getMeta('plan_pricing_subtitle');
    $plan_pricing_description = $getMeta('plan_pricing_description');
    $plan_pricing_items = $getRepeater('plan_pricing_items');

    $process_title = $getMeta('process_title');
    $process_subtitle = $getMeta('process_subtitle');
    $process_items = $getRepeater('process_items');

    $global_presence_title = $getMeta('global_presence_title');
    $global_presence_subtitle = $getMeta('global_presence_subtitle');
    $global_presence_image = $getMeta('global_presence_image');
    $global_presence_locations = $getMeta('global_presence_locations');

    $enquiry_title = $getMeta('enquiry_title');
    $enquiry_subtitle = $getMeta('enquiry_subtitle');
@endphp

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Breadcrumb Section</h4>
    </div>

    <div class="col-md-6">
        <label class="form-label">Breadcrumb Image <span class="text-danger">*</span></label>
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
        <h4 class="text-primary">Why We Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[why_we_title]" value="{{ $why_we_title }}" placeholder="Enter section title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[why_we_subtitle]" value="{{ $why_we_subtitle }}" placeholder="Enter section subtitle" required>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Why We Items</h5>
    </div>

    <div class="why-we-items-target col-md-12">
        @if(isset($why_we_items['itration']) && is_array($why_we_items['itration']))
            @foreach($why_we_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[why_we_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Count <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[why_we_items][count][]" value="{{ $why_we_items['count'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[why_we_items][title][]" value="{{ $why_we_items['title'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[why_we_items][description][]" value="{{ $why_we_items['description'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[why_we_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Count <span class="text-danger">*</span></label>
                            <input type="text" name="meta[why_we_items][count][]" class="form-control" placeholder="Enter count" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta[why_we_items][title][]" class="form-control" placeholder="Enter title" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <input type="text" name="meta[why_we_items][description][]" class="form-control" placeholder="Enter description" required>
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
        data-target=".why-we-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Plan & Pricing Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[plan_pricing_title]" value="{{ $plan_pricing_title }}" placeholder="Enter section title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[plan_pricing_subtitle]" value="{{ $plan_pricing_subtitle }}" placeholder="Enter section subtitle" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[plan_pricing_description]" value="{{ $plan_pricing_description }}" placeholder="Enter description" required>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Plan & Pricing Items</h5>
    </div>

    <div class="plan-pricing-items-target col-md-12">
        @if(isset($plan_pricing_items['itration']) && is_array($plan_pricing_items['itration']))
            @foreach($plan_pricing_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[plan_pricing_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[plan_pricing_items][quantity][]" value="{{ $plan_pricing_items['quantity'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Tier <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[plan_pricing_items][tier][]" value="{{ $plan_pricing_items['tier'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Notes <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[plan_pricing_items][notes][]" value="{{ $plan_pricing_items['notes'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[plan_pricing_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="text" name="meta[plan_pricing_items][quantity][]" class="form-control" placeholder="Enter quantity" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Tier <span class="text-danger">*</span></label>
                            <input type="text" name="meta[plan_pricing_items][tier][]" class="form-control" placeholder="Enter tier" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Notes <span class="text-danger">*</span></label>
                            <input type="text" name="meta[plan_pricing_items][notes][]" class="form-control" placeholder="Enter notes" required>
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
        data-target=".plan-pricing-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Process Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[process_title]" value="{{ $process_title }}" placeholder="Enter section title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[process_subtitle]" value="{{ $process_subtitle }}" placeholder="Enter section subtitle" required>
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

                            <div class="col-md-4">
                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                <div class="form-group mb-2">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                        <input value="{{ $process_items['image'][$index] ?? '' }}" type="hidden" name="meta[process_items][image][]" class="selected-files" required>
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
                        <div class="col-md-4">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <div class="form-group mb-2">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                    <input type="hidden" name="meta[process_items][image][]" class="selected-files" required>
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
        data-target=".process-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Global Presence Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[global_presence_title]" value="{{ $global_presence_title }}" placeholder="Enter global presence title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[global_presence_subtitle]" value="{{ $global_presence_subtitle }}" placeholder="Enter global presence subtitle" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $global_presence_image }}" type="hidden" name="meta[global_presence_image]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Locations <span class="text-danger">*</span></label>
        <input type="text" class="form-control aiz-tag-input" name="meta[global_presence_locations]" value="{{ $global_presence_locations }}" placeholder="Enter locations separated by commas" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Enquiry Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[enquiry_title]" value="{{ $enquiry_title }}" placeholder="Enter enquiry title" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[enquiry_subtitle]" value="{{ $enquiry_subtitle }}" placeholder="Enter enquiry subtitle" required>
    </div>
</div>
