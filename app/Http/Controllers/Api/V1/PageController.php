<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\SeoMeta;
use App\Services\ApiPayloadCache;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Upload-based meta keys
    private array $uploadMetaKeys = [
        'banner_images',
        'short_summary_icon',
        'hero_image',
        'single_image',
        'multiple_image',
        'single_document',
        'multiple_document',
        'single_video',
        'multiple_video',
        'image',
        'icon',
        'breadcrumb_image',
        'insights_image',
        'pilot_plant_image',
        'leading_image',
        'short_summary_image',
        'technical_sheet',
        'desktop_banner',
        'mobile_banner',        
        'about_image',        
        'about_image_secondary',        
        'vision_mission_image',        
        'ethical_banner',        
        'global_standard_image',
        'timeline_certificates',
        'certificates',
        'community_image',
        'membership_map',
        'membership_block_1_icon',
        'membership_block_2_icon',
        'membership_block_3_icon',
        'hr_photo',
        'recycling_journey_image',
        'lamipak_commitment_image',
        'sustainable_packaging_vision_image',
        'shared_guide_image',
        'social_world_images',
        'sustainability_journey_image',
        'global_beverage_image',
        'consultation_background_image',
        'side_image',
        'banner_desktop',
        'banner_mobile',
        'growth_image',
        'global_scale_image',
        'knowledge_center_image',
        'sustainability_image',
        'business_services_image',
        'global_image',
    ];

    // Post reference keys
    private array $post_category_MetaKeys = [
        'post_block_categories',
    ];

    // Page reference keys
    private array $pageSectionMetaKeys = [
        'product_categories',
        'recommended_products',
        'standard_products',
        'premium_products',
        'products',
        'relation_category',
        'relation_industries',
        'page_blocks',        
        'pilot_plant_pages',        
        'application_versatility_product_industries',
        'approach_product_industries',
    ];

    // JSON dynamic keys
    private array $dynamicJsonMetaKeys = [
        'dynamic_field',
        'hero_items',
        'info_items',
        'product_info_items',
        'features_items',
        'accessories_items',
        'highlights_items',
        'brand_journey_items',
        'differentiation_items',
        'information_items',
        'faqs_items',
        'banner_items',
        'sizes_formats',    
        'business_statistics_items',    
        'journey_items',    
        'values_items',
        'solution_items',
        'governance_items',    
        'risk_control_items',    
        'global_standard_items',    
        'digital_trust_items',    
        'speak_up_items', 
        'support_items',
        'sustainability_section_items',
        'path_items',
        'lifecycle_items',
        'laboratory_zones_items',
        'why_carton_items',
        'special_ability_items',
        'special_ability_images',
        'lamira_love_items',
        'ecosystem_items',
        'application_versatility_items',
        'global_count_items',
        'global_scale_year_items',
        'knowledge_center_items',
        'sustainability_items',
        'business_services_items',
        'global_scale_stat_items',


    ];

    /**
     * Fetch by ID
     */
    public function showById(int $id, Request $request): JsonResponse
    {
        $autofetch = $request->get('autofetch');

        $cached = ApiPayloadCache::getCachedPagePayload($id, $autofetch);
        if ($cached !== null) {
            return response()->json(['data' => $cached]);
        }

        $page = Page::query()
            ->with('meta')
            ->where('id', $id)
            ->where('is_active', true)
            ->first();

        if (!$page) {
            return response()->json([
                'error' => [
                    'message' => 'Page not found',
                    'code' => 'PAGE_NOT_FOUND',
                ],
            ], 404);
        }

        $data = $this->pagePayload($page, $autofetch);
        ApiPayloadCache::storePagePayload((int) $page->id, $autofetch, $data);

        return response()->json(['data' => $data]);
    }

    /**
     * Fetch by slug
     */
    public function showBySlug(string $slug, Request $request): JsonResponse
    {
        $normalizedSlug = trim($slug, '/');
        $autofetch = $request->get('autofetch');

        $pageId = Page::query()
            ->where('slug', $normalizedSlug)
            ->where('is_active', true)
            ->value('id');

        if ($pageId === null) {
            return response()->json([
                'error' => [
                    'message' => 'Page not found',
                    'code' => 'PAGE_NOT_FOUND',
                ],
            ], 404);
        }

        $pageId = (int) $pageId;

        $cached = ApiPayloadCache::getCachedPagePayload($pageId, $autofetch);
        if ($cached !== null) {
            return response()->json(['data' => $cached]);
        }

        $page = Page::query()
            ->with('meta')
            ->where('id', $pageId)
            ->where('is_active', true)
            ->first();

        if (!$page) {
            return response()->json([
                'error' => [
                    'message' => 'Page not found',
                    'code' => 'PAGE_NOT_FOUND',
                ],
            ], 404);
        }

        $data = $this->pagePayload($page, $autofetch);
        ApiPayloadCache::storePagePayload($pageId, $autofetch, $data);

        return response()->json(['data' => $data]);
    }

    /**
     * Main Payload Builder
     */
    private function pagePayload(Page $page, $additionalParams = null): array
    {
        $seoMeta = SeoMeta::query()
            ->where('slug', $page->slug)
            ->first();

        //additionalParams

        $autofetchSections = [];
        if(!empty($additionalParams)){
            $additionalParams = explode(',', $additionalParams);
            
            foreach($additionalParams as $param):
                // if($param === 'services') {
                //     $ids = Page::query()->whereIn('layout', ['marketing_services', 'technical_services'])->where('is_active', true)->pluck('id')->toArray();
                //     $autofetchSections['services'] = page_details_from_ids($ids);
                // }

                // if($param === 'industries') {
                //     $ids = Page::query()->whereIn('layout', ['product_industry_detail'])->where('is_active', true)->pluck('id')->toArray();
                //     $autofetchSections['industries'] = page_details_from_ids($ids);
                // }                

                // if($param === 'sustainabilities') {
                //     $ids = Page::query()->whereIn('layout', ['sustainability_1', 'sustainability_2', 'sustainability_3','sustainability_4','sustainability_5','sustainability_6'])->where('is_active', true)->pluck('id')->toArray();
                //     $autofetchSections['sustainabilities'] = page_details_from_ids($ids);
                // }                

                // if($param === 'product_categories') {
                //     $ids = Page::query()->whereIn('layout', ['product_category_detail_1','product_category_detail_2','product_category_detail_3','product_category_detail_4','product_category_detail_5'])->where('is_active', true)->pluck('id')->toArray();
                //     $autofetchSections['product_categories'] = page_details_from_ids($ids);
                // }   
                
                if($param === 'related_products') {
                    $ids = $this->getRelatedProductIdsByOccasions($page);
                    $autofetchSections['related_products'] = page_details_from_ids($ids);
                }    

                // if($param === 'sustainable_products') {
                //     $ids = Page::query()->whereIn('layout', ['products'])->where('is_active', true)
                //         ->whereHas('meta', function ($q) {
                //             $q->where('meta_key', 'relation_category')
                //             ->where('meta_value', 17); // Assuming 17 is the ID for the sustainable category
                //         })->pluck('id')->toArray();
                //     $autofetchSections['sustainable_products'] = page_details_from_ids($ids);
                // }     
                
                // if($param === 'lamistraw_products') {
                //     $ids = Page::query()->whereIn('layout', ['products'])->where('is_active', true)
                //         ->whereHas('meta', function ($q) {
                //             $q->where('meta_key', 'relation_category')
                //             ->where('meta_value', 7); // Assuming 6 is the ID for the lamistraw category
                //         })->pluck('id')->toArray();
                //     $autofetchSections['lamistraw_products'] = page_details_from_ids($ids);
                // }                 

                // if($param === 'featured_products') {
                //     $ids = Page::query()->whereIn('layout', ['products'])->where('is_active', true)
                //             ->whereHas('meta', function ($q) {
                //                 $q->where('meta_key', 'relation_featured')
                //                 ->where('meta_value', 'yes');
                //             })->pluck('id')->toArray();
                //     $autofetchSections['featured_products'] = page_details_from_ids($ids);
                // }  
                
                // if ($param === 'standard_products') {
                //     // Backward-compatibility alias for older consumers.
                //     $ids = $this->getProductIdsByType('Best Seller', $page);
                //     $autofetchSections['standard_products'] = page_details_from_ids($ids);
                // } 
                
                if ($param === 'premium_products') {
                    $ids = $this->getProductIdsByType('Premium', $page);
                    $autofetchSections['premium_products'] = page_details_from_ids($ids);
                }

                if ($param === 'best_seller_products') {
                    $ids = $this->getProductIdsByType('Best Seller', $page);
                    $autofetchSections['best_seller_products'] = page_details_from_ids($ids);
                }
                
                if($param === 'latest_insights') {
                    $categoryId = 1;
                    $postsQuery = Post::query()
                        ->where('is_active', true)
                        ->whereHas('categories', function ($q) use ($categoryId) {
                            $q->where('categories.id', $categoryId);
                        })
                        ->with('meta')
                        ->orderByDesc('published_at')
                        ->limit(8);

                    if (auth()->user()?->company_id) {
                        $postsQuery->where('company_id', auth()->user()->company_id);
                    }

                    $latestPosts = $postsQuery->get();

                    $autofetchSections['latest_insights'] = $latestPosts->map(function (Post $post) {
                        $summary = $post->meta->firstWhere('meta_key', 'short_summary')?->meta_value;
                        if (!filled($summary)) {
                            $summary = $post->meta->firstWhere('meta_key', 'summary')?->meta_value;
                        }

                        $date = $post->meta->firstWhere('meta_key', 'date')?->meta_value;
                        $time = $post->meta->firstWhere('meta_key', 'time')?->meta_value;

                        return [
                            'id' => $post->id,
                            'title' => $post->title,
                            'slug' => $post->slug,
                            'featured_image' => filled($post->featured_image)
                                ? uploaded_asset_details_from_ids($post->featured_image)
                                : null,
                            'summary' => $summary,
                            'date' => filled($date) ? $date : null,
                            'time' => filled($time) ? $time : null,
                        ];
                    })->values()->all();
                }  
                
                // if($param === 'latest_news') {
                //     $categoryId = 18;
                //     $postsQuery = Post::query()
                //         ->where('is_active', true)
                //         ->whereHas('categories', function ($q) use ($categoryId) {
                //             $q->where('categories.id', $categoryId);
                //         })
                //         ->with('meta')
                //         ->orderByDesc('published_at')
                //         ->limit(8);

                //     if (auth()->user()?->company_id) {
                //         $postsQuery->where('company_id', auth()->user()->company_id);
                //     }

                //     $latestPosts = $postsQuery->get();

                //     $autofetchSections['latest_news'] = $latestPosts->map(function (Post $post) {
                //         $summary = $post->meta->firstWhere('meta_key', 'short_summary')?->meta_value;
                //         if (!filled($summary)) {
                //             $summary = $post->meta->firstWhere('meta_key', 'summary')?->meta_value;
                //         }

                //         $date = $post->meta->firstWhere('meta_key', 'date')?->meta_value;
                //         $time = $post->meta->firstWhere('meta_key', 'time')?->meta_value;

                //         return [
                //             'id' => $post->id,
                //             'title' => $post->title,
                //             'slug' => $post->slug,
                //             'featured_image' => filled($post->featured_image)
                //                 ? uploaded_asset_details_from_ids($post->featured_image)
                //                 : null,
                //             'summary' => $summary,
                //             'date' => filled($date) ? $date : null,
                //             'time' => filled($time) ? $time : null,
                //         ];
                //     })->values()->all();
                // }                 
            endforeach;

        }

        return [
            'id' => $page->id,
            'slug' => $page->slug,
            'language' => $page->language,
            'title' => $page->title,
            'content' => $page->content,
            'is_active' => (bool) $page->is_active,
            'layout' => $page->layout,
            'company_id' => $page->company_id,

            'meta' => $page->meta
                ->mapWithKeys(function ($m) {

                    $value = $m->meta_value;

                    if (in_array($m->meta_key, $this->dynamicJsonMetaKeys)) {
                        $value = $this->resolveDynamicJson($value);
                    } else {
                        $value = $this->resolveMetaValue($m->meta_key, $value);
                    }

                    return [$m->meta_key => $value];
                })
                ->all(),

            'seo' => [
                'title'       => filled($seoMeta?->meta_title) ? $seoMeta->meta_title : $page->seo_title,
                'description' => filled($seoMeta?->meta_description) ? $seoMeta->meta_description : $page->seo_description,
                'keywords'    => filled($seoMeta?->meta_keywords) ? $seoMeta->meta_keywords : $page->seo_keywords,
                'schema'              => $seoMeta?->schema_json,
                'canonical_url'       => $seoMeta?->canonical_url,
                'robots_index'        => $seoMeta?->robots_index,
                'robots_follow'       => $seoMeta?->robots_follow,
                'og_title'            => $seoMeta?->og_title,
                'og_description'      => $seoMeta?->og_description,
                'og_image'            => filled($seoMeta?->og_image) ? uploaded_asset_details_from_ids($seoMeta->og_image) : null,
                'twitter_title'       => $seoMeta?->twitter_title,
                'twitter_description' => $seoMeta?->twitter_description,
                'twitter_image'       => filled($seoMeta?->twitter_image) ? uploaded_asset_details_from_ids($seoMeta->twitter_image) : null,
                'sitemap_priority'    => $seoMeta?->sitemap_priority,
            ],
            'autofetch' => $autofetchSections,
        ];
    }

    /**
     * Resolve normal meta values
     */
    private function resolveMetaValue(string $key, $value)
    {
        if (in_array($key, $this->uploadMetaKeys)) {
            return filled($value)
                ? uploaded_asset_details_from_ids($value)
                : null;
        }

        if (in_array($key, $this->pageSectionMetaKeys)) {
            return page_details_from_ids($value);
        }

        if (in_array($key, $this->post_category_MetaKeys)) {
            return post_category_details_from_ids($value);
        }

        return $value;
    }

    /**
     * Resolve dynamic JSON meta
     */
    private function resolveDynamicJson($json)
    {
        $decoded = json_decode($json, true);

        if (!is_array($decoded)) {
            return $json;
        }

        foreach ($decoded as $key => $values) {

            if (!is_array($values)) continue;

            foreach ($values as $index => $val) {
                $decoded[$key][$index] = $this->resolveMetaValue($key, $val);
            }
        }

        return $decoded;
    }

    private function getProductIdsByType(string $type, Page $page): array
    {
        return Page::query()
            ->with('meta')
            ->where('layout', 'products')
            ->where('is_active', true)
            ->when($page->company_id, function ($query) use ($page) {
                $query->where('company_id', $page->company_id);
            })
            ->whereHas('meta', function ($query) use ($type) {
                $query->where('meta_key', 'type')
                    ->where('meta_value', $type);
            })
            ->pluck('id')
            ->toArray();
    }

    private function getRelatedProductIdsByOccasions(Page $page): array
    {
        $currentOccasions = $this->normalizedMetaList(
            $page->meta->firstWhere('meta_key', 'occasions')?->meta_value
        );

        if ($currentOccasions === []) {
            return [];
        }

        $currentOccasions = array_map('mb_strtolower', $currentOccasions);

        return Page::query()
            ->with('meta')
            ->where('layout', 'products')
            ->where('is_active', true)
            ->where('id', '!=', $page->id)
            ->when($page->company_id, function ($query) use ($page) {
                $query->where('company_id', $page->company_id);
            })
            ->get()
            ->filter(function (Page $product) use ($currentOccasions) {
                $productOccasions = $this->normalizedMetaList(
                    $product->meta->firstWhere('meta_key', 'occasions')?->meta_value
                );

                if ($productOccasions === []) {
                    return false;
                }

                $productOccasions = array_map('mb_strtolower', $productOccasions);

                return array_intersect($currentOccasions, $productOccasions) !== [];
            })
            ->pluck('id')
            ->values()
            ->all();
    }

    private function normalizedMetaList($rawValue): array
    {
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
    }
}
