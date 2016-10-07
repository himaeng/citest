<?php

/**
*
*/
class Play_with_mocks_Test extends TestCase
{

  public function test_mocking_Temperature_convert() {
    $mock = $this->getMockBuilder('Temperature_converter')
      ->getMock();
    $mock->method('FtoC')->willReturn(99.9);

    $mock2 =$this->getMockBuilder('Temperature_converter')
      ->setMethods(['FtoC'])
      ->getMock();
    $mock2->method('FtoC')->willReturn(99.9);
    //eval(\Psy\sh());
  }
}