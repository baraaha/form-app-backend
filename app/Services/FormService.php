<?php

namespace App\Services;

use App\Models\Form;
use App\Models\Submission;

class FormService
{
    public function getForms($userId)
    {

        return Form::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('submission_limit', '>', 0)
                    ->orWhereNull('submission_limit');
            })
            ->whereDate('expires_at', '>', now())
            ->get();
    }

    public function createForm($formData)
    {
        $formData['user_id'] = 1;
        $formData['elements'] = json_encode($formData['elements']);
        $formData['published_at'] ?? now();
        // allow notifications
        $formData['allow_notifications'] = $formData['allow_notifications']  == true  ? 1 : 0;
        return Form::create($formData);
    }

    public function getForm($id)
    {
        return Form::findOrFail($id);
    }

    public function updateForm($id, $formData)
    {
        $form = $this->getForm($id);
        $form->update($formData);
        return $form;
    }

    public function deleteForm(Form $form)
    {
        return $form->delete();
    }

    function submition($data)
    {

        $userId = auth('sanctum')->user()->id;
        // check if user already submitted the form
        $submission = Submission::where('form_id', $data['form_id'])
            ->where('user_id', $userId)
            ->first();

        if (!$submission) {
            return response()->json(['message' => 'You already submitted this form'], 400);
        }
        // check if form submission limit is set and if it is greater than 0
        $form = Form::find($data['form_id']);
        if ($form->submission_limit && $form->submission_limit <= 0) {
            return response()->json(['message' => 'Form submission limit reached'], 400);
        }

        // create submission
        $submission = new Submission();
        $submission->form_id = $data['form_id'];
        $submission->user_id = $userId;
        $submission->data = json_encode($data['data']);
        $submission->save();

        // if form submitn limit is set then decrease it by 1

        if ($form->submission_limit) {
            $form->submission_limit = $form->submission_limit - 1;
            $form->save();
        }

        // write message for user



        return response()->json(['message' => 'submition success', 'data' => $submission], 201);
    }
}
