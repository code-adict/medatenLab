<?php
//First we need to introduce the namespace
namespace App\Enums;

enum VisitTypeEnums: string {
    case IN_HOUSE = 'in-house';

    case IN_HOSPITAL = 'in-hospital';
}
