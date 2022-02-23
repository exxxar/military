<?php

namespace App\Enums;

enum QualityStateEnum: int
{
    case UNKNOWN = 0; //НЕИЗВЕСТНОЕ СОСТОЯНИЕ
    case NORMAL = 1; //В НОРМАЛЬНОМ СОСТОЯНИИ
    case NOT_ACCEPTABLE = 2; //НЕ ПРИЕМЛИМОЕ СОСТОЯНИЕ
    case FLOODED = 3; //ПОДТОПЛЕННОЕ

}
