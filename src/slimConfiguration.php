<?php

namespace src;

function slimConfiguration()
{
  $configuration = [
    'settings' => [
      'displayErrorDetails' => getenv('DISPLAY_ERRORS_DEFAULT'),
    ],
  ];
  return new \Slim\Container($configuration);
}