<?php

namespace model;

class FitnessModel extends AbstractModel
{
  public string $name;
  public string $description;
  public int $level;
  public string $user_id;
  public int $delete_flag;
  protected static $SESSION_NAME = '_fitness';
}