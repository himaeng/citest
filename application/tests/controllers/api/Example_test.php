<?php

/**
*
*/
class Example_test extends TestCase
{

  public function test_When_get_valid_user_id_Then_returns_the_user_data() {
    $json = '{"id":1,"name":"John","email":"john@example.com","fact":"Loves coding"}';

    $output = $this->request('GET', 'api/example/users/id/1');
    $this->assertJsonStringEqualsJsonString($json, $output);
    $this->assertResponseCode(200);
  }


  public function test_When_get_not_found_user_id_Then_returns_error() {
    $output = $this->request('GET', 'api/example/users/id/5');
    $data = json_decode($output, true);
    $this->assertFalse($data['status']);
    $this->assertResponseCode(404);
  }

  public function test_When_post_user_data_Then_returns_created() {
    $post = [
      'name' => 'Ming',
      'email' => 'mingnoi@example.com',
    ];

    $output = $this->request('POST', 'api/example/users', $post);
    $data = json_decode($output, true);

    $this->assertEquals($post['name'], $data['name']);
    $this->assertResponseCode(201);
  }


}