<?php
namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * @Entity()
 * @Table(name="user_login")
 * @uses      UserLogin
 */
class UserLogin extends Model
{
    /**
     * @var int $id 主键ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $userId 用户ID
     * @Column(name="user_id", type="integer")
     * @Required()
     */
    private $userId;

    /**
     * @var int $exception 异常登录[0:正常 1:异常]
     * @Column(name="exception", type="tinyint", default=0)
     */
    private $exception;

    /**
     * @var string $createdTime 登录时间
     * @Column(name="created_time", type="timestamp", default="0000-00-00 00:00:00")
     */
    private $createdTime;

    /**
     * @var string $updateTime 修改时间
     * @Column(name="update_time", type="timestamp", default="0000-00-00 00:00:00")
     */
    private $updateTime;

    /**
     * 主键ID
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 用户ID
     * @param int $value
     * @return $this
     */
    public function setUserId(int $value): self
    {
        $this->userId = $value;

        return $this;
    }

    /**
     * 异常登录[0:正常 1:异常]
     * @param int $value
     * @return $this
     */
    public function setException(int $value): self
    {
        $this->exception = $value;

        return $this;
    }

    /**
     * 登录时间
     * @param string $value
     * @return $this
     */
    public function setCreatedTime(string $value): self
    {
        $this->createdTime = $value;

        return $this;
    }

    /**
     * 修改时间
     * @param string $value
     * @return $this
     */
    public function setUpdateTime(string $value): self
    {
        $this->updateTime = $value;

        return $this;
    }

    /**
     * 主键ID
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 用户ID
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 异常登录[0:正常 1:异常]
     * @return int
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * 登录时间
     * @return mixed
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * 修改时间
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

}
