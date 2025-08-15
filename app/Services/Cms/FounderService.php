<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Http\Requests\Cms\UpdateFounderRequest;
use App\Models\Cms\Founder;
use Yajra\DataTables\Facades\DataTables;

class FounderService {
    protected $imageHelper;
    public function __construct() {
        $this->imageHelper = new ImageHelpers('back_assets/img/cms/founders/');
    }

    public function store(UpdateFounderRequest $request) {
        $request->validated();

        try {
            Founder::create(array_merge($request->all(), [
                'image' => $this->imageHelper->uploadImage($request, 'image'),
            ]));
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateFounderRequest $request, Founder $founder)
    {
        $request->validated();

        try {
            $founder->update(array_merge($request->all(), [
                'image' => $request->hasFile('image') ?
                    $this->imageHelper->updateImage($request, 'image', $founder->image) :
                    $founder->image,
            ]));
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(Founder $founder) {
        try {
            $this->imageHelper->deleteImage($founder->image);
            $founder->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $founder)
    {
        $array = $founder->get(['id', 'name', 'position', 'image']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['position'] = $item->position;
            $nestedData['image'] = '<img src="' . asset($item->image) . '" width="100" height="100">';
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.cms.founders.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.cms.founders.destroy', $item) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "image"])->toJson();
    }
}
