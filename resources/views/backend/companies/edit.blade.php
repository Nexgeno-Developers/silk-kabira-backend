@extends('backend.layouts.app')

@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-16 text-uppercase fw-bold mb-0">{{$moduleName}}</h4>
    </div>
	<div class="text-end">
		<ol class="breadcrumb m-0 py-0 fs-13">
			<li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Back to {{$moduleName}} list</a></li>
		</ol>
	</div>    
</div>

<form class="form" action="{{ route('companies.update', $pageData->id) }}" method="POST">
    @include('backend.includes.alert-message')
    @csrf
    @method('PUT')
    <div class="row">
        <!-- Company Details -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Primary Information</h5>
                    <div class="mb-3 form-group">
                        <label for="company-name" class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text" id="company-name" name="name" value="{{ old('name', $pageData->name) }}" class="form-control" placeholder="e.g : Sample Company" required>
                    </div>
                    <div class="mb-2 form-group clearfix">
                        <label for="company-logo" class="form-label">{{ __('Logo') }} <span class="text-danger">*</span></label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ __('Choose File') }}</div>
                            <input type="hidden" id="company-logo" name="logo" value="{{ $pageData->logo }}" class="selected-files" required>
                        </div>
                        <div class="file-preview box sm"></div>
                    </div>     
                    <div class="clearfix"></div>               

                    <div class="mb-3 form-group">
                        <label for="company-short-description" class="form-label">{{ __('Short Description') }}</label>
                        <textarea
                            id="company-short-description"
                            name="short_description"
                            class="form-control"
                            rows="3"
                            placeholder="Short company summary for footer or profile sections"
                        >{{ old('short_description', $pageData->short_description) }}</textarea>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-copyright-text" class="form-label">Copyright Text</label>
                        <input type="text" id="company-copyright-text" name="copyright_text" value="{{ old('copyright_text', $pageData->copyright_text) }}" class="form-control" placeholder="Copyright 2026 Your Company. All rights reserved.">
                    </div>

                    <div class="mb-3 mt-1 form-group">
                        <label for="company-website" class="form-label">Website <span class="text-danger">*</span></label>
                        <input type="url" id="company-website" name="website" value="{{ old('website', $pageData->website) }}" class="form-control" placeholder="https://example.com" required>
                    </div>  
                    
                    <div class="mb-3 form-group">
                        <label for="company-google-map" class="form-label">{{ __('Map URL') }}</label>
                        <input type="url"
                               id="company-google-map"
                               name="google_map"
                               value="{{ old('google_map', $pageData->google_map) }}"
                               class="form-control"
                               placeholder="https://maps.google.com/...">
                        <small class="text-muted">Paste the public Google Maps share or embed URL.</small>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" id="company-address" name="address" value="{{ old('address', $pageData->address) }}" class="form-control" placeholder="e.g : 123 Main St, City, Country" required>
                    </div>    
                    
                    <div class="mb-3 form-group">
                        <label for="company-phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" id="company-phone" name="phone" value="{{ old('phone', $pageData->phone) }}" class="form-control" placeholder="+91 98765 43210" required>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-whatsapp" class="form-label">WhatsApp No</label>
                        <input type="text" id="company-whatsapp" name="whatsapp" value="{{ old('whatsapp', $pageData->whatsapp) }}" class="form-control" placeholder="+91 98765 43210">
                    </div>                    

                    <div class="mb-3 form-group">
                        <label for="company-email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="company-email" name="email" value="{{ old('email', $pageData->email) }}" class="form-control" placeholder="info@example.com" required>
                    </div>

                    {{-- <div class="mb-3 form-group">
                        <label for="company-sales-partnership-email" class="form-label">Sales &amp; Partnership Email</label>
                        <input type="email"
                               id="company-sales-partnership-email"
                               name="meta[sales_partner_email]"
                               value="{{ old('meta.sales_partner_email', $pageData->meta->where('meta_key', 'sales_partner_email')->first()->meta_value ?? '') }}"
                               class="form-control"
                               placeholder="">
                    </div> --}}

                    {{-- <div class="mb-3 form-group">
                        <label for="company-technical-support-email" class="form-label">Technical Support Email</label>
                        <input type="email"
                               id="company-technical-support-email"
                               name="meta[technical_support_email]"
                               value="{{ old('meta.technical_support_email', $pageData->meta->where('meta_key', 'technical_support_email')->first()->meta_value ?? '') }}"
                               class="form-control"
                               placeholder="">
                    </div> --}}

                    {{-- <div class="mb-3 form-group">
                        <label for="company-careers-email" class="form-label">Careers Email</label>
                        <input type="email"
                               id="company-careers-email"
                               name="meta[careers_email]"
                               value="{{ old('meta.careers_email', $pageData->meta->where('meta_key', 'careers_email')->first()->meta_value ?? '') }}"
                               class="form-control"
                               placeholder="">
                    </div> --}}

                </div>
            </div>

        </div>
        
        <!-- Secondary Meta Data -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Social Links</h5>
                    <p class="text-muted mb-3">Add only full public profile URLs for the channels you want to show.</p>
                    <div class="mb-3 form-group">
                        <label for="meta-instagram" class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" id="meta-instagram" name="meta[instagram_url]" value="{{ old('meta.instagram_url', $pageData->meta->where('meta_key', 'instagram_url')->first()->meta_value ?? '') }}" placeholder="Enter Instagram URL">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="meta-x" class="form-label">X URL</label>
                        <input type="url" class="form-control" id="meta-x" name="meta[x_url]" value="{{ old('meta.x_url', $pageData->meta->where('meta_key', 'x_url')->first()->meta_value ?? '') }}" placeholder="Enter X URL">
                    </div>
                    {{-- <div class="mb-3 form-group">
                        <label for="meta-linkedin" class="form-label">LinkedIn URL</label>
                        <input type="url" class="form-control" id="meta-linkedin" name="meta[linkedin_url]" value="{{ old('meta.linkedin_url', $pageData->meta->where('meta_key', 'linkedin_url')->first()->meta_value ?? '') }}" placeholder="Enter LinkedIn URL">
                    </div> --}}
                    <div class="mb-3 form-group">
                        <label for="meta-facebook" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" id="meta-facebook" name="meta[facebook_url]" value="{{ old('meta.facebook_url', $pageData->meta->where('meta_key', 'facebook_url')->first()->meta_value ?? '') }}" placeholder="Enter Facebook URL">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="meta-youtube" class="form-label">YouTube URL</label>
                        <input type="url" class="form-control" id="meta-youtube" name="meta[youtube_url]" value="{{ old('meta.youtube_url', $pageData->meta->where('meta_key', 'youtube_url')->first()->meta_value ?? '') }}" placeholder="Enter YouTube URL">
                    </div>
                    <div class="mb-0 form-group">
                        <label for="meta-pinterest" class="form-label">Pinterest URL</label>
                        <input type="url" class="form-control" id="meta-pinterest" name="meta[pinterest_url]" value="{{ old('meta.pinterest_url', $pageData->meta->where('meta_key', 'pinterest_url')->first()->meta_value ?? '') }}" placeholder="Enter Pinterest URL">
                    </div>
                    {{-- <div class="mb-3 form-group">
                        <label for="meta-tiktok" class="form-label">TikTok URL</label>
                        <input type="url" class="form-control" id="meta-tiktok" name="meta[tiktok_url]" value="{{ old('meta.tiktok_url', $pageData->meta->where('meta_key', 'tiktok_url')->first()->meta_value ?? '') }}" placeholder="Enter TikTok URL">
                    </div> --}}
                    {{-- <div class="mb-3 form-group">
                        <label for="meta-vimeo" class="form-label">Vimeo URL</label>
                        <input type="url" class="form-control" id="meta-vimeo" name="meta[vimeo_url]" value="{{ old('meta.vimeo_url', $pageData->meta->where('meta_key', 'vimeo_url')->first()->meta_value ?? '') }}" placeholder="Enter Vimeo URL">
                    </div> --}}
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Bottom CTA</h5>
                    {{-- <p class="text-muted mb-3">Use this content for the final call-to-action section shown near the bottom of the site.</p> --}}
                    <div class="mb-3 form-group">
                        <label for="company-cta-title" class="form-label">CTA Title</label>
                        <input type="text" id="company-cta-title" name="cta_title" value="{{ old('cta_title', $pageData->cta_title) }}" class="form-control" placeholder="Ready to work with our team?">
                    </div>
                    <div class="mb-0 form-group">
                        <label for="company-cta-subtitle" class="form-label">CTA Subtitle</label>
                        <textarea id="company-cta-subtitle" name="cta_subtitle" class="form-control" rows="3" placeholder="Add supporting text for the CTA section">{{ old('cta_subtitle', $pageData->cta_subtitle) }}</textarea>
                    </div>
                </div>
            </div>
            
            <!-- SEO -->
            {{-- <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">DEFAULT SEO</h5>
                    <div class="mb-3 form-group">
                        <label for="meta-title" class="form-label">Meta Title</label>
                        <input type="text" id="meta-title" name="meta_title" value="{{ old('meta_title', $pageData->meta_title) }}" class="form-control" placeholder="Enter meta title">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="meta-description" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="meta-description" name="meta_description" rows="3" placeholder="Enter meta description">{{ old('meta_description', $pageData->meta_description) }}</textarea>
                    </div>

                    <hr class="my-3">

                    <div class="mb-3 form-group">
                        <label for="meta-favicon" class="form-label">Favicon</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ __('Choose File') }}</div>
                            <input type="hidden" id="meta-favicon" name="meta[favicon]" value="{{ old('meta.favicon', $pageData->meta->where('meta_key', 'favicon')->first()->meta_value ?? '') }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="meta-og-title" class="form-label">OG Title</label>
                        <input type="text" id="meta-og-title" name="meta[og_title]" value="{{ old('meta.og_title', $pageData->meta->where('meta_key', 'og_title')->first()->meta_value ?? '') }}" class="form-control" placeholder="Enter OG title">
                    </div>

                    <div class="mb-3 form-group">
                        <label for="meta-og-description" class="form-label">OG Description</label>
                        <textarea class="form-control" id="meta-og-description" name="meta[og_description]" rows="3" placeholder="Enter OG description">{{ old('meta.og_description', $pageData->meta->where('meta_key', 'og_description')->first()->meta_value ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="meta-og-image" class="form-label">OG Image</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ __('Choose File') }}</div>
                            <input type="hidden" id="meta-og-image" name="meta[og_image]" value="{{ old('meta.og_image', $pageData->meta->where('meta_key', 'og_image')->first()->meta_value ?? '') }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="meta-twitter-title" class="form-label">Twitter Title</label>
                        <input type="text" id="meta-twitter-title" name="meta[twitter_title]" value="{{ old('meta.twitter_title', $pageData->meta->where('meta_key', 'twitter_title')->first()->meta_value ?? '') }}" class="form-control" placeholder="Enter Twitter title">
                    </div>

                    <div class="mb-3 form-group">
                        <label for="meta-twitter-description" class="form-label">Twitter Description</label>
                        <textarea class="form-control" id="meta-twitter-description" name="meta[twitter_description]" rows="3" placeholder="Enter Twitter description">{{ old('meta.twitter_description', $pageData->meta->where('meta_key', 'twitter_description')->first()->meta_value ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="meta-twitter-image" class="form-label">Twitter Image</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ __('Choose File') }}</div>
                            <input type="hidden" id="meta-twitter-image" name="meta[twitter_image]" value="{{ old('meta.twitter_image', $pageData->meta->where('meta_key', 'twitter_image')->first()->meta_value ?? '') }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="meta-schema-json" class="form-label">Schema JSON</label>
                        <textarea class="form-control" id="meta-schema-json" name="meta[schema_json]" rows="4" placeholder="Enter JSON-LD only (no &lt;script&gt; wrapper)">{{
                            old(
                                'meta.schema_json',
                                $pageData->meta->where('meta_key', 'schema_json')->first()->meta_value ?? ''
                            )
                        }}</textarea>
                    </div>
                </div>
            </div> --}}
            
            <!-- Submit Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </div>
        </div>
    </div>
</form>

<script defer>
    initValidate('.form');
</script>
@endsection
