<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Http\Requests\MasterData\UpdateTalentPhotoRequest;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentPhoto;
use Yajra\DataTables\Facades\DataTables;

class TalentPhotoService
{
    protected $fileHelper;
    public function __construct() {
        $this->fileHelper = new ImageHelpers('back_assets/img/master-data/talent/photos/');
    }

    public function store(UpdateTalentPhotoRequest $request, Talent $talent) {
        $request->validated();

        try {
            $talent->talentPhotos()->create(array_merge($request->all(), [
                'image' => $this->fileHelper->uploadImage($request, 'image'),
            ]));
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateTalentPhotoRequest $request, TalentPhoto $talentPhoto)
    {
        $request->validated();

        try {
            $talentPhoto->update(array_merge($request->all(), [
                'image' => $request->hasFile('image') ?
                $this->fileHelper->updateImage($request, 'image', $talentPhoto->image) :
                $talentPhoto->image,
            ]));
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(TalentPhoto $talentPhoto) {
        try {
            $this->fileHelper->deleteImage($talentPhoto->image);
            $talentPhoto->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(Talent $talent, object $talentPhoto)
    {
        $array = $talentPhoto->get(['id', 'image']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['image'] = '<img src="' . asset($item->image) . '" width="100" height="100">';
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.talents.talent_photo.edit', [$talent, $item]) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.talents.talent_photo.destroy', [$talent, $item]) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "image"])->toJson();
    }
}
