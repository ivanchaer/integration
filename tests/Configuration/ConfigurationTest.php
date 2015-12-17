<?php

/**
 * @file
 * Contains ConfigurationTest.
 */

namespace Drupal\integration\Tests\Configuration;

use Drupal\integration\Configuration\AbstractConfiguration;
use Drupal\integration\Tests\AbstractTest;

/**
 * Class ConfigurationTest.
 *
 * @group configuration
 *
 * @package Drupal\integration\Tests\Configuration
 */
class ConfigurationTest extends AbstractTest {

  /**
   * Test configuration properties setters.
   */
  public function testSetters() {
    /** @var AbstractConfiguration $configuration */
    $configuration = entity_create('integration_backend', []);
    $expected_settings = [
      'a' => [
        'b' => ['c' => 1],
        'd' => ['e' => 2],
      ],
      'f' => 3,
    ];

    $configuration->setPluginSetting('a.b.c', 1);
    $configuration->setPluginSetting('a.d.e', 2);
    $configuration->setPluginSetting('f', 3);
    $this->assertEquals($expected_settings, $configuration->getPluginSettings());

    $configuration->setComponentSetting('component', 'a.b.c', 1);
    $configuration->setComponentSetting('component', 'a.d.e', 2);
    $configuration->setComponentSetting('component', 'f', 3);
    $this->assertEquals($expected_settings, $configuration->getComponentSettings('component'));
  }

  /**
   * Test configuration properties getters.
   */
  public function testGetters() {
    /** @var AbstractConfiguration $configuration */
    $configuration = entity_create('integration_backend', []);
    $configuration->setPluginSetting('a', [
      'b' => ['c' => 1],
      'd' => ['e' => 2],
    ]);
    $this->assertEquals(1, $configuration->getPluginSetting('a.b.c'));
    $this->assertEquals(2, $configuration->getPluginSetting('a.d.e'));

    $configuration->setComponentSetting('component', 'a', [
      'b' => ['c' => 1],
      'd' => ['e' => 2],
    ]);
    $this->assertEquals(1, $configuration->getComponentSetting('component', 'a.b.c'));
    $this->assertEquals(2, $configuration->getComponentSetting('component', 'a.d.e'));
  }

}