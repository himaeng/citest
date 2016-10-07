<?php

/**
*
*/
class Auth_test extends TestCase
{

  public function test_When_not_login_Then_redirected()
  {
    $this->request('GET', 'auth');
    $this->assertRedirect('auth/login');
  }

  public function tet_When_admin_user_get_auth_Then_returns_user_list() {
    $this->request->setCallable(
      function ($CI) {
        $auth = $this->getDouble(
          'Ion_auth', ['logged_in' => true, 'is_admin' => true]
        );
        $CI->ion_auth = $auth;
      }
    );

    $output = $this->request('GET', 'auth');
    $this->assertContains('Below is a list of the users', $output);
  }
}