<?php

namespace App\Enums;

enum NotificationType: string
{
    case REGISTRATION = 'registration';
    case PROFILE_UPDATE = 'profile_update';
    case NEW_COMMENT = 'new_comment';
    case NEW_ARTICLE = 'new_article';
    case STATISTICS = 'statistics';
    case DEFAULT = 'default';
}