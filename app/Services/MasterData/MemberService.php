<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Http\Requests\MasterData\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MemberService
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'company_name' => 'nullable',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'password' => 'required',
        ]);

        try {
            Member::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $request->validated();

        try {
            $member->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(Member $member)
    {
        try {
            $member->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $member)
    {
        $array = $member->get(['id', 'name', 'phone', 'email', 'category']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['phone'] = $item->phone;
            $nestedData['email'] = $item->email;
            $nestedData['category'] = $item->category;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.members.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.members.destroy', $item) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
