<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrandResource;
use App\Models\Errand;
use App\Services\ErrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ErrandController extends Controller
{

    private ErrandService $errandService;

    public function __construct(ErrandService $errandService)
    {
        $this->errandService = $errandService;
    }

    public function index()
    {
        return $this->load_errands(null);
    }
    public function user_errands()
    {
        $user_id = auth('api')->user()->id;
        return $this->load_errands($user_id);
    }
    public function run_errand(Request $request, $id)
    {
        $user_id = auth('api')->user()->id;
        try {
            $result = $this->errandService->run_errand($id, $user_id);
            return $this->build_success_response(response(),
                'items found',
                self::convert_documents_paginated_result(
                    $result['hits'], $request->get('page')
                )
            );
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed to load errand', 400);
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $errand = $this->errandService->load_errand($id);
            return $this->build_success_response(
                    response(),
                'errand loaded',
                    [
                        'item' => new ErrandResource($errand)
                    ]
            );
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed load errand.');
        }
    }

    public function load_errand(Request $request, $id)
    {
        logger()->info('HELLO');
        try {
            $errand = $this->errandService->load_errand($id, auth('api')->user()->id);
            return $this->build_success_response(
                response(),
                'errand loaded',
                [
                    'item' => new ErrandResource($errand)
                ]
            );
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed load errand.');
        }
    }
    
    public function store(Request $request)
    {
        try {
            $user_id = auth('api')->user()->id;
            $this->errandService->save_errand($request, $user_id);
            return $this->build_success_response(response(), 'Errand saved');
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed to save errand details.');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::transaction(function() use ($request, $id) {
                $errand = Errand::find($id);
                if (!$errand) {
                    throw new Exception("Errand not found");
                };
                foreach($errand->images as $image) {
                    Storage::delete($image->image);
                    $image->delete();
                }
                $errand->delete();
            });
            return $this->build_success_response(response(), 'Errand deleted successfully');
        } catch(\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed to delete errand');
        }
    }
    public function load_errands($user_id)
    {
        $errands = $this->errandService->load_errands($user_id);
        return $this->build_success_response(
            response(),
            'errands loaded',
            self::convert_paginated_result(
                $errands,
                ErrandResource::collection($errands)
            )
        );
    }
}
