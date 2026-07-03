@php
    $getMeta = function ($key, $default = '') use ($pageData) {
        return $pageData->meta->where('meta_key', $key)->first()->meta_value ?? $default;
    };

    $getRepeater = function ($key) use ($getMeta) {
        $data = json_decode($getMeta($key, '[]'), true);

        return is_array($data) ? $data : [];
    };

    $banner_desktop = $getMeta('banner_desktop');
    $banner_mobile = $getMeta('banner_mobile');
    $banner_title = $getMeta('banner_title');
    $banner_subtitle = $getMeta('banner_subtitle');
    $banner_explore_solutions_link = $getMeta('banner_explore_solutions_link');
    $banner_watch_our_story_link = $getMeta('banner_watch_our_story_link');

    $global_scale_image = $getMeta('global_scale_image');
    $global_scale_title = $getMeta('global_scale_title');
    $global_scale_subtitle = $getMeta('global_scale_subtitle');
    $global_scale_description = $getMeta('global_scale_description');
    $global_scale_year_items = $getRepeater('global_scale_year_items');
    $global_scale_stat_items = $getRepeater('global_scale_stat_items');

    $solution_title = $getMeta('solution_title');
    $solution_subtitle = $getMeta('solution_subtitle');
    $solution_description = $getMeta('solution_description');

    $knowledge_center_image = $getMeta('knowledge_center_image');
    $knowledge_center_image_title = $getMeta('knowledge_center_image_title');
    $knowledge_center_image_description = $getMeta('knowledge_center_image_description');
    $knowledge_center_title = $getMeta('knowledge_center_title');
    $knowledge_center_subtitle = $getMeta('knowledge_center_subtitle');
    $knowledge_center_description = $getMeta('knowledge_center_description');
    $knowledge_center_items = $getRepeater('knowledge_center_items');
    $knowledge_center_button_content = $getMeta('knowledge_center_button_content');
    $knowledge_center_button_link = $getMeta('knowledge_center_button_link');

    $sustainability_image = $getMeta('sustainability_image');
    $sustainability_title = $getMeta('sustainability_title');
    $sustainability_subtitle = $getMeta('sustainability_subtitle');
    $sustainability_description = $getMeta('sustainability_description');
    $sustainability_items = $getRepeater('sustainability_items');
    $sustainability_button_content = $getMeta('sustainability_button_content');
    $sustainability_button_link = $getMeta('sustainability_button_link');

    $business_services_image = $getMeta('business_services_image');
    $business_services_image_title = $getMeta('business_services_image_title');
    $business_services_title = $getMeta('business_services_title');
    $business_services_subtitle = $getMeta('business_services_subtitle');
    $business_services_description = $getMeta('business_services_description');
    $business_services_items = $getRepeater('business_services_items');
    $business_services_button_content = $getMeta('business_services_button_content');
    $business_services_button_link = $getMeta('business_services_button_link');
