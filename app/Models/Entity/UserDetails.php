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
 * @Table(name="user_details")
 * @uses      UserDetails
 */
class UserDetails extends Model
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
     * @var string $wechatAccount 微信账号
     * @Column(name="wechat_account", type="string", length=25, default="")
     */
    private $wechatAccount;

    /**
     * @var string $email 电子邮件
     * @Column(name="email", type="string", length=25)
     */
    private $email;

    /**
     * @var string $mobile 电话号码
     * @Column(name="mobile", type="string", length=15)
     */
    private $mobile;

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
     * 微信账号
     * @param string $value
     * @return $this
     */
    public function setWechatAccount(string $value): self
    {
        $this->wechatAccount = $value;

        return $this;
    }

    /**
     * 电子邮件
     * @param string $value
     * @return $this
     */
    public function setEmail(string $value): self
    {
        $this->email = $value;

        return $this;
    }

    /**
     * 电话号码
     * @param string $value
     * @return $this
     */
    public function setMobile(string $value): self
    {
        $this->mobile = $value;

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
     * 用户ID
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 微信账号
     * @return string
     */
    public function getWechatAccount()
    {
        return $this->wechatAccount;
    }

    /**
     * 电子邮件
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * 电话号码
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
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
