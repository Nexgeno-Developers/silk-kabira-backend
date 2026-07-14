<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UploadController extends Controller
{
    protected $moduleName;

    public function __construct()
    {
        //Module Name
        $this->moduleName = 'Uploads';
        view()->share('moduleName', $this->moduleName);

        $this->middleware('permission:uploads view')->only([
            'index',
            'get_uploaded_files',
            'get_preview_files',
            'attachment_download',
            'file_info',
        ]);
        $this->middleware('permission:uploads create')->only([
            'create',
            'show_uploader',
            'upload',
        ]);
        $this->middleware('permission:uploads delete')->only([
            'destroy',
            'bulk_uploaded_files_delete',
            'all_file',
        ]);
    }

    public function index(Request $request)
    {
        //dd(auth()->user()->role_id);
        $all_uploads = Upload::query();
        $search = null;
        $sort_by = null;
        $extension =  $request->extension ?? null;

        if ($request->search != null) {
            $search = $request->search;
            $all_uploads->where('file_original_name', 'like', '%' . $request->search . '%');
        }

        $sort_by = $request->sort;
        switch ($request->sort) {
            case 'newest':
                $all_uploads->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $all_uploads->orderBy('created_at', 'asc');
                break;
            case 'smallest':
                $all_uploads->orderBy('file_size', 'asc');
                break;
            case 'largest':
                $all_uploads->orderBy('file_size', 'desc');
                break;
            default:
                $all_uploads->orderBy('created_at', 'desc');
                break;
        }
        
        if ($extension != null) {
            $all_uploads->where('extension', $extension);
        }

        if (auth()->user()->role_id != 1) {
            //$all_uploads->where('user_id', auth()->user()->id);
            $all_uploads->whereIn('user_id', [auth()->id(), 1]);
        }   
        
        $all_uploads = $all_uploads->paginate(config('custom.pagination_per_media_page'))->appends(request()->query());
        $extensions = Upload::select('extension')->distinct()->pluck('extension');

        return view('backend.uploads.index', compact('all_uploads', 'search', 'sort_by', 'extensions', 'extension'));
    }

    public function create()
    {
        return view('backend.uploads.create');
    }

    public function show_uploader(Request $request)
    {
        return view('backend.uploads.aiz-uploader-modal');
    }
    public function upload(Request $request)
    {
        $allowedMimeMap = [
            'image/jpeg' => ['extension' => 'jpg', 'type' => 'image'],
            'image/png' => ['extension' => 'png', 'type' => 'image'],
            'image/webp' => ['extension' => 'webp', 'type' => 'image'],
            'image/gif' => ['extension' => 'gif', 'type' => 'image'],
            'video/mp4' => ['extension' => 'mp4', 'type' => 'video'],
            'video/quicktime' => ['extension' => 'mov', 'type' => 'video'],
            'video/x-msvideo' => ['extension' => 'avi', 'type' => 'video'],
            'video/webm' => ['extension' => 'webm', 'type' => 'video'],
            'video/x-matroska' => ['extension' => 'mkv', 'type' => 'video'],
            'audio/mpeg' => ['extension' => 'mp3', 'type' => 'audio'],
            'audio/wav' => ['extension' => 'wav', 'type' => 'audio'],
            'audio/x-wav' => ['extension' => 'wav', 'type' => 'audio'],
            'audio/aac' => ['extension' => 'aac', 'type' => 'audio'],
            'application/pdf' => ['extension' => 'pdf', 'type' => 'document'],
            'text/plain' => ['extension' => 'txt', 'type' => 'document'],
            'text/csv' => ['extension' => 'csv', 'type' => 'document'],
            'application/msword' => ['extension' => 'doc', 'type' => 'document'],
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => ['extension' => 'docx', 'type' => 'document'],
            'application/vnd.ms-excel' => ['extension' => 'xls', 'type' => 'document'],
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => ['extension' => 'xlsx', 'type' => 'document'],
            'application/zip' => ['extension' => 'zip', 'type' => 'archive'],
            'application/x-zip-compressed' => ['extension' => 'zip', 'type' => 'archive'],
            'application/x-rar-compressed' => ['extension' => 'rar', 'type' => 'archive'],
            'application/x-7z-compressed' => ['extension' => '7z', 'type' => 'archive'],
        ];

        $validator = Validator::make($request->all(), [
            'aiz_file' => 'required|file|max:10240|mimes:jpg,jpeg,png,webp,gif,pdf,doc,docx,xls,xlsx,csv,txt,mp4,mov,avi,webm,mkv,mp3,wav,aac,zip,rar,7z',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first('aiz_file') ?: 'Invalid file upload.';

            return response()->json([
                'status' => false,
                'message' => $message,
                'notification' => [
                    'aiz_file' => [$message],
                ],
                'errors' => [
                    'aiz_file' => [$message],
                ],
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $file = $request->file('aiz_file');
        $detectedMime = strtolower((string) $file->getMimeType());
        $mimeConfig = $allowedMimeMap[$detectedMime] ?? null;

        if ($mimeConfig === null) {
            return response()->json([
                'status' => false,
                'message' => 'Unsupported file type.',
                'notification' => [
                    'aiz_file' => ['Unsupported file type.'],
                ],
                'errors' => [
                    'aiz_file' => ['Unsupported file type.'],
                ],
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $upload = new Upload;
        $upload->file_original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $size = $file->getSize();
        $schoolId = 'media';
        $path = $file->storeAs(
            'uploads/' . $schoolId . '/' . date("Y") . '/' . date("m"),
            uniqid('', true) . '.' . $mimeConfig['extension'],
            'public'
        );

        $upload->extension = $mimeConfig['extension'];
        $upload->file_name = 'storage/' . $path;
        $upload->user_id = Auth::user()->id;
        $upload->type = $mimeConfig['type'];
        $upload->file_size = $size;
        $upload->save();

        return '{}';
    }

    public function get_uploaded_files(Request $request)
    {
        //$uploads = Upload::where('user_id', Auth::user()->id);
        $uploads = Upload::query();
        if ($request->search != null) {
            $uploads->where('file_original_name', 'like', '%' . $request->search . '%');
        }
        if ($request->sort != null) {
            switch ($request->sort) {
                case 'newest':
                    $uploads->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $uploads->orderBy('created_at', 'asc');
                    break;
                case 'smallest':
                    $uploads->orderBy('file_size', 'asc');
                    break;
                case 'largest':
                    $uploads->orderBy('file_size', 'desc');
                    break;
                default:
                    $uploads->orderBy('created_at', 'desc');
                    break;
            }
        }

        if (auth()->user()->role_id != 1) {
            //$uploads->where('user_id', auth()->user()->id);
            $uploads->whereIn('user_id', [auth()->id(), 1]);
        }
        
        if($request->type != "all"){
            $uploads->where('type', $request->type); //new
        }
         

        return $uploads->paginate(config('custom.pagination_per_media_page'))->appends(request()->query());
    }

    public function destroy($id)
    {
        $upload = $this->findAuthorizedUpload($id);

        try {
            $this->deleteUploadRecord($upload);
            return redirect()->back()->with('success', __('File deleted successfully'));
        } catch (\Exception $e) {
            $upload->delete();
            return redirect()->back()->with('success', __('File deleted successfully'));
        }
    }

    public function bulk_uploaded_files_delete(Request $request)
    {
        $ids = $request->input('id', []);
        if (is_array($ids) && count($ids) > 0) {
            foreach ($ids as $file_id) {
                $upload = $this->findAuthorizedUpload((int) $file_id);
                $this->deleteUploadRecord($upload);
            }

            return 1;
        }

        return 0;
    }

    // public function get_preview_files(Request $request)
    // {
    //     $ids = explode(',', $request->ids);
    //     $files = Upload::whereIn('id', $ids)->get();
    //     $new_file_array = [];
    //     foreach ($files as $file) {
    //         $file['file_name'] = my_asset($file->file_name);
    //         if ($file->external_link) {
    //             $file['file_name'] = $file->external_link;
    //         }
    //         $new_file_array[] = $file;
    //     }

    //     return $new_file_array;
    // }

    public function get_preview_files(Request $request)
    {
        $ids = collect(explode(',', (string) $request->ids))
            ->map(fn ($id) => (int) $id)
            ->filter(fn ($id) => $id > 0)
            ->values()
            ->all();

        if ($ids === []) {
            return [];
        }

        $uploadsQuery = Upload::query()->whereIn('id', $ids);
        $this->applyUploadAccessScope($uploadsQuery);
        $files = $uploadsQuery->get()->keyBy('id');
    
        $new_file_array = [];
        foreach ($ids as $id) {
            $file = $files->get($id);
            if (!$file) {
                abort(HttpResponse::HTTP_FORBIDDEN, 'You are not allowed to access one or more selected files.');
            }

            $file['file_name'] = my_asset($file->file_name);
            if ($file->external_link) {
                $file['file_name'] = $file->external_link;
            }
            $new_file_array[] = $file;
        }
    
        return $new_file_array;
    }
    

    public function all_file(Request $request)
    {
        abort_unless($request->isMethod('post'), HttpResponse::HTTP_METHOD_NOT_ALLOWED);
        abort_unless($this->isSuperAdmin(), HttpResponse::HTTP_FORBIDDEN);

        $uploads = Upload::query()->get();
        foreach ($uploads as $upload) {
            $this->deleteUploadRecord($upload);
        }

        flash(__('Files deleted successfully'))->success();
        return back();
    }

    //Download project attachment
    public function attachment_download($id)
    {
        $project_attachment = $this->findAuthorizedUpload($id);
        try {
            $file_path = public_path($project_attachment->file_name);
            return Response::download($file_path);
        } catch (\Exception $e) {
            flash(__('File does not exist!'))->error();
            return back();
        }
    }
    //Download project attachment
    public function file_info(Request $request)
    {
        $file = $this->findAuthorizedUpload((int) $request['id']);
        return view('backend.uploads.info', compact('file'));
    }

    public function generate_all_thumbnails()
    {
        // Standard thumbnail sizes
        $sizes = [
            [150, 150],
            [300, 300],
        ];
    
        // Get all image uploads
        $images = Upload::where('type', 'image')->get();
    
        foreach ($images as $image) {
            foreach ($sizes as [$width, $height]) {
                makeImageThumbnail($image->file_name, $width, $height);
            }
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Thumbnails regenerated for all existing images.'
        ]);
    }

    private function isSuperAdmin(): bool
    {
        return (int) auth()->user()?->role_id === 1;
    }

    private function applyUploadAccessScope($query): void
    {
        if (! $this->isSuperAdmin()) {
            $query->whereIn('user_id', [auth()->id(), 1]);
        }
    }

    private function findAuthorizedUpload(int $id): Upload
    {
        $query = Upload::query()->where('id', $id);
        $this->applyUploadAccessScope($query);

        $upload = $query->first();
        if (! $upload) {
            abort(HttpResponse::HTTP_FORBIDDEN, 'You are not allowed to access this file.');
        }

        return $upload;
    }

    private function deleteUploadRecord(Upload $upload): void
    {
        $publicFilePath = public_path($upload->file_name);
        if (is_file($publicFilePath)) {
            @unlink($publicFilePath);
        }

        $upload->delete();
    }
}
