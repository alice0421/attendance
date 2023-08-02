<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Entities;

use App\Domains\Auth\Domain\ValueObjects\MentorCodeVO;
use App\Domains\Auth\Domain\ValueObjects\MentorEmailVO;
use App\Domains\Auth\Domain\ValueObjects\MentorIdVO;
use App\Domains\Auth\Domain\ValueObjects\MentorNameVO;
use App\Models\Mentor;

/**
 * メンター登録の出力Entity
 */
class MentorRegisterOutputEntity
{
    /**
     * @var MentorCodeVO
     */
    private MentorCodeVO $code;

    /**
     * @var MentorEmailVO
     */
    private MentorEmailVO $email;

    /**
     * @var MentorIdVO
     */
    private MentorIdVO $id;

    /**
     * @var MentorNameVO
     */
    private MentorNameVO $name;

    /**
     * @param MentorCodeVO $code
     * @param MentorEmailVO $email
     * @param MentorIdVO $id
     * @param MentorNameVO $name
     */
    public function __construct(MentorCodeVO $code, MentorEmailVO $email, MentorIdVO $id, MentorNameVO $name)
    {
        $this->code = $code;
        $this->email = $email;
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @param Mentor $model
     * @return self
     */
    public static function createFromModel(Mentor $model): self
    {
        return new self(
            MentorCodeVO::create($model->code),
            MentorEmailVO::create($model->email),
            MentorIdVO::create($model->id),
            MentorNameVO::create($model->name),
        );
    }

    /**
     * @return MentorCodeVO
     */
    public function getCode(): MentorCodeVO
    {
        return $this->code;
    }

    /**
     * @return MentorEmailVO
     */
    public function getEmail(): MentorEmailVO
    {
        return $this->email;
    }

    /**
     * @return MentorIdVO
     */
    public function getId(): MentorIdVO
    {
        return $this->id;
    }

    /**
     * @return MentorNameVO
     */
    public function getName(): MentorNameVO
    {
        return $this->name;
    }
}
