@extends('backend.layouts.app')

@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-16 text-uppercase fw-bold mb-0">{{$moduleName}} / Create</h4>
    </div>
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Back to {{$moduleName}} list</a></li>
        </ol>
    </div>
</div>

<form class="form" action="{{ route('companies.store') }}" method="POST">
    @include('backend.includes.alert-message')
    @csrf
    <div class="row">
        <!-- Company Details -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Primary Information</h5>
                    <div class="mb-3 form-group">
                        <label for="company-name" class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text" id="company-name" name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g : Sample Company" required>
                    </div>
                    <div class="mb-2 form-group clearfix">
                        <label for="company-logo" class="form-label">{{ __('Logo') }} <span class="text-danger">*</span></label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ __('Choose File') }}</div>
                            <input type="hidden" id="company-logo" name="logo" value="{{ old('logo') }}" class="selected-files" required>
                        </div>
                        <div class="file-preview box sm"></div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="mb-3 form-group">
                        <label for="company-short-description" class="form-label">{{ __('Short Description') }}</label>
                        <textarea id="company-short-description" name="short_description" class="form-control" rows="3" placeholder="Short company summary for footer or profile sections">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-copyright-text" class="form-label">Copyright Text</label>
                        <input type="text" id="company-copyright-text" name="copyright_text" value="{{ old('copyright_text') }}" class="form-control" placeholder="Copyright 2026 Your Company. All rights reserved.">
                    </div>

                    <div class="mb-3 mt-1 form-group">
                        <label for="company-website" class="form-label">Website <span class="text-danger">*</span></label>
                        <input type="url" id="company-website" name="website" value="{{ old('website') }}" class="form-control" placeholder="https://example.com" required>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-google-map" class="form-label">{{ __('Map URL') }}</label>
                        <input type="url" id="company-google-map" name="google_map" value="{{ old('google_map') }}" class="form-control" placeholder="https://maps.google.com/...">
                        <small class="text-muted">Paste the public Google Maps share or embed URL.</small>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" id="company-address" name="address" value="{{ old('address') }}" class="form-control" placeholder="e.g : 123 Main St, City, Country" required>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" id="company-phone" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+91 98765 43210" required>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-whatsapp" class="form-label">WhatsApp No</label>
                        <input type="text" id="company-whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" class="form-control" placeholder="+91 98765 43210">
                    </div>

                    <div class="mb-3 form-group">
                        <label for="company-email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="company-email" name="email" value="{{ old('email') }}" class="form-control" placeholder="info@example.com" required>
                    </div>

                    {{-- <div class="mb-3 form-group">
                        <label for="company-sales-partnership-email" class="form-label">Sales &amp; Partnership Email</label>
                        <input type="email" id="company-sales-partnership-email" name="meta[sales_partner_email]" value="{{ old('meta.sales_partner_email') }}" class="form-control" placeholder="">
                    </div> --}}

                    {{-- <div class="mb-3 form-group">
                        <label for="company-technical-support-email" class="form-label">Technical Support Email</label>
                        <input type="email" id="company-technical-support-email" name="meta[technical_support_email]" value="{{ old('meta.technical_support_email') }}" class="form-control" placeholder="">
                    </div> --}}

                    {{-- <div class="mb-3 form-group">
                        <label for="company-careers-email" class="form-label">Careers Email</label>
                        <input type="email" id="company-careers-email" name="meta[careers_email]" value="{{ old('meta.careers_email') }}" class="form-control" placeholder="">
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
                        <input type="url" class="form-control" id="meta-instagram" name="meta[instagram_url]" value="{{ old('meta.instagram_url') }}" placeholder="Enter Instagram URL">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="meta-x" class="form-label">X URL</label>
                        <input type="url" class="form-control" id="meta-x" name="meta[x_url]" value="{{ old('meta.x_url') }}" placeholder="Enter X URL">
                    </div>
                    {{-- <div class="mb-3 form-group">
                        <label for="meta-linkedin" class="form-label">LinkedIn URL</label>
                        <input type="url" class="form-control" id="meta-linkedin" name="meta[linkedin_url]" value="{{ old('meta.linkedin_url') }}" placeholder="Enter LinkedIn URL">
                    </div> --}}
                    <div class="mb-3 form-group">
                        <label for="meta-facebook" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" id="meta-facebook" name="meta[facebook_url]" value="{{ old('meta.facebook_url') }}" placeholder="Enter Facebook URL">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="meta-youtube" class="form-label">YouTube URL</label>
                        <input type="url" class="form-control" id="meta-youtube" name="meta[youtube_url]" value="{{ old('meta.youtube_url') }}" placeholder="Enter YouTube URL">
                    </div>
                    <div class="mb-0 form-group">
                        <label for="meta-pinterest" class="form-label">Pinterest URL</label>
                        <input type="url" class="form-control" id="meta-pinterest" name="meta[pinterest_url]" value="{{ old('meta.pinterest_url') }}" placeholder="Enter Pinterest URL">
                    </div>
                    {{-- <div class="mb-3 form-group">
                        <label for="meta-tiktok" class="form-label">TikTok URL</label>
                        <input type="url" class="form-control" id="meta-tiktok" name="meta[tiktok_url]" value="{{ old('meta.tiktok_url') }}" placeholder="Enter TikTok URL">
                    </div> --}}
                    {{-- <div class="mb-3 form-group">
                        <label for="meta-vimeo" class="form-label">Vimeo URL</label>
                        <input type="url" class="form-control" id="meta-vimeo" name="meta[vimeo_url]" value="{{ old('meta.vimeo_url') }}" placeholder="Enter Vimeo URL">
                    </div> --}}
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Card Section</h5>
                    {{-- <p class="text-muted mb-3">Use this content for the final call-to-action section shown near the bottom of the site.</p> --}}
                    <div class="mb-3 form-group">
                        <label for="company-cta-title" class="form-label">Card Title</label>
                        <input type="text" id="company-cta-title" name="cta_title" value="{{ old('cta_title') }}" class="form-control" placeholder="Ready to work with our team?">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="company-cta-subtitle" class="form-label">Card Subtitle</label>
                        <textarea id="company-cta-subtitle" name="cta_subtitle" class="form-control" rows="3" placeholder="Add supporting text for the CTA section">{{ old('cta_subtitle') }}</textarea>
                    </div>
                    <div class="mb-3 form-group clearfix">
                        <label for="company-catalogue" class="form-label">Catalogue</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="document" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ __('Choose File') }}</div>
                            <input type="hidden" id="company-catalogue" name="catalogue" value="{{ old('catalogue') }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="mb-0 form-group clearfix">
                        <label for="company-sample" class="form-label">Sample</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="document" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ __('Choose File') }}</div>
                            <input type="hidden" id="company-sample" name="sample" value="{{ old('sample') }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary w-100">Create</button>
            </div>
        </div>
    </div>
</form>

<script defer>
    initValidate('.form');
</script>
@endsection
