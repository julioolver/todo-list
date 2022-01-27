<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class MeController extends Controller
{
    private array $fields = [
        'id',
        'first_name',
        'last_name',
        'email',
        'created_at'
    ];

    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return new UserResource(auth()->user());
    }

    public function update(Request $request)
    {
        $id = (int) $request->route("id");
        $subFields = $this->filterFields($request);

        try {
            $subject = $this->service->update($id, $subFields);
            return response()->json(['data' => $subject], 202);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function filterFields(Request $request)
    {
        return $request->only($this->fields);
    }
}
