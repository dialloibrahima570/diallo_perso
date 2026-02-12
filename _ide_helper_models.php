<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereUpdatedAt($value)
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $titre
 * @property string $description
 * @property string|null $fichier_cv
 * @property int $visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereFichierCv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereVisible($value)
 */
	class Cv extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $action
 * @property string $email
 * @property int|null $request_item_id
 * @property string|null $type
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereRequestItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereUpdatedAt($value)
 */
	class History extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $type
 * @property string $message
 * @property int $read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $technos
 * @property string|null $description
 * @property string $date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTechnos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $project
 * @property string $message
 * @property string $type
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereProject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectRequest whereUpdatedAt($value)
 */
	class ProjectRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $email
 * @property string|null $project_name
 * @property string|null $message
 * @property string $status
 * @property string|null $admin_message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereAdminMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereProjectName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestItem whereUpdatedAt($value)
 */
	class RequestItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $annees_experience
 * @property int $projets_realises
 * @property int $clients_satisfaits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique whereAnneesExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique whereClientsSatisfaits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique whereProjetsRealises($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Statistique whereUpdatedAt($value)
 */
	class Statistique extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $message
 * @property int $approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelechargerCV whereUpdatedAt($value)
 */
	class TelechargerCV extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property bool $notifications
 * @property array<array-key, mixed>|null $notification_types
 * @property bool $dark_mode
 * @property string $theme_color
 * @property string $language
 * @property string $timezone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereDarkMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereNotificationTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereThemeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSetting whereUserId($value)
 */
	class UserSetting extends \Eloquent {}
}

