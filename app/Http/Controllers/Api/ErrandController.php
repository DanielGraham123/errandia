<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrandResource;
use App\Services\ErrandService;
use Illuminate\Http\Request;

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
                    $result['hits'], $request->get('page')?? 1
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
            return $this->build_response(response(), 'failed load errand.', 400);
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
            return $this->build_response(response(), 'failed load errand.', 400);
        }
    }
    
    public function store(Request $request)
    {
        try {
            $rules = [
                'title' => 'required',
                'description' => 'required'
            ];

            $data = $request->all();
            $this->validate($data, $rules);
            if(!empty($this->validations_errors)) {
                return $this->build_response(response(), 'check required fields', 400);
            }

            $user_id = auth('api')->user()->id;
            $this->errandService->save_errand($request, $user_id);
            return $this->build_success_response(response(), 'Errand saved');
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed to save errand details.', 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $rules = [
                'title' => 'required',
                'description' => 'required'
            ];

            $this->validate($data, $rules);
            if(!empty($this->validations_errors)) {
                return $this->build_response(response(), 'check required fields', 400);
            }

            $user_id = auth('api')->user()->id;
            $errand = $this->errandService->update_errand($id, $user_id, $request);
            return $this->build_success_response(
                response(),
                'errand updated',
                [
                    'item' => new ErrandResource($errand)
                ]
            );
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), $e->getMessage(), 400);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $user_id = auth('api')->user()->id;
            $this->errandService->delete_errand($id, $user_id);
            return $this->build_success_response(response(), 'Errand deleted successfully');
        } catch(\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), $e->getMessage(), 400);
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

    public function delete_image(Request $request, $id, $image_id)
    {
        try {
            auth('api')->user();;
            $this->errandService->delete_image($image_id, $id);
            return $this->build_success_response(response(), 'errand image deleted');
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), $e->getMessage(), 400);
        }
    }

    public function add_image(Request $request, $id)
    {
        try {
            $user_id = auth('api')->user()->id;;
            $image = $this->errandService->add_image($id, $user_id, $request);
            return $this->build_success_response(response(), 'image added',
                [
                    'item' => [
                        'id' => $image->id,
                        'image' => $image->image
                    ]
                ]
            );
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), $e->getMessage(), 400);
        }
    }
}
