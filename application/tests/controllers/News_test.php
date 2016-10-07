<?php

/**
*
*/
class News_test extends TestCase
{

  public static function setUpBeforeClass() {
    parent::setUpBeforeClass();

    $CI =& get_instance();
    $CI->load->library('Seeder');
    $CI->seeder->call('NewsSeeder');
  }

  public function test_When_access_news_Then_see_news_index_view() {
    $output = $this->request('GET', '/news');
    $this->assertContains('<h1>News archive</h1>', $output);
    $this->assertContains('<h3>News test</h3>', $output);
  }

  public function test_When_access_new_with_not_exiting_slug_Then_get_404() {
    $slug = 'not-exiting-slug';
    $output = $this->request('GET', "/news/$slug");
    $this->assertResponseCode(404);
  }

  public function test_When_access_news_with_slug_Then_see_the_item() {
    $slug = 'news-test';
    $output = $this->request('GET', "/news/$slug");
    $this->assertContains('<h1>News test</h1>', $output);
  }

  public function test_When_post_valid_news_item_Then_see_successful_message() {
    $output = $this->request(
      'POST',
      '/news/create',
      [
        'title' => 'CodeIgniter is easy to write tests',
        'text' => 'You can write tests for controllers very easily',
      ]
    );
    $this->assertContains('Successfully Created', $output);
  }

  public function test_When_access_news_Then_see_two_items() {
    $output = $this->request('GET', '/news');
    $this->assertContains('News test', $output);
    $this->assertContains('CodeIgniter is easy to write tests', $output);
  }

  public function test_When_post_invalid_news_item_Then_see_error_messages() {
    $output = $this->request(
      'POST',
      '/news/create',
      [
        'title' => '',
        'text' => '',
      ]
    );
    $this->assertContains('The Title field is required', $output);
    $this->assertContains('The Text field is required', $output);
  }
}