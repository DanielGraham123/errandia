<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementResource;
use App\Services\AnnouncementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnoucementController extends Controller
{

    public function index(Request $request)
    {
        $announcements = AnnouncementService::find_all(Auth::user());
        return $this->build_success_response(
            response(),
            'announcements loaded',
            self::convert_paginated_result(
                $announcements,
                AnnouncementResource::collection($announcements)
            )
        );
    }

    public function show(Request $request, $id)
    {
        $user = Auth::user();
        try {
            $announcement = AnnouncementService::load($id);
            AnnouncementService::make_as_read($user->id, $id);
            return $this->build_success_response(
                response(),
                'announcement loaded',
                [
                    'item' => new AnnouncementResource($announcement)
                ]
            );
        } catch (\Exception $e) {
            return $this->build_response(response(), $e->getMessage(), 400);
        }
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();
        try {
            AnnouncementService::make_as_deleted($user->id, $id);
            return $this->build_success_response(
                response(),
                'announcement deleted'
            );
        } catch (\Exception $e) {
            return $this->build_response(response(), $e->getMessage(), 400);
        }
    }
}