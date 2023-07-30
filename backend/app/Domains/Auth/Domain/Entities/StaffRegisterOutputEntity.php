<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Entities;

use App\Domains\Auth\Domain\ValueObjects\StaffCodeVO;
use App\Domains\Auth\Domain\ValueObjects\StaffEmailVO;
use App\Domains\Auth\Domain\ValueObjects\StaffIdVO;
use App\Domains\Auth\Domain\ValueObjects\StaffNameVO;
use App\Models\Staff;

/**
 * 運営登録の出力Entity
 */
class StaffRegisterOutputEntity
{
    /**
     * @var StaffCodeVO
     */
    private StaffCodeVO $code;

    /**
     * @var StaffEmailVO
     */
    private StaffEmailVO $email;

    /**
     * @var StaffIdVO
     */
    private StaffIdVO $id;

    /**
     * @var StaffNameVO
     */
    private StaffNameVO $name;

    /**
     * @param StaffCodeVO $code
     * @param StaffEmailVO $email
     * @param StaffIdVO $id
     * @param StaffNameVO $name
     */
    public function __construct(StaffCodeVO $code, StaffEmailVO $email, StaffIdVO $id, StaffNameVO $name)
    {
        $this->code = $code;
        $this->email = $email;
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @param Staff $model
     * @return self
     */
    public static function createFromModel(Staff $model): self
    {
        return new self(
            StaffCodeVO::create($model->code),
            StaffEmailVO::create($model->email),
            StaffIdVO::create($model->id),
            StaffNameVO::create($model->name)
        );
    }

    /**
     * @return StaffCodeVO
     */
    public function getCode(): StaffCodeVO
    {
        return $this->code;
    }

    /**
     * @return StaffEmailVO
     */
    public function getEmail(): StaffEmailVO
    {
        return $this->email;
    }

    /**
     * @return StaffIdVO
     */
    public function getId(): StaffIdVO
    {
        return $this->id;
    }

    /**
     * @return StaffNameVO
     */
    public function getName(): StaffNameVO
    {
        return $this->name;
    }
}
