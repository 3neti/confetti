<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static GOOD_PUBLICITY()
 * @method static static BAD_PUBLICITY()
 * @method static static PREMATURE_CAMPAIGNING()
 * @method static static VOTE_BUYING()
 * @method static static VOTING_DELAYED()
 * @method static static VOTING_DENIED()
 * @method static static POLLING_AREA_VIOLENCE()
 * @method static static POLLING_AREA_POLICE()
 * @method static static POLLING_AREA_MILITARY()
 * @method static static FAILED_VCM_TESTING()
 * @method static static FAILED_VCM_MALFUNCTION()
 * @method static static FAILED_VCM_COUNT()
 * @method static static FAILED_VCM_PRINTING()
 * @method static static FAILED_VCM_TRANSMISSION()
 */
final class IncidentType extends Enum
{
    const GOOD_PUBLICITY = 'good publicity';
    const BAD_PUBLICITY = 'bad publicity';
    const PREMATURE_CAMPAIGNING = 'premature campaigning';
    const VOTE_BUYING = 'vote buying';
    const VOTING_DELAYED = 'voting delayed';
    const VOTING_DENIED = 'voting denied';
    const POLLING_AREA_VIOLENCE = 'polling area violence';
    const POLLING_AREA_POLICE = 'polling area police';
    const POLLING_AREA_MILITARY = 'polling area military';
    const FAILED_VCM_TESTING = 'failed vcm testing';
    const FAILED_VCM_MALFUNCTION = 'failed vcm malfunction';
    const FAILED_VCM_COUNT = 'failed vcm count';
    const FAILED_VCM_PRINTING = 'failed vcm printing';
    const FAILED_VCM_TRANSMISSION = 'failed vcm transmission';
}
