<?php

namespace model;

class rewardModel extends AbstractModel
{
  public string $name;
  public int $price;
  public string $user_id;
  protected static $SESSION_NAME = '_reward';
}