@endphp

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Banner Section</h4>
    </div>

    <div class="col-md-6">
        <label class="form-label">Desktop banner <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $banner_desktop }}" type="hidden" name="meta[banner_desktop]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mobile banner <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $banner_mobile }}" type="hidden" name="meta[banner_mobile]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[banner_title]" value="{{ $banner_title }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[banner_subtitle]" value="{{ $banner_subtitle }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Explore solutions Link <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[banner_explore_solutions_link]" value="{{ $banner_explore_solutions_link }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Watch our story Link <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[banner_watch_our_story_link]" value="{{ $banner_watch_our_story_link }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Global scale Section</h4>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $global_scale_image }}" type="hidden" name="meta[global_scale_image]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[global_scale_title]" value="{{ $global_scale_title }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[global_scale_subtitle]" value="{{ $global_scale_subtitle }}" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="meta[global_scale_description]" class="form-control" rows="4" required>{{ $global_scale_description }}</textarea>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Global scale Year Items</h5>
    </div>

    <div class="global-scale-year-items-target col-md-12">
        @if(isset($global_scale_year_items['itration']) && is_array($global_scale_year_items['itration']))
            @foreach($global_scale_year_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[global_scale_year_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Year <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[global_scale_year_items][year][]" value="{{ $global_scale_year_items['year'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-6 form-group mb-2">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[global_scale_year_items][description][]" value="{{ $global_scale_year_items['description'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[global_scale_year_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label class="form-label">Year <span class="text-danger">*</span></label>
                            <input type="text" name="meta[global_scale_year_items][year][]" class="form-control" placeholder="Enter year" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <input type="text" name="meta[global_scale_year_items][description][]" class="form-control" placeholder="Enter description" required>
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
        data-target=".global-scale-year-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Global scale Stat Items</h5>
    </div>

    <div class="global-scale-stat-items-target col-md-12">
        @if(isset($global_scale_stat_items['itration']) && is_array($global_scale_stat_items['itration']))
            @foreach($global_scale_stat_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[global_scale_stat_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Icon <span class="text-danger">*</span></label>
                                <div class="form-group mb-2">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                        <input value="{{ $global_scale_stat_items['icon'][$index] ?? '' }}" type="hidden" name="meta[global_scale_stat_items][icon][]" class="selected-files" required>
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Count <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[global_scale_stat_items][count][]" value="{{ $global_scale_stat_items['count'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[global_scale_stat_items][title][]" value="{{ $global_scale_stat_items['title'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[global_scale_stat_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Icon <span class="text-danger">*</span></label>
                            <div class="form-group mb-2">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                    <input type="hidden" name="meta[global_scale_stat_items][icon][]" class="selected-files" required>
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Count <span class="text-danger">*</span></label>
                            <input type="text" name="meta[global_scale_stat_items][count][]" class="form-control" placeholder="Enter count" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta[global_scale_stat_items][title][]" class="form-control" placeholder="Enter title" required>
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
        data-target=".global-scale-stat-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Solution Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[solution_title]" value="{{ $solution_title }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[solution_subtitle]" value="{{ $solution_subtitle }}" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[solution_description]" value="{{ $solution_description }}" required>
    </div>

    <div class="col-md-12">
        <div class="text-center">
            <label class="form-label mb-0">Product are Fetch by system</label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Knowledge Center Section</h4>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $knowledge_center_image }}" type="hidden" name="meta[knowledge_center_image]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Image Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[knowledge_center_image_title]" value="{{ $knowledge_center_image_title }}" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Image Description <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[knowledge_center_image_description]" value="{{ $knowledge_center_image_description }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[knowledge_center_title]" value="{{ $knowledge_center_title }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[knowledge_center_subtitle]" value="{{ $knowledge_center_subtitle }}" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="meta[knowledge_center_description]" class="form-control" rows="4" required>{{ $knowledge_center_description }}</textarea>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Knowledge Center Items</h5>
    </div>

    <div class="knowledge-center-items-target col-md-12">
        @if(isset($knowledge_center_items['itration']) && is_array($knowledge_center_items['itration']))
            @foreach($knowledge_center_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[knowledge_center_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Icon <span class="text-danger">*</span></label>
                                <div class="form-group mb-2">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                        <input value="{{ $knowledge_center_items['icon'][$index] ?? '' }}" type="hidden" name="meta[knowledge_center_items][icon][]" class="selected-files" required>
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[knowledge_center_items][title][]" value="{{ $knowledge_center_items['title'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[knowledge_center_items][description][]" value="{{ $knowledge_center_items['description'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[knowledge_center_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Icon <span class="text-danger">*</span></label>
                            <div class="form-group mb-2">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                    <input type="hidden" name="meta[knowledge_center_items][icon][]" class="selected-files" required>
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta[knowledge_center_items][title][]" class="form-control" placeholder="Enter title" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <input type="text" name="meta[knowledge_center_items][description][]" class="form-control" placeholder="Enter description" required>
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
        data-target=".knowledge-center-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Button Link content <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[knowledge_center_button_content]" value="{{ $knowledge_center_button_content }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Button Link <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[knowledge_center_button_link]" value="{{ $knowledge_center_button_link }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Sustainability Section</h4>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $sustainability_image }}" type="hidden" name="meta[sustainability_image]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[sustainability_title]" value="{{ $sustainability_title }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[sustainability_subtitle]" value="{{ $sustainability_subtitle }}" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="meta[sustainability_description]" class="form-control" rows="4" required>{{ $sustainability_description }}</textarea>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Sustainability Items</h5>
    </div>

    <div class="sustainability-items-target col-md-12">
        @if(isset($sustainability_items['itration']) && is_array($sustainability_items['itration']))
            @foreach($sustainability_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[sustainability_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Icon <span class="text-danger">*</span></label>
                                <div class="form-group mb-2">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                        <input value="{{ $sustainability_items['icon'][$index] ?? '' }}" type="hidden" name="meta[sustainability_items][icon][]" class="selected-files" required>
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[sustainability_items][title][]" value="{{ $sustainability_items['title'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[sustainability_items][description][]" value="{{ $sustainability_items['description'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[sustainability_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Icon <span class="text-danger">*</span></label>
                            <div class="form-group mb-2">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                    <input type="hidden" name="meta[sustainability_items][icon][]" class="selected-files" required>
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta[sustainability_items][title][]" class="form-control" placeholder="Enter title" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <input type="text" name="meta[sustainability_items][description][]" class="form-control" placeholder="Enter description" required>
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
        data-target=".sustainability-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Button Link content <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[sustainability_button_content]" value="{{ $sustainability_button_content }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Button Link <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[sustainability_button_link]" value="{{ $sustainability_button_link }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Business Services Section</h4>
    </div>

    <div class="col-md-6">
        <label class="form-label">Image <span class="text-danger">*</span></label>
        <div class="form-group mb-2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                </div>
                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                <input value="{{ $business_services_image }}" type="hidden" name="meta[business_services_image]" class="selected-files" required>
            </div>
            <div class="file-preview box sm"></div>
        </div>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Image Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[business_services_image_title]" value="{{ $business_services_image_title }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[business_services_title]" value="{{ $business_services_title }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[business_services_subtitle]" value="{{ $business_services_subtitle }}" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="meta[business_services_description]" class="form-control" rows="4" required>{{ $business_services_description }}</textarea>
    </div>

    <div class="col-md-12">
        <hr>
        <h5 class="text-primary">Business Services Items</h5>
    </div>

    <div class="business-services-items-target col-md-12">
        @if(isset($business_services_items['itration']) && is_array($business_services_items['itration']))
            @foreach($business_services_items['itration'] as $index => $itration)
                <div class="row remove-parent">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <input value="{{ $index }}" name="meta[business_services_items][itration][]" type="hidden" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Icon <span class="text-danger">*</span></label>
                                <div class="form-group mb-2">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                        <input value="{{ $business_services_items['icon'][$index] ?? '' }}" type="hidden" name="meta[business_services_items][icon][]" class="selected-files" required>
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[business_services_items][title][]" value="{{ $business_services_items['title'][$index] ?? '' }}" required>
                            </div>

                            <div class="col-md-4 form-group mb-2">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="meta[business_services_items][description][]" value="{{ $business_services_items['description'][$index] ?? '' }}" required>
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
                            <input value="data" name="meta[business_services_items][itration][]" type="hidden" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Icon <span class="text-danger">*</span></label>
                            <div class="form-group mb-2">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                    <input type="hidden" name="meta[business_services_items][icon][]" class="selected-files" required>
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta[business_services_items][title][]" class="form-control" placeholder="Enter title" required>
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <input type="text" name="meta[business_services_items][description][]" class="form-control" placeholder="Enter description" required>
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
        data-target=".business-services-items-target"
    >
        <i class="ti ti-plus"></i>
        <span class="ml-2">Add More</span>
    </button>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Button Link content <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[business_services_button_content]" value="{{ $business_services_button_content }}" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Button Link <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[business_services_button_link]" value="{{ $business_services_button_link }}" required>
    </div>
</div>
