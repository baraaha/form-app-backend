<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submission;
use App\Services\FormService;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    protected $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }


    function index(Form $form)
    {
        return $form->load('submissions', 'submissions.user');
    }

    // show
    public function show(Submission $submission)
    {

        return $submission->load('user', 'form');
    }

    function store(Request $request)
    {

        return $this->formService->submition($request->all());
    }
}
