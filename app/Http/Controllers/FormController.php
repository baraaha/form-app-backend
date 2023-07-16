<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormStoreRequest;
use App\Http\Resources\FormResource;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Services\FormService;
use Illuminate\Http\Client\Request as ClientRequest;

class FormController extends Controller
{
    protected $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }

    public function index()
    {
        $userId = auth('sanctum')->user()->id;
        $forms = $this->formService->getForms($userId);
        return FormResource::collection($forms);
    }

    public function store(FormStoreRequest $request)
    {
        $form = $this->formService->createForm($request->all());
        return new FormResource($form);
    }

    public function show($id)
    {
        $form = $this->formService->getForm($id);
        return new FormResource($form);
    }

    public function update(Request $request,  $id)
    {
        $form = $this->formService->updateForm($id, $request->all());
        return new FormResource($form);
    }

    public function destroy(Form $form)
    {
        $this->formService->deleteForm($form);
        return response()->noContent();
    }

    // submit form
    function submition(Request $request)
    {
        return $request;
        $this->formService->submition($request->all());
        return response()->json(['message' => 'submition success'], 201);
    }
}
