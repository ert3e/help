<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackBase extends BaseModel
{

    /**
     * @var string ТИП ЗАПРОСА - по умолчанию
     */
    const FEEDBACK_DEFAULT = 'DEFAULT';

    /**
     * @var string ТИП ЗАПРОСА - волонтер
     */
    const FEEDBACK_VOLUNTEER = 'VOLUNTEER';

    /**
     * @var string ТИП ЗАПРОСА - нужна помощь
     */
    const FEEDBACK_HELP = 'HELP';

    public $table = 'feedbacks';

    public static function getTypes() {
        return [
            self::FEEDBACK_DEFAULT      => 'Обращение',
            self::FEEDBACK_VOLUNTEER    => 'Стать волонтером',
            self::FEEDBACK_HELP         => 'Нужна помощь',
        ];
    }

    public function getType() {
        return self::getTypes()[$this->type];
    }

    public function setType($type) {
        if (array_key_exists($type, self::getTypes())) {
            $this->type = $type;
        }
    }

}
