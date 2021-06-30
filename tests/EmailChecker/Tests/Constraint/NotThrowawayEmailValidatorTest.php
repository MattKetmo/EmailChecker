<?php

/*
 * This file is part of the EmailChecker package.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EmailChecker\Tests\Constraint;

use EmailChecker\Constraints\NotThrowawayEmail;
use EmailChecker\Constraints\NotThrowawayEmailValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class NotThrowawayEmailValidatorTest extends TestCase
{
    protected $context;
    protected $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->context = $this->createMock(ExecutionContextInterface::class);
        $this->validator = new NotThrowawayEmailValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->context = null;
        $this->validator = null;
    }

    public function testNullIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, new NotThrowawayEmail());
    }

    public function testEmptyStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('', new NotThrowawayEmail());
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedTypeException::class);

        $this->validator->validate(new \stdClass(), new NotThrowawayEmail());
    }

    /**
     * @dataProvider getValidEmails
     */
    public function testValidEmails($email)
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate($email, new NotThrowawayEmail());
    }

    public function getValidEmails()
    {
        return [
            ['matthieu@moquet.com'],
            ['john.doe@gmail.com'],
        ];
    }

    /**
     * @dataProvider getInvalidEmails
     */
    public function testInvalidEmails($email)
    {
        $constraint = new NotThrowawayEmail([
            'message' => 'myMessage',
        ]);

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->validator->validate($email, $constraint);
    }

    public function getInvalidEmails()
    {
        return [
            // Invalid emails
            ['example@'],
            ['example@example.com@example.com'],
            // Throwaway emails
            ['example@yopmail.com'],
            ['example@trashmail.net'],
        ];
    }
}
