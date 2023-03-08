<?php

namespace Core;

class Authorization extends Authentication
{
    public function getUserGroup(): int
    {
        $userGroup = $this->getUserSessionInfo('userGroup');
        if ($userGroup) {
            switch ($userGroup) {
                case 'Standard User':
                    $level = 1;
                    break;
                case 'Admin':
                    $level = 2;
                    break;
            }
        }
        return $level;
    }
}