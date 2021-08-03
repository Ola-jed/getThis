<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class ArticlesTest
 * Class to test articles routes
 * Do not run multiple times or change the data before
 * @package Tests\Feature
 */
class ArticlesTest extends TestCase
{
    use WithFaker;

    protected User $user;
    protected Article $article;

    /**
     * Set up our test class
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->user = User::factory()->create();
        $this->article = new Article();
        $this->article->title = 'article';
        $this->article->slug = 'article';
        $this->article->content = 'this is a new article to test my laravel app';
        $this->article->subject = 'test';
        $this->be($this->user);
    }

    /**
     * Testing our /articles url
     */
    public function testGetAllArticles(): void
    {
        $response = $this->withSession(['user' => $this->user])
            ->get('/articles');
        $response->assertOk();
    }

    /**
     * Testing an article creation
     */
    public function testArticleCreationAndRead(): void
    {
        $response = $this->withSession(['user' => $this->user])
            ->post('/articles', $this->article->toArray());
        $response->assertRedirect('/article/' . $this->article->slug);
    }

    /**
     * Testing that the update form will be shown and handled correctly
     */
    public function testArticleEdit(): void
    {
        $response = $this->withSession(['user' => $this->user])
            ->get('/article/' . $this->article->slug . '/update');
        $response->assertOk();
        $response = $this->withSession(['user' => $this->user])
            ->put('/article/' . $this->article->slug, [
                'title'   => 'new',
                'content' => 'Article updated in unit tests',
                'subject' => 'Update'
            ]);
        $response->assertRedirect('/article/new');
    }

    public function testArticleDeletion(): void
    {

    }
}
