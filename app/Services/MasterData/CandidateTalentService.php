<?php

namespace App\Services\MasterData;

use App\Models\MasterData\Talent;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CandidateTalentService
{
    public function update(Request $request, Talent $talent)
    {
        $this->storeTalent($request, $talent);

        $this->storeTalentArt($request, $talent);

        $this->storeTalentContent($request, $talent);

        $this->storeTalentProfessional($request, $talent);

        $this->storeTalentEducation($request, $talent);

        $this->updateTalentWorkExperience($request, $talent);
        $this->storeTalentWorkExperience($request, $talent);

        $this->updateTalentExperience($request, $talent);
        $this->storeTalentExperience($request, $talent);

        $this->updateTalentPortofolio($request, $talent);
        $this->storeTalentPortofolio($request, $talent);

        $this->storeTalentRate($request, $talent);
    }

    private function storeTalent(Request $request, Talent $talent)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'birth_date' => 'required|date',
                'birth_place' => 'required',
                'gender' => 'required',
                'appereance' => 'required',
                'address' => 'required',
                'email' => 'required | email',
                'phone' => 'required',
                'status' => 'required',
                'instagram' => 'nullable',
                'tiktok' => 'nullable',
                'facebook' => 'nullable',
                'marriage_status' => 'nullable',
            ]);

            $talent = $talent->update($validated);

            return $talent;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function storeTalentArt(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'talent_art' => 'required | array'
        ]);

        $talent->talentArts()->sync($validate['talent_art']);
    }

    private function storeTalentContent(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'talent_content' => 'required | array'
        ]);

        $requestedArray = $validate['talent_content'];
        $talentsArray = $talent->talentContents()->get()->pluck('name')->toArray();
        $deletedValues = array_diff($requestedArray, $talentsArray);

        foreach($deletedValues as $item) {
            $talent->talentContents()->delete([
                'name' => $item
            ]);
        }

        foreach($requestedArray as $item) {
            $talent->talentContents()->firstOrCreate([
                'name' => $item
            ]);
        }
    }

    private function storeTalentProfessional(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'talent_professional' => 'required | array'
        ]);

        $talent->talentProfessionals()->sync($validate['talent_professional']);
    }

    private function storeTalentEducation(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'education_level' => 'required',
            'education_institution' => 'required',
            'education_major' => 'required',
            'education_year' => 'required'
        ]);

        $talent->talentEducation()->update([
            'education_level' => $validate['education_level'],
            'institution_name' => $validate['education_institution'],
            'major' => $validate['education_major'],
            'graduation_year' => $validate['education_year']
        ]);
    }

    private function updateTalentWorkExperience(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'edit_work_id' => 'nullable | array',
            'edit_work_company' => 'nullable | array',
            'edit_work_position' => 'nullable | array',
            'edit_work_period' => 'nullable | array',
            'edit_work_description' => 'nullable | array',
            'edit_work_quit' => 'nullable | array',
        ]);

        $arrayWorks = $validate['edit_work_id'] ?? false;

        if($arrayWorks) {
            $countingArray = count($validate['edit_work_id']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentWorkExperiences()->where('id', $validate['edit_work_id'][$i])->update([
                    'company' => $validate['edit_work_company'][$i],
                    'position' => $validate['edit_work_position'][$i],
                    'employment_period' => $validate['edit_work_period'][$i],
                    'description' => $validate['edit_work_description'][$i],
                    'quit_reason' => $validate['edit_work_quit'][$i],
                ]);
            }
        }
    }

    private function storeTalentWorkExperience(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'work_company' => 'nullable | array',
            'work_position' => 'nullable | array',
            'work_period' => 'nullable | array',
            'work_description' => 'nullable | array',
            'work_quit' => 'nullable | array',
        ]);

        $arrayWorks = $validate['work_company'] ?? false;

        if($arrayWorks) {
            $countingArray = count($validate['work_company']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentWorkExperiences()->create([
                    'company' => $validate['work_company'][$i],
                    'position' => $validate['work_position'][$i],
                    'employment_period' => $validate['work_period'][$i],
                    'description' => $validate['work_description'][$i],
                    'quit_reason' => $validate['work_quit'][$i],
                ]);
            }
        }
    }

    private function updateTalentExperience(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'edit_experience_id' => 'nullable | array',
            'edit_experience_skill' => 'nullable | array',
            'edit_experience_period' => 'nullable | array',
            'edit_experience_link' => 'nullable | array',
        ]);

        $arrayExperiences = $validate['edit_experience_id'] ?? false;

        if($arrayExperiences) {
            $countingArray = count($validate['edit_experience_id']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentExperiences()->where('id', $validate['edit_experience_id'][$i])->update([
                    'skill' => $validate['edit_experience_skill'][$i],
                    'period' => $validate['edit_experience_period'][$i],
                    'link' => $validate['edit_experience_link'][$i],
                ]);
            }
        }
    }

    private function storeTalentExperience(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'experience_skill' => 'nullable | array',
            'experience_period' => 'nullable | array',
            'experience_link' => 'nullable | array',
        ]);

        $arrayExperiences = $validate['experience_skill'] ?? false;

        if($arrayExperiences) {
            $countingArray = count($validate['experience_skill']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentExperiences()->create([
                    'skill' => $validate['experience_skill'][$i],
                    'period' => $validate['experience_period'][$i],
                    'link' => $validate['experience_link'][$i],
                ]);
            }
        }
    }

    private function updateTalentPortofolio(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'edit_portofolio_id' => 'nullable | array',
            'edit_portofolio_skill' => 'nullable | array',
            'edit_portofolio_link' => 'nullable | array'
        ]);

        $arrayPortofolios = $validate['edit_portofolio_id'] ?? false;

        if($arrayPortofolios) {
            $countingArray = count($validate['edit_portofolio_id']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentPortfolios()->where('id', $validate['edit_portofolio_id'][$i])->update([
                    'skill' => $validate['edit_portofolio_skill'][$i],
                    'link' => $validate['edit_portofolio_link'][$i],
                ]);
            }
        }
    }

    private function storeTalentPortofolio(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'portofolio_skill' => 'nullable | array',
            'portofolio_link' => 'nullable | array'
        ]);

        $arrayPortofolios = $validate['portofolio_skill'] ?? false;

        if($arrayPortofolios) {
            $countingArray = count($validate['portofolio_skill']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentPortfolios()->create([
                    'skill' => $validate['portofolio_skill'][$i],
                    'link' => $validate['portofolio_link'][$i],
                ]);
            }
        }
    }

    private function storeTalentRate(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'rate_period' => 'nullable',
            'rate_rate' => 'nullable',
            'rate_call_day' => 'required',
            'rate_call_time' => 'required',
        ]);

        $talent->talentRate()->update([
            'period' => $validate['rate_period'],
            'rate' => $validate['rate_rate'],
            'call_day' => $validate['rate_call_day'],
            'call_time' => $validate['rate_call_time'],
        ]);
    }

    public function data(object $talent)
    {
        $array = $talent->select('id', 'name', 'phone', 'status')
                        ->where('status', Talent::STATUS_PENDING)
                        ->orWhere('status', Talent::STATUS_REVIEW)
                        ->get();

        $data = [];
        $no = 0;

        function renderStatusBadge($status) {
            switch ($status) {
                case Talent::STATUS_REVIEW:
                    return '<span class="badge badge-warning">Review</span>';
                    break;
                case Talent::STATUS_APPROVED:
                    return '<span class="badge badge-success">Accepted</span>';
                    break;
                case Talent::STATUS_REJECTED:
                    return '<span class="badge badge-danger">Rejected</span>';
                    break;
                default:
                    return '<span class="badge badge-info">Pending</span>';
                    break;
            }
        }

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['phone'] = $item->phone;
            $nestedData['status'] = renderStatusBadge($item->status);
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.candidate-talents.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "status"])->toJson();
    }
}
