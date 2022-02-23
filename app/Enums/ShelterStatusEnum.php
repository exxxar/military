<?php

namespace App\Enums;

enum ShelterStatusEnum: int
{
    case NOT_VERIFIED = 0; //НЕ ПРОВЕРЕНО
    case ACTIVE = 1; //ДЕЙСТВУЮЩЕЕ
    case DESTROYED = 2; //РАЗРУШЕНОЕ
    case MISSING = 3; //ОТСУТСТВУЕТ

}
