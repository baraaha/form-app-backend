<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FormController
 */
class FormControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $forms = Form::factory()->count(3)->create();

        $response = $this->get(route('form.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FormController::class,
            'store',
            \App\Http\Requests\FormStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user_id = $this->faker->numberBetween(-10000, 10000);
        $title = $this->faker->sentence(4);
        $slug = $this->faker->slug;
        $allow_notifications = $this->faker->boolean;
        $published = $this->faker->boolean;

        $response = $this->post(route('form.store'), [
            'user_id' => $user_id,
            'title' => $title,
            'slug' => $slug,
            'allow_notifications' => $allow_notifications,
            'published' => $published,
        ]);

        $forms = Form::query()
            ->where('user_id', $user_id)
            ->where('title', $title)
            ->where('slug', $slug)
            ->where('allow_notifications', $allow_notifications)
            ->where('published', $published)
            ->get();
        $this->assertCount(1, $forms);
        $form = $forms->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $form = Form::factory()->create();

        $response = $this->get(route('form.show', $form));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FormController::class,
            'update',
            \App\Http\Requests\FormUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $form = Form::factory()->create();
        $user_id = $this->faker->numberBetween(-10000, 10000);
        $title = $this->faker->sentence(4);
        $slug = $this->faker->slug;
        $allow_notifications = $this->faker->boolean;
        $published = $this->faker->boolean;

        $response = $this->put(route('form.update', $form), [
            'user_id' => $user_id,
            'title' => $title,
            'slug' => $slug,
            'allow_notifications' => $allow_notifications,
            'published' => $published,
        ]);

        $form->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user_id, $form->user_id);
        $this->assertEquals($title, $form->title);
        $this->assertEquals($slug, $form->slug);
        $this->assertEquals($allow_notifications, $form->allow_notifications);
        $this->assertEquals($published, $form->published);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $form = Form::factory()->create();

        $response = $this->delete(route('form.destroy', $form));

        $response->assertNoContent();

        $this->assertDeleted($form);
    }
}
