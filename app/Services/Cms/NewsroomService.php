<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Http\Requests\Cms\NewsroomRequest;
use App\Models\Cms\Newsroom;
use Yajra\DataTables\Facades\DataTables;

class NewsroomService
{
    protected $imageHelper;
    public function __construct() {
        $this->imageHelper = new ImageHelpers('back_assets/img/cms/newsrooms/');
    }

    public function store(NewsroomRequest $request) {
        $request->validated();

        try {
            Newsroom::create(array_merge($request->all(), [
                'image' => $this->imageHelper->uploadImage($request, 'image'),
                'slug' => $request->title
            ]));
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(NewsroomRequest $request, Newsroom $newsRoom)
    {
        $request->validated();

        try {
            $newsRoom->update(array_merge($request->all(), [
                'image' => $request->hasFile('image') ?
                    $this->imageHelper->updateImage($request, 'image', $newsRoom->image) :
                    $newsRoom->image,
                'slug' => $request->title
            ]));
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(Newsroom $newsRoom) {
        try {
            $this->imageHelper->deleteImage($newsRoom->image);
            $newsRoom->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $newsRoom)
    {
        $array = $newsRoom->get(['id', 'title', 'image']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['title'] = $item->title;
            $nestedData['image'] = '<img src="' . asset($item->image) . '" width="100" height="100">';
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.cms.newsrooms.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.cms.newsrooms.destroy', $item) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "image"])->toJson();
    }
}
