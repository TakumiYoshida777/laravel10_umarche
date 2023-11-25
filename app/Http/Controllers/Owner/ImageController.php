<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;




class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('image'); //imageのid取得
            if (!is_null($id)) { // null判定
                $imagesOwnerId = Image::findOrFail($id)->owner->id;
                $imageId = (int)$imagesOwnerId; // キャスト 文字列→数値に型変換
                if ($imageId !==  Auth::id()) { // 同じでなかったら
                    abort(404); // 404画面表示
                }
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::where('owner_id', Auth::id())
        ->orderby('updated_at', 'desc')
        ->paginate(20);

        return view('owner.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UploadImageRequest $request)
    {
        $imageFiles = $request->file('files');
        if (!is_null($imageFiles)) {
            foreach ($imageFiles as $imageFile) {
                $imageService = new ImageService($imageFile, 'products');
                $fileNameToStore = $imageService->upload();
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore
                ]);
            }
        }
        return redirect()
        ->route('owner.images.index')
        ->with([
            'message' => '画像登録を実施しました。',
            'status' => 'info'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = Image::findOrFail($id);
        // dd(Image::findOrFail($id));
        return view('owner.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['string', 'max:50'],
        ]);
        
        $image = Image::findOrFail($id);
        $image->title = $request->title;
        $image->save();

        return redirect()
            ->route('owner.images.index')
            ->with([
                'message' => '画像情報を更新しました。',
                'status' => 'info'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $image = Image::findOrFail($id);//モデルインスタンスの作成--選択された画像情報を取得
        $filePath = 'public/products/' . $image->filename; //pathの作成

        if (Storage::exists($filePath)) {//ストレージに指定されたファイルpathが存在したら
            Storage::delete($filePath);//ストレージから画像を削除
        }

        Image::findOrFail($id)->delete();//データベースから画像を削除
           
        return redirect()->route('owner.images.index')
            ->with(['success' => '画像を削除しました。', 'status' => 'alert']);
    }
}
