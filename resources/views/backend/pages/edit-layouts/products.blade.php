@php
    $getMeta = function ($key, $default = '') use ($pageData) {
        return $pageData->meta->where('meta_key', $key)->first()->meta_value ?? $default;
    };

    $breadcrumb_image = $getMeta('breadcrumb_image');
    $breadcrumb_title = $getMeta('breadcrumb_title');
    $breadcrumb_subtitle = $getMeta('breadcrumb_subtitle');
    $breadcrumb_description = $getMeta('breadcrumb_description');

    $normalizeTagValues = function ($rawValue) {
        if (!filled($rawValue)) {
            return [];
        }

        $decoded = json_decode($rawValue, true);

        if (is_array($decoded)) {
            return collect($decoded)
                ->map(function ($item) {
                    if (is_array($item)) {
                        return trim((string) ($item['value'] ?? ''));
                    }

                    return trim((string) $item);
                })
                ->filter()
                ->values()
                ->all();
        }

        return collect(explode(',', (string) $rawValue))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    };

    $selected_occasions = $normalizeTagValues($getMeta('occasions', ''));

    $sku = $getMeta('sku');
    $description = $getMeta('description');
    $process = $getMeta('process');
    $fabric = $getMeta('fabric');
    $color = $getMeta('color');
    $best_for = $getMeta('best_for');
    $moq = $getMeta('moq');
    $lead_time = $getMeta('lead_time');
    $export = $getMeta('export');
    $amazon_url = $getMeta('amazon_url');
    $ajio_url = $getMeta('ajio_url');
    $features = $getMeta('features');
    $type = $getMeta('type');

    $occasion_options = \App\Models\Page::query()
        ->with('meta')
        ->where('layout', 'collections')
        ->when($pageData->company_id, function ($query) use ($pageData) {
            $query->where('company_id', $pageData->company_id);
        })
        ->get()
        ->flatMap(function ($page) use ($normalizeTagValues) {
            $occasionMeta = $page->meta->where('meta_key', 'occasions')->first()->meta_value ?? '';

            if (!filled($occasionMeta)) {
                return [];
            }

            return collect($normalizeTagValues($occasionMeta));
        })
        ->unique(fn ($item) => strtolower($item))
        ->values()
        ->all();
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

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[breadcrumb_subtitle]" value="{{ $breadcrumb_subtitle }}" placeholder="Enter breadcrumb subtitle" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[breadcrumb_description]" value="{{ $breadcrumb_description }}" placeholder="Enter breadcrumb description" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Product Information Section</h4>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Occasion <span class="text-danger">*</span></label>
        <select class="form-control select2" name="meta[occasions][]" multiple required>
            @foreach ($occasion_options as $occasion_option)
                <option value="{{ $occasion_option }}" {{ in_array($occasion_option, $selected_occasions, true) ? 'selected' : '' }}>
                    {{ $occasion_option }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">SKU <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[sku]" value="{{ $sku }}" placeholder="Enter SKU" required>
    </div>

    <div class="col-md-12 form-group mb-2">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="meta[description]" class="form-control text-editor" rows="4" required>{{ $description }}</textarea>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Process <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[process]" value="{{ $process }}" placeholder="Enter process" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Fabric <span class="text-danger">*</span></label>
        <input type="text" class="form-control aiz-tag-input" name="meta[fabric]" value="{{ $fabric }}" placeholder="Enter fabric tags" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Color <span class="text-danger">*</span></label>
        <input type="text" class="form-control aiz-tag-input" name="meta[color]" value="{{ $color }}" placeholder="Enter color tags" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Best For <span class="text-danger">*</span></label>
        <input type="text" class="form-control aiz-tag-input" name="meta[best_for]" value="{{ $best_for }}" placeholder="Enter best for tags" required>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">MOQ <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[moq]" value="{{ $moq }}" placeholder="Enter MOQ" required>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">Lead Time <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[lead_time]" value="{{ $lead_time }}" placeholder="Enter lead time" required>
    </div>

    <div class="col-md-4 form-group mb-2">
        <label class="form-label">Export <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[export]" value="{{ $export }}" placeholder="Enter export details" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Amazon Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[amazon_url]" value="{{ $amazon_url }}" placeholder="https://amazon.in/..." required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Ajio Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="meta[ajio_url]" value="{{ $ajio_url }}" placeholder="https://www.ajio.com/..." required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Features <span class="text-danger">*</span></label>
        <input type="text" class="form-control aiz-tag-input" name="meta[features]" value="{{ $features }}" placeholder="Enter feature tags" required>
    </div>

    <div class="col-md-6 form-group mb-2">
        <label class="form-label">Type <span class="text-danger">*</span></label>
        <select class="form-control select2" name="meta[type]" required>
            <option value="">Select type</option>
            <option value="Premium" {{ $type === 'Premium' ? 'selected' : '' }}>Premium</option>
            <option value="Best Seller" {{ $type === 'Best Seller' ? 'selected' : '' }}>Best Seller</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h4 class="text-primary">Related Product Section</h4>
    </div>

    <div class="col-md-12">
        <div class="text-center py-2">
            <label class="form-label mb-0">Related products will be automatically fetched.</label>
        </div>
    </div>
</div>
