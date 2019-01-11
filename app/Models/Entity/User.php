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
 * @Table(name="user")
 * @uses      User
 */
class User extends Model
{
    /**
     * @var int $id 主键ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $nickname 用户昵称
     * @Column(name="nickname", type="string", length=25, default="")
     */
    private $nickname;

    /**
     * @var string $photoUrl 用户头像Url
     * @Column(name="photo_url", type="string", length=100, default="")
     */
    private $photoUrl;

    /**
     * @var string $account 用户账号
     * @Column(name="account", type="string", length=25, default="")
     */
    private $account;

    /**
     * @var string $password 用户密码
     * @Column(name="password", type="string", length=50, default="")
     */
    private $password;

    /**
     * @var int $status 用户状态[0:正常 1:禁用]
     * @Column(name="status", type="tinyint", default=0)
     */
    private $status;

    /**
     * @var string $createdTime 创建时间
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
     * 用户昵称
     * @param string $value
     * @return $this
     */
    public function setNickname(string $value): self
    {
        $this->nickname = $value;

        return $this;
    }

    /**
     * 用户头像Url
     * @param string $value
     * @return $this
     */
    public function setPhotoUrl(string $value): self
    {
        $this->photoUrl = $value;

        return $this;
    }

    /**
     * 用户账号
     * @param string $value
     * @return $this
     */
    public function setAccount(string $value): self
    {
        $this->account = $value;

        return $this;
    }

    /**
     * 用户密码
     * @param string $value
     * @return $this
     */
    public function setPassword(string $value): self
    {
        $this->password = $value;

        return $this;
    }

    /**
     * 用户状态[0:正常 1:禁用]
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * 创建时间
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
     * 用户昵称
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * 用户头像Url
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    /**
     * 用户账号
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * 用户密码
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 用户状态[0:正常 1:禁用]
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 创建时间
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
