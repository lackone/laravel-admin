<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    protected $connection = 'mysql';

    protected $guarded = ['_token'];

    /**
     * 指示模型是否主动维护时间戳。
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * 与数据表关联的主键。
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 模型日期字段的存储格式。
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * 序列化日期
     *
     * @param DateTimeInterface $date
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->getDateFormat());
    }

    /**
     * 获取列表
     * @param $key
     * @param $value
     */
    protected function optionList($key, $value, $where = [])
    {
        return $this->where($where)->pluck($value, $key)->toArray();
    }
}
